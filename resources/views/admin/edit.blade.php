<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DB Edit</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.2/css/bootstrap.min.css" integrity="sha512-4siNO4sFxAKlBhV2KjotA+THV7BfYgW/UhXpCjLz77VbWRu19OL/34QVjLwO/Vmb/vlCazPk/f0iXVxOJjgB7Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container my-4">
        <h1 class="mb-4">{{ $barang->nama_barang }}</h1>
        <form method="POST" action="{{ url('admin/admin') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">ID:</label>
                <input type="text" class="form-control" name="barang_id" value="{{ $barang->id }}">
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
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.2/js/bootstrap.min.js" integrity="sha512-y7LzDFRf+jLD9d/5f5g5Wy5S5S5G5c5+xLZJNhx/Gg4l4VLdtY0QMLnMf32yUxPCErGMxn6QnCyaWnNhZgKp6w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>