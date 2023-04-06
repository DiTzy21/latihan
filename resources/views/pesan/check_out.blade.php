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
                                    <a href="{{url('konfirmasi-check-out')}}" class="btn btn-success"><i class="fa fa-shopping-cart"></i>Check Out</a>
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
@endsection