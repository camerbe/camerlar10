<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        /*factory(Role::class,5)->created();*/
        Role::factory()->count(2)->create()->each(function ($role) {
            $company->contacts()->save(factory(App\Contact::class)->make());
        });
        
    }
}
