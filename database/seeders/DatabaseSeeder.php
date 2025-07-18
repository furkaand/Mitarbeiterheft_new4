<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'firstname' => 'Furkan',
            'lastname' => 'Dogan',
            'email' => 'furkan@dogan.de',
            'password' => bcrypt('furkan@dogan.de'),
        ]);

        // $this->call(TestShiftSeeder::class);
    }
}
