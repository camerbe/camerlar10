<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
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
        User::factory(User::class,5)->create()->each(function($user){
            $user->roles()->save(Role::factory(Role::class)->make());
        });
        /*factory(App\Models\User, 5)->create()->each(function ($user) {
            $user->roles()->save(factory(App\Models\Role::class)->make());
        });*/
    }

}
