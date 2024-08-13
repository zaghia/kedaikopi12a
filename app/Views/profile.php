<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>View Profile</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }
    .container {
        max-width: 600px;
        margin: 20px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h1 {
        text-align: center;
    }
    .profile-info {
        margin-bottom: 20px;
    }
    .profile-info label {
        font-weight: bold;
    }
    .profile-img {
        display: block;
        margin: 0 auto 20px;
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
    }
</style>
</head> 
<body>
<form id="sellerForm" class="" novalidate action="<?= base_url('home/aksieprofile/')?>" method="POST" enctype="multipart/form-data">
<div class="container">
    <h1>Profile Information</h1>
    <img src="<?= base_url('images/'.$user->foto)?>" class="profile-img" alt="Profile Picture" >
    <div class="profile-info">
        <label for="foto">Foto Profile:</label>
       <input type="file" id="foto" class="form-control" name="foto">
       <input type="hidden" name="old_foto" value="<?= $user->foto ?>">
    </div>
    <div class="profile-info">
        <label for="nama">Nama:</label>
        <input name="nama" type="text" class="form-control" id="nama" value="<?= $user->nama_user?>">
    </div>
    <div class="profile-info">
        <label for="nohp">Nomor Telepon:</label>
        <input name="nohp" type="text" class="form-control" id="nohp" value="<?= $user->nomor_hp?>">
    </div>
    <div class="profile-info">
        <label for="alamat">Alamat:</label>
        <input name="alamat" type="text" class="form-control" id="alamat" value="<?= $user->alamat?>">
        <input name="id" type="hidden" class="form-control" id="id" value="<?= $user->id_user?>">
    </div>
    <button class="btn btn-warning btn-sm round">Save Edit</button>
     <a href="<?= base_url('home/changepassword/'.$user->id_user)?>" class="btn btn-secondary btn-sm round">Change Password</a>
</div>
</form>
</body>
</html>
