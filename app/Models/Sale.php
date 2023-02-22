<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sale extends Model
{
    /************************************
     * 売上登録処理
     * 購入された商品の売上を登録する
     * 
     * @param $id 商品ID
     * 
     * @return $result 処理結果
     */
    public function salesRegistration($id) {
        $result = 0;

        DB::beginTransaction();
        try {
            $this->product_id = $id;
            $this->save();
            DB::commit();

            $result = 0;

        } catch (\Exception $e) {
            DB::rollback();

            $result =1;
        }

        return $result;
    }
}
