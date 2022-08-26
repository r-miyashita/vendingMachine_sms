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
        <form class="search-box" action="{{ route('product.list') }}" method="GET">
            @csrf
            <input  class="search-box__control" type="text" name="keyword" value="{{ $keyword }}">
            <select name="filter" class="search-box__control" value="{{ old('filter') }}">
                <option value="" hidden>メーカー</option>
                @foreach ($companies as $company)
                    <option value="{{ $company->company_name }}"
                    @if ($company->company_name == old('filter')) selected @endif>
                    {{ $company->company_name }}</option>
                @endforeach
            </select>
            <input type="submit" value="Search" class="search-box__button link--search">
        </form>     
    </div>
<!----------------------------------------------------
商品一覧テーブル
----------------------------------------------------->
    <table class="table">
        <thead class="table__head">
            <tr class="table__head-row">
                <th class="table__head-row-cell table__head-row-cell--narrow">id</th>
                <th class="table__head-row-cell table__head-row-cell--primary">商品画像</th>
                <th class="table__head-row-cell table__head-row-cell--wide">商品名</th>
                <th class="table__head-row-cell table__head-row-cell--narrow">価格</th>
                <th class="table__head-row-cell table__head-row-cell--narrow">在庫数</th>
                <th class="table__head-row-cell table__head-row-cell--primary">メーカー名</th>
                <th class="table__head-row-cell table__head-row-cell--narrow"></th>
                <th class="table__head-row-cell table__head-row-cell--narrow"></th>
            </tr>
        </thead>
        <tbody class="table__body">
        @foreach ($products as $product)
            <tr class="table__data-row">
                <td class="table__data-row-cell">{{ $product->id }}</td>
                <td class="table__data-row-cell"><img class="table__data-row-cell--img" src="{{ asset('storage/' . $product->img_path) }}"></td>
                <td class="table__data-row-cell">{{ $product->product_name }}</td>
                <td class="table__data-row-cell">{{ $product->price }}</td>
                <td class="table__data-row-cell">{{ $product->stock }}</td>
                <td class="table__data-row-cell">{{ $product->company_name }}</td>
                <td class="table__data-row-cell table__data-row-cell--button"><a class="link--detail" href="{{ route('product.detail', ['id'=>$product->id]) }}">Detail</a></td>
                <td class="table__data-row-cell table__data-row-cell--button">
                    <form action="{{ route('product.destroy', ['id'=>$product->id]) }}" method="POST">
                        @csrf
                        <button class="link--destroy" type="submit" value="">Destroy</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<!----------------------------------------------------
JavaScript
----------------------------------------------------->
<script src="{{ asset('/js/script.js') }}"></script>
@endsection

