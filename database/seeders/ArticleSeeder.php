<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            //code...
            DB::beginTransaction();
            Schema::disableForeignKeyConstraints();
            Article::factory()->count(10)->create();
            DB::commit();
            Schema::enableForeignKeyConstraints();
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
    }
}
