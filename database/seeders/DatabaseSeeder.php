<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Critic;
use App\Models\Language;
use App\Models\Film;
use App\Models\Actor;
use App\Models\ActorFilm;
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
        //Teacher::factory(10)->has(Classe::factory(3)->has(Student::factory(30)))->create();
        User::factory(10)->has(Critic::factory(30))->create();

        $this->call([
            LanguageSeeder::class,
            FilmSeeder::class,
            ActorSeeder::class,
            ActorFilmSeeder::class,
            
        ]);
    }
}
