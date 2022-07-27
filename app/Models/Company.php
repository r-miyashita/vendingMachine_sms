<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Company extends Model
{
    /************************************
     * 会社情報取得
     * テーブルから一覧情報を取得。
     * 
     * @param なし
     * @return 全ての会社情報
     */
    public function getList() {
        $companies = DB::table('companies')
                       ->get();
        
        return $companies;
    }

    /************************************
     * 会社ID取得
     * テーブルからIDを取得。
     * 
     * @param $request 商品名
     * @return 商品名と一致するID
     */
    public function getCompanyId($request) {
        $company_id = DB::table('companies')
                        ->select('id')
                        ->where('company_name', $request->input('company_name'))
                        ->value('id');
        
        return $company_id;
    }

     /************************************
     * 会社名取得
     * テーブルから会社名を取得。
     * 
     * @param $product ID
     * @return IDと一致する商品名
     */
    public function getCompanyName($product) {
        $company_name = DB::table('companies')
                          ->select('company_name')
                          ->where('id', $product->company_id)
                          ->value('company_name');

        return $company_name;
    }
}

