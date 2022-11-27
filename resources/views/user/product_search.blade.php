<section class="product_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Our <span>products</span>
            </h2>
            <form id="searchProduct" action="{{url('search_product')}}" method="get">
                @csrf
                <input id="search" style="width: 400px;" type="text" name="search" placeholder="Search for something">
                <select  style="width: 100px;" name="category" id="category">
                    @foreach($categories as $category)
                        <option style="color:red; width: 20px;" value="{{$category->category_name}}">{{$category->category_name}}</option>
                    @endforeach
                    <option value="None">None</option>
                </select>
                <input type="submit" value="Search">
            </form>
        </div>
        @include('user.paginate')
    </div>
</section>
<script src="user/js/jquery-3.4.1.min.js"></script>
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).on('click', '.pagination a', function (event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetch_data(page);
        });

        function fetch_data(page) {
            $.ajax({
                url: "/paginate/fetch_data?page=" + page,
                success: function (data) {
                    $("#product_data").html(data);
                }
            });
        }
    })
</script>
