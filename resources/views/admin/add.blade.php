<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create New Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>New Product</h1>

            <form method="POST" action="{{ url('admin/add') }}">
            @csrf

            <div class="form-group">
                <label for="title">Nama:</label>
                <input type="text" class="form-control" id="nama_barang" name="nama_barang">
            </div>

            <div class="form-group">
                <label for="image">Gambar:</label>
                <input type="text" class="form-control" id="gambar" name="gambar">
            </div>

            <div class="form-group">
                <label for="price">Harga:</label>
                <input type="text" class="form-control" id="harga" name="harga">
            </div>

            <div class="form-group">
                <label for="stock">Stok:</label>
                <input type="text" class="form-control" id="stok" name="stok">
            </div>

            <div class="form-group">
                <label for="description">Keterangan:</label>
                <input type="text" class="form-control" id="keterangan" name="keterangan">
            </div>

            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>
</body>
</html>