<?php

namespace Database\Factories;

use App\Models\Isession;
use Illuminate\Database\Eloquent\Factories\Factory;

class IsessionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Isession::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'start_session' => '1',
            'end_session'  => '6'
        ];
    }
}
