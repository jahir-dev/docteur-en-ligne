<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        factory(App\Models\Tag::class, 20)->create();
        factory(App\Models\Specialite::class, 5)->create();
        
        $tags = App\Models\Tag::all();
        
        // Populate the pivot table
        App\Models\Specialite::all()->each(function ($specialite) use ($tags) {
            $specialite->tags()->attach(
                $tags->random(rand(1, 5))->pluck('id')->toArray()
            );
        });
        
        factory(App\Models\Medecin::class, 20)->create();

        

        factory(App\Models\Post::class, 10)->create();

        // Populate the pivot table
        $medecins = App\Models\Medecin::all();

        App\Models\Post::all()->each(function ($post) use ($medecins) {

            $post->medecins()->attach(
                $medecins->random(rand(1, 5))->pluck('id')->toArray()
            );

            $reponses = $post->medecins;

            foreach($reponses as $reponse)
            {
                $post->medecins()->updateExistingPivot($reponse->id, ['reponse' => "testing "]);
            }

        });


    }
}
