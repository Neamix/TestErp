<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Traits\upsertInstance;
use App\Traits\validationTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable,upsertInstance,validationTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

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
        return $user->updateInstance();
    }

    public function updateInstance() {
        $user = User::firstOrCreate(
            ['id' => $this->id ?? null],
            [
                'email' => $this->email,
                'name'  => $this->name,
                'password' => Hash::make($this->password),
                'active' => $this->active,
                'grade'  => $this->grade ?? null,
                'join_date' => Carbon::now(),
            ]
        );

        return validationResult('success',__('user_has_been_created_successfully'));
    }
}
