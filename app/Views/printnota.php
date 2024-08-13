<!DOCTYPE html>
<html>
<head>
    <title>Nota Pembelian</title>
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 350px; /* Sesuaikan dengan ukuran A6 */
            margin: auto;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 10px;
        }
        .header, .footer {
            text-align: center;
        }
        .header {
            margin-bottom: 10px;
        }
        .footer {
            margin-top: 10px;
            font-size: 10px;
            color: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        table, th, td {
            border: 1px solid #999;
            padding: 5px;
            text-align: left;
            font-size: 10px;
        }
        th {
            background-color: #f2f2f2;
        }
        .total {
            font-weight: bold;
            border-top: 2px solid #999;
        }
        .transaction-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 10px;
        }
        .nama-toko {
            font-weight: bold;
            font-size: 20px;
            color: #333;
        }
        @media print {
            body {
                margin: 0;
            }
            .container {
                width: auto;
                max-width: none;
                border: none;
                box-shadow: none;
                margin: 0 auto;
            }
            table {
                width: 100%;
                border-collapse: collapse;
            }
            .total {
                font-weight: bold;
                border-top: 2px solid #999;
            }
            @page {
                size: auto;
                margin: 5mm;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="nama-toko"><?php echo htmlspecialchars($setting->nama_toko); ?></div>
            <p>Terima kasih atas pembelian Anda!</p>
            <div class="transaction-info">
                <span><?= htmlspecialchars($elly[0]->tgl_pesanan); ?></span>
                <span><?= htmlspecialchars($elly[0]->kode_pesanan); ?> / <?= htmlspecialchars($elly[0]->jenis_pesanan); ?> / <?= htmlspecialchars($elly[0]->nama_user); ?></span>
            </div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Catatan</th>
                    <th>Harga Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $total_pesanan = 0;
                    foreach($elly as $item) {
                        $harga_total = $item->jumlah * $item->harga;
                        $total_pesanan += $harga_total;
                ?>
                <tr>
                    <td><?= htmlspecialchars($item->nama_produk); ?></td>
                    <td>Rp <?= number_format($item->harga, 2, ',', '.'); ?></td>
                    <td><?= htmlspecialchars($item->jumlah); ?></td>
                    <td><?= htmlspecialchars($item->catatan); ?></td>
                    <td>Rp <?= number_format($harga_total, 2, ',', '.'); ?></td>
                </tr>
                <?php 
                    }
                ?>
                <tr class="total">
                    <td colspan="4">Total Harga Pesanan</td>
                    <td>Rp <?= number_format($total_pesanan, 2, ',', '.'); ?></td>
                </tr>
                <tr class="total">
                    <td colspan="4">Bayar</td>
                    <td>Rp <?= number_format($elly[0]->uang_user, 2, ',', '.'); ?></td>
                </tr>
                <tr class="total">
                    <td colspan="4">Kembali</td>
                    <td>Rp <?= number_format($elly[0]->uang_kembalian, 2, ',', '.'); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>
