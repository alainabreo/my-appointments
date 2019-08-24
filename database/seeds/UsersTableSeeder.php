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
                'password' => bcrypt('123456'),
                'role' => 'admin',
                'active' => True,
            ]);

        factory(User::class)->create([
                'name' => 'Catalina Bayona',
                'email' => 'bayonacatalina@hotmail.com',
                'password' => bcrypt('123456'),
                'role' => 'doctor',
                'active' => True,
            ]);

        factory(User::class)->create([
                'name' => 'Nicolas Abreo',
                'email' => 'nicolasabreo@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 'doctor',
                'active' => True,
            ]);

        factory(User::class)->create([
                'name' => 'Maria Florez',
                'email' => 'mariaflorez@example.com',
                'password' => bcrypt('123456'),
                'role' => 'patient',
                'active' => True,
            ]);

        //factory(User::class, 50)
           //->create();
           // ->each(function ($user) {
           //      $user->posts()->save(factory(App\Post::class)->make());
           //  });

        factory(User::class, 50)->states('patient')->create();
    }
}
