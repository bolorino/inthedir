<?php

namespace Database\Factories;

use App\Models\Organization;
use App\Models\Province;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrganizationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Organization::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $name = $this->faker->text(50);
        return [
            'province_id' => Province::all()->random(1)->first()->id,
            'name' => $name,
            'slug' => \Str::slug($name),
            'address' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'postal_code' => $this->faker->randomNumber(5, true),
            'phone' => $this->faker->phoneNumber,
            'website' => $this->faker->url,
            'created_at' => now(),
        ];
    }
}
