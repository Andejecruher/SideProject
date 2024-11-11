<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * This method is used to seed the tags table with initial data.
     *
     * @return void
     */
    public function run()
    {


        // Define an array of tags
        $tags = [
            // Tags de Programación
            [
                'name' => 'JavaScript',
                'color' => '#F0DB4F'
            ],
            [
                'name' => 'Python',
                'color' => '#306998'
            ],
            [
                'name' => 'React',
                'color' => '#61DAFB'
            ],
            [
                'name' => 'Node.js',
                'color' => '#3C873A'
            ],
            [
                'name' => 'CSS',
                'color' => '#264de4'
            ],
            [
                'name' => 'HTML',
                'color' => '#E34C26'
            ],
            [
                'name' => 'SOLID',
                'color' => '#4A90E2'
            ],
            [
                'name' => 'Next.js',
                'color' => '#000000'
            ],
            [
                'name' => 'Laravel',
                'color' => '#FF2D20'
            ],
            [
                'name' => 'MySQL',
                'color' => '#00758F'
            ],
            [
                'name' => 'Full Stack',
                'color' => '#34495E'
            ],
            [
                'name' => 'Backend',
                'color' => '#FF4500'
            ],
            [
                'name' => 'Frontend',
                'color' => '#1E90FF'
            ],

            // Tags de Tecnología e Innovación
            [
                'name' => 'Machine Learning',
                'color' => '#FF7F0E'
            ],
            [
                'name' => 'Inteligencia Artificial',
                'color' => '#8A2BE2'
            ],
            [
                'name' => 'Productividad',
                'color' => '#FFBF00'
            ],
            [
                'name' => 'Tendencias',
                'color' => '#6A0DAD'
            ],
            [
                'name' => 'Blockchain',
                'color' => '#FF7F50'
            ],
            [
                'name' => 'Internet of Things',
                'color' => '#1F618D'
            ],
            [
                'name' => 'Automatización',
                'color' => '#16A085'
            ],
            [
                'name' => 'Big Data',
                'color' => '#2980B9'
            ],

            // Tags de Superación Personal
            [
                'name' => 'Desarrollo Personal',
                'color' => '#FF69B4'
            ],
            [
                'name' => 'Crecimiento Profesional',
                'color' => '#FF6347'
            ],
            [
                'name' => 'Inteligencia Emocional',
                'color' => '#DC143C'
            ],
            [
                'name' => 'Resiliencia',
                'color' => '#2ECC71'
            ],
            [
                'name' => 'Motivación',
                'color' => '#FF1493'
            ],
            [
                'name' => 'Productividad Personal',
                'color' => '#FFD700'
            ],
            [
                'name' => 'Equilibrio Vida-Trabajo',
                'color' => '#FFA07A'
            ],
            [
                'name' => 'Habilidades Blandas',
                'color' => '#8FBC8F'
            ],
            [
                'name' => 'Mindfulness',
                'color' => '#4682B4'
            ],
            [
                'name' => 'Bienestar',
                'color' => '#FF4500'
            ]
        ];


        // Insert each tag into the tags table
        foreach ($tags as $tag) {
            DB::table('tags')->insert([
                'name' => $tag["name"], // Name of the tag
                'color' => $tag["color"], // Generate a random hex color
                'created_at' => now(), // Set the current timestamp for created_at
                'updated_at' => now(), // Set the current timestamp for updated_at
            ]);
        }
    }
}
