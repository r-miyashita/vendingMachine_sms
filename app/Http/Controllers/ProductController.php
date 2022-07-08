<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;

class ProductController extends Controller
{
    // 会社リスト取得用
    public function getCompaniesList() {
        // CompanyController から　companies テーブルのデータ取得 (一覧ソート用)
    }
    // 商品一覧表示用
    public function showProductsList() {
        // products テーブルからデータ取得
        $model_1 = new Product();
        $products = $model_1->getList();
        // getCompaniesList から会社リスト取得
        // products_list を呼び出す（ビュー表示）
        return view('products_list', compact('products'));
    }
}
