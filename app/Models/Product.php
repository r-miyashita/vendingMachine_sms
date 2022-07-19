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
}
