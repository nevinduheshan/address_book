<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Create 50 customers for testing
        foreach (range(1, 20) as $index) {
            $customer = Customer::create([
                'name' => $faker->name,
                'company' => $faker->company,
                'email' => $faker->unique()->safeEmail,
                'phone' => $faker->phoneNumber,
                'country' => $faker->country,
                'status' => $faker->randomElement(['active', 'inactive']),
            ]);

            // Create an address for each customer
            Address::create([
                'customer_id' => $customer->id,
                'address' => $faker->address,
            ]);
        }
    }
}
