@extends('layouts.layout')

@section('content')
<div class="container">
<!----------------------------------------------------
見出し
----------------------------------------------------->
    <br>
    <div class="heading">
        <h2 class="heading__text">New Registration</h2>
    </div>
    <br>
<!----------------------------------------------------
登録フォーム
----------------------------------------------------->
    <form class="form" action="{{ route('product.create') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form__group">
            <label class="form__group-label" for="product_name">商品名</label>
            <input class="form__group-control"  class="form__group-control" type="text" name="product_name" value="{{ old('product_name') }}">
            <div class="wrapper--message">
            @if ($errors->has('product_name'))
                <p class="message--worning">{{ $errors->first('product_name') }}</p>
            @endif
            </div>
        </div>
        <div class="form__group">
            <label class="form__group-label" for="company_name">メーカー</label>
            <select class="form__group-control" name="company_name" value="{{ old('company_name') }}">
                <option value="" hidden>選択してください</option>
                @foreach ($companies as $company)
                    <option value="{{ $company->company_name }}">{{ $company->company_name }}</option>
                @endforeach
            </select>
            <div class="wrapper--message">
            @if ($errors->has('company_name'))
                <p class="message--worning">{{ $errors->first('company_name') }}</p>
            @endif
            </div>
        </div>
        <div class="form__group">
            <label class="form__group-label" for="price">価格</label>
            <input class="form__group-control" type="text" name="price" value="{{ old('price') }}">
            <div class="wrapper--message">
            @if ($errors->has('price'))
                <p class="message--worning">{{ $errors->first('price') }}</p>
            @endif
            </div>
        </div>
        <div class="form__group">
            <label class="form__group-label" for="stock">在庫数</label>
            <input class="form__group-control" type="text" name="stock" value="{{ old('stock') }}">
            <div class="wrapper--message">
            @if ($errors->has('stock'))
                <p class="message--worning">{{ $errors->first('stock') }}</p>
            @endif
            </div>
        </div>
        <div class="form__group">
            <label class="form__group-label" for="comment">コメント</label>
            <textarea class="form__group-control" type="text" name="comment" value="{{ old('comment') }}"></textarea>
            <div class="wrapper--message">
            @if ($errors->has('comment'))
                <p class="message--worning">{{ $errors->first('comment') }}</p>
            @endif
            </div>
        </div>
        <div class="form__group">
            <label class="form__group-label" for="photo">商品画像</label>
            <input class="form__group-control form__group-control--file" type="file" name="photo" value="{{ old('photo') }}" class="form-control-file">
            <div class="wrapper--message">
            @if ($errors->has('photo'))
                <p class="message--worning">{{ $errors->first('photo') }}</p>
            @endif
            </div>
        </div>
<!----------------------------------------------------
ボタン
----------------------------------------------------->
        <div class="form__group--button">
            <input class="form__group-button link--update" type="submit" value="Resister">
            <a class="form__group-button link--back" href="{{ route('product.list') }}">Back</a>
        </div>
    </form>
</div>
@endsection
