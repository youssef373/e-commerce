<!DOCTYPE html>
<html>
<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <base href="/public">
    <link rel="shortcut icon" href="user/images/favicon.png" type="">
    <title>Famms - Fashion HTML Template</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="user/css/bootstrap.css" />
    <!-- font awesome style -->
    <link href="user/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="user/css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="user/ss/responsive.css" rel="stylesheet" />
</head>
<body>
<div class="hero_area">
    <!-- header section starts -->
    @include('user.header')
    <!-- end header section -->
    @if(session()->has('message'))
        <div style="width: 235%" class="alert alert-{{session()->get('status')}}" role="alert">
            <button type="button" class="close" data-dismiss="alert">
                X
            </button>
            {{session()->get('message')}}
        </div>
    @endif

    <div class="col-sm-6 col-md-4 col-lg-4" style="margin: auto; width: 50%; padding: 30px;">
        <div class="box">
            <div class="img-box" style="padding: 20px">
                <img src="productimage/{{$product->image}}" alt="">
            </div>
            <div class="detail-box">
                <h5>
                    {{$product->title}}
                </h5>
                @if($product->discount_price != NULL)
                    <h6>
                        {{$product->discount_price}} EGP
                    </h6>
                    <h6 style="text-decoration: line-through">
                        {{$product->price}} EGP
                    </h6>
                @else
                    <h6>
                        {{$product->price}} EGP
                    </h6>
                @endif
                <h6>
                    Product Category: {{$product->category}}
                </h6>
                <h6>
                    Product Details: {{$product->description}}
                </h6>
                <h6>
                    Available Quantity: {{$product->quantity}}
                </h6>
                <form action="{{url('add_to_cart', $product->id)}}" method="post">

                    @csrf

                    <div class="row">
                        @if($product->quantity == 0)
                            <div class="col-md-8">
                                <p style="color: red">The Product is not available right now</p>
                            </div>
                        @else
                            <div class="col-md-4">
                                <input width="100px;" type="number" name="quantity" value="1" min="1" max="{{$product->quantity}}">
                            </div>
                            <div class="col-md-3">
                                <input type="submit" value="Add to cart">
                            </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@include('user.footer')
<!-- footer end -->
<div class="cpy_">
    <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>

        Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>

    </p>
</div>
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
