<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
                'name' => 'Alain Abreo',
                'email' => 'alainabreo@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'admin',
            ]);

        factory(User::class, 50)
           ->create();
           // ->each(function ($user) {
           //      $user->posts()->save(factory(App\Post::class)->make());
           //  });
    }
}
