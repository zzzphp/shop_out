<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Currency;
use Illuminate\Support\Carbon;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $attributes = [
                ['title' => '矿机费用','value' => '永久产权', 'mark' => ''],
                ['title' => '电费','value' => '￥29.07元/天', 'mark' => '￥0.35/度'],
                ['title' => '预计日产出','value' => '0.00065550BTC/天', 'mark' => '≈￥100.05/天'],
                ['title' => '算力','value' => '95TH/s', 'mark' => ''],
                ['title' => '功耗','value' => '3.3kw/h', 'mark' => ''],
                ['title' => '管理费','value' => '0%', 'mark' => ''],
            ];
        $currency = Currency::query()->inRandomOrder()->first();
        $price = $this->faker->randomNumber(4);
        return [
            'currency_id' => $currency->id,
            'title' => $currency->name.'产品'.mt_rand(1, 50),
            'image' => 'http://m.minercloud.cn/static/img/mill.7f14bc79.png',
            'description' => $this->faker->sentence,
            'original_price' => $price,
            'price'     => $price*0.8,
            'attributes'    => $attributes,
            'stock'    => mt_rand(10, 99),
            'detail'    => $this->faker->sentence,
            'end_at'    => Carbon::now()->addMonth(1)->toDateTimeString(),
            'begin_at'    => Carbon::now()->addMonth(1)->toDateTimeString(),
        ];
    }
}
