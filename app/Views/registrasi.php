<body>
    <div id="auth">
        
<div class="container">
    <div class="row">
        <div class="col-md-7 col-sm-12 mx-auto">
            <div class="card pt-4">
                <div class="card-body">
                    <div class="text-center mb-5">
                        <img src="assets/images/favicon.svg" height="48" class='mb-4'>
                        <h3>Sign Up</h3>
                        <p>Please fill the form to register.</p>
                    </div>
                    <form action="<?= base_url('home/aksi_register')?>" method="POST">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="first-name-column">Nama</label>
                                    <input type="text" id="first-name-column" class="form-control"  name="nama">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="last-name-column">Alamat</label>
                                    <input type="text" id="last-name-column" class="form-control"  name="alamat">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="username-column">Nomor Telepon</label>
                                    <input type="text" id="username-column" class="form-control" name="nohp">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="country-floating">Password</label>
                                    <input type="Password" id="country-floating" class="form-control" name="password">
                                </div>
                            </div>
                            
                           
                        </diV>

                                <a href="<?= base_url('home/login')?>">Have an account? Login</a>
                        <div class="clearfix">
                            <button class="btn btn-primary float-end">Submit</button>
                        </div>
                    </form>
                    <div class="divider">
                        <div class="divider-text">OR</div>
                    </div>
                    <div class="row">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>