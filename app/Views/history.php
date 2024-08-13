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
                    <h4 class="card-title" align="center">Riwayat Pesanan</h4>
                </div>
                <div class="card-content">
                    
                    <!-- table bordered -->
                <div class="table-responsive">
    <table class="table table-bordered mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Waktu Pemesanan</th>
                            <th>Kode Pemesanan</th>
                            <th>Status</th>
                            <th>Aksi</th>
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
                                     <td>' . $gou->status . '</td>
                                    <td>
                                        <button class="btn btn-info round detail-btn">Detail</button>
                                         <button class="btn btn-danger round delete-btn" data-kode-pesanan="' . $gou->kode_pesanan . '">Hapus</button>
    </td>
                                    </td>
                                </tr>';
                            }
                            ?>
                            <tr class="additional-details" style="display: none;" data-kode-pesanan="<?= $gou->kode_pesanan ?>">
                                <td colspan="5">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td>Nama Produk</td>
                                                <td>Harga</td>
                                                <td>Jumlah</td>
                                                <td>Catatan</td>
                                                <td>Harga</td>
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
                                                        <td>' . number_format($gou_detail->harga, 0, ',', '.') . '</td>
                                                        <td>' . $gou_detail->jumlah . '</td>
                                                         <td>' . $gou_detail->catatan . '</td>
                                                        <td>' . number_format($total_harga_per_item, 0, ',', '.') . '</td>
                                                    </tr>';
                                                }
                                            }
                                            ?>
                                            <!-- Tampilkan total harga pesanan pada baris terakhir -->
                                            <tr>
                                                <td colspan="4"><strong>Total Harga pesanan</strong></td>
                                                <td><strong><?php echo number_format($total_harga_pesanan, 0, ',', '.'); ?></strong></td>

                                            </tr>
                                            <!-- Tambahkan tombol di bawah kolom Harga Total -->
                                            <!-- <tr>
                                                <td colspan="5" class="text-right">
                                                    <a href="<?= base_url('home/printnota/'.$gou->kode_pesanan)?>">
                                                        <button class="btn btn-warning round">Nota</button>
                                                    </a>
                                                </td>
                                            </tr> -->
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

<style>
    /* CSS untuk mengatur warna latar belakang tabel secara bergantian */

    /* CSS untuk mengatur warna latar belakang tabel dalam detail */
    
</style>

<script>
   document.addEventListener("DOMContentLoaded", function () {
    const checkboxes = document.querySelectorAll('.checkbox');

    checkboxes.forEach((checkbox, index) => {
        const kodePesanan = checkbox.dataset.kodePesanan; // Ambil id_pesanan dari data attribute
        const key = `checkbox${kodePesanan}`; // Gunakan id_pesanan sebagai bagian dari kunci

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

    // Script untuk tombol hapus
    const deleteButtons = document.querySelectorAll('.delete-btn');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const kodePesanan = this.dataset.kodePesanan;

            if (confirm('Apakah Anda yakin ingin menghapus pesanan dengan kode: ' + kodePesanan + '?')) {
                // Lakukan penghapusan data, misalnya dengan AJAX atau mengarahkan ke URL penghapusan
              window.location.href = '<?= base_url("home/hapuspesanan/") ?>/' + kodePesanan;

            }
        });
    });
});

</script>
