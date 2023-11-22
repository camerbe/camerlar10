<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        factory(App\Models\User, 5)->create()->each(function ($user) {
            $user->roles()->save(factory(App\Models\Role::class)->make());
        });
    }
    
}
