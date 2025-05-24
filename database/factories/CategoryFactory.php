<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected static $categories = ['легкий', 'хрупкий', 'тяжелый'];
    protected static $currentIndex = 0;

    public function definition(): array
    {
        // Циклически возвращаем категории
        $name = self::$categories[self::$currentIndex % count(self::$categories)];
        self::$currentIndex++;

        return [
            'name' => $name,
        ];
    }
}
