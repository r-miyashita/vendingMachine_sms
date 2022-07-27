<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    /************************************
     * 登録（更新）
     * パラメータをDBに保存
     * 
     * @param $request フォームからの登録情報
     * @param $product 登録対象となるインスタンス
     * @param $company_id 
     * 
     * @return 商品詳細情報
     */
    public function register() {

    }

    /************************************
     * 関連レコード取得
     * 商品情報と紐付くレコードを特定
     * 
     * @param $id 商品ID
     * 
     * @return 紐付けされたセールス情報
     */
    public function getRelationalRecord($id) {
        $sale = DB::table('sales')
                  ->where('product_id', $id);

        return $sale;
    }
}
