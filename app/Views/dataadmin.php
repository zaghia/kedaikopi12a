<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Admin</h3>
                
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Datatable</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <a href="<?= base_url('home/tambahadmin') ?>">
                <button class="btn btn-success round">Tambah</button>
                </a>
            </div>
            <div class="card-body">
                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                <th>No</th>      
                <th>Nama</th>
                <th>Alamat</th>
                <th>Nomor Telepon</th>
               
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
    <td><?=$gou->nama_admin?></td> 
    <td><?=$gou->alamat?></td>
    <td><?=$gou->nomor_hp?></td>
   
    
    
    <td>
     <a href="<?= base_url('home/editadmin/'.$gou->id_admin)?>">
    <button class="btn btn-warning btn-sm round">Edit</button>
</a>
    <a href="<?= base_url('home/hapusadmin/'.$gou->id_admin)?>">
    <button class="btn btn-danger btn-sm round">Hapus</button>

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