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
        //
        DB::table('users')->insert([
            'first_name' => "Admin",
            'email' => 'admin@gmail.com',
            'password' => md5('123456'),
            'is_admin' => 1,
        ]);
    }
}
