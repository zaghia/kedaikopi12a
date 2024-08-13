<!DOCTYPE html>
<html>
<head>
    <title>Nota Pembelian</title>
    <style type="text/css">
        .page-break {
            page-break-before: always;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 350px; /* Sesuaikan dengan ukuran A6 */
            margin: auto;
            /* border: 1px solid #999; */
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1); /* Kurangi box shadow */
        }
        h2 {
            text-align: center;
            margin-bottom: 10px; /* Kurangi margin */
        }
        .header, .footer {
            text-align: center;
        }
        .header {
            margin-bottom: 10px; /* Kurangi margin */
        }
        .footer {
            margin-top: 10px; /* Kurangi margin */
            font-size: 10px; /* Kurangi font size */
            color: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px; /* Kurangi margin */
        }
        table, th, td {
            border: 1px solid #999;
            padding: 5px; /* Kurangi padding */
            text-align: left;
            font-size: 10px; /* Kurangi font size */
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
            margin-bottom: 10px; /* Kurangi margin */
            font-size: 10px; /* Kurangi font size */
        }
        .nama-toko {
            font-weight: bold;
            font-size: 20px; /* Kurangi font size */
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
                margin: 0 auto; /* Pusatkan elemen secara horizontal saat print */
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
                size: auto; /* Ukuran kertas otomatis sesuai konten */
                margin: 5mm; /* Atur margin jika diperlukan */
            }
        }
    </style>
</head>
<body>
<?php 
$no = 1;
if (!empty($elly)): ?>
    <?php foreach ($elly as $kode_pesanan => $pesanan_items): ?>
        <?php if ($no > 1) { ?>
            <div class="page-break"></div>
        <?php } ?>
        <div class="container">
            <div class="header">
                <div class="nama-toko"><?php echo htmlspecialchars($setting->nama_toko); ?></div>
                <p>Terima kasih atas pembelian Anda!</p>
                <div class="transaction-info">
                    <span><?= htmlspecialchars($pesanan_items[0]->tgl_pesanan); ?></span>
                    <span><?= htmlspecialchars($pesanan_items[0]->kode_pesanan); ?> / <?= htmlspecialchars($pesanan_items[0]->jenis_pesanan); ?> / <?= htmlspecialchars($pesanan_items[0]->nama_user); ?></span>
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
                    $no++;
                    $total_pesanan = 0;
                    foreach ($pesanan_items as $item) {
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
                        <td>Rp <?= number_format($pesanan_items[0]->uang_user, 2, ',', '.'); ?></td>
                    </tr>
                    <tr class="total">
                        <td colspan="4">Kembali</td>
                        <td>Rp <?= number_format($pesanan_items[0]->uang_kembalian, 2, ',', '.'); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="footer">
            <p></p>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>Tidak ada data pesanan untuk ditampilkan.</p>
<?php endif; ?>

<script type="text/javascript">
    window.print();
</script>
</body>
</html>
