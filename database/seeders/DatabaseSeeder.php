<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Teacher;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $languages = [
            'French',
            'English',
            'Espanish'
        ];
       
        foreach($languages as $language) {
            Teacher::factory()->create([
                'name' => 'Test Teacher',
                'email' => Str::random(10).'@gmail.com',
                'language' => $language
            ]);
        }
    
        $this->call([
            StudentSeeder::class
        ]);
    }
}
