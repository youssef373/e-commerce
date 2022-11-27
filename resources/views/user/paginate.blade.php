<div class="row" id="product_data">
    @foreach($products as $product)
        <div class="col-sm-8 col-md-6 col-lg-6">
            <div class="box">
                    <div class="option_container">
                        <div class="options">
                            <a href="{{url('product_details', $product->id)}}" class="option1">
                                Product Details
                            </a>
                        </div>
                    </div>

                    <div class="img-box">
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
                    </div>
            </div>
        </div>
    @endforeach
        <span style="padding-top: 40px;">
                {!!  $products->withQueryString()->links('pagination::bootstrap-5') !!}
        </span>
    </div>

