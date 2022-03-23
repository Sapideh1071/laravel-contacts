<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $colors = collect(range(1, 3))->map(function()  {         return $this->faker->colorName;     })->toArray();


        return [         
            'name' => $this->faker->name,
            'phone' => $this->faker->e164PhoneNumber,         
            'address' => $this->faker->address,         
            'favorites' => ['colors' => $colors],     
        ];

    }
}
