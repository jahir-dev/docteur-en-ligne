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
        //tags
        factory(App\Models\Tag::class, 20)->create();
        //Specialite
        factory(App\Models\Specialite::class, 5)->create();
        
        //get Tags
        $tags = App\Models\Tag::all();
        
        // Attach Tags to specialite
        App\Models\Specialite::all()->each(function ($specialite) use ($tags) {
            $specialite->tags()->attach(
                $tags->random(rand(2, 5))->pluck('id')->toArray()
            );
        });
        
        //Medecins
        factory(App\Models\Medecin::class, 20)->create();
        //Internaute
        factory(App\Models\Internaute::class, 10)->create();
        //Posts
        factory(App\Models\Post::class, 10)->create();

        // get Medecins
        $medecins = App\Models\Medecin::all();
        // get Internaute
        // $internautes = App\Models\Internaute::all();

        //Attach medecins response to posts
        App\Models\Post::all()->each(function ($post) use ($medecins, $tags) {
            $post->tags()->attach(
                $tags->random(rand(1,5))->pluck('id')->toArray()
            );
            $post->medecins()->attach(
                $medecins->random(rand(1, 5))->pluck('id')->toArray()
            );

            $reponses = $post->medecins;

            foreach($reponses as $reponse)
            {
                $post->medecins()->updateExistingPivot($reponse->id, ['reponse' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur, earum fugit? Et odio debitis quibusdam nam quos, perspiciatis officia numquam quae facilis. "]);
            }

        });

    }
}
