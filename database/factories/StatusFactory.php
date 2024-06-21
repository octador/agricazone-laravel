<?php

namespace Database\Factories;

use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

class StatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Status::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $i = 0;
        $states = ['Pending', 'Cancel', 'Rejected', 'Validate'];
        return [
            'state' => $states[($i++) % count($states)],
        ];
    }
}
