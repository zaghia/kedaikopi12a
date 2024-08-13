<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
    <link rel="stylesheet" href="path/to/your/bootstrap.css">
    <style>
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
        <div class="col-12">
            <div class="card">
                <div class="card-header">
              
                    <h4 class="card-title" align="center">Restore Produk</h4>
                   
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
                                <th>Stok</th>
                                <th>Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach($elly as $gou) {
                               if ($gou->isdelete == 1) {
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?=$gou->nama_produk?></td> 
                                <td>
                                    <img src="<?php echo base_url('images/'.$gou->foto)?>" style="width: 120px; height: auto;" onclick="openPopup('<?php echo base_url('images/'.$gou->foto)?>')">
                                </td>
                                <td><?= number_format($gou->harga, 0, ',', '.') ?></td>
                                <td><?=$gou->deskripsi?></td>
                                <td><?=$gou->stok?></td>
                                <td><?=$gou->nama_kategori?></td>
                                <td>
                                    <a href="<?= base_url('home/aksireproduk/'.$gou->id_produk)?>">
                                        <button class="btn btn-info btn-sm round">Restore</button>
                                    </a>
                                </td>
                            </tr>
                            <?php }} ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

    <!-- Overlay dan popup gambar -->
    <div id="imagePopup" class="overlay">
        <div class="popup-content">
            <button class="close-btn" onclick="closePopup()">&times;</button>
            <img id="popupImage" src="" alt="Gambar">
        </div>
    </div>

    <script>
        function openPopup(imageSrc) {
            document.getElementById('popupImage').src = imageSrc;
            document.getElementById('imagePopup').style.display = 'flex';
        }

        function closePopup() {
            document.getElementById('imagePopup').style.display = 'none';
        }
    </script>
    <script src="path/to/your/bootstrap.bundle.js"></script>
</body>
</html>
