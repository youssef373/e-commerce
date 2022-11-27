<!DOCTYPE html>
<html>
<head>
    <!-- Basic -->
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <!-- Site Metas -->
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <base href="/public">
    <link rel="shortcut icon" href="user/images/favicon.png" type="">
    <title>Famms - Fashion HTML Template</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="user/css/bootstrap.css"/>
    <!-- font awesome style -->
    <link href="user/css/font-awesome.min.css" rel="stylesheet"/>
    <!-- Custom styles for this template -->
    <link href="user/css/style.css" rel="stylesheet"/>
    <!-- responsive style -->
    <link href="user/ss/responsive.css" rel="stylesheet"/>
    <style>

    </style>
</head>
<body>
<div class="hero_area">
    <!-- header section starts -->
    @include('user.header')
    <!-- end header section -->
    @if(session()->has('message'))
        <div style="width: 235%" class="alert alert-{{session()->get('status')}}" role="alert">
            {{session()->get('message')}}
        </div>
    @endif
    @if($productsCount == 0)
        @if(session()->has('delivery_order'))
            <div style="text-align: center;">
                <div class="alert alert-{{session()->get('status')}}" role="alert">
                    <a href="{{'cart_items_view'}}" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <h1 style="text-align: center; font-size: 20px;">{{session()->get('delivery_order')}}</h1>
                </div>
                <a class="btn btn-success"
                   href="{{url('home')}}">Continue Shopping</a>
            </div>
        @else
        <div style="text-align: center;font-size: 30px;">
            <h1>Your Cart Is Empty</h1>
            <a class="btn btn-success"
               href="{{url('home')}}">Continue Shopping</a>
        </div>
        @endif
    @else
        <table class="table-bordered" style="text-align: center">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Product title</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
                <th scope="col">Image</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
                <?php $totalPrice = 0 ?>
            @foreach($userProducts as $userProduct)
                <tr>
                    <td>{{$userProduct->product_title}}</td>
                    <td>{{$userProduct->quantity}}</td>
                    <td>{{$userProduct->price}} EGP</td>
                    <td><img style="width: 200px; height: 200px; margin: auto"
                             src="productimage/{{$userProduct->image}}" alt=""></td>
                    <td>
                        <a onclick="return confirm('are you sure you want to delete this')"
                           href="{{url('remove_cart_product', $userProduct->id)}}" class="btn btn-danger">Remove</a>
                        <a href="{{url('update_cart_product_view', $userProduct->id)}}" class="btn btn-success">Update Quantity</a>
                    </td>
                </tr>
                    <?php $totalPrice = $totalPrice + $userProduct->price ?>
            @endforeach
            </tbody>
        </table>

        <div style="text-align: center; margin: 30px;">
            <h1 style="font-size: 20px; margin-bottom: 5px;">Total Price: {{$totalPrice}} EGP</h1>
            <a onclick="return confirm('are you sure you want to remove all the items')"
               href="{{url('remove_cart_products')}}" class="btn btn-danger">Remove All Products
            </a>
            <a class="btn btn-success" href="{{url('home')}}">Continue Shopping</a>
        </div>

        <div style="text-align: center">
            <h1 style="font-size: 20px; margin-bottom: 5px;">Proceed to Order</h1>
            <a href="{{url('cash_order')}}" class="btn btn-primary">Cash On Delivery</a>
            <a href="{{url('stripe', $totalPrice)}}" class="btn btn-primary">Pay Using Card</a>
        </div>
    @endif

    <!-- jQery -->
    <script src="user/js/jquery-3.4.1.min.js"></script>
    <!-- popper js -->
    <script src="user/js/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="user/js/bootstrap.js"></script>
    <!-- custom js -->
    <script src="user/js/custom.js"></script>
    <script>

    </script>
</body>
</html>
