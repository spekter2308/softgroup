<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$role_admin = Role::where('name', 'admin')->first();
    	$role_editor = Role::where('name', 'editor')->first();
    	$role_user = Role::where('name', 'user')->first();

    	$admin = new User();
    	$admin->name = 'Admin';
    	$admin->email = 'admin@g.g';
    	$admin->password = bcrypt('12345678');
    	$admin->save();
    	$admin->roles()->attach($role_admin);

		$editor = new User();
		$editor->name = 'Editor';
		$editor->email = 'editor@g.g';
		$editor->password = bcrypt('12345678');
		$editor->save();
		$editor->roles()->attach($role_editor);

		$user = new User();
		$user->name = 'User';
		$user->email = 'user@g.g';
		$user->password = bcrypt('12345678');
		$user->save();
		$user->roles()->attach($role_user);

    }
}
