<?php

namespace Database\Factories;

use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = News::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        //http://m.minercloud.cn/static/images/newsimg.png
        $type = $this->faker->randomElement([News::TYPE_KUAIXUN, News::TYPE_ZIXUN, News::TYPE_SHUJU]);
        $data = [];
        switch ($type) {
            case News::TYPE_KUAIXUN:
                $data = [
                    'type' => News::TYPE_KUAIXUN,
                    'content' => $this->faker->sentence,
                    'stars' => random_int(1,5),
                    'look_up' => random_int(10,100),
                    'look_down' => random_int(10,100),
                    ];
                break;
            case News::TYPE_ZIXUN:
                $data = [
                    'type' => News::TYPE_ZIXUN,
                    'title' => $this->faker->word,
                    'content' => $this->faker->sentence,
                    'looks'     => random_int(10,100),
                    'stars' => 0,
                    ];
                break;
            case News::TYPE_SHUJU:
                $data = [
                    'type' => News::TYPE_SHUJU,
                    'title' => $this->faker->word,
                    'content' => $this->faker->sentence,
                    'stars' => 0,
                    ];
            break;
        }
        return $data;
    }
}
