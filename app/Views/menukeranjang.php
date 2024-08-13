<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu dan Keranjang</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .container-fluid {
            padding: 20px;
        }
        .card {
            margin-bottom: 20px;
        }
        .table img {
            width: 80px; /* Sesuaikan ukuran gambar agar tidak terlalu besar */
            height: auto;
            cursor: pointer;
        }
        .quantity-controls {
            display: flex;
            align-items: center;
        }
        .quantity-controls button {
            background-color: #ddd;
            border: none;
            padding: 5px 10px;
            margin: 0 5px;
            cursor: pointer;
        }
        .quantity-controls input {
            text-align: center;
            width: 40px;
            border: 1px solid #ddd;
        }
        .invoice {
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .invoice-header, .invoice-body, .invoice-footer {
            margin-bottom: 20px;
        }
        .invoice-header h5 {
            margin: 0;
            font-weight: bold;
        }
        .invoice-body p {
            margin: 0;
            padding: 5px 0;
            border-bottom: 1px dashed #ddd;
        }
        .product-info {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 10px;
        }
        .product-info .info {
            display: flex;
            flex-direction: column;
        }
        .product-info .price {
            text-align: right;
            font-weight: bold;
        }
        .invoice-footer {
            font-weight: bold;
            text-align: right;
        }
        /* Style untuk overlay */
        .overlay {
            display: none;
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }
        /* Style untuk popup gambar */
        .popup-content {
            position: relative;
            max-width: 90%;
            max-height: 90%;
        }
        .popup-content img {
            width: 100%;
            height: auto;
            display: block;
        }
        .close-btn {
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 30px;
            cursor: pointer;
            color: white;
            background: rgba(0, 0, 0, 0.5);
            border: none;
            border-radius: 50%;
            padding: 5px 10px;
        }
        
    </style>
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
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" align="center">Menu</h4>
                </div>
                <div class="card-content">
                    
                    <!-- table bordered -->
                <div class="table-responsive">
    <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Produk</th>
                                            <th>Foto</th>
                                            <th>Harga</th>
                                            <th>Deskripsi</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
    <?php
    $no = 1;
    foreach ($elly as $gou) {
        // Cek apakah stok produk lebih dari 0
        if ($gou->stok > 0 && $gou->isdelete == 0) {
    ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $gou->nama_produk ?></td>
        <td>
            <img src="<?php echo base_url('images/' . $gou->foto) ?>" alt="Foto Produk" onclick="openPopup('<?php echo base_url('images/' . $gou->foto) ?>')">
        </td>
        <td><?= number_format($gou->harga, 0, ',', '.') ?></td>
        <td><?= $gou->deskripsi ?></td>
        <td>
            <i data-feather="plus" data-bs-toggle="modal" data-bs-target="#orderModal" data-product-id="<?= $gou->id_produk ?>"></i>
           <!--  <button class="btn btn-primary round" data-bs-toggle="modal" data-bs-target="#orderModal" data-product-id="<?= $gou->id_produk ?>">Add</button> -->
        </td>
    </tr>
    <?php
        }
    }
    ?>
</tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
           
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" align="center">Keranjang</h4>
                     <button class="btn btn-success round" id="btn-bayar">Pesan</button>
                </div>
                <div class="card-content">
                    
                    <!-- table bordered -->
                <div class="table-responsive" id="table1">
    <table class="table table-bordered mb-0">


                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Produk</th>
                                            <th>Jumlah</th>
                                            <th>Catatan</th>
                                            <th>Total harga</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $no = 1;
                                    foreach($keranjang as $gou){
                                    ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?=$gou->nama_produk?></td> 
                                        <td>
                                            <div class="quantity-controls">
                                                <button class="btn-decrement" data-id="<?=$gou->id_keranjang?>">-</button>
                                                <input type="text" value="<?=$gou->jumlah?>" readonly>
                                                <button class="btn-increment" data-id="<?=$gou->id_keranjang?>">+</button>
                                            </div>
                                        </td>
                                        <td><?=$gou->catatan?></td>
                                        <td class="total-harga" data-harga-per-item="<?=$gou->harga?>"><?= number_format($gou->total_harga, 0, ',', '.') ?></td>
                                        <td>
                                            <a href="<?= base_url('home/hapuskeranjang/'.$gou->id_keranjang)?>">
                                                                        <i data-feather="trash" width="20"></i>
                                                                       <!--  <button class="btn btn-danger btn-sm round">Hapus</button> -->
                                            </a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Order -->
        <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="orderModalLabel">Masukkan Jumlah Pesanan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="orderForm" action="<?= base_url('home/aksikeranjang') ?>" method="POST">
                            <div class="mb-3">
                                <label for="jumlahPesanan" class="form-label">Jumlah</label>
                                <input type="number" class="form-control" id="jumlahPesanan" name="jumlah" required>
                                <input type="hidden" id="productId" name="productid">
                            </div>
                            <div class="mb-3">
                                <label for="catatan" class="form-label">Catatan</label>
                                <textarea class="form-control" id="catatan" name="catatan" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-success">Masukkan ke keranjang</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Bayar -->
        <div class="modal fade" id="modalBayar" tabindex="-1" role="dialog" aria-labelledby="modalBayarLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalBayarLabel">Detail Pembayaran</h5>
                        <select id="jenisPesanan" class="form-control" style="width: auto; display: inline-block; margin-left: 10px;">
                            <option value="Dine In">Dine In</option>
                            <option value="Take Away">Take Away</option>
                        </select>
                    </div>
                    <div class="modal-body">
                        <div class="invoice">
                            <div class="invoice-header">
                                <h5>Pesanan</h5>
                            </div>
                            <div class="invoice-body" id="order-details">
                                <!-- Detail produk akan ditambahkan di sini -->
                            </div>
                            <div class="invoice-footer">
                                Total Pesanan: <span id="total-harga"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="btn-bayar-confirm">Bayar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Popup Image -->
        <div class="overlay" id="popupOverlay">
            <div class="popup-content">
                <button class="close-btn" onclick="closePopup()">&times;</button>
                <img id="popupImage" src="" alt="Popup Image">
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var orderModal = document.getElementById('orderModal');
                orderModal.addEventListener('show.bs.modal', function (event) {
                    var button = event.relatedTarget; // Button that triggered the modal
                    var productId = button.getAttribute('data-product-id'); // Extract info from data-* attributes
                    var modalProductIdInput = document.getElementById('productId');
                    modalProductIdInput.value = productId;
                });

                function formatCurrency(amount) {
                    if (isNaN(amount)) {
                        return 'Rp 0';
                    }
                    return 'Rp ' + amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,').replace('.', ',');
                }

                document.getElementById('btn-bayar').addEventListener('click', function() {
                    var tbody = document.querySelector('#table1 tbody');
                    var rows = tbody.querySelectorAll('tr');
                    var orderDetails = '';
                    var totalHarga = 0;

                    rows.forEach(function(row) {
                        var namaProduk = row.querySelector('td:nth-child(2)').textContent.trim();
                        var catatan = row.querySelector('td:nth-child(4)').textContent.trim();
                        var jumlah = row.querySelector('td:nth-child(3) input').value.trim();
                        var totalHargaProdukText = row.querySelector('td:nth-child(5)').textContent.trim();

                        var totalHargaProduk = parseFloat(totalHargaProdukText.replace(/[^0-9,-]+/g, "").replace(',', '.'));

                        orderDetails += '<div class="product-info">' +
                                            '<div class="info">' +
                                                '<div>' + namaProduk + '</div>' +
                                                '<div>Jumlah: ' + jumlah + '</div>' +
                                                '<div>Catatan: ' + catatan + '</div>' +
                                            '</div>' +
                                            '<div class="price">Total Harga: ' + formatCurrency(totalHargaProduk) + '</div>' +
                                        '</div>';
                        totalHarga += totalHargaProduk;
                    });

                    document.getElementById('order-details').innerHTML = orderDetails;
                    document.getElementById('total-harga').textContent = formatCurrency(totalHarga);

                    $('#modalBayar').modal('show');
                });

                document.getElementById('btn-bayar-confirm').addEventListener('click', function() {
                    var jenisPesanan = document.getElementById('jenisPesanan').value;
                    window.location.href = '<?= base_url("home/aksipesan") ?>?jenis_pesanan=' + jenisPesanan;
                });

                document.querySelector('.modal-footer .btn-secondary').addEventListener('click', function() {
                    $('#modalBayar').modal('hide');
                });

                $(document).on('click', '.btn-increment, .btn-decrement', function() {
                    var btn = $(this);
                    var idKeranjang = btn.data('id');
                    var row = btn.closest('tr');
                    var jumlahInput = row.find('input[type="text"]');
                    var currentJumlah = parseInt(jumlahInput.val());
                    var newJumlah = currentJumlah;

                    if (btn.hasClass('btn-increment')) {
                        newJumlah += 1;
                    } else if (btn.hasClass('btn-decrement') && currentJumlah > 1) {
                        newJumlah -= 1;
                    }

                    jumlahInput.val(newJumlah);

                    $.ajax({
    url: '<?= base_url("home/updatekeranjang") ?>',
    type: 'POST',
    data: {
        id_keranjang: idKeranjang,
        jumlah: newJumlah
    },
    success: function(response) {
        if (response.success) {
            var hargaPerItem = parseFloat(row.find('.total-harga').data('harga-per-item'));
            var newTotalHarga = newJumlah * hargaPerItem;
            row.find('.total-harga').text(newTotalHarga.toLocaleString('id-ID'));  // Perbaikan di sini
            updateOverallTotalHarga();
            alert('Berhasil memperbarui jumlah.');
        } else {
            var hargaPerItem = parseFloat(row.find('.total-harga').data('harga-per-item'));
            var newTotalHarga = newJumlah * hargaPerItem;
            row.find('.total-harga').text(newTotalHarga.toLocaleString('id-ID'));  // Perbaikan di sini
            updateOverallTotalHarga();
        }
    },
    error: function() {
        alert('Terjadi kesalahan.');
    }
});

                });

                function updateOverallTotalHarga() {
                    var totalHarga = 0;
                    $('#table1 tbody tr').each(function() {
                        var row = $(this);
                        var totalHargaProduk = parseFloat(row.find('.total-harga').text());
                        totalHarga += totalHargaProduk;
                    });
                    $('#total-harga').text(totalHarga.toFixed(2));
                }
            });

            function openPopup(src) {
                document.getElementById('popupImage').src = src;
                document.getElementById('popupOverlay').style.display = 'flex';
            }

            function closePopup() {
                document.getElementById('popupOverlay').style.display = 'none';
            }
        </script>
    </div>
</body>
</html>
