<?php 

namespace App\Policies;

use Illuminate\Support\Facades\Gate;

class Gates {

    static function policies() {
        //users gates
        Gate::define('view-dashboard',[UserPolicy::class,'viewDashboard']);
        Gate::define('view-user',[UserPolicy::class,'viewAny']);
        Gate::define('edit-user',[UserPolicy::class,'editUser']);
        Gate::define('suspend-user',[UserPolicy::class,'suspendUser']);
        Gate::define('delete-user',[UserPolicy::class,'deleteUser']);
        Gate::define('trash-user',[UserPolicy::class,'trashUser']);
        Gate::define('trash-user',[UserPolicy::class,'trashUser']);
        Gate::define('super-user',[UserPolicy::class,'superAdmin']);
        //subjects gates
        Gate::define('trash-course',[UserPolicy::class,'trashCourse']);
        Gate::define('edit-course',[UserPolicy::class,'upsertCourse']);
        Gate::define('delete-course',[UserPolicy::class,'deleteCourse']);
        Gate::define('view-course',[UserPolicy::class,'viewCourse']);
    }

    static function resolve($name) {

        $gate = true;

        if($name == 'user.list' || $name == 'user.profile') {
           $gate =  Gate::allows('view-user');
        }

        if($name == 'user.edit') {
            $gate = Gate::allows('edit-user');
        }

        if($name == 'user.index') {
            $gate = Gate::allows('edit-user');
        }

        if($name == 'user.state') {
            $gate = Gate::allows('suspend-user');
        }

        if($name == 'user.soft' || $name == 'user.restore') {
            $gate = Gate::allows('trash-user');
        }

        if($name == 'course.index' || $name == 'course.schedule') {
            $gate = Gate::allows('view-course');
        }

        if($name == 'course.edit' || $name == 'course.upsert') {
            $gate = Gate::allows('edit-course');
        }

        if($name == 'course.delete') {
            $gate = Gate::allows('delete-course');
        }

        if($name == 'course.soft' || $name == 'course.restore') {
            $gate = Gate::allows('trash-course');
        }
        
        return $gate;

    }

}