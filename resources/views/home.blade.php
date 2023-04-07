@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mb-5">
            <img src="{{url('images/logo.png')}}" class="rounded mx-auto d-block" width="500" alt="">
        </div>
        @foreach($barangs as $barang)
        <div class="col-md-4">
            <div class="card">
                <img class="card-img-top" src="{{url('uploads')}}/{{$barang->gambar}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{$barang->nama_barang}}</h5>
                    <p class="card-text">
                        <strong>Harga :</strong> Rp. {{number_format($barang->harga)}}<br>
                        <strong>Stock :</strong> {{$barang->stok}}<br>
                        <hr>
                        <strong>Keterangan :</strong> <br>
                        {{$barang->keterangan}}
                    </p>
                    <a href="{{url('pesan')}}/{{$barang->id}}" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Pesan</a>
                    <button class="btn btn-secondary whishlist-btn" data-product-id="{{$barang->id}}"><i class="fa fa-heart"></i>Add to Whishlist</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>
<script>
    $(document).ready(function() {
        // Add click event listener to all wishlist buttons
        $('.whishlist-btn').click(function() {
            // Get the product ID from the data attribute
            var productId = $(this).data('product-id');
            // Send AJAX request to add the product to the wishlist
            $.ajax({
                url: "{{url('wishlist/store')}}",
                method: 'POST',
                data: {
                    '_token': "{{ csrf_token() }}",
                    'product_id': productId
                },
                success: function(response) {
                    // Show success message
                    window.location.href = window.location.pathname
                },
                error: function(response) {
                    alert('An error occurred while adding to whishlist.');
                }
            });
        });
    });
</script>
@endsection
