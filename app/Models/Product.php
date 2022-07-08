<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    // products テーブルから全件取得
    public function getList() {
        $products = DB::table('products')->get();

        return $products;
    }
}
