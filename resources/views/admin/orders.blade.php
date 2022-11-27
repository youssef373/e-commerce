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
    <div class="main-panel" style="margin-top: 100px; margin-right: 300px;">
        @if(session()->has('message'))
            <div style="width: 100%" class="alert alert-{{session()->get('status')}}" role="alert">
                {{session()->get('message')}}
            </div>
        @endif
        <div style="">

            <form action="{{url('search_orders')}}" method="get" style="color: black">

                @csrf

                <input type="text" name="search" placeholder="Search for orders">

                <input type="submit" value="search" class="btn btn-primary">
            </form>
        </div>
        <table class="table table-light" style="width: 1600px; text-align: center;">
            <thead class="table">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Product Title</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Image</th>
                <th>Payment Status</th>
                <th>Delivery Status</th>
                <th>Delivered</th>
                <th>Print PDF</th>
                <th>Email</th>
            </tr>
            </thead>
            <tbody>
            @forelse($orders as $order)
                <tr>

                    <td>{{$order->name}}</td>
                    <td>{{$order->email}}</td>
                    <td>{{$order->phone}}</td>
                    <td>{{$order->address}}</td>
                    <td>{{$order->product_title}}</td>
                    <td>{{$order->price}}</td>
                    <td>{{$order->quantity}}</td>
                    <td>
                        <img style="margin: auto; width: 300px; height: 100px;" src="productimage/{{$order->image}}" alt="">
                    </td>
                    <td>{{$order->payment_status}}</td>
                    <td>{{$order->delivery_status}}</td>
                    <td>
                        @if($order->delivery_status == 'processing')
                            <a href="{{url('deliver_order', $order->id)}}" class="btn btn-success">Deliver</a>
                        @elseif($order->delivery_status == 'Canceled')
                            <p style="color:red;">Canceled</p>
                        @else
                            <p style="color:green;">Delivered</p>
                        @endif
                    </td>
                    <td><a href="{{url('print_pdf', $order->id)}}" class="btn btn-secondary">Print PDF</a></td>
                    <td><a href="{{url('send_email_view', $order->id)}}" class="btn btn-info">Send Email</a></td>
                </tr>
            @empty
                <tr>
                    <td colspan="16" style="font-size: 20px;">No data found</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <!-- plugins:js -->
    @include('admin.script')
</div>
</body>
</html>
