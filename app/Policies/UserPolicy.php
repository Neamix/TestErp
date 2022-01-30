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

        return Auth::user()->hasPriviledge(VIEW_USER_LIST);
    }

    public function editUser() {

        return Auth::user()->hasPriviledge(EDIT_USER);

    }

    public function suspendUser() {

        return Auth::user()->hasPriviledge(SUSPEND_USER);

    }

    public function trashUser() {

        return Auth::user()->hasPriviledge(TRASH_USER);

    }

    public function deleteUser() {

        return Auth::user()->hasPriviledge(DELETE_USER);

    }

    public function viewDashboard() {
        return Auth::user()->hasPriviledge(SYSTEM_ADMIN);
    }
}
