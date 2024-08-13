<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Manage Produk</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Manage Produk</li>
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
                        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="edit-produk-tab" data-bs-toggle="tab" href="#edit-produk" role="tab" aria-controls="edit-produk" aria-selected="true">Edit Produk</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="delete-produk-tab" data-bs-toggle="tab" href="#delete-produk" role="tab" aria-controls="delete-produk" aria-selected="false">Delete Produk</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                <!-- Edit Produk Form -->
                                <div class="tab-pane fade show active" id="edit-produk" role="tabpanel" aria-labelledby="edit-produk-tab">
                                    <form action="<?= base_url('home/aksieproduk') ?>" method="POST" enctype="multipart/form-data">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Nama Produk</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <input type="text" id="first-name" class="form-control" name="nama" placeholder="Nama Produk" value="<?= $satu->nama_produk ?? '' ?>">
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Foto</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <input type="file" id="foto" class="form-control" name="foto" value="<?= $satu->foto ?? '' ?>">
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Deskripsi</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <input type="text" id="contact-info" class="form-control" name="deskripsi" placeholder="Deskripsi" value="<?= $satu->deskripsi ?? '' ?>">
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Harga</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <input type="text" id="contact-info" class="form-control" name="harga" placeholder="Harga" value="<?= $satu->harga ?? '' ?>">
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Stok</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <input type="text" id="contact-info" class="form-control" name="stok" placeholder="Stok" value="<?= $satu->stok ?? '' ?>">
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Kategori</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <select class="form-control" name="kategori">
                                                        <option value="<?= $dua->id_kategori ?? '' ?>"><?= $dua->nama_kategori ?? 'Pilih Kategori' ?></option>
                                                        <?php foreach($kater as $gou): ?>
                                                            <option value="<?= $gou->id_kategori ?>"><?= $gou->nama_kategori ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                                </div>
                                                <input type="hidden" name="id" value="<?= $satu->id_produk ?? '' ?>">
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- Delete Produk Form -->
                                <div class="tab-pane fade" id="delete-produk" role="tabpanel" aria-labelledby="delete-produk-tab">
                                    <form action="<?= base_url('home/hapusproduk/' . ($satu->id_produk ?? '')) ?>" method="POST">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Delete Produk</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <button type="submit" class="btn btn-danger me-1 mb-1">Delete Produk</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div> <!-- End of Tab Content -->
                        </div> <!-- End of Card Body -->
                    </div> <!-- End of Card Content -->
                </div> <!-- End of Card -->
            </div> <!-- End of Column -->
        </div> <!-- End of Row -->
    </section>
</div>
