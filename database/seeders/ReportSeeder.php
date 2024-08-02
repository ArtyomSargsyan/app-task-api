<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Carbon;
use App\Models\Report;
use App\Models\Website;

class ReportSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $websites = Website::take(10)->get();

        $startDate = '2024-03-01';
        $endDate = '2024-04-12';

        $currentDate = Carbon::createFromFormat('Y-m-d', $startDate);
        $endDate = Carbon::createFromFormat('Y-m-d', $endDate);

        $recordCount = 0;

        while ($currentDate <= $endDate && $recordCount < 100) {
            foreach ($websites as $website) {
                if ($recordCount >= 100) {
                    break;
                }

                Report::updateOrCreate(
                    [
                        'website_id' => $website->id,
                        'date' => $currentDate->format('Y-m-d')
                    ],
                    [
                        'revenue' => $faker->randomFloat(2, 0, 10000),
                        'impressions' => $faker->numberBetween(0, 100000),
                        'clicks' => $faker->numberBetween(0, 10000)
                    ]
                );

                $recordCount++;
            }
            $currentDate->addDay();
        }
    }
}
