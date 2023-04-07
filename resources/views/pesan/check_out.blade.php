@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="{{url('home')}}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Return</a>
        </div>
        <div class="col-md-12 mt-3">
            <nav aria-label="breadcrumb" class="bg-info py-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><strong>Check Out</strong></li>
                </ol>
            </nav>
        </div>
        <div class="col-md-12 mt-3">
            <div class="card">
                <div class="card-header">
                    <h3><i class="fa fa-shopping-cart col-mt-2"></i>Check Out</h3>
                    @if(!empty($pesanan))
                    <p align="right">Tanggal pesan: {{$pesanan->tanggal}}</p>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Total Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($pesanan_detail as $pesanan_details)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$pesanan_details->barang->nama_barang}}</td>
                                <td>{{$pesanan_details->jumlah}} Buah</td>
                                <td align="left">Rp {{number_format($pesanan_details->barang->harga)}}</td>
                                <td align="left">Rp {{number_format($pesanan_details->jumlah_harga)}}</td>
                                <td>
                                    <form action="{{url('check-out')}}/{{$pesanan_details->id}}" method="post">
                                        @csrf
                                        {{method_field('DELETE')}}
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                    </form>
                                    
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="4" align="right"><strong>Total Price :</strong></td>
                                <td><strong>Rp. {{number_format($pesanan->jumlah_harga)}}</strong></td>
                                <td>
                                        <button type="button" id="check-out-btn" class="btn btn-success btn-sm"><i class="fa fa-shopping-cart"></i>Check Out</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        // Add click event listener to all wishlist buttons
        $('#check-out-btn').click(function() {
            // Get the product ID from the data attribute
            // Send AJAX request to add the product to the wishlist
            $.ajax({
                url: "{{url('check-out')}}",
                method: 'POST',
                data: {
                    '_token': "{{ csrf_token() }}"
                },
                success: async function(response) {
                    // Show success message
                    var { value: description } = await Swal.fire({
                        title: 'Comment our product',
                        input: 'textarea',
                        showCancelButton: true,
                    });
                    $.ajax({
                        url: "{{url('product-comments')}}",
                        method: 'POST',
                        data: {
                            '_token': "{{ csrf_token() }}",
                            description: description,
                            product_ids: response.ids
                        },
                        success: async function(response) {
                            // Show success message
                            window.location.href = "{{url('/home')}}"
                        },
                        error: function(response) {
                            alert('An error occurred.');
                        }
                    });
                },
                error: function(response) {
                    alert('An error occured.');
                }
            });
        });
    });
</script>
@endsection