<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            $project = Project::create([
                'name' => $faker->word . ' Project',
                'description' => $faker->sentence,
            ]);

            $customers = Customer::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $project->customers()->attach($customers);
        }
    }
}
