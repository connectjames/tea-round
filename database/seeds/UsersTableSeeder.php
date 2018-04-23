<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['jd@connectjames.com', 'James', Hash::make('adminTeaRound'), 1, 1],
            ['test@test.com', 'Test', Hash::make('teaRound'), 3, 0],
            ['test1@test.com', 'Test1', Hash::make('teaRound1'), 5, 0],
            ['test2@test.com', 'Test2', Hash::make('teaRound2'), 10, 0],
        ];

        $count = count($users);

        foreach ($users as $key => $user) {
            User::insert([
                'email' => $user[0],
                'name' => $user[1],
                'password' => $user[2],
                'frequency' => $user[3],
                'admin' => $user[4]
            ]);
            $count--;
        }
    }
}
