<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Comment;
use App\Post;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        //Filtro i post pubblicati
        $postsPublished = Post::where('published', 1)->get();
        //Ciclo sui post pubblicati
        foreach ($postsPublished as $post ) {
           for( $i = 0; $i < rand(0, 3); $i++) {
               $newComment = new Comment();
               $newComment->post_id = $post->id;
               $newComment->name = $faker->name();
               $newComment->content = $faker->text();
               $newComment->save();
           }
        }
    }
}
