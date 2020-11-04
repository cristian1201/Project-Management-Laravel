<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin')
        ]);

        $role = Role::create(['name' => 'Admin']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);
//        $role->syncPermissions([1, 2, 3, 4, 5, 6, 7, 8]);

        $user->assignRole([$role->id]);
        User::create([
            'name'=>'user1',
            'email'=>'user1@gmail.com',
            'password'=>bcrypt('asdf'),
            'team_id' => 1,
            'is_leader' => true,
        ]);
        User::create([
            'name'=>'user2',
            'email'=>'user2@gmail.com',
            'password'=>bcrypt('asdf'),
            'team_id' => 1
        ]);
        User::create([
            'name'=>'user3',
            'email'=>'user3@gmail.com',
            'password'=>bcrypt('asdf'),
            'team_id' => 2
        ]);
    }
}
