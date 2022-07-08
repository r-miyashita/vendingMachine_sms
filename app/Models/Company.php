<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Company extends Model
{
    // companies テーブルから全件取得
    public function getList() {
        $companies = DB::table('companies')->get();
        
        return $companies;
    }
}
