<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Company;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    // ↓↓↓ 【 list 】 処理ここから ↓↓↓
    /************************************
     * 商品の一覧を表示
     * テーブルから一覧情報を取得。検索リクエストがあれば絞り込みを行う。

     * @param $request 検索条件
     * @return 検索条件、検索結果
     */
    public function showList(Request $request) {
       
        // Product モデルから商品一覧データ取得
        $keyword = $request->input('keyword');
        $filter = $request->input('filter');
        
        $product_obj = new Product();
        $products = $product_obj->getProductsList($keyword, $filter);
        
        // 会社一覧情報を取得(検索フォームのフィルター用)
        $company_obj = new Company();
        $companies = $company_obj->getList();

        // list を呼び出す（ビュー表示）
        return view('list', compact('keyword', 'filter', 'products', 'companies'));
    }
    // ↑↑↑ 【 list 】 処理ここまで ↑↑↑


    // ↓↓↓ 【 create 】 処理ここから ↓↓↓
    /************************************
     * 新規登録フォームを表示
     * セレクトボックス用の会社情報を取得し登録フォームに渡す
     * 
     * @param なし
     * @return セレクトボックス情報
     */
    public function showCreateForm() {
        // 会社一覧情報を取得(検索フォームのフィルター用)
        $company_obj = new Company();
        $companies = $company_obj->getList();

        return view('create', compact('companies'));
    }

    /************************************
     * 新規登録
     * 入力フォーム情報をDBに保存
     * 
     * @param $request 新規登録情報
     * @return なし
     */
    public function create(ProductRequest $request) {

        $product = new Product();
        $sale = new Sale();

        // 会社名に合致する id を取得
        $company_obj = new Company();
        $company_id = $company_obj->getCompanyId($request);
        
        $product->register($request, $product, $company_id);

        return back();
    }
    // ↑↑↑ 【 create 】 処理ここまで ↑↑↑


    // ↓↓↓ 【 detail 】 処理ここから ↓↓↓
    /************************************
     * 特定商品のレコードを表示
     * IDと紐付く商品情報を取得
     * 
     * @param $id 特定用のID
     * @return 商品情報、これに紐付く会社名
     */
    public function showDetail($id) {
        $product_obj = new Product();
        $product = $product_obj->getProductDetail($id)
                               ->first();
                               
        // 商品のメーカー名取得しておく
        $company_obj = new Company();
        $company_name = $company_obj->getCompanyName($product);

        return view('detail', compact('product', 'company_name'));
    }
    // ↑↑↑ 【 detail 】 処理ここまで ↑↑↑


    // ↓↓↓ 【 update 】 処理ここから ↓↓↓
    /************************************
     * 編集フォームを表示
     * IDと紐付く商品情報を初期値としたフォームを表示。セレクトボックス用の会社情報を取得し登録フォームに渡す
     * 
     * @param $id 特定用のID
     * @return 商品情報、これに紐付く会社名、セレクトボックス情報
     */
    public function showUpdateForm($id) {
        $product_obj = new Product();
        $product = $product_obj->getProductDetail($id)
                               ->first();
                                
        // 商品のメーカー名取得しておく
        $company_obj = new Company();
        $company_name = $company_obj->getCompanyName($product);

        // 会社一覧取得
        $companies = $company_obj->getList();

        return view('update', compact('product', 'companies', 'company_name'));
    }

    /************************************
     * 編集データ更新
     * 入力フォーム情報をDBに保存
     * 
     * @param $request 新規登録情報
     * @param $id 特定用のID
     * @return なし
     */
    public function update(ProductRequest $request, $id) {

        $product = Product::findOrFail($id);

        $sale_obj = new Sale();
        $sale = $sale_obj->getRelationalRecord($id)
                         ->first();

        // 会社名に合致する id を取得
        $company_obj = new Company();
        $company_id = $company_obj->getCompanyId($request);
        
        $product->register($request, $product, $company_id);
            
        return back();
    }
    // ↑↑↑ 【 update 】 処理ここまで ↑↑↑


    // ↓↓↓ 【 destroy 】 処理ここから ↓↓↓
    /************************************
     * 選択した商品レコードを削除
     * 商品レコードのidと紐付くデータをDBから削除
     * 
     * @param $id 商品レコードのid
     * @return なし
     */
    public function destroy($id) {
        // products テーブルの指定idを削除
        Product::destroy($id);
        // list に戻る
        return back();
    }
    // ↑↑↑ 【 destroy 】 処理ここまで ↑↑↑
}
