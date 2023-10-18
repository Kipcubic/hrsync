<?php

namespace Database\Factories;

use App\Models\Bank;
use App\Models\Department;
use App\Models\EmploymentType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{

    public function definition(): array
    {
        return [
            'staff_number'=>'TR#'.fake()->unique()->randomNumber(),
            'first_name' => fake()->unique()->firstName(),
            'middle_name' => fake()->unique()->name(),
            'last_name' => fake()->lastName(),
            'national_id'=>fake()->unique()->randomNumber(8,true),
            'mobile_number'=>'07'.fake()->unique()->randomNumber(8,true),
            'dob'=>fake()->date('Y-m-d','2001-01-01'),
            'email' => fake()->unique()->safeEmail(),
            'job_title'=>fake()->jobTitle(),
            'currency'=>'KES',
            'gender'=>fake()->randomElement(['male','female']),
            'employment_type_id'=>fake()->randomElement(EmploymentType::all()->pluck('id')),
            'email_verified_at' => now(),
            'bank_id'=>fake()->randomElement(Bank::all()->pluck('id')),
            'department_id'=>fake()->randomElement(Department::all()->pluck('id')),
            'basic_salary'=>fake()->numberBetween(100000,600000),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
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
