<?php

use Illuminate\Database\Seeder;

use Faker\Generator as Faker;
use App\Comment;
use App\Post;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // seleziono solo post pubblicati
        $posts = Post::where('published', 1)->get();
        // ciclo sui posts
        foreach ($posts as $post) {
            
            // ciclo per creare n commenti
            for ($i=0; $i < rand(0, 3); $i++) { 
                
                $newComment = new Comment();
                $newComment->post_id = $post->id;
                // randomizzo tra 0 e 1 per vedere se il commento è anonimo oppure no
                if (rand(0, 1)) {
                    $newComment->name = $faker->name();
                }

                $newComment->content = $faker->text();
                $newComment->save();
            }
        }
    }
}
