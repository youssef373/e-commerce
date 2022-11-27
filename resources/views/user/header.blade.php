<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <base href="/public">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <title>Document</title>
</head>
<body>
<header class="header_section">
    <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container">
            <a class="navbar-brand" href="{{url('/')}}"><img width="250" src="user/images/logo.png" alt="#" /></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class=""> </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav" style="">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{url('/')}}">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> <span class="nav-label">Pages <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="user/about.html">About</a></li>
                            <li><a href="user/testimonial.html">Testimonial</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('products')}}">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user/blog_list.html">Blog</a>
                    </li>

                    @if(Route::has('login'))
                        @auth
                            <li class="nav-item" style="margin: 5px;">
                                <a class="nav-link" href="{{url('cart_items_view')}}"><i class="fa-solid fa-cart-shopping"></i>
                                    <span style="color: red; margin: auto">
                                        @if ($productsCount > 0)
                                            {{$productsCount}}
                                        @endif
                                    </span>
                                </a>
                            </li>

                            <li class="nav-item active ">
                                <a class="nav-link" href="{{url('user_orders')}}" style="">ORDERS</a>
                            </li>

                            <x-app-layout>

                            </x-app-layout>
                        @else
                            <li class="nav-item">
                                <a class="btn btn-success ml-2" href="{{route('login')}}">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-primary ml-2" href="{{route('register')}}">Register</a>
                            </li>
                        @endauth
                    @endif
                    <form class="form-inline">
                        <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </form>
                </ul>
            </div>
        </nav>
    </div>
</header>
</body>
</html>

