<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            /* ↓↓ 自分で記述 ↓↓ */
            .form__input--red {
                color: red;
                font-size: 10px;
            }
            /* ↑↑ 自分で記述ここまで ↑↑ */
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <!-- ↓↓↓ 登録フォーム ↓↓↓ -->
                <form action="{{ route('product.create') }}" method="POST" enctype="multipart/form-data" class="form">
                    @csrf
                    <div class="form__input">
                        <label for="id">ID</label>
                        <input type="text" name="id" value="" placeholder="{{ $products->id }}" readonly>
                    </div>
                    <div class="form__input">
                        <label for="product_name">商品名</label>
                        <input type="text" name="product_name" value="" placeholder="{{ $products->product_name }}">
                        @if ($errors->has('product_name'))
                            <p class="form__input--red">{{ $errors->first('product_name') }}</p>
                        @endif
                    </div>
                    <div class="form__input">
                        <label for="company_name">メーカー</label>
                        <select name="company_name" value="">
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
                    <div class="form__input">
                        <label for="price">価格</label>
                        <input type="text" name="price" value="" placeholder="{{ $products->price }}">
                        @if ($errors->has('price'))
                            <p class="form__input--red">{{ $errors->first('price') }}</p>
                        @endif
                    </div>
                    <div class="form__input">
                        <label for="stock">在庫数</label>
                        <input type="text" name="stock" value="" placeholder="{{ $products->stock }}">
                        @if ($errors->has('stock'))
                            <p class="form__input--red">{{ $errors->first('stock') }}</p>
                        @endif
                    </div>
                    <div class="form__input">
                        <label for="comment">コメント</label>
                        <textarea type="text" name="comment" value="{{ $products->comment }}" placeholder="{{ $products->comment }}"></textarea>
                        @if ($errors->has('comment'))
                            <p class="form__input--red">{{ $errors->first('comment') }}</p>
                        @endif
                    </div>
                    <div class="form__input">
                        <label for="photo">商品画像</label>
                        <input type="file" name="photo" value="{{ $products->img_path }}">
                        @if ($errors->has('photo'))
                            <p class="form__input--red">{{ $errors->first('photo') }}</p>
                        @endif
                    </div>
                    
                    <input type="submit" value="登録">
                </form>
                <!-- ↑↑↑ 登録フォームここまで ↑↑↑ -->
                <!-- ↓↓↓ 戻るボタン ↓↓↓ -->
                <a href="{{ route('products_list') }}">戻る</a>
                <!-- ↑↑↑ 戻るボタンここまで ↑↑↑ -->
            </div>
        </div>
    </body>
</html>
