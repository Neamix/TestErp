<?php

use App\Priviledge;
use Illuminate\Database\Seeder;

class PriviledgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Priviledge::updateOrCreate([
            'id' => 1,
            'constant' => 'VIEW_USER_LIST',
            'name' => 'View User List'
        ]);

        Priviledge::updateOrCreate([
            'id' => 2,
            'constant' => 'EDIT_USER',
            'name' => 'Edit User'
        ]);

        Priviledge::updateOrCreate([
            'id' => 3,
            'constant' => 'DELETE_USER',
            'name' => 'Delete User'
        ]);

        Priviledge::updateOrCreate([
            'id' => 4,
            'constant' => 'SUSBEND_USER',
            'name' => 'Susbend User'
        ]);

        Priviledge::updateOrCreate([
            'id' => 5,
            'constant' => 'TRASH_USER',
            'name' => 'Trash User'
        ]);

        Priviledge::updateOrCreate([
            'id' => 6,
            'constant' => 'VIEW_USER_PRIVILEDGES',
            'name' => 'View User Priviledges'
        ]);

        Priviledge::updateOrCreate([
            'id' => 7,
            'constant' => 'EDIT_USER_PRIVILEDGES',
            'name' => 'Edit User Priviledges'
        ]);

        Priviledge::updateOrCreate([
            'id' => 8,
            'constant' => 'REMOVE_USER_PRIVILEDGES',
            'name' => 'Remove User Priviledges'
        ]);

        Priviledge::updateOrCreate([
            'id' => 9,
            'constant' => 'SUPER_ADMIN',
            'name' => 'Super Admin'
        ]);

        Priviledge::updateOrCreate([
            'id' => 10,
            'constant' => 'SYSTEM_ADMIN',
            'name' => 'SYSTEM Admin'
        ]);

        Priviledge::updateOrCreate([
            'id' => 11,
            'constant' => 'VIEW_SUBJECT_LIST',
            'name' => 'View subject list'
        ]);

        Priviledge::updateOrCreate([
            'id' => 12,
            'constant' => 'DELETE_SUBJECT',
            'name' => 'Delete subject'
        ]);

        Priviledge::updateOrCreate([
            'id' => 13,
            'constant' => 'EDIT_SUBJECT',
            'name' => 'Edit subject'
        ]);

        Priviledge::updateOrCreate([
            'id' => 14,
            'constant' => 'TRASH_SUBJECT',
            'name' => 'Trash subject'
        ]);
    }
}
