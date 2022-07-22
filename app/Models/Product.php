<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Company;

class Product extends Model
{
    // 商品一覧データ作成（products に companies を結合）
    public function getProductsList() {
        $products = DB::table('products')
                        ->join('companies', 'products.company_id', '=', 'companies.id')
                        ->select(
                            'products.id',
                            'products.img_path',
                            'products.product_name',
                            'products.price',
                            'products.stock',
                            'companies.company_name'
                        );
                        
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
}
