<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Company extends Model
{
    // 全件取得
    public function getList() {
        $companies = DB::table('companies')->get();
        
        return $companies;
    }

    // 会社名 & 会社コード取得
    public function getCompanyName() {
        $companies = DB::table('companies')
                         ->select(
                             'companies.id',
                             'companies.company_name'
                         );
        
        return $companies;
    }
}

