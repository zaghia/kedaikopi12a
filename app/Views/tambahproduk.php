<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3></h3>
               
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page"></li>
                    </ol>
                </nav>
            </div>
        </div>

    </div>
    <section id="basic-horizontal-layouts">
        <div class="row match-height">
            <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-header">
                <h4 class="card-title">Tambah Produk</h4>
                </div>
                <div class="card-content">
                <div class="card-body">
                    <form action="<?= base_url('home/aksitproduk') ?>" method="POST" enctype="multipart/form-data">

                    <div class="form-body">
                        <div class="row">
                        <div class="col-md-4">
                            <label>Nama Produk</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" id="first-name" class="form-control" name="nama" placeholder="Nama Produk">
                        </div>
                        <div class="col-md-4">
                            <label>Foto</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="file" id="foto" class="form-control" name="foto" >
                        </div>
                        <div class="col-md-4">
                            <label>Deskripsi</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" id="contact-info" class="form-control" name="deskripsi" placeholder="Deskripsi">
                        </div>
                        <div class="col-md-4">
                            <label>Harga</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" id="contact-info" class="form-control" name="harga" placeholder="Harga">
                        </div>
                        <div class="col-md-4">
                            <label>Stok</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" id="contact-info" class="form-control" name="stok" placeholder="Stok">
                        </div>
                        <div class="col-md-4">
                            <label>Kategori</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <select type="text" class="form-control" name="kategori">
                        echo "<option>Pilih</option>";

                      <?php
                        foreach($kater as $gou){
                          ?>
                          <option value="<?=$gou->id_kategori?>"><?=$gou->
                          nama_kategori?></option>
                        <?php }?>
                        </select>
                        </div>
                        
                        
                        <div class="col-12 col-md-8 offset-md-4 form-group">
                            <div class='form-check'>
                                <div class="checkbox">
                                   
                                   
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                        </div>
                        </div>
                    </div>
                    </form>
                </div>
                </div>
            </div>
            </div>
            
        </div>
    </section>