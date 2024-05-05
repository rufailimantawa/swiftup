<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FirstSuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (User::role('Super Admin')->get()->count() < 1) {
            $superAdmin = User::create([
                'fullname' => 'Super Admin',
                'username' => 'superadmin',
                'email' => 'superadmin@email.com',
                'mobile_number' => '08062800000',
                'password' => Hash::make('Super@1234')
            ]);
            $superAdmin->assignRole('Super Admin');
        } else {
            echo "System already has user with 'Super Admin' role.\n";
        }
    }
}
