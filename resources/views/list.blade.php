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

                <!-- ????????? ?????????????????? ????????? -->
                <div class="search">
                    <form action="{{ route('product.list') }}" method="GET" class="search__form">
                        @csrf
                        <input type="text" name="keyword" value="{{ $keyword }}" class="search__form-input">
                        <select name="filter" class="search__form-filter" value="{{ old('filter') }}">
                            <option value="" hidden>????????????</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->company_name }}"
                                @if ($company->company_name == old('filter')) selected @endif>
                                {{ $company->company_name }}</option>
                            @endforeach
                        </select>
                        <input type="submit" value="??????" class="search__form-button">
                    </form>
                    
                </div>
                <!-- ????????? ?????????????????????????????? ????????? -->

                <!-- ????????? ????????????????????? ????????? -->
                <a href="{{ route('product.create.get') }}" >????????????</a>
                <!-- ????????? ????????????????????????????????? ????????? -->

                <!-- ????????? ?????????????????????????????? ????????? -->
                <div class="lists">
                    <table>
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>????????????</th>
                                <th>?????????</th>
                                <th>??????</th>
                                <th>?????????</th>
                                <th>???????????????</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->img_path }}</td>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>{{ $product->company_name }}</td>
                                <td><a href="{{ route('product.detail', ['id'=>$product->id]) }}">????????????</a></td>
                                <td>
                                    <form action="{{ route('product.destroy', ['id'=>$product->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit">??????</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- ????????? ?????????????????????????????????????????? ????????? -->

            </div>
        </div>
    </body>
</html>
