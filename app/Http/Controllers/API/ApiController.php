<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Company;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;

class ApiController extends Controller
{
    public function index()
    {
        // Product モデルから商品一覧データ取得
        $product = new Product();
        $items = $product->getProductsList();

        // 会社一覧情報を取得(検索フォームのフィルター用)
        $company_obj = new Company();
        $companies = $company_obj->getList();
        return response()->json([
            'status' => true,
            'message' => "successfully!",
            'items' => $items,
            'companies' => $companies
        ], 200);
    }

    public function getSearchResult(Request $request) {
        // Product モデルから商品一覧データ取得
        $product_obj = new Product();

        $products = $product_obj->getSearchResult($request);

        return response()->json([
            'status' => true,
            'massage' => 'successfully!',
            'items' => $products
        ]);
    }
     // ↓↓↓ 【 update 】 処理ここから ↓↓↓
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

        // 会社名に合致する id を取得
        $company_obj = new Company();
        $company_id = $company_obj->getCompanyId($request);

        // DB更新
        $product->register($request, $company_id);

        return response()->json([
            'status' => true,
            'massage' => 'successfully!',
        ]);
    }
     // ↑↑↑ 【 update 】 処理ここまで ↑↑↑

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

        return response()->json([
            'status' => true,
            'massage' => 'successfully!',
            'companies' => $companies
        ]);
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

        $product->register($request, $company_id, $sale);

        return response()->json([
            'status' => true,
            'massage' => 'successfully!'
        ]);
    }
    // ↑↑↑ 【 create 】 処理ここまで ↑↑↑

        // ↓↓↓ 【 destroy 】 処理ここから ↓↓↓
    /************************************
     * 商品レコードのidと紐付くデータをDBから削除
     *
     * @param $id 商品レコードのid
     * @return なし
     */
    public function destroy($id) {
        // 削除対象取得
        $product = Product::findOrFail($id);
        // 物理ファイル削除
        $target = $product->img_path;
        if($target) { Storage::disk('public')->delete($target); }

        // DB削除
        $product->destroyProduct();

        return response()->json([
            'status' => true,
            'massage' => 'successfully!'
        ]);
    }

    // ↑↑↑ 【 destroy 】 処理ここまで ↑↑↑
}
