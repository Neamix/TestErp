<?php

namespace App\Console\Commands;

use App\Http\Helpers\Mailer;
use App\Priviledge;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class superadmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:super {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Added Super Admin to the system';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $email = $this->argument('email');

        if( filter_var($email,FILTER_VALIDATE_EMAIL) ) {

            $existUser = User::where('email',$email)->pluck('id')->toArray();
            
            if(  count($existUser) ) {
                DB::table('user_priviledge')->insert([
                    'user_id' => $existUser[0],
                    'priviledge_id' => SUPER_ADMIN,
                ]);

                $this->info('this user become super admin now');
            } else {
                $this->error('this email doesn\'t exist in the system we will create a new record');
                $user = User::create(['id' => null,'name' => 'admin','email' => $email,'password' => NULL,'type'=>CREW,'join_date' => Carbon::now()]);
                $this->info('user created successfully');
                $user->modifyPriviledges(SUPER_ADMIN);
                $token = User::token($user);
                Mailer::verifyUser($user,$token);
                $this->warn('please go to your email to activate this user');
            }

        } else {
            $this->info('please enter a valid email to setup the user');
        }
    }
}
