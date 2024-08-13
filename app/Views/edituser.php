<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Manage User</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Manage User</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <style>
        .profile-img {
        display: block;
        margin: 0 auto 20px;
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
    }
    </style>

    <section id="basic-horizontal-layouts">
        <div class="row match-height">
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="edit-user-tab" data-bs-toggle="tab" href="#edit-user" role="tab" aria-controls="edit-user" aria-selected="true">Edit User</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="reset-password-tab" data-bs-toggle="tab" href="#reset-password" role="tab" aria-controls="reset-password" aria-selected="false">Reset Password</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="delete-user-tab" data-bs-toggle="tab" href="#delete-user" role="tab" aria-controls="delete-user" aria-selected="false">Delete User</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                <!-- Edit User Form -->
                                <div class="tab-pane fade show active" id="edit-user" role="tabpanel" aria-labelledby="edit-user-tab">
                                    <form action="<?= base_url('home/aksieuser') ?>" method="POST" enctype="multipart/form-data">
                                        <div class="form-body">
                                             <img src="<?= base_url('images/'.$satu->foto)?>" class="profile-img" alt="Profile Picture" >
                                            <div class="row">
                                                 <div class="col-md-4">
                                                    <label>Profile</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                   <input type="file" id="foto" class="form-control" name="foto">
                                                    <input type="hidden" name="old_foto" value="<?= $satu->foto ?>">
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Nama User</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <input type="text" id="first-name" class="form-control" name="nama" placeholder="Nama User" value="<?= $satu->nama_user ?? '' ?>">
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Alamat</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <input type="text" id="email-id" class="form-control" name="alamat" placeholder="Alamat" value="<?= $satu->alamat ?? '' ?>">
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Nomor Telepon</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <input type="text" id="contact-info" class="form-control" name="nohp" placeholder="Nomor Telepon" value="<?= $satu->nomor_hp ?? '' ?>">
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Level</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <select class="form-select" id="level" name="level" value="<?= $satu->level ?? '' ?>">
                                                        <option value="<?= $satu->level?>">
                                                            <?php 
                                                                if($satu->level == 1){
                                                                    echo "Admin";
                                                                } else if ($satu->level == 2){
                                                                    echo "Waitress";
                                                                    } else if ($satu->level == 3){
                                                                    echo "Dapur";
                                                                }
                                                            ?>
                                                        </option>
                                                        <option value="1">Admin</option>
                                                        <option value="2">Waitress</option>
                                                        <option value="2">Dapur</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                                </div>
                                                <input type="hidden" name="id" value="<?= $satu->id_user ?? '' ?>"> 
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- Reset Password Form -->
                                <div class="tab-pane fade" id="reset-password" role="tabpanel" aria-labelledby="reset-password-tab">
                                    <form action="<?= base_url('home/aksireset') ?>" method="POST">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Reset Password</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <button type="submit" class="btn btn-warning me-1 mb-1">Reset Password</button>
                                                </div>
                                                <input type="hidden" name="id" value="<?= $satu->id_user ?? '' ?>">
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane fade" id="delete-user" role="tabpanel" aria-labelledby="delete-user-tab">
                                <form action="<?= base_url('home/hapususer/' . ($satu->id_user ?? '')) ?>" method="POST">
    <div class="form-body">
        <div class="row">
            <div class="col-md-4">
                <label>Delete User</label>
            </div>
            <div class="col-md-8 form-group">
                <button type="submit" class="btn btn-danger me-1 mb-1">Delete User</button>
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
