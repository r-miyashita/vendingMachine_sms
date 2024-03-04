<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = DB::table('products');
        $date = new Carbon('now');
        // 全件削除
        $table->truncate();
        $table->insert([
            [
                'company_id' => 2,
                'product_name' => 'ファンタオレンジ',
                'price' => 100,
                'stock' => 100,
                'comment' => 'test',
                'img_path' => 'upfiles/20220802_144709_testPhoto.jpg',
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'company_id' => 1,
                'product_name' => 'コカコーラ',
                'price' => 90,
                'stock' => 100,
                'comment' => 'test',
                'img_path' => 'upfiles/20220802_144709_testPhoto.jpg',
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'company_id' => 3,
                'product_name' => 'ポンジュース',
                'price' => 80,
                'stock' => 50,
                'comment' => 'test',
                'img_path' => 'upfiles/20220802_144709_testPhoto.jpg',
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'company_id' => 2,
                'product_name' => 'ファンタレモン',
                'price' => 120,
                'stock' => 99,
                'comment' => 'test',
                'img_path' => 'upfiles/20220802_144709_testPhoto.jpg',
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'company_id' => 4,
                'product_name' => 'ライフガード',
                'price' => 100,
                'stock' => 100,
                'comment' => 'test',
                'img_path' => 'upfiles/20220802_144709_testPhoto.jpg',
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'company_id' => 2,
                'product_name' => 'ファンタグレープ',
                'price' => 99,
                'stock' => 99,
                'comment' => 'test',
                'img_path' => 'upfiles/20220802_144709_testPhoto.jpg',
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'company_id' => 6,
                'product_name' => 'ミニッツメイドグレープ',
                'price' => 100,
                'stock' => 100,
                'comment' => 'test',
                'img_path' => 'upfiles/20220802_144709_testPhoto.jpg',
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'company_id' => 1,
                'product_name' => 'ウーロン茶',
                'price' => 100,
                'stock' => 100,
                'comment' => 'test',
                'img_path' => 'upfiles/20220802_144709_testPhoto.jpg',
                'created_at' => $date,
                'updated_at' => $date
            ],
        ]);
    }
}
