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
                <h4 class="card-title">Tambah User</h4>
                </div>
                <div class="card-content">
                <div class="card-body">
                    <form action="<?= base_url('home/aksituser') ?>" method="POST" enctype="multipart/form-data">

                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                            <label>Foto</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="file" id="foto" class="form-control" name="foto" >
                        </div>
                        <div class="col-md-4">
                            <label>Nama User</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" id="first-name" class="form-control" name="nama" placeholder="Nama User">
                        </div>
                        <div class="col-md-4">
                            <label>Alamat</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" id="email-id" class="form-control" name="alamat" placeholder="Alamat">
                        </div>
                        <div class="col-md-4">
                            <label>Nomor Telepon</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" id="contact-info" class="form-control" name="nohp" placeholder="Nomor Telepon">
                        </div>
                        <div class="col-md-4">
                            <label>Password</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="password" id="password" class="form-control" name="password" placeholder="Password">
                        </div>

                        <div class="col-md-4">
                            <label>Level</label>
                        </div>
                        <div class="col-md-8 form-group">
                             <select class="form-select" id="level" name="level"> 
  
         <option value="1">Admin</option>
         <option value="2">Waitress</option>
        <option value="3">Dapur</option>
         
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