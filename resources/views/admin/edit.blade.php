@extends('layouts.app')


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chick.CO Product Edit</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.2/css/bootstrap.min.css" integrity="sha512-4siNO4sFxAKlBhV2KjotA+THV7BfYgW/UhXpCjLz77VbWRu19OL/34QVjLwO/Vmb/vlCazPk/f0iXVxOJjgB7Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 30px;
            color: #343a40;
        }
        label {
            font-weight: 600;
        }
        input[type="text"] {
            border-radius: 5px;
            border: 1px solid #ced4da;
            padding: 8px;
            width: 100%;
        }
        button[type="submit"] {
            margin-top: 20px;
            width: 100%;
        }
    </style>
</head>
<body>
    @section('content')
    <div class="container my-4">
        <h1>{{ $barang->nama_barang }}</h1>
        <form method="POST" action="{{ url('admin/product') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">ID:</label>
                <input type="text" class="form-control" name="id" value="{{ $barang->id }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Nama:</label>
                <input type="text" class="form-control" name="nama_barang" value="{{ $barang->nama_barang }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Gambar:</label>
                <input type="text" class="form-control" name="gambar" value="{{ $barang->gambar }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Harga:</label>
                <input type="text" class="form-control" name="harga" value="{{ $barang->harga }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Stok:</label>
                <input type="text" class="form-control" name="stok" value="{{ $barang->stok }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Keterangan:</label>
                <input type="text" class="form-control" name="keterangan" value="{{ $barang->keterangan }}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
    </form>
           
@endsection
