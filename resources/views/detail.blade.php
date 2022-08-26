@extends('layouts.layout')

@section('content')
<div class="container">
<!----------------------------------------------------
見出し
----------------------------------------------------->
    <div class="heading">
        <br>
        <h2 class="heading__text">Product Detail</h2>
        <br>
    </div>
<!----------------------------------------------------
テーブル
----------------------------------------------------->
    <table class="table">
        <thead class="table__head">
            <tr class="table__head-row">
            <th class="table__head-row-cell table__head-row-cell--narrow">id</th>
            <th class="table__head-row-cell table__head-row-cell--primary">商品画像</th>
            <th class="table__head-row-cell table__head-row-cell--wide">商品名</th>
            <th class="table__head-row-cell table__head-row-cell--primary">メーカー名</th>
            <th class="table__head-row-cell table__head-row-cell--narrow">価格</th>
            <th class="table__head-row-cell table__head-row-cell--narrow">在庫数</th>
            <th class="table__head-row-cell table__head-row-cell--wide">コメント</th>
            <th class="table__head-row-cell table__head-row-cell--narrow"></th>
            </tr>
        </thead>
        <tbody class="table__body">
            <tr class="table__data-row">
                <td class="table__data-row-cell">{{ $product->id }}</td>
                <td class="table__data-row-cell"><img class="table__data-row-cell--img" src="{{ asset('storage/' . $product->img_path) }}"></td>
                <td class="table__data-row-cell">{{ $product->product_name }}</td>
                <td class="table__data-row-cell">{{ $company_name }}</td>
                <td class="table__data-row-cell">{{ $product->price }}</td>
                <td class="table__data-row-cell">{{ $product->stock }}</td>
                <td class="table__data-row-cell">{{ $product->comment }}</td>
                <td class="table__data-row-cell"><a class="link--edit" href="{{ route('product.update.get', ['id'=>$product->id]) }}">Edit</a></td>
            </tr>
        </tbody>
    </table>
<!----------------------------------------------------
戻るボタン
----------------------------------------------------->
    <div class="wrapper--button">
        <a class="link--back" href="{{ route('product.list') }}">Back</a>
    </div>
</div>
@endsection

