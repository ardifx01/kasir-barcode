@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Scan Barcode Produk</h2>
    <div id="reader" style="width:300px;"></div>
    <div id="result" class="mt-3"></div>
</div>

<script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
<script>
    function onScanSuccess(decodedText, decodedResult) {
        document.getElementById('result').innerHTML = `<b>Barcode:</b> ${decodedText}`;

        // otomatis cek ke database produk (opsional AJAX)
        fetch(`/api/product/${decodedText}`)
            .then(res => res.json())
            .then(data => {
                if(data) {
                    alert(`Produk: ${data.name} | Harga: Rp ${data.price}`);
                } else {
                    alert("Produk tidak ditemukan!");
                }
            });
    }

    let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", { fps: 10, qrbox: 250 });
    html5QrcodeScanner.render(onScanSuccess);
</script>
@endsection
