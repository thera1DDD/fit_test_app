<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Сначала создаем фиксированные категории
        \App\Models\Category::insert([
            ['name' => 'легкий'],
            ['name' => 'хрупкий'],
            ['name' => 'тяжелый']
        ]);

        // Затем создаем продукты и заказы
        \App\Models\Product::factory(10)->create();
        \App\Models\Order::factory(20)->create();
    }
}
