<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = ['Аккумуляторная угловая','пила Ryobi ONE+ RRS1801M','Аккумуляторный лобзик Ryobi ONE+',
            'углошлифмашина Ryobi ONE+','Перфоратор Ryobi ONE+','Эксцентриковая шлифмашина Ryobi ONE+ R18ROS-0 5133002471',
            'пила Ryobi ONE+ R18CS7-0','Гвоздезабивной инструмент','Ryobi ONE+ R18PL-0','ONE+ R18TR-0','Ryobi ONE+ HP RRS18C-0',
            'AEG BEX18-125-0 4935451086','Ryobi ONE+ R18ST50-0','машинка ЗУБР УШМ-18-125-41','Zitrek AG 20 Pro 063-4067',
            'АКБ 2 Ач, в коробке СПЛ-125','DEKO DKAG20-125, 2х4.0 Ач','RB18L50 5133002433 (18 В; 5','DEKO DKAG20-125 063-2150'
        ];

        foreach($products as $key => $product){
            Product::create([
                'name' => $product,
                'description' => $product,
                'category_id' => $key+1,
                'price' => rand(100, 15000),
                'width' => rand(1, 15),
                'length' => rand(5, 105),
                'weight' => rand(1, 25),
            ]);
        }
    }
}
