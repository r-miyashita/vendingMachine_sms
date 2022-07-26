<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Company;

class Product extends Model
{
    // 商品一覧データ作成（products に companies を結合）
    public function getProductsList($keyword, $filter) {
        $query = DB::table('products')
                        ->join('companies', 'products.company_id', '=', 'companies.id')
                        ->select(
                            'products.id',
                            'products.img_path',
                            'products.product_name',
                            'products.price',
                            'products.stock',
                            'companies.company_name'
                        );
        // 検索キーワードがあればデータを絞り込む
        if (!empty($keyword)) {
            $query->where('product_name', 'LIKE', "%{$keyword}%");
        }
        // フィルターが選択されていればデータを絞り込む
        if (!empty($filter)) {
            $query->where('company_name', $filter);
        }
        
        $products = $query->get();

        return $products;
    }
    
    // 商品詳細データ取得
    public function getProductDetail($id) {
        $product = DB::table('products')
                       ->select(
                           'id',
                           'company_id',
                           'img_path',
                           'product_name',
                           'price',
                           'stock',
                           'comment'
                       )
                       ->where('id', $id);
        
        return $product;
    }

    // 登録処理
    public function register($request, $product, $company_id) {
        DB::beginTransaction();

        try {
            // 登録していく
            $product->company_id = $company_id;
            $product->product_name = $request->input('product_name');
            $product->price = $request->input('price');
            $product->stock = $request->input('stock');
            $product->comment = $request->input('comment');
    
            // アップロードしたファイルを保存 & ファイルパスをDBへ保存
            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');
                $name = date('Ymd_His') . '_' . $photo->getClientOriginalName();
                $path = $photo->storeAS('upfiles', $name, 'public');
                $product->img_path = 'storage/' . $path;
            }
             // 保存
            $product->save();

            // コミット
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
    }
}
