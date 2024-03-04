<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = DB::table('companies');
        $date = new Carbon('now');
        // 全件削除
        $table->truncate();
        // データ挿入
        $table->insert([
            [
                'company_name' => 'asahi',
                'street_address' => '東京都品川区舞鶴1-1-33-3',
                'representative_name' => '兎内 昂能',
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'company_name' => 'サッポロ',
                'street_address' => '大阪府枚方市香ヶ丘2-33-4444',
                'representative_name' => '清弘 英夫',
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'company_name' => '伊藤園',
                'street_address' => '福岡県福岡市博多区博多1-1-33-3',
                'representative_name' => '厨井 優海',
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'company_name' => 'コカコーラ',
                'street_address' => '京都府京都市伏見区淀水垂町509-16',
                'representative_name' => '原城 学',
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'company_name' => 'キリン',
                'street_address' => '愛知県名古屋市北区金田町4-721-1',
                'representative_name' => '清鶴 空',
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'company_name' => 'メグミルク',
                'street_address' => '神奈川県茅ヶ崎市東海岸南1-1-33-3',
                'representative_name' => '大島 瑛依人',
                'created_at' => $date,
                'updated_at' => $date
            ]
        ]);
    }
}
