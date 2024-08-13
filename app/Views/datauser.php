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
                    <h4 class="card-title" align="center">Manajemen User</h4>
               <a href="<?= base_url('home/tambahuser') ?>">
                <button class="btn btn-success round">Tambah</button>
                </a>
            </div>
                <div class="card-content">
                    
                    <!-- table bordered -->
                <div class="table-responsive">
    <table class="table table-bordered mb-0">
                    <thead>
                        <tr>
                <th>No</th>      
                <th>Nama</th>
                <th>Level</th>
                <th>Aksi</th>

                        </tr>
                    </thead>
                    <tbody>
                       <?php

    $no=1;
    foreach($elly as $gou){
         if ($gou->isdelete == 0) {
        ?>
        <tr>
    <td><?= $no++ ?></td>
    <td><?=$gou->nama_user?></td> 
    <!-- <td><?=$gou->alamat?></td>
    <td><?=$gou->nomor_hp?></td> -->
    <td><?php 
        if($gou->level==1){
          echo "Admin";
        }else if ($gou->level==2){
          echo "Waitress";
          }else if ($gou->level==3){
          echo "Dapur";
        }
         ?></td>
    
    
    <td>
    <a href="<?= base_url('home/edituser/'.$gou->id_user)?>">
    <button class="btn btn-danger btn-sm round">Detail</button>
    </a>
   
    <!-- <a href="<?= base_url('home/hapususer/'.$gou->id_user)?>">
    <button class="btn btn-danger btn-sm round">Hapus</button>
    </a> -->
    </td>
    </tr>
    <?php }} ?>
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>