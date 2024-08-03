<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Photobooth</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        .centered-button {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>

<body>
    <div class="container centered-button">
        <a href="" class="btn btn-dark shadow btn-lg" id="pay-button">
            Bayar</a>
    </div>
</body>


</html>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
</script>
<script>
    const payButton = document.querySelector('#pay-button');
    payButton.addEventListener('click', function(e) {
        e.preventDefault();

        snap.pay('{{ $snapToken }}', {
            // Optional
            onSuccess: function(result) {
                Swal.fire({
                    icon: 'success',
                    title: 'Pembayaran Berhasil!',
                    text: 'Terima kasih atas pembayaran Anda.',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    // Redirect atau lakukan tindakan lain setelah pengguna menekan OK
                    if (result.isConfirmed) {
                        window.location.href =
                            '/daftar-transaksi'; // Ganti dengan URL halaman informasi lainnya
                    }
                });;
                console.log(result)
            },
            // Optional
            onPending: function(result) {
                Swal.fire({
                    icon: 'info',
                    title: 'Pembayaran Sedang Diproses',
                    text: 'Pembayaran Anda masih dalam proses. Harap tunggu konfirmasi lebih lanjut.',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    // Redirect atau lakukan tindakan lain setelah pengguna menekan OK
                    if (result.isConfirmed) {
                        window.location.href =
                            '/daftar-transaksi'; // Ganti dengan URL halaman informasi lainnya
                    }
                });
                console.log(result)
            },
            // Optional
            onError: function(result) {
                Swal.fire({
                    icon: 'info',
                    title: 'Pembayaran Sedang Diproses',
                    text: 'Pembayaran Anda masih dalam proses. Harap tunggu konfirmasi lebih lanjut.',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    // Redirect atau lakukan tindakan lain setelah pengguna menekan OK
                    if (result.isConfirmed) {
                        window.location.href =
                            '/daftar-transaksi'; // Ganti dengan URL halaman informasi lainnya
                    }
                });
                console.log(result)
            }
        });
    });
</script>
