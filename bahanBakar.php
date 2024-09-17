<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bahan Bakar</title>
    <style>
        /* Mengatur seluruh body agar memiliki margin dan padding 0 */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        /* Styling untuk form agar tampil lebih rapi */
        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin-bottom: 20px;
        }

        /* Mengatur ukuran dan posisi dari judul form */
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }

        /* Mengatur tampilan label */
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #333;
        }

        /* Styling untuk dropdown dan input agar serasi */
        select, input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        /* Styling untuk tombol submit */
        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        /* Hover effect untuk tombol */
        button:hover {
            background-color: #0056b3;
        }

        /* Media query untuk layar lebih kecil */
        @media (max-width: 600px) {
            form {
                width: 90%;
            }
        }

        /* Styling untuk hasil transaksi */
        .transaction-result {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: left;
        }

        .transaction-result h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .transaction-result p {
            font-size: 16px;
            color: #555;
            margin-bottom: 10px;
        }

        .transaction-result strong {
            color: #007bff;
        }
    </style>
</head>
<body>

    <form action="" method="post">
        <h1>Pembelian Bahan Bakar Shell</h1>
        <label for="jenis">Jenis Bahan Bakar</label>
        <select name="jenis" id="jenis" required>
            <option value="" hidden>Pilih Jenis Bahan Bakar</option>
            <option value="Shell Super">Shell Super</option>
            <option value="Shell V-Power">Shell V-Power</option>
            <option value="Shell V-Power Diesel">Shell V-Power Diesel</option>
            <option value="Shell V-Power Nitro">Shell V-Power Nitro</option>
        </select>

        <label for="jumlah">Jumlah Liter</label>
        <input type="number" name="jumlah" id="jumlah" required>

        <button type="submit" name="btn" id="btn">Beli</button>
    </form>

    <?php
    if (isset($_POST['btn'])) {
        $jenis = $_POST['jenis'];
        $jumlah = $_POST['jumlah'];

        class BahanBakar {
            public $jenis;
            public $jumlah;

            public function __construct($jenis, $jumlah) {
                $this->jenis = $jenis;
                $this->jumlah = $jumlah;
            }

            public function hitungPembayaran() {
                switch ($this->jenis) {
                    case 'Shell Super':
                        $harga = 14830;
                        break;
                    case 'Shell V-Power':
                        $harga = 14140;
                        break;
                    case 'Shell V-Power Diesel':
                        $harga = 12600;
                        break;
                    case 'Shell V-Power Nitro':
                        $harga = 12600;
                        break;
                    default:
                        $harga = 0;
                        break;
                }
                return $this->jumlah * $harga;
            }

            public function hitungPPN() {
                $totalPembayaran = $this->hitungPembayaran();
                return $totalPembayaran * 10 / 100;
            }
        }

        $bahanBakar = new BahanBakar($jenis, $jumlah);
        $totalPembayaran = $bahanBakar->hitungPembayaran();
        $ppn = $bahanBakar->hitungPPN();

        echo "<div class='transaction-result'>";
        echo "<h2>Bukti Transaksi</h2>";
        echo "<p>Anda membeli bahan bakar minyak tipe <strong>" . $jenis . "</strong></p>";
        echo "<p>Dengan Jumlah: <strong>" . $jumlah . " Liter</strong></p>";
        echo "<p>Total yang harus Anda bayar: Rp. <strong>" . number_format($totalPembayaran + $ppn, 0, ',', '.') . "</strong></p>";
        echo "<p>PPN 10%: Rp. " . number_format($ppn, 0, ',', '.') . "</p>";
        echo "</div>";
    }
    ?>
</body>
</html>
