<?php

namespace App\Controllers;

use Codeigniter\Controllers;
use App\models\M_kedaikopi;
use CodeIgniter\Session\Session;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Home extends BaseController
{  

    public function __construct()
    {
        $this->db = \Config\Database::connect(); // Access the database connection via Dependency Injection
    }

    public function index() 
    {
        if (session()->get('level')>0){

        $model= new M_kedaikopi();

        $id_user = session()->get('id_user'); // Ambil ID user dari session
        $activity = 'Mengakses halaman dashboard'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
        
        $where=array(
          'id_toko'=> 1
        );
        $data['setting'] = $model->getWhere('toko',$where);
        $data['currentMenu'] = 'home'; // Sesuaikan dengan menu yang aktif
        echo view('header',$data);
        echo view('menu',$data);
        echo view('dashboard',$data);
        echo view('footer');
        }else{
        return redirect()->to('home/login');

    }
    }
    public function login()
        {
            $model= new M_kedaikopi();
        
        
        $where=array(
          'id_toko'=> 1
        );
        $data['setting'] = $model->getWhere('toko',$where);

           echo view('header',$data);
            echo view('login', $data);
    

} 

// public function error()
// {
//         $model = new M_kedaikopi();
//         $where=array(
//           'id_toko'=> 1
//         );
//         $data['setting'] = $model->getWhere('toko',$where);
//         echo view('header');
//         echo view ('menu', $data);
//         echo view('error');
//         echo view ('footer');
       
        
// }

public function aksireset()
    {
        $model = new M_kedaikopi();
         $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mereset password user'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
        $id = $this->request->getPost('id');
        
        $where= array('id_user'=>$id);
           
        $isi = array(

            'password' => md5('12345'),
             'updated_at' => date('Y-m-d H:i:s'), // Waktu saat produk dibuat
        'updated_by' => $id_user // ID user yang login
            
            
        );
        $model->edit('user', $isi,$where);

        return redirect()->to('Home/datauser');
        
        
        
    }

public function logonama()
{
    // Memeriksa level akses user
    if (session()->get('level') == 1 || session()->get('level') == 0) {
        $model = new M_kedaikopi();
         $id_user = session()->get('id_user'); // Ambil ID user dari session
        $activity = 'Mengakses halaman setting'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        

        // Menentukan id_toko yang ingin diambil
        $id = 1; // id_toko yang diinginkan

        // Menyusun kondisi untuk query
        $where = array('id_toko' => $id);

        // Mengambil data dari tabel 'toko' berdasarkan kondisi
        $data['user'] = $model->getWhere('toko', $where);
 
        // Memuat view
        $where=array(
          'id_toko'=> 1
        );
        $data['setting'] = $model->getWhere('toko',$where);
        $data['currentMenu'] = 'logonama'; // Sesuaikan dengan menu yang aktif
        echo view('header', $data);
        echo view('menu', $data);
        echo view('logonama', $data);
        echo view('footer', $data);
    //  }else{
        // return redirect()->to('Home/login');
        } else {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }
}

public function aksietoko()
{
    $model = new M_kedaikopi();
     $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengubah informasi toko'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
    $nama = $this->request->getPost('nama');
    $id = $this->request->getPost('id');
    $uploadedFile = $this->request->getFile('foto');

    $where = array('id_toko' => $id);

    $isi = array(
        'nama_toko' => $nama,
        'updated_at' => date('Y-m-d H:i:s'), // Waktu saat produk dibuat
        'updated_by' => $id_user // ID user yang login
    );

    // Cek apakah ada file yang diupload
    if ($uploadedFile && $uploadedFile->isValid() && !$uploadedFile->hasMoved()) {
        $foto = $uploadedFile->getName();
        $model->upload($uploadedFile); // Mengupload file baru
        $isi['logo'] = $foto; // Menambahkan nama file baru ke array data
    }

    $model->edit('toko', $isi, $where);

    return redirect()->to('home/logonama/'.$id);
}






public function logout()
        {
           session()->destroy();
            return redirect()->to('Home/login');
    

}

// 
public function aksilogin()
        {
        
        $u=$this->request->getPost('nama');
        $p=$this->request->getPost('password');
 
        $model = new M_kedaikopi();

        $where=array(
          'nama_user'=> $u,
          'password'=> md5($p)
        );
        $cek = $model->getWhere('user',$where);
        if ($cek>0){

            session()->set('id',$cek->id_user);
            session()->set('nama',$cek->nama_user);
            session()->set('level',$cek->level);
            return redirect()->to('Home');
        }else{
            return redirect()->to('Home/login');
        }
        
}
//produk

public function produk()
    {   
       if(session()->get('level')==1 || session()->get('level')==0 ){
        // if (session()->get('level')>0){
        $model= new M_kedaikopi();
         $id_user = session()->get('id_user'); // Ambil ID user dari session
        $activity = 'Mengakses halaman produk'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
        // $data['elly'] = $model->tampil('produk','id_produk');
        $data['elly'] = $model->join('produk','kategori','produk.id_kategori=kategori.id_kategori','produk.id_produk');
        $where=array(
          'id_toko'=> 1
        );
        $data['setting'] = $model->getWhere('toko',$where);
        $data['currentMenu'] = 'produk'; // Sesuaikan dengan menu yang aktif
        echo view('header',$data);
        echo view ('menu',$data);
        echo view('produk',$data);
        echo view ('footer');
        //  }else{
        // return redirect()->to('Home/login');
        } else {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
 
    }
    }


    public function tambahproduk()
    {
       if(session()->get('level')==1 || session()->get('level')==0 ){
        $model= new M_kedaikopi();
         $id_user = session()->get('id_user'); // Ambil ID user dari session
        $activity = 'Mengakses halaman tambah produk'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        

        $data['elly'] = $model->tampil('produk','id_produk');
       $data['kater'] = $model->tampil('kategori','id_kategori');
       $where=array(
          'id_toko'=> 1
        );
        $data['setting'] = $model->getWhere('toko',$where);
         $data['currentMenu'] = 'tambahproduk'; // Sesuaikan dengan menu yang aktif
        echo view('header',$data);
        echo view ('menu',$data);
        echo view('tambahproduk',$data);
        echo view ('footer');
      //  }else{
        // return redirect()->to('Home/login');
        } else {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }    
    }

    public function editproduk($id)
    {
       if(session()->get('level')==1 || session()->get('level')==0 ){
        $model= new M_kedaikopi();
         $id_user = session()->get('id_user'); // Ambil ID user dari session
        $activity = 'Mengakses halaman detail produk'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        

        $where= array('id_produk'=>$id);
        $data['satu']=$model->getwhere('produk',$where);
        $data['dua']=$model->joinWhere('produk','kategori','produk.id_kategori=kategori.id_kategori',$where);


       $data['elly'] = $model->tampil('produk','id_produk');
       $data['kater'] = $model->tampil('kategori','id_kategori');
       $where=array(
          'id_toko'=> 1
        );
        $data['setting'] = $model->getWhere('toko',$where);
         $data['currentMenu'] = 'editproduk';
        echo view('header',$data);
        echo view ('menu',$data);
        echo view('editproduk',$data);
        echo view ('footer');
      //  }else{
        // return redirect()->to('Home/login');
        } else {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }    
    }

    public function aksitproduk()
{
    $model = new M_kedaikopi();
     $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Menambah produk baru'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        


    $a = $this->request->getPost('nama');
    $b = $this->request->getPost('deskripsi');
    $c = $this->request->getPost('harga');
    $d = $this->request->getPost('stok');
    $e = $this->request->getPost('kategori');
    $uploadedFile = $this->request->getFile('foto');
    $foto = '';

    if ($uploadedFile->isValid() && !$uploadedFile->hasMoved()) {
        $foto = $uploadedFile->getName();
        $model->upload($uploadedFile);
    }

    $isi = array(
        'nama_produk' => $a,
        'deskripsi' => $b,
        'harga' => $c,
        'stok' => $d,
        'id_kategori' => $e,
        'foto' => $foto,
         'created_at' => date('Y-m-d H:i:s'), // Waktu saat produk dibuat
        'created_by' => $id_user // ID user yang login
    );

    $where = array('nama_produk' => $a);
    $model->tambah('produk', $isi);

    return redirect()->to('home/produk');
}



 public function aksieproduk()
{
    $model = new M_kedaikopi();

     $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengubah detail produk'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
    
    $a = $this->request->getPost('nama');
    $b = $this->request->getPost('deskripsi');
    $c = $this->request->getPost('harga');
    $d = $this->request->getPost('stok');
    $e = $this->request->getPost('kategori');
    $id = $this->request->getPost('id');

    // Menyiapkan data yang akan di-update
    $isi = array(
        'nama_produk' => $a,
        'deskripsi' => $b,
        'harga' => $c,
        'stok' => $d,
        'id_kategori' => $e,
         'updated_at' => date('Y-m-d H:i:s'), // Waktu saat produk dibuat
        'updated_by' => $id_user // ID user yang login
    );

    // Memeriksa apakah ada file foto baru
    $uploadedFile = $this->request->getFile('foto');

    if ($uploadedFile && $uploadedFile->isValid() && !$uploadedFile->hasMoved()) {
        $foto = $uploadedFile->getName();
        // Menambahkan nama foto ke data yang akan di-update
        $isi['foto'] = $foto;

        // Upload file foto baru
        $model->upload($uploadedFile);
    }

    // Update data produk di database
    $where = array('id_produk' => $id);
    $model->edit('produk', $isi, $where);

    return redirect()->to('home/produk');
}




    

public function hapusproduk($id){
    $model = new M_kedaikopi();
    $id_user = session()->get('id'); // Ambil ID user dari session
    $activity = 'Menghapus produk'; // Deskripsi aktivitas
    $this->addLog($id_user, $activity);

    // Data yang akan diupdate untuk soft delete
    $data = [
        'isdelete' => 1,
        'deleted_by' => $id_user,
        'deleted_at' => date('Y-m-d H:i:s') // Format datetime untuk deleted_at
    ];

    // Update data produk dengan kondisi id_produk sesuai
    $model->edit('produk', $data, ['id_produk' => $id]);

    return redirect()->to('home/produk');
}

 

    //pesanan
    public function pesanan()
{
   if(session()->get('level')==1 || session()->get('level')==0|| session()->get('level')==3 ){
    $model = new M_kedaikopi();
     $id_user = session()->get('id_user'); // Ambil ID user dari session
        $activity = 'Mengakses halaman pesanan'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        

$where = array(
            
            'pesanan.isdelete' => 0 // Tambahkan kondisi untuk isdelete=0
        );
    $data['elly'] = $model->jointigawhere(
        'pesanan', 
        'user', 
        'produk', 
        
        'pesanan.id_user=user.id_user',
        
        'pesanan.id_produk=produk.id_produk',
        'pesanan.id_pesanan', $where
    );
    $where=array(
          'id_toko'=> 1
        );
        $data['setting'] = $model->getWhere('toko',$where);
        $data['currentMenu'] = 'pesanan'; // Sesuaikan dengan menu yang aktif

    echo view('header',$data);
    echo view('menu', $data);
    echo view('pesanan', $data);
    echo view('footer');
 //  }else{
        // return redirect()->to('Home/login');
        } else {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
 
    }
    }

    // Controller PesananController.php

public function updateStatus()
{
    $model = new M_kedaikopi();
    $kode_pesanan = $this->request->getPost('kode_pesanan');
    $status = $this->request->getPost('status');

    // Dapatkan ID user yang sedang login
    $id_user = session()->get('id'); // Asumsikan ID user disimpan di session
 $activity = 'Memperbarui status pesanan'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
    $where = array('kode_pesanan' => $kode_pesanan);
    $isi = array(
        'status' => $status,
        'updated_at' => date('Y-m-d H:i:s'), // Waktu saat status diperbarui
        'updated_by' => $id_user // ID user yang melakukan update
    );

    $model->edit('pesanan', $isi, $where);

    echo 'Status updated successfully';
}


public function update_pembayaran()
{
    // Inisialisasi model
    $model = new M_kedaikopi();

    // Ambil data dari request
    $kode_pesanan = $this->request->getPost('kode_pesanan');

    // Tentukan status yang ingin diupdate
    $status = 'Terbayar';

    // Tentukan kondisi pencarian dan data yang akan diupdate
    $where = array('kode_pesanan' => $kode_pesanan);
    $isi = array('statusbyr' => $status); // Pastikan field yang diupdate sesuai dengan yang ada di tabel

    // Panggil metode edit dari model
    $model->edit('pesanan', $isi, $where);

    // Tampilkan pesan sukses
    echo 'Status pembayaran telah diperbarui menjadi Terbayar';
}


public function hapuspesanan($kode) {
    // Instansiasi model
    $model = new M_kedaikopi();
    $id_user = session()->get('id'); // Ambil ID user dari session
    $activity = 'Menghapus pesanan'; // Deskripsi aktivitas
    $this->addLog($id_user, $activity);
    
    // Data yang akan diupdate untuk soft delete
    $data = [
        'isdelete' => 1,
        'deleted_by' => $id_user,
        'deleted_at' => date('Y-m-d H:i:s') // Format datetime untuk deleted_at
    ];
    
    // Tentukan kondisi penghapusan
    $where = ['kode_pesanan' => $kode];
    
    // Panggil metode update di model
    $model->edit('pesanan', $data, $where);
    
    // Redirect setelah penghapusan
    return redirect()->to('home/history');
}






    //menuproduk

    // public function menuproduk()
    // {
    //     if(session()->get('level')==2 || session()->get('level')==0 || session()->get('level')==1){
    //     $model= new M_kedaikopi();
    //     // $where= array('kategori.id_kategori'=>$kat);
    //     // $data['elly'] = $model->tampil('produk','id_produk');
    //     $data['elly'] = $model->tampil('produk','id_produk');
    //     $where=array(
    //       'id_toko'=> 1
    //     );
    //     $data['setting'] = $model->getWhere('toko',$where);
    //     echo view('header');
    //     echo view ('menu',$data);
    //     echo view('menuproduk',$data);
    //      echo view ('footer');
    // //  }else{
    //     // return redirect()->to('Home/login');
    //     } else {
    //     throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
 
    // }
    // }

   
    // public function keranjang()
    // {   
    //    if(session()->get('level')==2 || session()->get('level')==0 || session()->get('level')==1){
    //     $model= new M_kedaikopi();
    //     $where=array('user.id_user'=>session()->get('id'));
        
       
    //     // $data['elly'] = $model->tampil('produk','id_produk');
    //     $data['elly'] = $model->jointigawhere('keranjang','produk', 'user','keranjang.id_produk=produk.id_produk','keranjang.id_produk=produk.id_produk','keranjang.id_keranjang', $where);

    //     $where=array(
    //       'id_toko'=> 1
    //     );
    //     $data['setting'] = $model->getWhere('toko',$where);
    //     echo view('header');
    //     echo view ('menu',$data);
    //     echo view('keranjang',$data);
    //     echo view ('footer');
    //     //  }else{
    //     // return redirect()->to('Home/login');
    //     } else {
    //     throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
 
    // }
    // }

    public function menukeranjang()
{
    // Cek hak akses user
    if (session()->get('level') == 2 || session()->get('level') == 0 || session()->get('level') == 1) {
        $model = new M_kedaikopi();
         $id_user = session()->get('id_user'); // Ambil ID user dari session
        $activity = 'Mengakses halaman Menu dan Keranjang'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        

        // Ambil data produk
        $data['elly'] = $model->tampil('produk', 'id_produk');

        // Ambil data keranjang
       $where = array(
            'user.id_user' => session()->get('id'),
            'keranjang.isdelete' => 0 // Tambahkan kondisi untuk isdelete=0
        );
        $data['keranjang'] = $model->jointigawhere(
            'keranjang', 
            'produk', 
            'user', 
            'keranjang.id_produk=produk.id_produk', 
            'keranjang.id_user=user.id_user', 
            'keranjang.id_keranjang',  $where 
            
        );

        // Ambil setting toko
        $whereToko = array('id_toko' => 1);
        $data['setting'] = $model->getWhere('toko', $whereToko);
        $data['currentMenu'] = 'menukeranjang'; // Sesuaikan dengan menu yang aktif

        // Tampilkan view
        echo view('header',$data);
        echo view('menu', $data);
        echo view('menukeranjang', $data); // Tampilkan produk
       
        echo view('footer');
    } else {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }
}


   public function hapuskeranjang($id){
      $model = new M_kedaikopi();
       $id_user = session()->get('id_user'); // Ambil ID user dari session
        $activity = 'Menghapus produk dari keranjang'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
      $where=array('id_keranjang'=>$id);
      $model ->hapus('keranjang', $where);
      return redirect()->to('home/menukeranjang');
 }

public function aksikeranjang()
{
    $id_user = session()->get('id'); // Ambil id_user dari session
    $id_produk = $this->request->getPost('productid');
    $jumlah = $this->request->getPost('jumlah');
    $catatan = $this->request->getPost('catatan');

    // Load model M_kedaikopi
    $model = new M_kedaikopi();

        $activity = 'Menambah produk ke keranjang'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        

    // Ambil harga produk berdasarkan id_produk
    $produk = $model->getWhere('produk', ['id_produk' => $id_produk]);

    
        $harga = $produk->harga; // Harga produk

        // Hitung total harga
        $total_harga = $jumlah * $harga;



        // Data untuk dimasukkan ke tabel keranjang
        $data = [
            'id_produk' => $id_produk,
            'jumlah' => $jumlah,
            'id_user' => $id_user,
            'total_harga' => $total_harga,
            'catatan' => $catatan, 
             'created_at' => date('Y-m-d H:i:s'), // Waktu saat produk dibuat
        'created_by' => $id_user // ID user yang login
        ];



        // Simpan data ke tabel keranjang
        $insert = $model->tambah('keranjang', $data);

        
    return redirect()->to('home/menukeranjang');
}


public function updatekeranjang()
{
     $id_user = session()->get('id'); // Ambil id_user dari session
    $id_keranjang = $this->request->getPost('id_keranjang');
    $jumlah = $this->request->getPost('jumlah');

    $model = new M_kedaikopi();

    $keranjang = $model->getWhere3('keranjang', ['id_keranjang' => $id_keranjang]);
    if (!empty($keranjang)) {
        $id_produk = $keranjang[0]->id_produk;
        $produk = $model->getWhere3('produk', ['id_produk' => $id_produk]);
        $harga = $produk[0]->harga;

        $total_harga = $jumlah * $harga;

        $data = [
            'jumlah' => $jumlah,
            'total_harga' => $total_harga,
            'updated_at' => date('Y-m-d H:i:s'), // Waktu saat produk dibuat
        'updated_by' => $id_user // ID user yang login
        ];
        $update = $model->edit('keranjang', $data, ['id_keranjang' => $id_keranjang]);

        if ($update) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    } else {
        echo json_encode(['success' => false]);
    }
}




//pesan

public function aksipesan()
{
    $id_user = session()->get('id');
    $jenis_pesanan = $this->request->getGet('jenis_pesanan');
    
    log_message('debug', "ID User: $id_user, Jenis Pesanan: $jenis_pesanan");

    $model = new M_kedaikopi();

        $activity = 'Melakukan Pemesanan'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
    $keranjangItems = $model->getWherecon('keranjang', ['id_user' => $id_user]);

    if (empty($keranjangItems)) {
        return redirect()->back()->with('error', 'Keranjang kosong!');
    }

    $tanggalSekarang = date("Ymd");
    $urutanTerakhir = $model->getLastOrderNumber($tanggalSekarang);
    $nomorUrutBaru = str_pad($urutanTerakhir + 1, 3, '0', STR_PAD_LEFT);
    $kode_pesanan = $tanggalSekarang . $nomorUrutBaru;

    foreach ($keranjangItems as $item) {
        $dataPesanan = [
            'tgl_pesanan' => date('Y-m-d H:i:s'),
            'kode_pesanan' => $kode_pesanan,
            'id_user' => $id_user,
            'id_produk' => $item->id_produk,
            'jumlah' => $item->jumlah,
            'total_harga' => $item->total_harga,
            'jenis_pesanan' => $jenis_pesanan,
            'catatan' => $item->catatan,
            'status' => 'Not Yet',
            'statusbyr' => 'Belum Terbayar',
             'created_at' => date('Y-m-d H:i:s'), // Waktu saat produk dibuat
        'created_by' => $id_user // ID user yang login


        ];

        $model->tambah('pesanan', $dataPesanan);
    }

    $model->hapus('keranjang', ['id_user' => $id_user]);

    return redirect()->to('home/history')->with('success', 'Pembayaran berhasil!');
}





    //history
    public function history()
{
   if(session()->get('level')==2 || session()->get('level')==0 || session()->get('level')==1){
    $model = new M_kedaikopi();
     $id_user = session()->get('id_user'); // Ambil ID user dari session
        $activity = 'Mengakses halaman Riwayat Pesanan'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        

$where = array(
            'user.id_user' => session()->get('id'),
            'pesanan.isdelete' => 0 // Tambahkan kondisi untuk isdelete=0
        );
    $data['elly'] = $model->jointigawhere(
        'pesanan', 
        'user', 
        'produk', 
        
        'pesanan.id_user=user.id_user',
        
        'pesanan.id_produk=produk.id_produk',
        'pesanan.id_pesanan', $where
    );

    $where=array(
          'id_toko'=> 1
        );
        $data['setting'] = $model->getWhere('toko',$where);
        $data['currentMenu'] = 'history'; // Sesuaikan dengan menu yang aktif

    echo view('header',$data);
    echo view('menu', $data);
    echo view('history', $data);
    echo view('footer');
//  }else{
        // return redirect()->to('Home/login');
        } else {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

    }
}

//pembayaran

public function pembayaran()
{
   if(session()->get('level')==2 || session()->get('level')==0|| session()->get('level')==1 ){
    $model = new M_kedaikopi();
     $id_user = session()->get('id_user'); // Ambil ID user dari session
        $activity = 'Mengakses halaman pembayaran'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        

$where = array(
            'user.id_user' => session()->get('id'),
            'pesanan.isdelete' => 0 // Tambahkan kondisi untuk isdelete=0
        );
    $data['elly'] = $model->jointigawhere(
        'pesanan', 
        'user', 
        'produk', 
        
        'pesanan.id_user=user.id_user',
        
        'pesanan.id_produk=produk.id_produk',
        'pesanan.id_pesanan', $where
    );

    $where=array(
          'id_toko'=> 1
        );
        $data['setting'] = $model->getWhere('toko',$where);
        $data['currentMenu'] = 'pembayaran'; // Sesuaikan dengan menu yang aktif

    echo view('header',$data);
    echo view('menu', $data);
    echo view('pembayaran', $data);
    echo view('footer');
//  }else{
        // return redirect()->to('Home/login');
        } else {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

    }
}

public function aksibayar() {
    if (session()->get('level') == 2 || session()->get('level') == 0|| session()->get('level') == 1) {
        $kode_pesanan = $this->request->getPost('kode_pesanan');
        $uang_user = $this->request->getPost('uang_pembeli');
        $uang_kembalian = $this->request->getPost('pengembalian');
        $id_user = session()->get('id'); // Ambil id_user dari session

        $model = new M_kedaikopi();

        // Ambil ID user dari session
        $activity = 'Melakukan pembayaran'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        

        $query = $model->getWhere2('pesanan', ['kode_pesanan' => $kode_pesanan]);
        $pesanan = $query->getResult(); 

        if (empty($pesanan)) {
            return redirect()->back()->with('error', 'Pesanan tidak ditemukan.');
        }
        

        foreach ($pesanan as $item) {
            $id_pesanan = $item->id_pesanan;
            $id_produk = $item->id_produk;
           
            $jumlah = $item->jumlah;
            $catatan = $item->catatan;
           
            $tgl_pesanan = $item->tgl_pesanan;
            
           
                $queryProduk = $model->getWhere2('produk', ['id_produk' => $id_produk]);
                $produk = $queryProduk->getRow();

                $queryPesanan = $model->getWhere2('pesanan', ['id_pesanan' => $id_pesanan]);
                $pesanan = $queryPesanan->getRow();
    
                
            $data = [
                'kode_pesanan' => $kode_pesanan,
                'tgl_pesanan' => $tgl_pesanan,
                'id_user' => $id_user,
                'nama_produk' => $produk ? $produk->nama_produk : 'Unknown',
                'harga' => $produk ? $produk->harga : '0',
                'jumlah' => $jumlah,
                'catatan' => $catatan,
                'harga_total' => $pesanan ? $pesanan->total_harga : '0',
                'jenis_pesanan' => $pesanan ? $pesanan->jenis_pesanan : '0',
                'uang_user' => $uang_user,
                'uang_kembalian' => $uang_kembalian,
                 'created_at' => date('Y-m-d H:i:s'), // Waktu saat produk dibuat
                 'created_by' => $id_user, // ID user yang login
            ];

            $model->tambah('nota2', $data);
        }

        return redirect()->to('/home/pembayaran')->with('success', 'Pembayaran berhasil!');
    } else {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }
}








//user

    public function datauser()
    {  
       if(session()->get('level')==1 || session()->get('level')==0 ){
        $model= new M_kedaikopi();
         $id_user = session()->get('id_user'); // Ambil ID user dari session
        $activity = 'Mengakses halaman manajemen user'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
        $data['elly'] = $model->tampil('user','id_user');
        $where=array(
          'id_toko'=> 1
        );
        $data['setting'] = $model->getWhere('toko',$where);
        $data['currentMenu'] = 'datauser'; // Sesuaikan dengan menu yang aktif
        echo view('header',$data);
        echo view ('menu',$data);
        echo view('datauser',$data);
        echo view ('footer');
        //  }else{
        // return redirect()->to('Home/login');
        } else {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
    


    public function tambahuser()
    {
       if(session()->get('level')==1 || session()->get('level')==0 ){
        $model= new M_kedaikopi();
         $id_user = session()->get('id_user'); // Ambil ID user dari session
        $activity = 'Mengakses halaman tambah user'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
        $where=array(
          'id_toko'=> 1
        );
        $data['setting'] = $model->getWhere('toko',$where);
         $data['currentMenu'] = 'tambahuser';
        echo view('header',$data);
        echo view ('menu', $data);
        echo view('tambahuser');
        echo view ('footer');
      //  }else{
        // return redirect()->to('Home/login');
        } else {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }    
    }
    public function aksituser()
{
    $model = new M_kedaikopi();
     $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Menambah user baru'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
    $a = $this->request->getPost('nama');
    $b = $this->request->getPost('alamat');
    $c = $this->request->getPost('nohp');
    $d = md5($this->request->getPost('password'));
    $e = $this->request->getPost('level');
    $uploadedFile = $this->request->getFile('foto');

    // Cek apakah file foto di-upload atau tidak
    if ($uploadedFile && $uploadedFile->isValid() && !$uploadedFile->hasMoved()) {
        $foto = $uploadedFile->getName();
        $model->upload($uploadedFile);
    } else {
        // Set foto default jika tidak ada file yang di-upload
        $foto = 'default.jpg';
    }

    $isi = array(
        'nama_user' => $a,
        'alamat' => $b,
        'nomor_hp' => $c,
        'password' => $d,
        'level' => $e,
        'foto' => $foto,
         'created_at' => date('Y-m-d H:i:s'), // Waktu saat produk dibuat
        'created_by' => $id_user // ID user yang login
    );

    $model->tambah('user', $isi);
    
    return redirect()->to('home/datauser');
}

    public function edituser($id)
    {
       if(session()->get('level')==1 || session()->get('level')==0 ){
            $model = new M_kedaikopi();
             $id_user = session()->get('id_user'); // Ambil ID user dari session
        $activity = 'Mengakses halaman detail user'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
            $where=array('id_user'=>$id);
            $data['satu']=$model->getWhere('user',$where);
            $where=array(
          'id_toko'=> 1
        );
        $data['setting'] = $model->getWhere('toko',$where);
         $data['currentMenu'] = 'edituser';
            echo view ('header',$data);
            echo view ('menu',$data);
            echo view ('edituser',$data);
            echo view ('footer');
       //  }else{
        // return redirect()->to('Home/login');
        } else {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        
    }

public function aksieuser()
    {
        $model = new M_kedaikopi();
         $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengubah detail user'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
        $a = $this->request->getPost('nama');
        $b = $this->request->getPost('alamat');
        $c = $this->request->getPost('nohp');
        $d = $this->request->getPost('level');
        // $d = md5($this->request->getPost('password'));
        $id = $this->request->getPost('id');
       

       $fotoName = $this->request->getPost('old_foto'); // Mengambil nama foto lama

    $foto = $this->request->getFile('foto');
    if ($foto && $foto->isValid()) {
        // Generate a new name for the uploaded file
        $newName = $foto->getRandomName();
        // Move the file to the target directory
        $foto->move(ROOTPATH . 'public/images', $newName);
        // Set the new file name to be saved in the database
        $fotoName = $newName;
    }


        $where= array('id_user'=>$id); 

        $isi = array(
            'nama_user' => $a,
            'alamat' => $b,
            'nomor_hp' => $c,
             'level' => $d,
            'foto' => $fotoName,
            'updated_at' => date('Y-m-d H:i:s'), // Waktu saat produk dibuat
        'updated_by' => $id_user // ID user yang login
            

        );
        $model ->edit('user', $isi, $where);
        
        return redirect()->to('home/datauser');
    }

   
    



 public function hapususer($id){
      $model = new M_kedaikopi();
       $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Menghapus user'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
      $data = [
        'isdelete' => 1,
        'deleted_by' => $id_user,
        'deleted_at' => date('Y-m-d H:i:s') // Format datetime untuk deleted_at
    ];

    // Update data produk dengan kondisi id_produk sesuai
    $model->edit('user', $data, ['id_user' => $id]);

    return redirect()->to('home/datauser');
}

    



//registrasi
    // public function registrasi()
    // {
        
    //     echo view('header');
        
    //     echo view('registrasi');
        
    // }

    // public function aksi_register()
    // {
    //     $a = $this->request->getPost('nama');
    //     $b = $this->request->getPost('alamat');
    //     $c = $this->request->getPost('nohp');
    //     $d = md5($this->request->getPost('password'));

        

    //     $isi = array(

    //         'nama_user' => $a,
    //         'alamat' => $b,
    //         'nomor_hp' => $c,
    //         'password' => $d, 
    //         'level' => 1
           
    //     );

    //     $model = new M_kedaikopi();
    //     $model->tambah('user', $isi);
           
    //        $login=array(
    //       'nomor_hp'=> $c,
    //       'password'=> $d
    //     );

    //         $cek = $model->getWhere('user',$login);

    //         if ($cek>0){
    //        session()->set('id',$cek->id_user);
    //         session()->set('nama',$cek->nama_user);
    //         session()->set('level',$cek->id_level); 
    //         session()->set('level','2'); 
    //         return redirect()->to('home/');
    //     }else{
    //         return redirect()->to('Home/login');
    //     }


    // }

    //laporan
    public function laporan()
    {
    	if(session()->get('level')==1 || session()->get('level')==0 ){
        $model = new M_kedaikopi();
         $id_user = session()->get('id_user'); // Ambil ID user dari session
        $activity = 'Mengakses halaman laporan'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
        $where=array(
          'id_toko'=> 1
        );
        $data['setting'] = $model->getWhere('toko',$where);
        $data['currentMenu'] = 'laporan'; // Sesuaikan dengan menu yang aktif
        echo view('header',$data);
        echo view('menu', $data);
        echo view('laporan');
        echo view('footer');
    //  }else{
        // return redirect()->to('Home/login');
        } else {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }
    }
    public function formnota()
    {
        if(session()->get('level')==1 || session()->get('level')==0 ){
        $model = new M_kedaikopi();
         $id_user = session()->get('id_user'); // Ambil ID user dari session
        $activity = 'Mengakses halaman laporan nota pembeli'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
        $where=array(
          'id_toko'=> 1
        );
        $data['setting'] = $model->getWhere('toko',$where);
        $data['currentMenu'] = 'nota'; // Sesuaikan dengan menu yang aktif
        echo view('header',$data);
        echo view('menu', $data);
        echo view('formnota');
        echo view('footer');
    //  }else{
        // return redirect()->to('Home/login');
        } else {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }
    }


    //laporan

    public function word()
    {
        $a=$this->request->getPost('awal');
        $b=$this->request->getPost('akhir');

        $model = new M_kedaikopi();
         $id_user = session()->get('id_user'); // Ambil ID user dari session
        $activity = 'Mencetak laporan'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
        $data['elly']= $model->caritiga('pesanan','user','produk','pesanan.id_user=user.id_user','pesanan.id_produk=produk.id_produk',$a,$b,'tgl_pesanan');

        echo view('word',$data);
        
        
    }

    public function adminnota()
{
    $awal = $this->request->getPost('awal');
    $akhir = $this->request->getPost('akhir');
    $kode_pesanan = $this->request->getPost('kode_pesanan');

    $model = new M_kedaikopi();
     $id_user = session()->get('id_user'); // Ambil ID user dari session
        $activity = 'Mencetak laporan nota pembelian'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
    // $dompdf = new dompdf();
    $where = array(
        'id_toko' => 1
    );
    $data['setting'] = $model->getWhere('toko', $where);

    // Ambil semua pesanan dalam rentang tanggal yang diberikan
    $data_pesanan = $model->cari(
        'nota2',
        'user',
        'nota2.id_user=user.id_user',
        $awal,
        $akhir,
        'tgl_pesanan'
    );

    // Jika kode_pesanan diberikan, filter hasil untuk kode tersebut
    if ($kode_pesanan) {
        $data_pesanan = array_filter($data_pesanan, function($item) use ($kode_pesanan) {
            return $item->kode_pesanan === $kode_pesanan;
        });
    }

    // Kelompokkan data berdasarkan kode_pesanan
    $kelompok_pesanan = [];
    foreach ($data_pesanan as $item) {
        $kelompok_pesanan[$item->kode_pesanan][] = $item;
    }

    // Debugging: print data untuk memastikan data benar
    // echo "<pre>";
    // print_r($kelompok_pesanan);
    // echo "</pre>";
    // die();

    // Siapkan data untuk view
    $data['elly'] = $kelompok_pesanan;

    // Tampilkan view dengan data pesanan yang telah dikelompokkan
    echo view('adminnota',$data);
    
}





public function printnota($kode_pesanan)
{
    // Load model
    $model = new M_kedaikopi();

     $id_user = session()->get('id_user'); // Ambil ID user dari session
        $activity = 'Mencetak nota pembeli'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        

    // Ambil data setting toko
    $where = array(
        'id_toko' => 1
    );
    $data['setting'] = $model->getWhere('toko', $where);

    // Ambil data pesanan berdasarkan kode_pesanan
    // $dompdf = new dompdf();
    $data['elly'] = $model->joinduawhere('nota2', 'user', 'nota2.id_user=user.id_user', 'tgl_pesanan', ['kode_pesanan' => $kode_pesanan]);

    // $html = view('printnota', $data);
    // $dompdf->loadHtml($html);
    // $dompdf->setPaper('A6', 'portrait');
    // $dompdf->render();
    // // $dompdf->stream();
    // $dompdf->stream('laporan pesanan.pdf', array(
    //     "Attatchment" => false
    // ));

    echo view('printnota',$data);
    
}



    public function pdf(){


        $a=$this->request->getPost('awal');
        $b=$this->request->getPost('akhir');

        $model = new M_kedaikopi();
         $id_user = session()->get('id_user'); // Ambil ID user dari session
        $activity = 'Mencetak laporan'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        $dompdf = new dompdf();
            $data['elly']= $model->caritiga('pesanan','user','produk','pesanan.id_user=user.id_user','pesanan.id_produk=produk.id_produk', $a,$b,'tgl_pesanan');


        $html = view('pdf', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        // $dompdf->stream();
        $dompdf->stream('laporan pesanan.pdf', array(
            "Attatchment" => false
        ));
        
    }

    public function excel() {
    $a = $this->request->getPost('awal');
    $b = $this->request->getPost('akhir');

    $model = new M_kedaikopi();
     $id_user = session()->get('id_user'); // Ambil ID user dari session
        $activity = 'Mencetak laporan'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
    $data['elly'] = $model->caritiga('pesanan', 'user', 'produk', 'pesanan.id_user=user.id_user', 'pesanan.id_produk=produk.id_produk', $a, $b, 'tgl_pesanan');

    // Buat Spreadsheet baru
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set gaya border
    $borderStyle = [
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['argb' => '00000000'],
            ],
        ],
    ];

    // Set judul
    $sheet->setCellValue('A1', 'LAPORAN PRESANAN');
    $sheet->mergeCells('A1:F1'); // Gabungkan sel untuk judul
    $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16); // Buat teks judul menjadi tebal dan besar
    $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); // Buat teks judul menjadi di tengah
    $sheet->getStyle('A1:F1')->applyFromArray($borderStyle); // Terapkan border pada sel judul

    // Set header kolom
    $sheet->setCellValue('A2', 'No');
    $sheet->setCellValue('B2', 'Tanggal pesanan');
    $sheet->setCellValue('C2', 'Kode pesanan');
    $sheet->setCellValue('D2', 'Jenis pesanan');
    $sheet->setCellValue('E2', 'Pesanan');
    $sheet->setCellValue('F2', 'Total pesanan');
    

    // Set gaya border untuk header
    $sheet->getStyle('A2:F2')->applyFromArray($borderStyle);

    $no = 1;
    $row = 3; // Mulai dari baris 3 setelah judul dan header
    $grouped_transactions = array(); // Menyimpan pesanan yang telah digabungkan

    // Menggabungkan pesanan dengan kode pesanan yang sama
    foreach ($data['elly'] as $gou) {
        $kode_pesanan = $gou->kode_pesanan;
        if (!isset($grouped_transactions[$kode_pesanan])) {
            $grouped_transactions[$kode_pesanan] = array(
                'tgl_pesanan' => $gou->tgl_pesanan,
                'kode_pesanan' => $gou->kode_pesanan,
                'jenis_pesanan' => $gou->jenis_pesanan,
                'pesanan' => array(),
                'total_harga' => 0
                
            );
        }

        // Memasukkan nama_produk dan jumlah ke dalam pesanan yang sama
        $grouped_transactions[$kode_pesanan]['pesanan'][] = $gou->nama_produk . " " . $gou->jumlah;
        $grouped_transactions[$kode_pesanan]['total_harga'] += $gou->total_harga;
    }

    // Menampilkan hasil penggabungan ke dalam file Excel
    foreach ($grouped_transactions as $transaction) {
        $sheet->setCellValue('A' . $row, $no++);
        $sheet->setCellValue('B' . $row, $transaction['tgl_pesanan']);
        $sheet->setCellValue('C' . $row, $transaction['kode_pesanan']);
        $sheet->setCellValue('D' . $row, $transaction['jenis_pesanan']);
        $sheet->setCellValue('E' . $row, implode(", ", $transaction['pesanan']));
       $sheet->setCellValue('F' . $row, 'Rp ' . number_format($transaction['total_harga'], 2, ',', '.'));
        
        
        // Set gaya border untuk baris data
        $sheet->getStyle('A' . $row . ':F' . $row)->applyFromArray($borderStyle);
        
        $row++;
    }

    // Menyesuaikan lebar kolom secara otomatis
    foreach (range('A', 'F') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    // Buat file Excel
    $writer = new Xlsx($spreadsheet);

    // Set header untuk download file
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="laporan_pesanan.xlsx"');
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
}

//profile

public function profile($id)
{
        if (session()->get('level')>0){
        $model = new M_kedaikopi();

         $id_user = session()->get('id_user'); // Ambil ID user dari session
        $activity = 'Mengakses halaman profile'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        

        $where=array(
          'id_toko'=> 1
        );
        $data['setting'] = $model->getWhere('toko',$where);

        $where= array('user.id_user'=>$id);
        $where=array('id_user'=>session()->get('id'));
        
        $data['user']=$model->getWhere('user',$where);
        $data['currentMenu'] = 'profile';   

        echo view('header',$data);
        echo view ('menu',$data);
        echo view('profile',$data);
        echo view ('footer');
        } else {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }  
        
}
public function aksieprofile() 
{
    $model = new M_kedaikopi();
     $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengubah informasi profile'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);

    $a = $this->request->getPost('nama');
    $b = $this->request->getPost('nohp');
    $c = $this->request->getPost('alamat');
    $id = $this->request->getPost('id');

    $fotoName = $this->request->getPost('old_foto'); // Mengambil nama foto lama

    $foto = $this->request->getFile('foto');
    if ($foto && $foto->isValid()) {
        // Generate a new name for the uploaded file
        $newName = $foto->getRandomName();
        // Move the file to the target directory
        $foto->move(ROOTPATH . 'public/images', $newName);
        // Set the new file name to be saved in the database
        $fotoName = $newName;
    }

    $where = array('id_user' => $id);
    $isi = array(
        'nama_user' => $a,
        'nomor_hp' => $b,
        'alamat' => $c,
        'foto' => $fotoName,
        'updated_at' => date('Y-m-d H:i:s'), // Waktu saat produk dibuat
        'updated_by' => $id_user // ID user yang login
    );

    $model->edit('user', $isi, $where);
    return redirect()->to('home/profile/'.$id);
}


//changepass


public function changepassword()
{
    if (session()->get('level') > 0) {
        $model = new M_kedaikopi();
         $id_user = session()->get('id_user'); // Ambil ID user dari session
        $activity = 'Mengakses halaman ubah password'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
        $where = array(
            'id_toko' => 1
        );
        $data['setting'] = $model->getWhere('toko', $where);
        
        $where = array('id_user' => session()->get('id'));
        $data['elly'] = $model->getwhere('user', $where);
        
        echo view('header', $data);
        echo view('menu', $data);
        echo view('changepassword', $data);
        echo view('footer');
    } else {
        return redirect()->to('home/dashboard');
    }
}


public function aksi_changepass() {
    $model = new M_kedaikopi();
     $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengubah password'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
    $oldPassword = $this->request->getPost('old');
    $newPassword = $this->request->getPost('new');
    $userId = session()->get('id');

    // Dapatkan password lama dari database
    $currentPassword = $model->getPassword($userId);

    // Verifikasi apakah password lama cocok
    if (md5($oldPassword) !== $currentPassword) {
        // Set pesan error jika password lama salah
        session()->setFlashdata('error', 'Password lama tidak valid.');
        return redirect()->back()->withInput();
    }

    // Update password baru
    $data = [
        'password' => md5($newPassword),
         'updated_at' => date('Y-m-d H:i:s'), // Waktu saat produk dibuat
        'updated_by' => $id_user // ID user yang login
    ];
    $where = ['id_user' => $userId];
    
    $model->edit('user', $data, $where);
    
    // Set pesan sukses
    session()->setFlashdata('success', 'Password berhasil diperbarui.');
    return redirect()->to('home/changepassword');
}


//log

public function log() 
{
    if (session()->get('level') == 1 || session()->get('level') == 0) {
        $model = new M_kedaikopi();


        // Menambahkan log aktivitas ketika user mengakses halaman log
        $id_user = session()->get('id_user'); // Ambil ID user dari session
        $activity = 'Mengakses halaman log aktivitas'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
        // Mengambil data log aktivitas dari model
        $data['logs'] = $model->getActivityLogs();
        $where=array(
          'id_toko'=> 1
        );
        $data['setting'] = $model->getWhere('toko',$where);
        $data['currentMenu'] = 'log'; // Sesuaikan dengan menu yang aktif
        
        echo view('header', $data);
        echo view('menu', $data);
        echo view('log', $data);
        echo view('footer');
    } else {
        return redirect()->to('home/login');
    }
}

    public function addLog($id_user, $activity)
{
    $model = new M_kedaikopi(); // Gunakan model M_kedaikopi
    $id_user = session()->get('id');
    $data = [
        'id_user' => $id_user,
        'activity' => $activity,
        'timestamp' => date('Y-m-d H:i:s'),
    ];
    $model->tambah('activity_log', $data); // Pastikan 'activity_log' adalah nama tabel yang benar
}


    //restore

public function reproduk()
    {   
      if(session()->get('level')==1 || session()->get('level')==0){
        // if (session()->get('level')>0){
        $model= new M_kedaikopi();
         $id_user = session()->get('id_user'); // Ambil ID user dari session
        $activity = 'Mengakses halaman restore produk'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
        // $data['elly'] = $model->tampil('produk','id_produk');
        $data['elly'] = $model->join('produk','kategori','produk.id_kategori=kategori.id_kategori','produk.id_produk');
        $where=array(
          'id_toko'=> 1
        );
        $data['setting'] = $model->getWhere('toko',$where);
        $data['currentMenu'] = 'reproduk'; // Sesuaikan dengan menu yang aktif
        echo view('header',$data);
        echo view ('menu',$data);
        echo view('reproduk',$data);
        echo view ('footer');
        //  }else{
        // return redirect()->to('Home/login');
        } else {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
 
    }
    }


public function aksireproduk($id) {
    $model = new M_kedaikopi();
     $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Merestore produk'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
    
    // Data yang akan diupdate untuk mengembalikan produk
    $data = [
        'isdelete' => 0,
        'deleted_by' => null,
        'deleted_at' => null
    ];

    // Update data produk dengan kondisi id_produk sesuai
    $model->edit('produk', $data, ['id_produk' => $id]);

    return redirect()->to('home/reproduk');
}

public function reuser()
    {  
       if(session()->get('level')==1 || session()->get('level')==0){
        $model= new M_kedaikopi();
         $id_user = session()->get('id_user'); // Ambil ID user dari session
        $activity = 'Mengakses halaman restore user'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
        $data['elly'] = $model->tampil('user','id_user');
        $where=array(
          'id_toko'=> 1
        );
        $data['setting'] = $model->getWhere('toko',$where);
        $data['currentMenu'] = 'reuser'; // Sesuaikan dengan menu yang aktif
        echo view('header',$data);
        echo view ('menu',$data);
        echo view('reuser',$data);
        echo view ('footer');
        //  }else{
        // return redirect()->to('Home/login');
        } else {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
public function aksireuser($id) {
    $model = new M_kedaikopi();
     $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Merestore user'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
    
    // Data yang akan diupdate untuk mengembalikan produk
    $data = [
        'isdelete' => 0,
        'deleted_by' => null,
        'deleted_at' => null
    ];

    // Update data produk dengan kondisi id_produk sesuai
    $model->edit('user', $data, ['id_user' => $id]);

    return redirect()->to('home/reuser');
}

public function repesanan()
{
  if(session()->get('level')==1 || session()->get('level')==0){
    $model = new M_kedaikopi();
     $id_user = session()->get('id_user'); // Ambil ID user dari session
        $activity = 'Mengakses halaman restore pesanan'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        

$where = array(
            'user.id_user' => session()->get('id'),
            'pesanan.isdelete' => 1 // Tambahkan kondisi untuk isdelete=0
        );
    $data['elly'] = $model->jointigawhere(
        'pesanan', 
        'user', 
        'produk', 
        
        'pesanan.id_user=user.id_user',
        
        'pesanan.id_produk=produk.id_produk',
        'pesanan.id_pesanan', $where
    );

    $where=array(
          'id_toko'=> 1
        );
        $data['setting'] = $model->getWhere('toko',$where);
        $data['currentMenu'] = 'repesanan'; // Sesuaikan dengan menu yang aktif

    echo view('header',$data);
    echo view('menu', $data);
    echo view('repesanan', $data);
    echo view('footer');
//  }else{
        // return redirect()->to('Home/login');
        } else {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

    }
}

public function aksirepesanan($kode) {
    // Instansiasi model
    $model = new M_kedaikopi();
     $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Merestore pesanan'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
    
    // Data yang akan diupdate untuk mengembalikan status pesanan
    $data = [
        'isdelete' => 0,
        'deleted_by' => null,
        'deleted_at' => null
    ];
    
    // Tentukan kondisi untuk update
    $where = ['kode_pesanan' => $kode];
    
    // Panggil metode update di model
    $model->edit('pesanan', $data, $where);
    
    // Redirect setelah restore
    return redirect()->to('home/repesanan');
}

// public function rekeranjang()
//     {   
//        if(session()->get('level')==1 || session()->get('level')==0){
//          $model= new M_kedaikopi();
//          $id_user = session()->get('id_user'); // Ambil ID user dari session
//         $activity = 'Mengakses halaman restore keranjang'; // Deskripsi aktivitas
//         $this->addLog($id_user, $activity);
        
//        $where = array(
//             'user.id_user' => session()->get('id'),
//             'keranjang.isdelete' => 1 

//             );
//         $data['elly'] = $model->jointigawhere('keranjang','produk', 'user','keranjang.id_produk=produk.id_produk','keranjang.id_produk=produk.id_produk','keranjang.id_keranjang', $where);

//         $where=array(
//           'id_toko'=> 1
//         );
//         $data['setting'] = $model->getWhere('toko',$where);
//         echo view('header');
//         echo view ('menu',$data);
//         echo view('rekeranjang',$data);
//         echo view ('footer');
//         //  }else{
//         // return redirect()->to('Home/login');
//         } else {
//         throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
 
//     }
//     }


// public function aksirekeranjang($id) {
//     $model = new M_kedaikopi();
//      $id_user = session()->get('id'); // Ambil ID user dari session
//         $activity = 'Merestore produk dari keranjang'; // Deskripsi aktivitas
//         $this->addLog($id_user, $activity);
    
//     // Data yang akan diupdate untuk mengembalikan produk
//     $data = [
//         'isdelete' => 0,
//         'deleted_by' => null,
//         'deleted_at' => null
//     ];

//     // Update data produk dengan kondisi id_produk sesuai
//     $model->edit('keranjang', $data, ['id_keranjang' => $id]);

//     return redirect()->to('home/rekeranjang');
// }




}


