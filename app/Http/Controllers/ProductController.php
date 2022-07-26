<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Company;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /************************************
     * 商品の一覧を表示
     * テーブルから一覧情報を取得。検索リクエストがあれば絞り込みを行う。
     * 
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
        $companies = $this->getCompanyList();

        // list を呼び出す（ビュー表示）
        return view('list', compact('keyword', 'filter', 'products', 'companies'));
    }

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

    /************************************
     * 新規登録フォームを表示
     * セレクトボックス用の会社情報を取得し登録フォームに渡す
     * 
     * @param なし
     * @return セレクトボックス情報
     */
    public function showCreateForm() {
        // 会社一覧情報を取得(検索フォームのフィルター用)
        $companies = $this->getCompanyList();

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

        // 会社名に合致する id を取得
        $company_id = $this->getCompanyId($request);
        
        $product->register($request, $product, $company_id);

        return back();
    }

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
        $company_name = $this->getCompanyName($product);

        return view('detail', compact('product', 'company_name'));
    }

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
        $company_name = $this->getCompanyName($product);

        // 会社一覧取得
        $companies = $this->getCompanyList();
        // dd($company_name);
        return view('update', compact('product', 'companies', 'company_name'));
    }

    /************************************
     * 商品データ更新
     * 入力フォーム情報をDBに保存
     * 
     * @param $request 新規登録情報
     * @param $id 特定用のID
     * @return なし
     */
    public function update(ProductRequest $request, $id) {

        $product = Product::findOrFail($id);

        // 会社名に合致する id を取得
        $company_id = $this->getCompanyId($request);
        
        $product->register($request, $product, $company_id);
            
        return back();
    }

     /************************************
     * 会社情報取得
     * テーブルから一覧情報を取得。
     * 
     * @param なし
     * @return 全ての会社情報
     */
    public function getCompanyList() {
        $model_companies = new Company();
        $companies = $model_companies->getList();

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
        $company_obj = new Company(); 
        $company_id = $company_obj->getCompanyName()
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
        $company_obj = new Company();
        $company_name = $company_obj->getCompanyName()
                                    ->select('company_name')
                                    ->where('id', $product->company_id)
                                    ->value('company_name');
        
        return $company_name;
    }
}
