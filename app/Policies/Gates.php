<?php 

namespace App\Policies;

use Illuminate\Support\Facades\Gate;

class Gates {

    static function policies() {

        Gate::define('view-dashboard',[UserPolicy::class,'viewDashboard']);
        Gate::define('view-user',[UserPolicy::class,'viewAny']);
        Gate::define('edit-user',[UserPolicy::class,'editUser']);

    }

    static function resolve($name) {

        $gate = true;

        if($name == 'user.filter' || $name == 'user.profile') {
           $gate =  Gate::allows('view-user');
        }

        if($name == 'user.edit') {
            $gate = Gate::allows('edit-user');
        }
        
        return $gate;

    }

}