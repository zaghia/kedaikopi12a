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
    .profile-info img {
        max-width: 100%;
        margin-top: 10px;
        display: block;
    }
</style>
</head>
<body>
<form id="sellerForm" novalidate action="<?= base_url('home/aksietoko/')?>" method="POST" enctype="multipart/form-data">
    <div class="container">
        <h1>Edit Toko</h1>
        <div class="profile-info">
            <label for="name">Nama Toko:</label>
            <input name="nama" type="text" class="form-control" id="nama" value="<?= $user->nama_toko?>">
        </div>
        <div class="profile-info">
            <label for="logo">Logo:</label>
            <input name="foto" type="file" class="form-control" id="foto" onchange="previewImage()">
            <input name="id" type="hidden" class="form-control" id="id" value="<?= $user->id_toko?>">
          
        </div>
        <button class="btn btn-warning btn-sm round">Save Edit</button>
    </div>
</form>

<script>
    function previewImage() {
        const fileInput = document.getElementById('foto');
        const preview = document.getElementById('preview');
        
        if (fileInput.files && fileInput.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function (e) {
                preview.src = e.target.result;
            }
            
            reader.readAsDataURL(fileInput.files[0]);
        }
    }
</script>
</body>
</html>
