<?php

namespace Database\Factories;

use App\Models\Report;
use App\Models\Website;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{

    protected $model = Report::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'website_id' => Website::inRandomOrder()->first()->id,
            'revenue' => $this->faker->randomFloat(2, 0, 500),
            'impressions' => $this->faker->numberBetween(0, 500),
            'clicks' => $this->faker->numberBetween(0, 500),
            'date' => $this->faker->date('Y-m-d', '2024-04-12')
        ];
    }
}
