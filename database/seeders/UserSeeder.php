<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Image;
use App\Models\Location;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Manolo Cabrera',
            'email' => 'viprestal@hotmail.com',
            'password' =>bcrypt('123456789')
        ]);

        User::factory(5)->create()->each(function(User $user){
            $profile = $user->profile()->save(Profile::factory()->make());
            $profile->location()->save(Location::factory()->make());
            $groups = Group::all();
            //$user->groups()->attach($this->array(rand(1,3)));
            $user->groups()->attach($groups->random(rand(1,3))->pluck('id')->toArray());

            $user->image()->save(Image::factory()->make(['url' => 'https://lorempixel.com/90/90']));
        });
    }

  
}
