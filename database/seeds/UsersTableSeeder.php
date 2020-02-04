<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
          [
            'name'     => 'Admin',
            'email'    => 'admin@test.com',
            'password' => Hash::make('123456789'),
          ],
          [
            'name'     => 'User',
            'email'    => 'user@test.com',
            'password' => Hash::make('123456789')
          ]
        ];
        foreach ($users as $key => $user) {
          User::updateOrCreate(
            ['email' => $user['email']],
            [
              'name'     => $user['name'],
              'password' => $user['password'],
            ]
          );
        }
    }
}
