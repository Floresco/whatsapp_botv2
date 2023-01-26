<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\users\AccessRight;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call(AccessRightSeeder::class);
        $this->call(UserProfilSeeder::class);
        $this->call(UserSeeder::class);
    }
}
