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
                    <li class="breadcrumb-item active" aria-current="page"><strong>{{$barang->nama_barang}}</strong></li>
                </ol>
            </nav>
        </div>
        <div class="col-md-12 mt-3">
            <div class="card">

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{url('uploads')}}/{{$barang->gambar}}" class="rounded mx-auto d-block" width="100%" alt="">
                        </div>
                        <div class="col-md-6 mt-5">
                            <h2>{{$barang->nama_barang}}</h2>
                            <table class="table table-striped">
                                <tbody>
                                    <tr class="table-primary">
                                        <td>Harga</td>
                                        <td>:</td>
                                        <td>Rp. {{number_format($barang->harga)}}</td>

                                    </tr>
                                    <tr>
                                        <td>Stock</td>
                                        <td>:</td>
                                        <td>{{($barang->stok)}}</td>

                                    </tr>
                                    <tr class="table-primary">
                                        <td>Keterangan</td>
                                        <td>:</td>
                                        <td>{{$barang->keterangan}}</td>

                                    </tr>

                                    <tr>
                                        <td>Jumlah Pesan</td>
                                        <td>:</td>
                                        <td>
                                            <form method="post" action="{{url('pesan')}}/{{$barang->id}}">
                                                @csrf
                                                <input type="text" name="jumlah_pesan" class="form-control" required="">
                                                <button type="submit" class="btn btn-outline-primary mt-2"><i class="fa fa-shopping-cart"></i> Go to the Cart</button>
                                            </form>
                                        </td>


                                    </tr>
                                    <tr class="table-primary">
                                        <td></td>
                                        <td></td>
                                        <td>


                                        </td>
                                    </tr>

                                    </form>


                                </tbody>


                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection