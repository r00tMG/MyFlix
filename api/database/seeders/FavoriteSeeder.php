<?php

namespace Database\Seeders;

use App\Models\Favorite;
use Database\Factories\FavoriteFactory;
use Illuminate\Database\Seeder;

class FavoriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Favorite::factory(20)->create();
    }
}
