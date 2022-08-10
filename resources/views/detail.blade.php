@extends('layouts.app')

@section('content')
            <div class="container">
                <!-- ↓↓↓ 商品一覧テーブル表示 ↓↓↓ -->
                <div class="list">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th>id</th>
                                <th>商品画像</th>
                                <th>商品名</th>
                                <th>メーカー名</th>
                                <th>価格</th>
                                <th>在庫数</th>
                                <th>コメント</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td><img src="{{ asset('storage/' . $product->img_path) }}" style="height:200px; width: 200px;"></td>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $company_name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>{{ $product->comment }}</td>
                                <td><a href="{{ route('product.update.get', ['id'=>$product->id]) }}">編集</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- ↑↑↑ 商品一覧テーブル表示ここまで ↑↑↑ -->

                <!-- ↓↓↓ 戻るボタン ↓↓↓ -->
                <a href="{{ route('product.list') }}">戻る</a>
                <!-- ↑↑↑ 戻るボタンここまで ↑↑↑ -->
            </div>
@endsection

