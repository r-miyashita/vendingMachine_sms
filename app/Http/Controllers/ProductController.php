<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;

class ProductController extends Controller
{

    // 商品一覧表示
    public function showProductsList(Request $request) {
        $keyword = $request->input('keyword');
        $filter = $request->input('filter');
        
        // Product モデルから商品一覧データ取得
        $model_product = new Product();
        $query = $model_product->getProductsList();

        // 検索キーワードがあればデータを絞り込む
        if (!empty($keyword)) {
            $query->where('product_name', 'LIKE', "%{$keyword}%");
        }
        // フィルターが選択されていればデータを絞り込む
        if (!empty($filter)) {
            $query->where('company_name', $filter);
        }
        
        // 商品一覧情報を作成
        $products = $query->get();
        
        // 会社一覧情報を取得
        $model_companies = new Company();
        $companies = $model_companies->getList();

        // products_list を呼び出す（ビュー表示）
        return view('products_list', compact('keyword', 'filter', 'products', 'companies'));
    }

    // 商品削除
    public function destroy($id) {
        // products テーブルの指定idを削除
        $model_product = new Product();
        $product = $model_product->destroy($id);
        // products_list を呼び出す（ビュー表示）
        return back();
    }
}
