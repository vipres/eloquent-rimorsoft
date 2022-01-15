<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Image;
use App\Models\Post;
use App\Models\Tag;
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
            $post->image()->save(Image::factory()->make(['url' => 'https://picsum.photos/90/90']));
            $tags = Tag::all();
            $post->tags()->attach($tags->random(rand(1,3))->pluck('id')->toArray());

            $number_comments = rand(1,6);
            for ($i=0; $i < $number_comments; $i++) {
                $post->comments()->save(Comment::factory()->make());
            }
       });
    }

}
