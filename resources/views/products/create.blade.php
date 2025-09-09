@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Produk</h2>

    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="barcode" class="form-label">Barcode</label>
            <input type="text" id="barcode" name="barcode" class="form-control" placeholder="Scan / Masukkan barcode">
        </div>

        <!-- Scanner Camera -->
        <div class="mb-3">
            <button type="button" id="startScan" class="btn btn-primary">Scan Barcode</button>
        </div>
        <div id="reader" style="width:300px; display:none;"></div>

        <div class="mb-3">
            <label for="name" class="form-label">Nama Produk</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stok</label>
            <input type="number" name="stock" class="form-control" placeholder="Masukkan jumlah stok" required>
        </div>


        <div class="mb-3">
            <label for="price" class="form-label">Harga</label>
            <input type="number" name="price" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
<!-- HTML5 QR Code Scanner -->
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

<script>
    const html5QrCode = new Html5Qrcode("reader");
    const qrCodeSuccessCallback = (decodedText, decodedResult) => {
        // Masukkan hasil scan ke input barcode
        document.getElementById("barcode").value = decodedText;
        // Stop scanning setelah sukses
        html5QrCode.stop().then(() => {
            document.getElementById("reader").style.display = "none";
        });
    };

    const config = { fps: 10, qrbox: { width: 250, height: 100 } };

    document.getElementById("startScan").addEventListener("click", () => {
        document.getElementById("reader").style.display = "block";
        html5QrCode.start({ facingMode: "environment" }, config, qrCodeSuccessCallback);
    });
</script>

@endsection
