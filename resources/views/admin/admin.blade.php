<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Database</title>
</head>
<body>
    <h1> Chick.Co </h1>
    <p> This is Database of Chick.Co Apparel Product</p>
  
    <a href="{{ route('admin.product.add') }}" class="btn btn-primary">Add Product</a>

    
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
                    <form method="GET" action="{{ url('admin/edit', $prod->id) }}">
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
</html>