<section class="product_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Our <span>products</span>
            </h2>
            <form id="searchProduct">
                @csrf
                <input id="search" style="width: 400px;" type="text" name="search" placeholder="Search for something">
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
        $('#searchProduct').on('submit', function (e)
        {
            e.preventDefault();
            let search = $('#search').val();
            let category = $('#category').val();
            $.ajax({
                url: 'search_product',
                method: "GET",
                data: {
                    search: search,
                },
                success:function (data) {
                    $("#product_data").html(data);
                    $("#searchProduct")[0].reset();
                }
            })
        })
    })
</script>
