<?php

namespace Database\Factories;

use App\Models\Advertisement;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageLinkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'advertisement_id' => Advertisement::factory(),
            'link' => 'https://icon-library.com/images/photo-placeholder-icon/photo-placeholder-icon-14.jpg'
        ];
    }
}
