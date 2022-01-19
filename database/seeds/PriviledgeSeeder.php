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
            'parent_id' => null,
            'name' => 'View User List'
        ]);

        Priviledge::updateOrCreate([
            'id' => 2,
            'constant' => 'EDIT_USER',
            'parent_id' => VIEW_USER_LIST,
            'name' => 'Edit User'
        ]);

        Priviledge::updateOrCreate([
            'id' => 3,
            'constant' => 'DELETE_USER',
            'parent_id' => VIEW_USER_LIST,
            'name' => 'Delete User'
        ]);

        Priviledge::updateOrCreate([
            'id' => 4,
            'constant' => 'SUSBEND_USER',
            'parent_id' => VIEW_USER_LIST,
            'name' => 'Susbend User'
        ]);

        Priviledge::updateOrCreate([
            'id' => 5,
            'constant' => 'TRASH_USER',
            'parent_id' => VIEW_USER_LIST,
            'name' => 'Trash User'
        ]);

        Priviledge::updateOrCreate([
            'id' => 6,
            'constant' => 'VIEW_USER_PRIVILEDGES',
            'parent_id' => null,
            'name' => 'View User Priviledges'
        ]);

        Priviledge::updateOrCreate([
            'id' => 7,
            'constant' => 'EDIT_USER_PRIVILEDGES',
            'parent_id' => VIEW_USER_PRIVILEDGES,
            'name' => 'Edit User Priviledges'
        ]);

        Priviledge::updateOrCreate([
            'id' => 8,
            'constant' => 'REMOVE_USER_PRIVILEDGES',
            'parent_id' => VIEW_USER_PRIVILEDGES,
            'name' => 'Remove User Priviledges'
        ]);

        Priviledge::updateOrCreate([
            'id' => 9,
            'constant' => 'SUPER_ADMIN',
            'parent_id' => null,
            'name' => 'Super Admin'
        ]);

        Priviledge::updateOrCreate([
            'id' => 10,
            'constant' => 'SYSTEM_ADMIN',
            'parent_id' => null,
            'name' => 'SYSTEM Admin'
        ]);
    }
}
