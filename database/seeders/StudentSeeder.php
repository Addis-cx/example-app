<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Student;
use App\Models\Teacher;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = [
            'French',
            'English',
            'Espanish'
        ];

        foreach ($languages as $language) {
            $teacher = Teacher::where('language',$language)->first();
            Student::create([
            'name' => 'Test Student',
            'email' => Str::random(10).'@gmail.com',
            'phone' => '1234567891',
            'language' => $language,
            'teacher_id' => $teacher->id 
        ]);
        }
    }
}
