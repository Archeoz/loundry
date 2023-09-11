<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [

                'nama' => 'RyanChen',
                'username' => 'Ryan',
                'email' => 'adminoutlet1@gmail.com',
                'password' => bcrypt('123'),
                'role' => 'admin',
            ],
            [
                'id_outlet' => '1',
                'nama' => 'SallyWan',
                'username' => 'Sally',
                'email' => 'kasiroutlet1@gmail.com',
                'password' => bcrypt('123'),
                'role' => 'kasir',
            ],
            [
                'id_outlet' => '1',
                'nama' => 'BenTan',
                'username' => 'Ben',
                'email' => 'owneroutlet1@gmail.com',
                'password' => bcrypt('123'),
                'role' => 'owner',
            ],
        ];
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
