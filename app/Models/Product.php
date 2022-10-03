<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Company;
use App\Models\Sale;

class Product extends Model
{
    /************************************
     * 商品一覧情報取得
     * products と companies を内部結合し一覧画面の必要項目取得
     * 
     * @param $keyword 検索キーワード
     * @param $filter フィルターワード
     * @return 一覧情報
     */
    public function getProductsList() {
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
        
        $products = $query->get();

        return $products;
    }

    /************************************
     * 登録（更新）
     * パラメータをDBに保存
     * 
     * @param $request フォームからの登録情報
     * @param $product 登録対象となるインスタンス
     * @param $company_id 会社ID
     * @param $sale $productに紐付くセールス情報のインスタンス
     * 
     * @return なし
     */
    public function register($request, $company_id, $sale) {
        DB::beginTransaction();

        try {
            // 登録していく
            $this->company_id = $company_id;
            $this->product_name = $request->input('product_name');
            $this->price = $request->input('price');
            $this->stock = $request->input('stock');
            $this->comment = $request->input('comment');
    
            // アップロードしたファイルを保存 & ファイルパスをDBへ保存
            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');
                $name = date('Ymd_His') . '_' . $photo->getClientOriginalName();
                $path = $photo->storeAS('upfiles', $name, 'public');
                $this->img_path = $path;
            }
             // 保存
            $this->save();
            // salesも一緒に登録（更新）
            $sale->register($this);
            // コミット
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
    }

    public function getSearchResult($request) {
        $keyword = $request->input('keyword');
        $filter = $request->input('filter');
        $minPrice = $request->input('minPrice');
        $maxPrice = $request->input('maxPrice');
        $minStock = $request->input('minStock');
        $maxStock = $request->input('maxStock');

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

        // 価格の下限・上限が設定されていればデータを絞り込む
        if (!empty($minPrice) && !empty($maxPrice)) {
        //① 上限・下限ともに存在
            $query->whereBetween('price', [$minPrice, $maxPrice]);
        } elseif (!empty($minPrice) && empty($maxPrice)) {
        //② 下限のみ存在
            $query->where('price', '>=', $minPrice);
        } elseif (!empty($maxPrice) && empty($minPrice)) {
        //③ 上限のみ存在
            $query->where('price', '<=', $maxPrice);
        }

        // 在庫の下限・上限が設定されていればデータを絞り込む
        if (!empty($minStock) && !empty($maxStock)) {
        //① 上限・下限ともに存在
            $query->whereBetween('stock', [$minStock, $maxStock]);
        } elseif (!empty($minStock) && empty($maxStock)) {
        //② 下限のみ存在
            $query->where('stock', '>=', $minStock);
        } elseif (!empty($maxStock) && empty($minStock)) {
        //③ 上限のみ存在
            $query->where('stock', '<=', $maxStock);
        }

        $products = $query->get();

        return $products;
    }
}
