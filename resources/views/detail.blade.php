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

                <!-- ↓↓↓ 商品一覧テーブル表示 ↓↓↓ -->
                <div class="lists">
                    <table>
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>商品画像</th>
                                <th>商品名</th>
                                <th>メーカー名</th>
                                <th>価格</th>
                                <th>在庫数</th>
                                <th>コメント</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td><img src="{{ asset($product->img_path) }}" style="height:200px; width: 200px;"></td>
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
        </div>
    </body>
</html>
