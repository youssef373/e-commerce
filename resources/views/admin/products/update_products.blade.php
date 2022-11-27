<!DOCTYPE html>
<html lang="en">
@include('admin.head')
<body>
<div class="container-scroller">
    <div class="row p-0 m-0 proBanner" id="proBanner">
        <div class="col-md-12 p-0 m-0">
            <div class="card-body card-body-padding d-flex align-items-center justify-content-between">
                <div class="ps-lg-1">
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="mb-0 font-weight-medium me-3 buy-now-text">Free 24/7 customer support, updates, and more with this template!</p>
                        <a href="https://www.bootstrapdash.com/product/corona-free/?utm_source=organic&utm_medium=banner&utm_campaign=buynow_demo" target="_blank" class="btn me-2 buy-now-btn border-0">Get Pro</a>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <a href="https://www.bootstrapdash.com/product/corona-free/"><i class="mdi mdi-home me-3 text-white"></i></a>
                    <button id="bannerClose" class="btn border-0 p-0">
                        <i class="mdi mdi-close text-white me-0"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- partial:partials/_sidebar.html -->
    @include('admin.sidebar')
    <!-- partial -->
    @include('admin.navbar')
    <!-- partial -->
    <div class="main-panel" style="margin-top: 100px; margin-right: 500px; padding: 100px;">
        @if(session()->has('message'))
            <div class="alert alert-{{session()->get('status')}}" role="alert">
                {{session()->get('message')}}
            </div>
        @endif
        <form action="{{url('update_product', $product->id)}}" enctype="multipart/form-data" method="post">

            @csrf

            <div class="input-group mt-6">
                <label class="col-sm-3 col-form-label">Title</label>
                <input style="color: black; background-color: white" type="text" name="title" class="form-control" value="{{$product->title}}">
            </div>

            @error('title')
            <span class="text-danger">{{$message}}</span>
            @enderror

            <div class="input-group mt-6">
                <label class="col-sm-3 col-form-label align-items-center">Description</label>
                <input style="color: black; background-color: white;" type="text" name="description" class="form-control" value="{{$product->description}}">
            </div>

            @error('description')
            <span class="text-danger">{{$message}}</span>
            @enderror

            <div class="input-group mt-6">
                <label  class="col-sm-3 col-form-label">Category</label>
                <input style="color: black; background-color: white" type="text" name="category" class="form-control" value="{{$product->category}}">
            </div>

            @error('category')
            <span class="text-danger">{{$message}}</span>
            @enderror

            <div class="input-group mt-6">
                <label class="col-sm-3 col-form-label">Price</label>
                <input style="color: black; background-color: white" type="text" name="price" class="form-control" value="{{$product->price}}">
            </div>

            @error('price')
            <span class="text-danger">{{$message}}</span>
            @enderror

            <div class="input-group mt-6">
                <label class="col-sm-3 col-form-label">Discount</label>
                <input style="color: black; background-color: white" type="text" name="discount_price" class="form-control" value="{{$product->discount_price}}">
            </div>

            @error('discount_price')
            <span class="text-danger">{{$message}}</span>
            @enderror

            <div class="input-group mt-6">
                <label class="col-sm-3 col-form-label">Quantity</label>
                <input style="color: black; background-color: white" type="number" name="quantity" class="form-control" value="{{$product->quantity}}">
            </div>

            @error('quantity')
            <span class="text-danger">{{$message}}</span>
            @enderror

            <div class="input-group mt-6 mb-3">
                <label class="col-sm-2 col-form-label">Image</label>
                <input name="image" type="file">
            </div>
            <div>
                <span>Current Image</span>
                <img src="productimage/{{$product->image}}" alt="">
            </div>
            <div class="input-group mt-6" style="margin-left: 200px !important">
                <input class="btn btn-primary" value="Update" style="" type="submit">
            </div>
        </form>
    </div>
    <!-- plugins:js -->
    @include('admin.script')
</div>
</body>
</html>
