<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        DB::table('users')->insert([
            [
                'name' => 'Andi',
                'email' => 'andi@andi.com',
                'password' => Hash::make('12345')
            ],
            [
                'name' => 'Budi',
                'email' => 'budi@budi.com',
                'password' => Hash::make('67890')
            ],
            [
                'name' => 'Caca',
                'email' => 'caca@caca.com',
                'password' => Hash::make('abcde')
            ],
            [
                'name' => 'Deni',
                'email' => 'deni@deni.com',
                'password' => Hash::make('fghij')
            ],
            [
                'name' => 'Euis',
                'email' => 'euis@euis.com',
                'password' => Hash::make('klmno')
            ],
            [
                'name' => 'Fafa',
                'email' => 'fafa@fafa.com',
                'password' => Hash::make('pqrst')
            ],
        ]);

        DB::table('courses')->insert([
            [
                'course' => 'C++',
                'mentor' => 'Ari',
                'title' => 'Dr.'
            ],
            [
                'course' => 'C#',
                'mentor' => 'Ari',
                'title' => 'Dr.'
            ],
            [
                'course' => 'C#',
                'mentor' => 'Ari',
                'title' => 'Dr.'
            ],
            [
                'course' => 'CSS',
                'mentor' => 'Cania',
                'title' => 'S.Kom'
            ],
            [
                'course' => 'HTML',
                'mentor' => 'Cania',
                'title' => 'S.Kom'
            ],
            [
                'course' => 'Javascript',
                'mentor' => 'Cania',
                'title' => 'S.Kom'
            ],
            [
                'course' => 'Python',
                'mentor' => 'Barry',
                'title' => 'S.T.'
            ],
            [
                'course' => 'Micropython',
                'mentor' => 'Barry',
                'title' => 'S.T.'
            ],
            [
                'course' => 'Java',
                'mentor' => 'Darren',
                'title' => 'M.T.'
            ],
            [
                'course' => 'Rubby',
                'mentor' => 'Darren',
                'title' => 'M.T.'
            ],
        ]);

        DB::table('user_courses')->insert([
            [
                'id_user' => '1',
                'id_course' => '1',
            ],
            [
                'id_user' => '1',
                'id_course' => '2',
            ],
            [
                'id_user' => '1',
                'id_course' => '3',
            ],
            [
                'id_user' => '2',
                'id_course' => '4',
            ],
            [
                'id_user' => '2',
                'id_course' => '5',
            ],
            [
                'id_user' => '2',
                'id_course' => '6',
            ],
            [
                'id_user' => '3',
                'id_course' => '7',
            ],
            [
                'id_user' => '3',
                'id_course' => '8',
            ],
            [
                'id_user' => '3',
                'id_course' => '9',
            ],
            [
                'id_user' => '4',
                'id_course' => '1',
            ],
            [
                'id_user' => '4',
                'id_course' => '2',
            ],
            [
                'id_user' => '4',
                'id_course' => '3',
            ],
            [
                'id_user' => '5',
                'id_course' => '4',
            ],
            [
                'id_user' => '5',
                'id_course' => '5',
            ],
            [
                'id_user' => '5',
                'id_course' => '6',
            ],
            [
                'id_user' => '6',
                'id_course' => '7',
            ],
            [
                'id_user' => '6',
                'id_course' => '8',
            ],
            [
                'id_user' => '6',
                'id_course' => '9',
            ],
        ]);
    }
}
