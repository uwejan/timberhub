<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Ramsey\Uuid\Type\Integer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Specifications>
 */
class SpecificationsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $products = range(1,5);
        return [
            'product_id' => range(1,5)[array_rand($products)],
            'species' => config('constants.accepted_species')[array_rand(config('constants.accepted_species'))],
            'grading_system' => config('constants.accepted_grading_systems')[array_rand(config('constants.accepted_grading_systems'))],
            'drying_method' => config('constants.accepted_drying_methods')[array_rand(config('constants.accepted_drying_methods'))],
            'treatment' => config('constants.accepted_treatments')[array_rand(config('constants.accepted_treatments'))],
            'thickness' => [40, 50, 90][array_rand([40, 50, 90])],
            'width' => [90, 100, 120, 150][array_rand([90, 100, 120, 150])],
            'length' => [1200, 2000, 3000][array_rand([1200, 2000, 3000])],
        ];
    }

}
