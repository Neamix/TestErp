<?php

namespace App;

use App\Http\Helpers\Mailer;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Traits\upsertTrait;
use App\Traits\generateToken;
use App\Traits\validationTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable,upsertTrait,generateToken,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $with = [
        'priviledges'
    ];

    public function setLocal($local) {

        if(!in_array($local,['en','ar'])) {
            abort(404);
        }

        $user = Auth::user();
        $user->lang = $local;
        $user->save();
    }

    public function createInstance() {
        $user = User::create([]);
        return $user->updateInstance($this->toArray());
    }

    static function validationResult($result,$message) {
        return [
            'result' => $result,
            'message' => $message
        ];
    }

    public function updateInstance($data) {
        $password = $this->password ?? null;
        $user = User::updateOrCreate(
            ['id' => $this->id ?? null],
            [
                'email' => $data['email'],
                'name'  => $data['name'],
                'password' => isset($data['password']) ? Hash::make($data['password']) : $password,
                'grade'  => $data['grade'] ?? null,
                'type'   => $data['type'],
                'join_date' => Carbon::now(),
            ]
        );

        if( ! $data['id'] ) {
            $token = self::token($user);
            Mailer::verifyUser($user,$token);
            return self::validationResult('success',__('system.user_has_been_created_successfully'));
        }

        return self::validationResult('success',__('validation.user_has_been_updated_successfully'));
    }

    public static function filter($request) {

        $builder = User::select('*');

        if(isset($request['name']) && ! empty($request['name'])) {
            $builder->where('name','like','%'.$request['name'].'%');
        }

        if(isset($request['type']) && ! empty($request['type'])) {
            $builder->where('type',$request['type']);
        }

        if(isset($request['active']) && ! empty($request['active'])) {
            $builder->where('active',$request['active']);
        }

        // dd($builder->toSql());

        return $builder;

    }

    public function sendPasswordResetNotification($token)
    {
        Mailer::forgetPassword($this,$token);

        return redirect('/login');
    }

    public function avatarModify($avatar) {
        $name = 'user_'.Auth::id().'.jpg';
        move_uploaded_file($avatar,public_path('assets/images/users/').$name);
        Auth::user()->avatar = $name;
        Auth::user()->save();
        return self::validationResult('success',__('validation.avatar_has_been_modified'));
    }

    public function priviledges() {
        return $this->belongsToMany(Priviledge::class,'user_priviledge');
    }

    public function hasPriviledge($priviledge,$super = false) {

        $hasPriviledge = ($super) ?  $this->priviledges->whereId('id',[SUPER_ADMIN,$priviledge]) : $this->priviledges->whereIn('id',[SUPER_ADMIN,SYSTEM_ADMIN,$priviledge]);
        if($hasPriviledge->count()) {
            return true;
        } else {
            return false;
        }
    }

    public function modifyPriviledges($priviledges) {

        if($this->hasPriviledge(SUPER_ADMIN) || $this->hasPriviledge(SYSTEM_ADMIN)) {
            $authIsAdmin = Auth::user()->priviledges->where('id',SUPER_ADMIN)->count();

            if( ! $authIsAdmin ) {
                return self::validationResult('fail',__('validation.un_expected_error'));
            }
        } 

        $this->priviledges()->sync($priviledges);

        return self::validationResult('success',__('validation.user_priviledges_has_been_modified'));

    }

    public function allowedToActionOn() {

        //prevent anyone from remove super admin except another super admin
        if($this->hasPriviledge(SUPER_ADMIN) || $this->hasPriviledge(SYSTEM_ADMIN)) {
            if(Auth::user()->hasPriviledge(SUPER_ADMIN)) {
                return true;
            } else {
                return false;
            }
        }

        return true;
    } 

    public function toggleActive() {
        if( $this->active == ACTIVE ) {
            $this->active = SUSPEND;
        } else {
            $this->active = ACTIVE;
        }

        $this->save();
        $state = ($this->active) ? 'Activated' : 'Suspended';

        return self::validationResult('success',__('validation.this_user_state_changed_to',['state' => $state]));
    }

    public function toggleAdmin() {
        $this->priviledges()->toggle([SYSTEM_ADMIN]);
        return self::validationResult('success','');
    }

    public function isAdmin() :bool
    {
        return $this->priviledges()->whereIn('priviledges.id',[SYSTEM_ADMIN,SUPER_ADMIN])->count();
    }

    public function teacher() {
        return $this->belongsTo(Teacher::class,'id');
    }

    public function crew() {
        return $this->belongsTo(Crew::class,'id');
    }

    public function student() {
        return $this->belongsTo(Student::class,'id');
    }
}
