<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * This method is used to seed the categories table with fake data.
     *
     * @return void
     */
    public function run()
    {

        // Insert 10 fake categories into the categories table
        $categorias = [
            [
                'name' => 'Programación',
                'description' => 'Explora guías prácticas, tutoriales y las mejores prácticas en desarrollo de software, tanto en frontend como backend. Ideal para desarrolladores que buscan profundizar en tecnologías y mejorar sus habilidades técnicas.',
                'icon' => 'fas fa-code',
                'color' => '#4A90E2'
            ],
            [
                'name' => 'Tecnología e Innovación',
                'description' => 'Descubre las últimas tendencias y avances en tecnología e inteligencia artificial. Esta categoría abarca temas innovadores, desde IA hasta herramientas de productividad, que transforman el mundo digital.',
                'icon' => 'fas fa-robot',
                'color' => '#7B16FF' // Púrpura como color innovador y futurista
            ],
            [
                'name' => 'Superación Personal',
                'description' => 'Consejos y reflexiones para el crecimiento personal y profesional. Aquí encontrarás estrategias para mejorar la inteligencia emocional, lograr un equilibrio saludable y potenciar tus habilidades en la industria tecnológica.',
                'icon' => 'fas fa-user-cog',
                'color' => '#F5A623' // Naranja como color cálido y motivacional
            ]
        ];


        foreach ($categorias as $category) {
            DB::table('categories')->insert([
                'name' => $category["name"], // Generate a fake name
                'description' => $category["description"], // Generate a fake description
                'icon' => $category["icon"], // Assign a random icon
                'color' => $category["color"], // Generate a random hex color
                'created_at' => now(), // Set the current timestamp for created_at
                'updated_at' => now(), // Set the current timestamp for updated_at
            ]);
        }
    }
}
