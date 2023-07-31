<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(RoleSeeder::class);
        $this->call(AdminSeeder::class);
//mitoni ham inja factory ra benevisi
//            DB::table('users')->insert([
//
//
//
//            ]);
        //mitoni har tabe ra be raveshhae zyadii taqqir dahi
//         User::factory(10)->create()->each(function ($user){
////$user yek nemone sakhtim
//            $user->posts()->save(Post::factory()->make());
//         });

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
