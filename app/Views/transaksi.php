<?php
// Ambil data dari database (misalnya menggunakan $elly) dan hitung jumlah transaksi yang berbeda
$kode_transaksi_list = [];
foreach ($elly as $gou) {
    if (!in_array($gou->kode_transaksi, $kode_transaksi_list)) {
        $kode_transaksi_list[] = $gou->kode_transaksi;
    }
}
$total_transaksi = count($kode_transaksi_list);
?>

<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Daftar Pesanan</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2  order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb"></ol>
                </nav>
            </div> 
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <!-- Tampilkan Total Transaksi di sini -->
                <h4>Total Transaksi: <?php echo $total_transaksi; ?></h4>
            </div>
            <div class="card-body">
                <table class='table mb-0' id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pembeli</th> 
                            <th>Nomor Telepon</th>
                            <th>Alamat Pembeli</th>
                            <th>Waktu Pemesanan</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $previous_kode_transaksi = '';
                        foreach ($elly as $gou) {
                            if ($previous_kode_transaksi != $gou->kode_transaksi) {
                                echo '<tr>
                                    <td>' . $no++ . '</td>
                                    <td>' . $gou->nama_user . '</td>
                                    <td>' . $gou->nomor_hp . '</td>
                                    <td>' . $gou->alamat . '</td>
                                    <td>' . $gou->tgl_transaksi . '</td>
                                    <td>
                                        <input type="checkbox" class="checkbox" data-kode-transaksi="' . $gou->kode_transaksi . '">
                                    </td>
                                    <td>
                                        <button class="btn btn-info round detail-btn">Detail</button>
                                    </td>
                                </tr>';
                            }
                            ?>
                            <tr class="additional-details" style="display: none;" data-kode-transaksi="<?= $gou->kode_transaksi ?>">
                                <td colspan="7">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td>Nama Produk</td>
                                                <td>Harga</td>
                                                <td>Jumlah</td>
                                                <td>Harga</td>
                                            </tr>
                                            <?php
                                            $total_harga_transaksi = 0; // Menyimpan total harga pesanan
                                            foreach ($elly as $gou_detail) {
                                                if ($gou_detail->kode_transaksi == $gou->kode_transaksi) {
                                                    // Hitung total harga per item
                                                    $total_harga_per_item = $gou_detail->harga * $gou_detail->jumlah;

                                                    // Tambahkan total harga per item ke total harga pesanan
                                                    $total_harga_transaksi += $total_harga_per_item;

                                                    echo '<tr>
                                                        <td>' . $gou_detail->nama_produk . '</td>
                                                        <td>' . $gou_detail->harga . '</td>
                                                        <td>' . $gou_detail->jumlah . '</td>
                                                        <td>' . $total_harga_per_item . '</td>
                                                    </tr>';
                                                }
                                            }
                                            ?>
                                            <!-- Tampilkan total harga pesanan pada baris terakhir -->
                                            <tr>
                                                <td colspan="3"><strong>Total Harga transaksi</strong></td>
                                                <td><strong><?php echo $total_harga_transaksi; ?></strong></td>
                                            </tr>
                                             <tr>
                                                <td colspan="5" class="text-right">
                                                     <a href="<?= base_url('home/printnota/'.$gou->kode_transaksi)?>">
                                                    <button class="btn btn-warning round">Nota</button>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        <?php
                            $previous_kode_transaksi = $gou->kode_transaksi;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<style>
    /* CSS untuk mengatur warna latar belakang tabel secara bergantian */
    .table-bordered tbody tr:nth-child(odd) td {
        background-color: #f2f2f2; /* abu */
    }

    .table-bordered tbody tr:nth-child(even) td {
        background-color: #ffffff; /* putih */
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const checkboxes = document.querySelectorAll('.checkbox');

        checkboxes.forEach((checkbox) => {
            const kodeTransaksi = checkbox.dataset.kodeTransaksi; // Ambil kode_transaksi dari data attribute
            const key = `checkbox${kodeTransaksi}`; // Gunakan kode_transaksi sebagai bagian dari kunci

            const value = localStorage.getItem(key);

            if (value === 'true') {
                checkbox.checked = true;
            }

            checkbox.addEventListener('change', function () {
                localStorage.setItem(key, this.checked);
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
