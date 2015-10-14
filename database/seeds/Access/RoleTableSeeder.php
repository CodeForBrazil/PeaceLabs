<?php

use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleTableSeeder extends Seeder
{
    public function run()
    {
        if (env('DB_DRIVER') == 'mysql') {
            DB::table(config('access.roles_table'))->truncate();
        } elseif (env('DB_DRIVER') == 'sqlite') {
            DB::statement('DELETE FROM '.config('access.roles_table'));
        } else {
            //For PostgreSQL or anything else

            DB::statement('TRUNCATE TABLE '.config('access.roles_table').' CASCADE');
        }

        //Create admin role, id of 1
        $role_model        = config('access.role');
        $admin             = new $role_model;
        $admin->name       = 'Administrator';
        $admin->all        = true;
        $admin->sort       = 1;
        $admin->created_at = Carbon::now();
        $admin->updated_at = Carbon::now();
        $admin->save();

        //id = 2
        $role_model       = config('access.role');
        $user             = new $role_model;
        $user->name       = 'User';
        $user->sort       = 2;
        $user->created_at = Carbon::now();
        $user->updated_at = Carbon::now();
        $user->save();
    }
}
