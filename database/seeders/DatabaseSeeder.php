<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\User;
use \App\Models\Category;
use \App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'Sano Manjiro',
            'username' => 'sanomanjiro',
            'slug' => 'sano-manjiro',
            'email' => 'sanoman@gmail.com',
            'password' => bcrypt('password'),
            'is_admin' => 1
        ]);

        User::create([
            'name' => 'Takemichi',
            'username' => 'takemichi',
            'slug' => 'takemichi',
            'email' => 'takemichi@gmail.com',
            'password' => bcrypt('password')
        ]);
        User::create([
            'name' => 'Nobita Chan',
            'username' => 'nobitachan',
            'slug' => 'nobita-chan',
            'email' => 'nobita@gmail.com',
            'password' => bcrypt('password')
        ]);

        // User::factory(1)->create();

        Category::create([
            'name' => 'Culture',
            'slug' => 'culture'
        ]);

        Category::create([
            'name' => 'Art',
            'slug' => 'art'
        ]);

        Category::create([
            'name' => 'Sport',
            'slug' => 'sport'
        ]);

        Post::factory(22)->create();

    }
}