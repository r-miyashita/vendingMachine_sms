@extends('layouts.layout')

@section('content')
<div class="container">
<!----------------------------------------------------
見出し
----------------------------------------------------->
    <div class="heading">
        <br>
        <h2 class="heading__text">Product List</h2>
        <br>
    </div>
<!----------------------------------------------------
オプションフィールド
----------------------------------------------------->
    <div class="optional-field">
<!-----------------------
新規登録ボタン
------------------------>
        <a class="link--add" href="{{ route('product.create.get') }}" >Add NewProduct</a>
<!-----------------------
検索ボックス
------------------------>
        <form class="search-box" action="{{ route('product.list.search') }}" method="GET">
            @csrf
            <input  class="search-box__control" id="keyword" type="text" name="keyword" value="{{ $keyword }}">
            <select name="filter" class="search-box__control" id="filter" value="{{ old('filter') }}">
                <option value="">Company</option>
                @foreach ($companies as $company)
                    <option value="{{ $company->company_name }}"
                    @if ($company->company_name == old('filter')) selected @endif>
                    {{ $company->company_name }}</option>
                @endforeach
            </select>
            <div class="search-box__control search-box__control-wrapper">
                <span>Price</span>
                <input class="iput-number" id="minPrice" type="number" name="min_price" min="0" value="" placeholder="下限">
                <span>~</span>
                <input class="iput-number" id="maxPrice" type="number" name="max_price" min="0" value="" placeholder="上限">
            </div>
            <div class="search-box__control search-box__control-wrapper">
                <span>Stock</span>
                <input class="iput-number" id="minStock" type="number" name="min_price" min="0" value="" placeholder="下限">
                <span>~</span>
                <input class="iput-number" id="maxStock" type="number" name="max_price" min="0" value="" placeholder="上限">
            </div>
            <input type="submit" value="Search" class="search-box__button link--search" id="ajaxSearch">
        </form>     
    </div>
<!----------------------------------------------------
商品一覧テーブル
----------------------------------------------------->
    <table class="table">
        <thead class="table__head" >
            <tr class="table__head-row">
                <th id="0" data-sort="" class="table__head-row-cell table__head-row-cell--narrow">ID</th>
                <th id="1" data-sort="" class="table__head-row-cell table__head-row-cell--primary">Image</th>
                <th id="2" data-sort="" class="table__head-row-cell table__head-row-cell--wide">Product</th>
                <th id="3" data-sort="" class="table__head-row-cell table__head-row-cell--narrow">Price</th>
                <th id="4" data-sort="" class="table__head-row-cell table__head-row-cell--narrow">Stock</th>
                <th id="5" data-sort="" class="table__head-row-cell table__head-row-cell--primary">Company</th>
                <th id="6" data-sort="" class="table__head-row-cell table__head-row-cell--narrow"></th>
                <th id="7" data-sort="" class="table__head-row-cell table__head-row-cell--narrow"></th>
            </tr>
        </thead>
        <tbody class="table__body"  id="result">
        @php $rowNum = 1; @endphp
        @foreach ($products as $product)
            
            <tr class="table__data-row" id="rowId{{ $rowNum }}">
                <td class="table__data-row-cell td-id">{{ $product->id }}</td>
                <td class="table__data-row-cell"><img class="table__data-row-cell--img" src="{{ asset('storage/' . $product->img_path) }}"></td>
                <td class="table__data-row-cell">{{ $product->product_name }}</td>
                <td class="table__data-row-cell">{{ $product->price }}</td>
                <td class="table__data-row-cell">{{ $product->stock }}</td>
                <td class="table__data-row-cell">{{ $product->company_name }}</td>
                <td class="table__data-row-cell table__data-row-cell--button"><a class="link--detail" href="{{ route('product.detail', ['id'=>$product->id]) }}">Detail</a></td>
                <td class="table__data-row-cell table__data-row-cell--button"><button class="link--destroy" type="submit" value="">Destroy</button></td>
            </tr>
            @php $rowNum ++; @endphp
        @endforeach
        </tbody>
    </table>
</div>
<!----------------------------------------------------
JavaScript
----------------------------------------------------->
@endsection

