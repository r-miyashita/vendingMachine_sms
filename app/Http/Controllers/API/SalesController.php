<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SalesController extends Controller
{
    /************************************
     * 購入処理
     * 購入分の在庫を減らして売上データ作成する。
     * 
     * @param $id 商品id
     * @return 処理結果、ステータスコード,メッセージ
     */
    public function purchase($id)
    {
        // 戻り値初期化
        $result = 0;
        $error_message = "";
        $requestId = $id;

        // 商品在庫を減算する
        $product = Product::findOrFail($id);
        $result = $product->decrementStock();
        $error_message = "購入処理完了";

        // 減算結果が完了したら、売上データを作成する 
        if ($result === 0) {
            $sale = new Sale();
            $result = $sale->salesRegistration($id);

            // 売上登録できなかった場合
            if ($result === 1) {
                $error_message = "購入処理失敗:売上登録失敗";
            }

        } elseif ($result === 1) { // 商品在庫を減算できなかった場合
            $error_message = "購入処理失敗:在庫なし";

        } else {
            $error_message = "購入処理失敗:例外発生により未処理で修了";

        }
         Log::info(compact('result', 'error_message', 'requestId', 'product'));
        return compact('result', 'error_message', 'requestId', 'product');
    }
}
