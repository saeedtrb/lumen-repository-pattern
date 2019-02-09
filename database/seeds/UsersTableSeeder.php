<?php

use Illuminate\Database\Seeder;
use \App\Data\Repositories\MySql\UserRepository;
use \App\Data\Entities\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        UserRepository::newQuery()->updateOrInsert(['id' => 1], [
            'id' => 1,
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'mobile' => '09350000000',
            'password' => User::passwordHash('abc123456789'),
            'created_at' => time()
        ]);
    }
}
