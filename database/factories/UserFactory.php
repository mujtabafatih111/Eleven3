<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = User::class;

    public function definition(): array
    {
        $status = $this->faker->randomElement([
            User::STATUS_ACTIVE,
            User::STATUS_SUSPENDED,
        ]);

        $email = $this->faker->unique()->safeEmail();
        return [
            'first_name' =>  $this->faker->firstName(),
            'last_name' =>  $this->faker->lastName(),
            'gender'=>  'male',
            'email' => $email,
            'password' => Hash::make('12345678'),
            'dob' => $this->faker->dateTimeThisMonth(),
            'phone' => $this->faker->unique()->phoneNumber(),
            'state_issued_id_number' => random_int(1, 100),
            'professional_license_numbers' =>random_int(1, 1000),
            'professional_associations' => $this->faker->postcode(),
            'category_id' => '3',
            'remote_service_offerings' => '1',
            'on_demand_service_offerings' => '1',
            'appointment_cancellation_policy' => '1',
            'status'  => $status,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
