<?php

namespace Database\Factories;

use App\Models\PractisTypeName;
use Illuminate\Database\Eloquent\Factories\Factory;

class PractisTypeNameFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PractisTypeName::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'SpeedPassage30',
        ];
    }
}
