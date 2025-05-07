<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'firstname'    => 'nobiliaa',
            'lastname'     => 'nobiliaa',
            'fullname'     => 'nobiliaa nobiliaa',
            'email'        => 'test1@gmail.com',
            'password'     => Hash::make('Test@123'),
            'company'      => 'PSSL',
            'phone_number' => '1234567899', 
            'status'       => 'active',
        ]);

        // Assign a role (make sure the role exists)
        $user->assignRole('admin');
    }
}
