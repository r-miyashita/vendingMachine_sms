@extends('layouts.app')

@section('content')
            <div class="container">
                <!-- ↓↓↓ 検索フォーム ↓↓↓ -->
                <div class="search">
                    <form action="{{ route('product.list') }}" method="GET" class="search__form">
                        @csrf
                        <input type="text" name="keyword" value="{{ $keyword }}" class="search__form-input">
                        <select name="filter" class="search__form-filter" value="{{ old('filter') }}">
                            <option value="" hidden>メーカー</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->company_name }}"
                                @if ($company->company_name == old('filter')) selected @endif>
                                {{ $company->company_name }}</option>
                            @endforeach
                        </select>
                        <input type="submit" value="検索" class="search__form-button">
                    </form>
                    
                </div>
                <!-- ↑↑↑ 検索フォームここまで ↑↑↑ -->

                <!-- ↓↓↓ 新規登録リンク ↓↓↓ -->
                <a href="{{ route('product.create.get') }}" >新規登録</a>
                <!-- ↑↑↑ 新規登録リンクここまで ↑↑↑ -->

                <!-- ↓↓↓ 商品一覧テーブル表示 ↓↓↓ -->
                <div class="list">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th>id</th>
                                <th>商品画像</th>
                                <th>商品名</th>
                                <th>価格</th>
                                <th>在庫数</th>
                                <th>メーカー名</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td><img src="{{ asset('storage/' . $product->img_path) }}" style="height:50px; width: 50px;"></td>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>{{ $product->company_name }}</td>
                                <td><a href="{{ route('product.detail', ['id'=>$product->id]) }}">詳細表示</a></td>
                                <td>
                                    <form class="table__del-btn" action="{{ route('product.destroy', ['id'=>$product->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit" value="">削除</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- ↑↑↑ 商品一覧テーブル表示ここまで ↑↑↑ -->
            </div>
        <!-- JavaScript -->
        <script src="{{ asset('/js/script.js') }}"></script>
@endsection

