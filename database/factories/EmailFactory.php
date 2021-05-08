<?php

namespace Database\Factories;

use App\Models\Email;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

class EmailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Email::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'email_address' => $this->faker->email(),
            'message' => $this->faker->realText(200),
            'attachment' => Storage::path('testFile.txt'),
            'attachment_name' => 'testFile.txt',
            'sent' => $this->faker->randomElement(array(0,1)),
        ];
    }

    public function testEmail()
    {
        return $this->state(function (array $attributes) {
            return [
              'email_address' => 'test@example.dev',
              'sent' => '0',
            ];
        });
    }
}
