<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = DB::table('sales');
        $date = new Carbon('now');
        // 全件削除
        $table->truncate();
        // データ挿入
        $table->insert([
            [
                'product_id' => 1,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'product_id' => 2,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'product_id' => 3,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'product_id' => 4,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'product_id' => 5,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'product_id' => 6,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'product_id' => 7,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'product_id' => 8,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'product_id' => 9,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'product_id' => 10,
                'created_at' => $date,
                'updated_at' => $date
            ],
        ]);
    }
}
