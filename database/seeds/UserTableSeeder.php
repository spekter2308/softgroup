<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
        	[
        		'name' => 'Admin',
				'email' => 'admin@g.g',
				'password' => bcrypt('admin'),
			],
			[
				'name' => 'Editor',
				'email' => 'editor@g.g',
				'password' => bcrypt('editor'),
			],
			[
				'name' => 'user',
				'email' => 'user@g.g',
				'password' => bcrypt('user'),
			],
		];

        DB::table('users')->insert($data);
    }
}
