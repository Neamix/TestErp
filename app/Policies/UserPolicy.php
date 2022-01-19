<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
       
    }

    public function viewAny() {

        if(Auth::user()->hasPriviledge(VIEW_USER_LIST)) {
            return true;
        } else {
            return false;
        }
    }

    public function editUser() {

        if(Auth::user()->hasPriviledge(EDIT_USER)) {
            return true;
        } else {
            return false;
        }

    }

    public function suspendUser() {

        if(Auth::user()->hasPriviledge(SUSPEND_USER)) {
            return true;
        } else {
            return false;
        }

    }

    public function trashUser() {

        if(Auth::user()->hasPriviledge(TRASH_USER)) {
            return true;
        } else {
            return false;
        }

    }

    public function deleteUser() {

        if(Auth::user()->hasPriviledge(DELETE_USER)) {
            return true;
        } else {
            return false;
        }

    }

    public function viewDashboard() {
        if(Auth::user()->hasPriviledge(SYSTEM_ADMIN)) {
            return true;
        } else {
            return false;
        }
    }
}
