<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class CoursePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function viewAny() {
        if(Auth::user()->hasPriviledge(VIEW_SUBJECT_LIST)) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteSubject() {
        if(Auth::user()->hasPriviledge(DELETE_SUBJECT)) {
            return true; 
        } else {
            return false;
        }
    }

    public function editSubject() {
        if(Auth::user()->hasPriviledge(EDIT_SUBJECT)) {
            return true;
        } else {
            return false;
        }
    }


    public function trashSubject() {
        if(Auth::user()->hasPriviledge(TRASH_SUBJECT)) {
            return true;
        } else {
            return false;
        }
    }

}
