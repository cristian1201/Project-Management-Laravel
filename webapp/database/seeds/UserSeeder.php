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
            'username'=>'admin',
            'telephone'=>'000000',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'position' => null
        ]);

        $role = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
        User::create([
            'name'=>'user1',
            'username'=>'user1',
            'telephone'=>'000000',
            'email'=>'user1@gmail.com',
            'password'=>bcrypt('asdf'),
            'team_id' => 1,
            'position' => 0,
        ])->assignRole([$userRole->id]);
        User::create([
            'name'=>'user2',
            'username'=>'user2',
            'telephone'=>'000000',
            'email'=>'user2@gmail.com',
            'password'=>bcrypt('asdf'),
            'team_id' => 1,
            'position' => 1
        ])->assignRole([$userRole->id]);
        User::create([
            'name'=>'user3',
            'username'=>'user3',
            'telephone'=>'000000',
            'email'=>'user3@gmail.com',
            'password'=>bcrypt('asdf'),
            'team_id' => 2,
        ])->assignRole([$userRole->id]);
    }
}
