<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<body>
    <div id="auth">
        
<div class="container">
    <div class="row">
        <div class="col-md-5 col-sm-12 mx-auto">
            <div class="card pt-4">
                <div class="card-body">
                    <div class="text-center mb-5">
                       
                        
                       <div style="text-align: center;">
  <img src="<?php echo base_url('images/'.$setting->logo) ?>" style="width: 120px; height: auto;">
</div>
<h5>Sign In</h5>
                       
                    </div>
                    <form class="row g-3 needs-validation" novalidate action="<?= base_url('home/aksilogin')?>" method="POST">
                        <div class="form-group position-relative has-icon-left">
                            <label for="username">Nama User</label>
                            <div class="position-relative">
                                <input type="text" class="form-control" id="nama" name="nama">
                                <div class="form-control-icon">
                                    <i data-feather="user"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left">
                            <div class="clearfix">
                                <label for="password">Password</label>
                                <a href="auth-forgot-password.html" class='float-end'>
                                    <small>Forgot password?</small>
                                </a>
                            </div>
                            <div class="position-relative">
                                <input type="password" class="form-control" id="password" name="password">
                                <div class="form-control-icon">
                                    <i data-feather="lock"></i>
                                </div>
                            </div>
                        </div>
<!-- 
                        <div class='form-check clearfix my-4'>
                            <div class="checkbox float-start">
                                <input type="checkbox" id="checkbox1" class='form-check-input' >
                                <label for="checkbox1">Remember me</label>
                            </div> -->
                           <!--  <div class="float-end">
                                <a href="<?= base_url('home/registrasi')?>">Don't have an account?</a>
                            </div> -->
                       <!--  </div> -->
                        <div class="g-recaptcha" data-sitekey="6LdLhiAqAAAAACazV6qYX_Y6L9bMo0aC8Q1jRJM-"></div>
      <br/>
                        <div class="clearfix">
                            <button class="btn btn-primary float-end">Submit</button>
                        </div>
                    </form>
                   <!--  <div class="divider">
                        <div class="divider-text">OR</div>
                    </div> -->
                    <!-- <div class="row">
                        <div class="col-sm-6">
                            <button class="btn btn-block mb-2 btn-primary"><i data-feather="facebook"></i> Facebook</button>
                        </div> -->
                        <!-- <div class="col-sm-6">
                            <button class="btn btn-block mb-2 btn-secondary"><i data-feather="github"></i> Github</button>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

   </div>
    <script src="<?= base_url('js/feather-icons/feather.min.js')?>"></script>
    <script src="<?= base_url('js/app.js')?>"></script>
    
    <script src="<?= base_url('js/main.js')?>"></script>
</body>

</html>

<script>
document.querySelector('form').addEventListener('submit', function(event) {
    var recaptchaResponse = grecaptcha.getResponse();
    if (recaptchaResponse.length === 0) {
        event.preventDefault();
        alert('Please complete the CAPTCHA.');
    }
});
</script>
