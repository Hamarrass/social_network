<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title =$this->faker->realText(67);
        return [
            'title'   =>$title,
            'content' => $this->faker->text,
            'updated_at'=>$this->faker->dateTimeBetween('-5 years')
        ];
    }
}
