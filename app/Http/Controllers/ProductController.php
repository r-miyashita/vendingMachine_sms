<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Company;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{

    // ★一覧表示
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
        
        // 会社一覧情報を取得(検索フォームのフィルター用)
        $model_companies = new Company();
        $companies = $model_companies->getList();

        // products_list を呼び出す（ビュー表示）
        return view('products_list', compact('keyword', 'filter', 'products', 'companies'));
    }

    // ★削除
    public function destroy($id) {
        // products テーブルの指定idを削除
        $model_product = new Product();
        $product = $model_product->destroy($id);
        // products_list を呼び出す（ビュー表示）
        return back();
    }

    // ★新規登録
    public function registerProduct() {
        // 
        // 会社一覧情報を取得(検索フォームのフィルター用)
        $model_companies = new Company();
        $companies = $model_companies->getList();
        return view('register_product', compact('companies'));
    }
    // ★ 新規登録
    public function create(ProductRequest $request) {

        $product = new Product();

        // 会社名に合致する id を取得
        $company = new Company(); 
        $company_id = $company->getCompanyName()
                              ->where('company_name', $request->input('company_name'))
                              ->value('id');
        
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
                $path = $photo->storeAS('upfiles', $name);
                $product->img_path = $path;
            }
             // 保存
            $product->save();

            // コミット
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
            
        return back();
    }


    // ★詳細表示
    public function showDetail($id) {
        $model_products = new Product();
        $products = $model_products->getProductDetail($id)
                                   ->get();
        // id を名前に変換しておく
        // $model_company = new Company();
        // $company_name = $model_company->getCompanyName()
        //                               ->where('id', $products->get('company_id'))
        //                               ->get();
        // $products->get('company_id') = $company_name->get('company_name');
        dd($products);
        return view('product_detail', compact('products'));
    }
}
