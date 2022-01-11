<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Image;
use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Post::factory(40)->create()->each(function(Post $post){
            $post->image()->save(Image::factory()->make(['url' => 'https://lorempixel.com/90/90']));
            $post->tags()->attach($this->array(rand(1,12)));
            $number_comments = rand(1,6);
            for ($i=0; $i < $number_comments; $i++) {
                $post->comments()->save(Comment::factory()->make());
            }
       });
    }

    public function array($max)
    {
        $values = [];
        for ($i=0; $i < $max; $i++) {
            $values[] = $i;
        }

        return $values;
    }
}
