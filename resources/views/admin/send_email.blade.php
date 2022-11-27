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
    <div class="main-panel" style="margin-top: 100px; margin-right: 500px;">
        @if(session()->has('message'))
            <div class="alert alert-{{session()->get('status')}}" role="alert">
                {{session()->get('message')}}
            </div>
        @endif
        <h1 style="text-align: center; margin: 10px;">Sending Email to {{ $user->email }}</h1>
        <form action="{{url('send_email', $user->id)}}" enctype="multipart/form-data" method="post">

            @csrf

            <div class="input-group">
                <label for="staticEmail" class="col-sm-2 col-form-label">Greeting</label>
                <input style="color: black; background-color: white" type="text" name="greeting" class="form-control" placeholder="">
            </div>

            <div class="input-group mt-6">
                <label class="col-sm-2 col-form-label">Body</label>
                <input style="color: black; background-color: white" type="text" name="body" class="form-control" placeholder="">
            </div>

            <div class="input-group mt-6">
                <label class="col-sm-2 col-form-label">Action Text</label>
                <input style="color: black; background-color: white" type="text" name="action_text" class="form-control" placeholder="">
            </div>

            <div class="input-group mt-6">
                <label class="col-sm-2 col-form-label">Action Url</label>
                <input style="color: black; background-color: white" type="text" name="action_url" class="form-control" placeholder="">
            </div>


            <div class="input-group mt-6">
                <label class="col-sm-2 col-form-label">End Part</label>
                <input style="color: black; background-color: white" type="text" name="end_part" class="form-control" placeholder="">
            </div>

            <div class="input-group mt-6" style="margin-left: 300px">
                <input class="btn btn-success" style="" type="submit" value="Send Email">
            </div>
        </form>
    </div>
    <!-- plugins:js -->
    @include('admin.script')
</div>
</body>
</html>
