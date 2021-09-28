<?php

namespace Database\Seeders;
use App\Models\News;
use Illuminate\Database\Seeder;
use Database\Factories\NewsFactory;
class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        News::factory(NewsFactory::class)
            ->times(50)
            ->create();
    }
}
