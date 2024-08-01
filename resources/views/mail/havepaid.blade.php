<!-- resources/views/mail/havepaid.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Bayar Uang Kas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 0;
            text-align: center;
        }

        .content {
            padding: 20px;
        }

        .content h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .content p {
            font-size: 16px;
            line-height: 1.5;
            margin-bottom: 20px;
        }

        .content .details {
            background-color: #f9f9f9;
            padding: 10px;
            border: 1px solid #dddddd;
        }

        .content .details p {
            margin: 0;
        }

        .footer {
            text-align: center;
            padding: 20px;
            background-color: #f4f4f4;
            color: #777777;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="container">
        {{-- <div class="header">
            <h2>Payment Confirmation</h2>
        </div> --}}
        <div class="content">
            <h1>Halo, Admin!</h1>
            <p>Saya sudah mengirimkan pembayarann uang kas, mohon segera di cek..</p>
            <div class="details">
                <p><strong>Nama Pengirim:</strong> {{ $income->users->name }}</p>
                <p><strong>Bukti Pembayaran:</strong> <a href="{{ asset('storage/' . $income->payment_proof) }}">Lihat
                        Bukti</a></p>
                <p><strong>Nominal:</strong> Rp. {{ number_format($income->amount, 2) }}</p>
                <p><strong>Tanggal:</strong> {{ $income->income_date }}</p>
                <p><strong>Deskripsi:</strong> {{ $income->description }}</p>
            </div>
            <p>Terima Kasih Mas!</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Kontrakan Las Vegas. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
