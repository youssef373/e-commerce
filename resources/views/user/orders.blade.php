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

        <table class="table" style="text-align: center">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Product Title</th>
                <th scope="col">Price</th>
                <th scope="col">quantity</th>
                <th scope="col">Image</th>
                <th scope="col">Delivery Status</th>
                <th>Payment Status</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>

            @foreach($orders as $order)
                <tr>
                  <td>{{$order->product_title}}</td>
                    <td>{{$order->product_title}}</td>
                    <td>{{$order->quantity}}</td>
                    <td style="width: 200px; margin:auto">
                        <img src="productimage/{{$order->image}}" alt="">
                    </td>
                    <td>{{$order->delivery_status}}</td>
                    <td>{{$order->payment_status}}</td>
                    <td>
                        @if($order->delivery_status == 'delivered')
                            <span style="color: green">Delivered</span>
                        @elseif($order->delivery_status == 'Canceled')
                            <span style="color: red">Canceled</span>
                        @else
                        <a onclick="return confirm('are you sure you want to cancel order')"
                           href="{{url('cancel_order', $order->id)}}" class="btn btn-danger">Cancel</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

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
