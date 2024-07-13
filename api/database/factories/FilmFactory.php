<?php

namespace Database\Factories;

use App\Models\Film;
use Illuminate\Database\Eloquent\Factories\Factory;

class FilmFactory extends Factory
{
    protected $model = Film::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
       /* $table->string('titre');
        $table->string('genre');
        $table->text('description')->nullable();
        $table->string('realisateur');
        $table->date('date_de_sortie');
        $table->integer('duree');
        $table->string('affiche')->nullable();*/
        return [
            'titre' => $this->faker->text(10),
            'genre' => $this->faker->text(10),
            'description' => $this->faker->text(1000),
            'realisateur' => $this->faker->text(20),
            'date_de_sortie' => $this->faker->date,
            'duree' => $this->faker->numberBetween(),
            'affiche' => $this->faker->imageUrl(),
            'film' => $this->faker->randomElement([
                'https://www.youtube.com/embed/NcucthcnGY0?si=_kToGcy_dU1R3ceD',
                'https://www.youtube.com/embed/yrL5eCMpqtc?si=BqzPUIOth63MPC1H',
                'https://www.youtube.com/embed/0g7HqfsCX4Y?si=haMraSRGE3KYtXnQ',
                'https://www.youtube.com/embed/XE4g1Tl6RQw?si=Ub58Knz-51x2lDst',
            ]),


        ];
    }
}
