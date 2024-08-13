<?php
// Ambil data dari database (misalnya menggunakan $elly) dan hitung jumlah Pesanan yang berbeda berdasarkan jenisnya
$kode_pesanan_dine_in = [];
$kode_pesanan_take_away = [];

foreach ($elly as $gou) {
    if ($gou->jenis_pesanan == 'Dine In' && !in_array($gou->kode_pesanan, $kode_pesanan_dine_in)) {
        $kode_pesanan_dine_in[] = $gou->kode_pesanan;
    }
    if ($gou->jenis_pesanan == 'Take Away' && !in_array($gou->kode_pesanan, $kode_pesanan_take_away)) {
        $kode_pesanan_take_away[] = $gou->kode_pesanan;
    }
}

$total_pesanan_dine_in = count($kode_pesanan_dine_in);
$total_pesanan_take_away = count($kode_pesanan_take_away);
?>
<body>
    <div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                   
                </nav>
            </div>
        </div>
    </div>

    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" align="center">Pesanan</h4>

                    <!-- Tampilkan Total pesanan di sini -->
                    <h4>Total Pesanan Dine In: <?php echo $total_pesanan_dine_in; ?></h4>
                    <h4>Total Pesanan Take Away: <?php echo $total_pesanan_take_away; ?></h4>
                </div>
                <div class="card-content">
                    
                    <!-- table bordered -->
                <div class="table-responsive">
    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Waktu Pesanan</th>
                                <th>Kode Pesanan</th>
                                <th>Jenis Pesanan</th>
                                <th>Status</th>
                                <th></th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            <?php  
                            $no = 1;
                            $previous_kode_pesanan = '';
                            foreach ($elly as $gou) {
                                if ($previous_kode_pesanan != $gou->kode_pesanan) {
                                    echo '<tr>
                                        <td>' . $no++ . '</td>
                                        <td>' . $gou->tgl_pesanan . '</td>
                                        <td>' . $gou->kode_pesanan . '</td>
                                        <td>' . $gou->jenis_pesanan . '</td>
                                        <td>
                                            <select class="status-dropdown" data-kode-pesanan="' . $gou->kode_pesanan . '">
                                                <option value="Not Yet" ' . ($gou->status == 'Not Yet' ? 'selected' : '') . '>Not Yet</option>
                                                <option value="Done" ' . ($gou->status == 'Done' ? 'selected' : '') . '>Done</option>
                                            </select>
                                        </td>
                                        <td>
                                            <button class="btn btn-info round detail-btn">Detail</button>
                                        </td>

                                    </tr>';
                                }
                            ?>
                                <tr class="additional-details" style="display: none;" data-kode-pesanan="<?= $gou->kode_pesanan ?>">
                                    <td colspan="7">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td>Nama Produk</td>
                                                    <td>Jumlah</td>
                                                    <td>Catatan</td>
                                                </tr>
                                                <?php
                                                $total_harga_pesanan = 0; // Menyimpan total harga pesanan
                                                foreach ($elly as $gou_detail) {
                                                    if ($gou_detail->kode_pesanan == $gou->kode_pesanan) {
                                                        // Hitung total harga per item
                                                        $total_harga_per_item = $gou_detail->harga * $gou_detail->jumlah;

                                                        // Tambahkan total harga per item ke total harga pesanan
                                                        $total_harga_pesanan += $total_harga_per_item;

                                                        echo '<tr>
                                                            <td>' . $gou_detail->nama_produk . '</td>
                                                            <td>' . $gou_detail->jumlah . '</td>
                                                            <td>' . $gou_detail->catatan . '</td>
                                                        </tr>';
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            <?php
                                $previous_kode_pesanan = $gou->kode_pesanan;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const statusDropdowns = document.querySelectorAll('.status-dropdown');

            statusDropdowns.forEach(dropdown => {
                dropdown.addEventListener('change', function () {
                    const kodePesanan = this.dataset.kodePesanan;
                    const status = this.value;

                    fetch('/home/updateStatus', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: `kode_pesanan=${kodePesanan}&status=${status}`
                    })
                    .then(response => response.text())
                    .then(data => {
                        console.log(data); // untuk debug, lihat apa yang dikembalikan
                    });
                });
            });

            const detailButtons = document.querySelectorAll('.detail-btn');

            detailButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const row = this.closest('tr');
                    const additionalDetails = row.nextElementSibling;

                    if (additionalDetails.style.display === 'none') {
                        additionalDetails.style.display = 'table-row';
                    } else {
                        additionalDetails.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>
</html>
