<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $first = new Category;
        $first->name = 'Инструмент';
        $first->save();

        $catalog = [
            'Гайковерты' => [
                'Аккумуляторные гайковерты','Бензиновые','Гидравлические гайковерты','Мультипликаторы усилия','Пневмогайковерты'
            ],
            'Генераторы (электростанции)' => [
                'Сварочные генераторы','Бензогенераторы','Инверторные генераторы','Дизель генераторы','Газовые генераторы'
            ],
            'Дрели' => [
                'Аккумуляторные дрели-шуруповерты','Безударные','Дрели-миксеры','Пневмодрели','Угловые дрели'
            ]
        ];

        foreach($catalog as $key => $categories){
            $new_category = Category::create([
                'name' => $key,
                'category_id' => $first->id,
            ]);
            foreach($categories as $category){
                Category::create([
                    'name' => $category,
                    'category_id' => $new_category->id,
                ]);
            }
        }
    }
}
