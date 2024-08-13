 <!DOCTYPE html>
<html>
<head>
    <title></title>
    <style type="text/css">
        table{
            font-family: arial;
            color: #232323;
            border-collapse: collapse;
            width: 100%;
        }
        table, th, td{
            border: 1px solid #999;
            padding: 8px 20px;
        }
        th:nth-child(1) { /* Mengatur lebar kolom No */
            width: 5%;
        }
        h3 {
            text-align: center; /* Mengatur header agar berada di tengah */
        }
    </style>
    
</head>
<body>

    <script type="text/javascript">
        window.print();
    </script>

    
    <br><br>

    <table border="1">
         <caption><h2>LAPORAN PESANAN</h2></caption>
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
                    <td><?= $transaction['tgl_pesanan'] ?></td>
                    <td><?= $transaction['kode_pesanan'] ?></td>
                    <td><?= $transaction['jenis_pesanan'] ?></td> 
                    <td><?= implode(", ", $transaction['pesanan']) ?></td>
                    <td>Rp <?= number_format($transaction['total_harga'], 2, ',', '.') ?></td>
                  
                </tr>
                <?php 
            }
        ?>
    
                </tbody>
              </table>

    

</body>
</html>
