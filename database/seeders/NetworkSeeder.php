<?php

namespace Database\Seeders;

use App\Models\NetworkOperator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NetworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (['MTN', "Airtel", "Glo", "9Mobile"] as $network) {
            NetworkOperator::create(['name' => $network]);
        }
    }
}
