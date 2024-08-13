<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang</title>
    <style>
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
        <div class="col-12">
            <div class="card">

              
                <div class="card-header">
                    <h4 class="card-title" align="center">Restore Keranjang</h4>
              
            </div>
                <div class="card-content">
                    
                    <!-- table bordered -->
                <div class="table-responsive">
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
                            $no=1;
                            foreach($elly as $gou){
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?=$gou->nama_produk?></td> 
                               
                                <td><?=$gou->jumlah?></td> 
                                <td><?=$gou->catatan?></td>
                                <td class="total-harga" data-harga-per-item="<?=$gou->harga?>"><?= number_format($gou->total_harga, 0, ',', '.') ?></td>
                                <td>
                                    <a href="<?= base_url('home/aksirekeranjang/'.$gou->id_keranjang)?>">
                                        <button class="btn btn-danger btn-sm round">Restore</button>
                                    </a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
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

    <!-- Script untuk modal -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
    document.getElementById('btn-bayar').addEventListener('click', function() {
        var tbody = document.querySelector('#table1 tbody');
        var rows = tbody.querySelectorAll('tr');
        var orderDetails = '';
        var totalHarga = 0;

        rows.forEach(function(row) {
            var namaProduk = row.querySelector('td:nth-child(2)').textContent.trim();
            var catatan = row.querySelector('td:nth-child(5)').textContent.trim();
            var jumlah = row.querySelector('td:nth-child(4)').textContent.trim();
            var totalHargaProdukText = row.querySelector('td:nth-child(6)').textContent.trim();

            var totalHargaProduk = parseFloat(totalHargaProdukText.replace(/[^0-9.-]+/g,""));

            orderDetails += '<div class="product-info">' +
                                '<div class="info">' +
                                    '<div>' + namaProduk + '</div>' +
                                    '<div>Jumlah: ' + jumlah + '</div>' +
                                    '<div>Catatan: ' + catatan + '</div>' +
                                '</div>' +
                                '<div class="price">Total Harga: ' + totalHargaProduk.toFixed(2) + '</div>' +
                            '</div>';
            totalHarga += totalHargaProduk;
        });

        document.getElementById('order-details').innerHTML = orderDetails;
        document.getElementById('total-harga').textContent = totalHarga.toFixed(2);

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

        // Update jumlah di input field
        jumlahInput.val(newJumlah);

        // AJAX request to update jumlah in database
        $.ajax({
            url: '<?= base_url("home/updatekeranjang") ?>',
            type: 'POST',
            data: {
                id_keranjang: idKeranjang,
                jumlah: newJumlah
            },
            success: function(response) {
                if (response.success) {
                    // Update total harga in the row
                    var hargaPerItem = parseFloat(row.find('.total-harga').data('harga-per-item'));
                    var newTotalHarga = newJumlah * hargaPerItem;
                    row.find('.total-harga').text(newTotalHarga.toFixed(2));
                    
                    // Update the overall total harga
                    updateOverallTotalHarga();
                    alert('Berhasil memperbarui jumlah.');
                } else {
                    //alert('Gagal memperbarui jumlah.');
                    var hargaPerItem = parseFloat(row.find('.total-harga').data('harga-per-item'));
                    var newTotalHarga = newJumlah * hargaPerItem;
                    row.find('.total-harga').text(newTotalHarga.toFixed(2));
                    
                    // Update the overall total harga
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
    </script>
</body>
</html>