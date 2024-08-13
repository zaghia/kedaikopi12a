<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
           
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                       
                    </ol>
                </nav>
            </div>
        </div>

    </div>

<div class="row" id="table-contexual">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">MENU</h4>
        <div style="display: flex; justify-content: flex-end;">
    
</div>
      </div>
      <div class="card-content">
       
        <!-- table contextual / colored -->
        <div class="table-responsive">
          <table class="table mb-0">
            <thead>
              <tr class="table-active">

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

    $no=1;
    foreach($elly as $gou){
        ?>
        <tr class="table-primary">
    <td><?= $no++ ?></td>
    <td><?=$gou->nama_produk?></td>
    <td>
    <img src="<?php echo base_url('images/'.$gou->foto)?>" style="width: 120px; height: auto;">
</td>
    <td><?= number_format($gou->harga, 0, ',', '.') ?></td>
    <td><?=$gou->deskripsi?></td>
    <td><button class="btn btn-primary round" data-bs-toggle="modal" data-bs-target="#orderModal" data-product-id="<?= $gou->id_produk ?>">Add
    </button>
</td> 
   
   
   
    </tr>
    <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
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
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var orderModal = document.getElementById('orderModal');
        orderModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget; // Button that triggered the modal
            var productId = button.getAttribute('data-product-id'); // Extract info from data-* attributes
            var modalProductIdInput = document.getElementById('productId');
            modalProductIdInput.value = productId;
        });

        
    });
</script>
