<?php

namespace Database\Seeders;

use App\Models\Favorite;
use Database\Factories\FilmFactory;
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
        // \App\Models\User::factory(10)->create();
        $this->call([
            FilmSeeder::class,
            UserSeeder::class,
            FavoriteSeeder::class,
        ]);
    }
}
