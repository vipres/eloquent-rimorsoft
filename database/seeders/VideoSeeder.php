<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Image;
use App\Models\Tag;
use App\Models\Video;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Video::factory(40)->create()->each(function(Video $video){
            $video->image()->save(Image::factory()->make(['url' => 'https://picsum.photos/90/90']));

            $tags = Tag::all();
            $video->tags()->attach($tags->random(rand(1,3))->pluck('id')->toArray());

            $number_comments = rand(1,6);
            for ($i=0; $i < $number_comments; $i++) {
                $video->comments()->save(Comment::factory()->make());
            }
       });
    }

}
