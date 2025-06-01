<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Kategori</th>
            <th>UMKM</th>
            <th>Harga</th>
            <th>Status UMKM</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $index => $product)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $product->nama_produk }}</td>
                <td>{{ $product->category->nama_kategori ?? '-' }}</td>
                <td>{{ $product->umkmProfile->nama_umkm ?? '-' }}</td>
                <td>{{ $product->harga }}</td>
                <td>{{ $product->umkmProfile->status ?? '-' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
