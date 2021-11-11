<?php

namespace Database\Seeders;

use App\Models\Polo;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionSeeder::class);
        Polo::create(['name' => 'Ceará-Mirim']);
        User::factory(6)->create();
    }
}
