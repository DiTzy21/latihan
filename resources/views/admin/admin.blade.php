@extends('layouts.app')


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chick.CO Database</title>
</head>

@section('content')
<body>
    <h1> Chick.Co </h1>
    <p> This is Database of Chick.Co Apparel Product</p>
  
    <div class="text-center mt-3">
    <a href="{{ route('admin.product.add') }}" class="btn btn-primary btn-lg" role="button">Add Product</a>
</div>


    
    <table border ="1px">
        <thead>
            <tr>
                <td>ID</td>
                <td>Nama</td>
                <td>Gambar</td>
                <td>Harga</td>
                <td>Stok</td>
                <td>Keterangan</td>
                <td></td>
                <td></td>
            </tr>
        </thead>

        <tbody>
             @foreach ($barang as $prod)
            <tr>
                <td>{{ $prod->id }}</td>
                <td>{{ $prod->nama_barang }}</td>
                <td>{{ $prod->gambar }}</td>
                <td>{{ $prod->harga }}</td>
                <td>{{ $prod->stok }}</td>
                <td>{{ $prod->keterangan }}</td>
                <td>
                    <form method="GET" action="{{ url('admin/productedit', $prod->id) }}">
                        <button type="submit" class="btn btn-sm btn-primary">Edit</button>
                    </form>
                </td>
                <td>
                    <form method="POST" action="{{ route('admin.product.delete', $prod->id) }}">
                    @csrf
                    @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-primary">Delete</button>
                    </form>
                </td>
                @endforeach
            </tr>
        </tbody>
    
    </table>
    
</body>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<style>
    /* Additional custom CSS */
    body {
        background-color: #f5f5f5;
    }
    h1 {
        color: #333;
        font-size: 3rem;
        margin-top: 2rem;
        margin-bottom: 2rem;
        text-align: center;
        text-shadow: 2px 2px #ddd;
    }
    p {
        color: #555;
        font-size: 1.5rem;
        margin-bottom: 3rem;
        text-align: center;
    }
    table {
        background-color: #fff;
        border-collapse: collapse;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin: 0 auto;
        max-width: 960px;
        width: 100%;
    }
    table thead tr {
        background-color: #007bff;
        color: #fff;
    }
    table th,
    table td {
        border: 1px solid #ddd;
        padding: 1rem;
        text-align: center;
    }
    table tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    .btn-add {
        background-color: #28a745;
        border: none;
    }
    .btn-add:hover {
        background-color: #218838;
    }
    .btn-edit,
    .btn-delete {
        background-color: #007bff;
        border: none;
        color: #fff;
    }
    .btn-edit:hover,
    .btn-delete:hover {
        background-color: #0069d9;
    }
</style>

</html>
@endsection
