<?php

namespace Database\Seeders;

use App\Models\Cusers;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cusers::factory()->count(10)->create();
    }
}
