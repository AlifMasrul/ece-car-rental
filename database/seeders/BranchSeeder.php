<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Branch; // Make sure you have this line

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Branch::create(['name' => 'Bandar Baru Bangi']);
        Branch::create(['name' => 'Shah Alam']);
        Branch::create(['name' => 'Gombak']);
    }
}
