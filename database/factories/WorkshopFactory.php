<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Workshop;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Workshop>
 */
class WorkshopFactory extends Factory
{
    protected $model = Workshop::class;

    public function definition(): array
    {
        $name = $this->faker->company . ' Car Service';

        return [
            'owner_id' => User::factory(),
            'name' => $name,
            'slug' => Str::slug($name) . '-' . Str::random(5),
            'city' => $this->faker->randomElement(['Novi Sad', 'Beograd', 'Niš', 'Subotica']),
            'address' => $this->faker->streetAddress(),
            'phone' => $this->faker->phoneNumber(),
            'description' => $this->faker->sentence(8),
            'is_verified' => true,
        ];
    }
}
