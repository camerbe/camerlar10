<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use App\Models\User;
use App\Models\Rubrique;
use App\Models\Categorie;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        /*$role=Role::factory()->count(1)
            ->create([
                'role'=>'Redac',
           ]);*/
        // User::factory()->count(1)
        //     ->create([
        //         'name' => fake()->name(),
        //         'email' => fake()->unique()->safeEmail(),
        //         'email_verified_at' => now(),
        //         'password' => Hash::make('password'),
        //         'remember_token' => Str::random(10),
        //         'role_id' => Role::factory(),
        //     ]);
        Rubrique::factory()->count(5)
            ->create([
                'rubrique' => fake()->sentence(1),
                'slugrubrique' => Str::slug(fake()->name()),
                'categorie_id' => Categorie::factory()->count(1)->create([
                    'categorie'=>fake()->text(),
                    'slugcategorie'=>Str::slug(fake()->name()),
                ]),
            ]);

        /*
        //$this->call(RoleSeeder::class);

         /\App\Models\User::factory()->create([
             'name' => $this->faker->name,
             'email' => 'test@example.com',
         ]);*/
    }
}
