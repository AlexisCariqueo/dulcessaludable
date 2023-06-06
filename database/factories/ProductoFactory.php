<?php

namespace Database\Factories;
use Illuminate\Support\str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->sentence();
        return [
            'name'=>$name,
            'slug' =>str::slug($name,'-'),
            'descripcion'=>$this->faker->paragraph()
        ];
    }
}
