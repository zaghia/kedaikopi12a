<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Include jQuery dan Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
</head>
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
                    <h4 class="card-title" align="center">Pembayaran</h4>
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
                            <th>Status Pembayaran</th>
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
                                    <td>' . $gou->statusbyr . '</td>
                                    <td>
                                        <button class="btn btn-info round detail-btn" data-kode-pesanan="' . $gou->kode_pesanan . '">Detail</button>
                                    
                                    
                                        <a href="' . base_url('home/printnota/'.$gou->kode_pesanan) . '" class="btn btn-primary round">Nota</a>
                                    </td>

                                </tr>';
                            }
                            $previous_kode_pesanan = $gou->kode_pesanan;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<!-- Modal untuk Detail Pesanan -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Pesanan</h5>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Catatan</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody id="detailPesananBody">
                        <!-- Data pesanan akan dimasukkan di sini melalui JavaScript -->
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4"><strong>Total Harga pesanan</strong></td>
                            <td><strong id="totalHargaPesanan"></strong></td>
                        </tr>
                    </tfoot>
                </table>
                <!-- Tambahkan field input untuk Uang Pembeli dan Pengembalian -->
                <div class="form-group row">
                    <label for="uangPembeli" class="col-sm-3 col-form-label"><strong>Uang Pembeli</strong></label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="uangPembeli" placeholder="Masukkan jumlah uang pembeli">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="pengembalian" class="col-sm-3 col-form-label"><strong>Pengembalian</strong></label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="pengembalian" readonly>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="close" type="button" class="btn btn-secondary round" data-dismiss="modal">Close</button>
                <button id="bayarBtn" class="btn btn-success round">Bayar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Uang Tidak Cukup -->
<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="errorModalLabel" style="color: red;">Uang Tidak Cukup</h5>
            </div>
            <div class="modal-body">
                <p style="color: red;">Uang yang anda masukkan tidak cukup untuk membayar total pesanan.</p>
            </div>
        </div>
    </div>
</div>

<style>
    /* CSS untuk mengatur warna latar belakang tabel dalam detail */
    
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const detailButtons = document.querySelectorAll('.detail-btn');

    detailButtons.forEach(button => {
        button.addEventListener('click', function () {
            const kodePesanan = this.dataset.kodePesanan;
            fetchDetailPesanan(kodePesanan);
        });
    });

    // Fungsi untuk memformat angka menjadi IDR
    function formatRupiah(angka) {
        const formatter = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
        });
        return formatter.format(angka);
    }

    // Fungsi untuk menghilangkan format IDR dari string
    function parseRupiah(rupiah) {
        return parseFloat(rupiah.replace(/[^0-9,-]+/g,"").replace(",", "."));
    }

    // Fungsi untuk mengambil detail pesanan
    function fetchDetailPesanan(kodePesanan) {
        const pesananDetails = <?php echo json_encode($elly); ?>;
        const filteredDetails = pesananDetails.filter(detail => detail.kode_pesanan === kodePesanan);

        let totalHargaPesanan = 0;
        let detailPesananHtml = '';

        filteredDetails.forEach(detail => {
            const totalHargaPerItem = detail.harga * detail.jumlah;
            totalHargaPesanan += totalHargaPerItem;

            detailPesananHtml += `
                <tr>
                    <td>${detail.nama_produk}</td>
                    <td>${formatRupiah(detail.harga)}</td>
                    <td>${detail.jumlah}</td>
                    <td>${detail.catatan}</td>
                    <td>${formatRupiah(totalHargaPerItem)}</td>
                </tr>
            `;
        });

        document.getElementById('detailPesananBody').innerHTML = detailPesananHtml;
        document.getElementById('totalHargaPesanan').textContent = formatRupiah(totalHargaPesanan);
        document.getElementById('uangPembeli').value = '';  // Reset nilai uang pembeli
        document.getElementById('pengembalian').value = '';  // Reset nilai pengembalian

        // Set kode pesanan yang sedang diproses untuk referensi nanti
        document.getElementById('bayarBtn').dataset.kodePesanan = kodePesanan;

        $('#detailModal').modal('show');
    }

    // Event listener untuk field Uang Pembeli
   document.getElementById('uangPembeli').addEventListener('input', function() {
    const totalHargaPesanan = parseRupiah(document.getElementById('totalHargaPesanan').textContent);
    const uangPembeli = parseRupiah(this.value);
    const pengembalian = uangPembeli - totalHargaPesanan;

    // Hanya masukkan angka murni ke dalam input 'pengembalian'
    document.getElementById('pengembalian').value = isNaN(pengembalian) ? '' : pengembalian;
});


    document.getElementById('close').addEventListener('click', function() {
        $('#detailModal').modal('hide');
    });

    document.getElementById('bayarBtn').addEventListener('click', function () {
        const totalHargaPesanan = parseRupiah(document.getElementById('totalHargaPesanan').textContent);
        const uangPembeli = parseRupiah(document.getElementById('uangPembeli').value);

        if (uangPembeli >= totalHargaPesanan) {
            const kodePesanan = this.dataset.kodePesanan;
            const pengembalian = parseRupiah(document.getElementById('pengembalian').value);

            // Kirim data ke `aksibayar`
            fetch('<?= base_url('home/aksibayar') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `kode_pesanan=${kodePesanan}&uang_pembeli=${uangPembeli}&pengembalian=${pengembalian}`
            })
            .then(response => {
                if (response.ok) {
                    // Kirim data ke `update_pembayaran`
                    return fetch('<?= base_url('home/update_pembayaran') ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `kode_pesanan=${kodePesanan}&status=pembayaran_diperbarui` // Sesuaikan data yang diperlukan
                    });
                } else {
                    throw new Error('Gagal melakukan pembayaran.');
                }
            })
            .then(response => {
                if (response.ok) {
                    // Redirect ke halaman print nota
                    window.location.href = `<?= base_url('home/printnota/') ?>/${kodePesanan}`;
                } else {
                    throw new Error('Gagal memperbarui pembayaran.');
                }
            })
            .catch(error => {
                console.error('Terjadi kesalahan:', error);
                $('#errorModal').modal('show');
                setTimeout(() => {
                    $('#errorModal').modal('hide');
                }, 1000);
            });
        } else {
            $('#errorModal').modal('show');
            setTimeout(() => {
                $('#errorModal').modal('hide');
            }, 1000);
        }
    });
});


</script>
</body>
</html>
