@extends('layouts.app')

@section('content')
            <div class="container">
                <!-- ↓↓↓ 見出し ↓↓↓ -->
                <br>
                <div class="heading">
                    <h2 class="text-left">更新</h2>
                </div>
                <br>
                <!-- ↑↑↑ 見出しここまで ↑↑↑ -->
                <!-- ↓↓↓ 登録フォーム ↓↓↓ -->
                <form action="{{ route('product.update', ['id'=>$product->id]) }}" method="POST" enctype="multipart/form-data" class="form">
                    @csrf
                    <div class="form-group">
                        <label for="id">ID</label>
                        <input type="text" name="id" value="{{ $product->id }}" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="product_name">商品名</label>
                        <input type="text" name="product_name" value="{{ $product->product_name }}" class="form-control">
                        @if ($errors->has('product_name'))
                            <p class="form__input--red">{{ $errors->first('product_name') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="company_name">メーカー</label>
                        <select name="company_name" value="" class="form-control">
                            <option value="" hidden>選択してください</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->company_name }}"
                                @if ($company->company_name == $company_name) selected @endif>
                                {{ $company->company_name }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('company_name'))
                            <p class="form__input--red">{{ $errors->first('company_name') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="price">価格</label>
                        <input type="text" name="price" value="{{ $product->price }}" class="form-control">
                        @if ($errors->has('price'))
                            <p class="form__input--red">{{ $errors->first('price') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="stock">在庫数</label>
                        <input type="text" name="stock" value="{{ $product->stock }}" class="form-control">
                        @if ($errors->has('stock'))
                            <p class="form__input--red">{{ $errors->first('stock') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="comment">コメント</label>
                        <textarea type="text" name="comment" value="{{ $product->comment }}" class="form-control">{{ $product->comment }}</textarea>
                        @if ($errors->has('comment'))
                            <p class="form__input--red">{{ $errors->first('comment') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="photo">商品画像</label>
                        <input type="file" name="photo" value="{{ $product->img_path }}" class="form-control-file">
                        @if ($errors->has('photo'))
                            <p class="form__input--red">{{ $errors->first('photo') }}</p>
                        @endif
                    </div>
                    <div class="form__button">
                        <input type="submit" value="更新" class="btn btn-primary">
                    </div>
                </form>
                <!-- ↑↑↑ 登録フォームここまで ↑↑↑ -->
                <!-- ↓↓↓ 戻るボタン ↓↓↓ -->
                <a href="{{ route('product.list') }}" class="back-btn">戻る</a>
                <!-- ↑↑↑ 戻るボタンここまで ↑↑↑ -->
            </div>
@endsection
