<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $musicCategory = \App\Models\Category::create([
            'name' => 'Müzik',
            'icon' => 'musical-notes'
        ]);

        $musicCategory->children()->create([
            'name' => 'Rock',
            'icon' => 'musical-notes'
        ]);

        $musicCategory->children()->create([
            'name' => 'Klasik',
            'icon' => 'musical-notes'
        ]);

        $musicCategory->children()->create([
            'name' => 'Pop',
            'icon' => 'musical-notes'
        ]);

        $musicCategory->children()->create([
            'name' => 'Caz',
            'icon' => 'musical-notes'
        ]);

        $musicCategory->children()->create([
            'name' => 'Alternatif',
            'icon' => 'musical-notes'
        ]);

        $sceneCategory = \App\Models\Category::create([
            'name' => 'Sahne',
            'icon' => 'people'
        ]);

        $sceneCategory->children()->create([
            'name' => 'Gösteri',
            'icon' => 'people'
        ]);

        $sceneCategory->children()->create([
            'name' => 'Stand-Up',
            'icon' => 'person'
        ]);

        $sceneCategory->children()->create([
            'name' => 'Tiyatro',
            'icon' => 'bowtie'
        ]);

        $sceneCategory->children()->create([
            'name' => 'Dans',
            'icon' => 'body'
        ]);

        $sportCategory = \App\Models\Category::create([
            'name' => 'Spor',
            'icon' => 'baseball'
        ]);

        $sportCategory->children()->create([
            'name' => 'Basketbol',
            'icon' => 'basketball'
        ]);

        $sportCategory->children()->create([
            'name' => 'Futbol',
            'icon' => 'football'
        ]);

        $sportCategory->children()->create([
            'name' => 'Voleybol',
            'icon' => 'basketball'
        ]);

        $sportCategory->children()->create([
            'name' => 'Tenis',
            'icon' => 'tennisball'
        ]);

        $sportCategory->children()->create([
            'name' => 'Motor & Bisiklet',
            'icon' => 'bicycle'
        ]);

        $sportCategory->children()->create([
            'name' => 'Araç',
            'icon' => 'car'
        ]);

        $foodCategory = \App\Models\Category::create([
            'name' => 'Yeme & İçme',
            'icon' => 'restaurant'
        ]);

        $foodCategory->children()->create([
            'name' => 'Kahve',
            'icon' => 'water'
        ]);
    }
}
