<?php

namespace Database\Seeders;

use App\Models\Status;

use Illuminate\Database\Seeder;

class StatusSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::factory(3)->create();
    }
}
