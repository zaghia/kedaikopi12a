<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pesanan</title>
    <style type="text/css">
        table {
            font-family: Arial, sans-serif;
            color: #232323;
            border-collapse: collapse;
            width: 100%;
        }
        table, th, td {
            border: 1px solid #999;
            padding: 8px 20px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <h2 align="center">LAPORAN PESANAN</h2>
    <br><br>

    <table>
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Waktu Pesanan</th>
                <th scope="col">Kode Pesanan</th>
                <th scope="col">Jenis Pesanan</th>
                <th scope="col">Pesanan</th>
                <th scope="col">Total Pesanan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $grouped_transactions = array(); // Menyimpan pesanan yang telah digabungkan

            // Menggabungkan pesanan dengan kode pesanan yang sama
            foreach($elly as $gou) {
                $kode_pesanan = $gou->kode_pesanan;
                if (!isset($grouped_transactions[$kode_pesanan])) {
                    $grouped_transactions[$kode_pesanan] = array(
                        'tgl_pesanan' => $gou->tgl_pesanan,
                        'kode_pesanan' => $gou->kode_pesanan,
                        'jenis_pesanan' => $gou->jenis_pesanan,
                        'pesanan' => array(),
                        'total_harga' => 0
                    );
                }

                // Memasukkan nama_produk dan jumlah ke dalam pesanan yang sama
                $grouped_transactions[$kode_pesanan]['pesanan'][] = $gou->nama_produk . " " . $gou->jumlah;
                $grouped_transactions[$kode_pesanan]['total_harga'] += $gou->total_harga;
            }

            // Menampilkan hasil penggabungan
            foreach($grouped_transactions as $kode_pesanan => $transaction) {
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($transaction['tgl_pesanan']) ?></td>
                    <td><?= htmlspecialchars($transaction['kode_pesanan']) ?></td>
                    <td><?= htmlspecialchars($transaction['jenis_pesanan']) ?></td> 
                    <td><?= htmlspecialchars(implode(", ", $transaction['pesanan'])) ?></td>
                    <td>Rp <?= number_format($transaction['total_harga'], 2, ',', '.') ?></td>
                </tr>
                <?php 
            }
            ?>
        </tbody>
    </table>

    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>
