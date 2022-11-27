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
    <div class="main-panel" style="margin-top: 100px; margin-right: 600px; width: 500px;">
        @if(session()->has('message'))
            <div  class="alert alert-{{session()->get('status')}}" role="alert">
                {{session()->get('message')}}
            </div>
        @endif
        <table class="table table-light" style="width: 500px;">
            <thead>
            <tr>
                <th style="text-align: center">Name</th>
                <th style="text-align: center">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td style="text-align: center">{{$category->category_name}}</td>
                    <td style="text-align: center">
                        <a onclick="return confirm('are you sure you want to delete this')"
                           href="{{url('delete_category', $category->id)}}" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- plugins:js -->
    @include('admin.script')
</div>
</body>
</html>
