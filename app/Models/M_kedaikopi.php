<?php

namespace App\Models;
use CodeIgniter\Model;

Class M_kedaikopi extends Model
{
  public function tampil($tabel,$id){
    return $this->db->table($tabel)
                    ->orderby ($id,'desc') 
                    ->get()
                    ->getResult();
  } 
  public function join($tabel, $tabel2, $on, $id){
    return $this->db->table($tabel)
                    ->join($tabel2,$on,'left')
                    ->orderby ($id,'desc') 
                    ->get()
                    ->getResult();
                    
  }

  public function getUserById($id_user) {
    $this->db->where('id_user', $id_user);
    $query = $this->db->get('user'); // Sesuaikan dengan nama tabel
    return $query->row();
}
   public function joinempat($tabel, $tabel2, $tabel3, $tabel4, $on, $on2, $on3, $id){
     return $this->db->table($tabel)
                    ->join($tabel2, $on,'left')
                    ->join($tabel3, $on2,'left')
                    ->join($tabel4, $on3,'left')
                    ->orderby($id,'desc')
                    ->get()
                    ->getResult();
}

public function jointiga($tabel, $tabel2, $tabel3, $on, $on2, $id){
     return $this->db->table($tabel)
                    ->join($tabel2, $on,'left')
                    ->join($tabel3, $on2,'left')
                    ->orderby($id,'desc')
                    ->get()
                    ->getResult();
}  
    public function joinWhere($tabel, $tabel2, $on, $where){
    return $this->db->table($tabel)
            ->join($tabel2,$on,'left')
            ->getWhere($where)
            ->getRow();
  }
  public function joinWherebaru($tabel, $tabel2, $on, $where) {
    return $this->db->table($tabel)
            ->join($tabel2, $on, 'left')
            ->where($where)
            ->get()
            ->getResult(); // Mengambil banyak hasil
}
  public function getWhere($tabel,$where){
    return $this->db->table($tabel)
             ->getWhere($where)
             ->getRow();
             
}
public function tambahBatch($table, $data)
{
    return $this->db->table($table)->insertBatch($data);
}
public function cari($tabel,$tabel2, $on, $awal, $akhir, $field){
    return $this->db->table($tabel)
            ->join($tabel2,$on,'left')
            ->getWhere("tgl_pesanan between '$awal' and '$akhir'")
            ->getResult();
}

public function carik($tabel,$tabel2, $on, $awal, $akhir, $field){
    return $this->db->table($tabel)
            ->join($tabel2,$on,'left')
            ->getWhere("tanggal_k between '$awal' and '$akhir'")
            ->getResult();
}

public function caritiga($tabel,$tabel2,$tabel3, $on, $on2, $awal, $akhir, $field){
    return $this->db->table($tabel)
            ->join($tabel2,$on,'left')
            ->join($tabel3, $on2,'left')
            ->getWhere("tgl_pesanan between '$awal' and '$akhir'")
            // ->getWhere($field. "between '$awal' and '$akhir'")
  // return $this->db->query ("select*from brg_msk join barang on brg_msk.id_brg=barang.id_brg")
                    ->getResult();
}

  public function upload($photo){
    
        $imageName = $photo->getName();
        $photo->move(ROOTPATH .'public/images', $imageName);
    }  

public function joinn($tabel, $tabel2, $tabel3,$tabel4, $on, $on2,$on3, $id, $where){
 return $this->db->table($tabel)
 ->join($tabel2, $on,'left')
 ->join($tabel3, $on2,'left')
 ->join($tabel4, $on3,'left')
 ->orderby($id,'desc')
 ->getWhere($where)
 ->getResult();
 
}
public function jointigawhere($tabel, $tabel2, $tabel3, $on, $on2, $id, $where){
     return $this->db->table($tabel)
                    ->join($tabel2, $on,'left')
                    ->join($tabel3, $on2,'left')
                    ->orderby($id,'desc')
                    ->getWhere($where)
                    ->getResult();
}
public function joinempatwhere($tabel, $tabel2, $tabel3, $tabel4, $on, $on2, $on3, $id, $where){
  return $this->db->table($tabel)
                 ->join($tabel2, $on,'left')
                 ->join($tabel3, $on2,'left')
                 ->join($tabel4, $on3,'left')
                 ->orderby($id,'desc')
                 ->getWhere($where)
                 ->getResult();
}
public function joinduawhere($tabel, $tabel2, $on, $id, $where){
     return $this->db->table($tabel)
                    ->join($tabel2, $on,'left')
                    ->orderby($id,'desc')
                    ->getWhere($where)
                    ->getResult();
}
public function getWherecon($table, $conditions)
{
    return $this->db->table($table)->where($conditions)->get()->getResult();
}

public function getPassword($userId)
{
  return $this->db->table('user')
                        ->select('password')
                        ->where('id_user', $userId)
                        ->get()
                        ->getRow()
                        ->password;

}

public function updateKeranjang($idKeranjang, $jumlah, $totalHarga)
{
    $data = [
        'jumlah' => $jumlah,
        'total_harga' => $totalHarga
    ];
    return $this->db->table('keranjang')->update($data, ['id_keranjang' => $idKeranjang]);
}

  
  public function tambah($tabel, $isi){
    return $this->db->table($tabel)
                    ->insert($isi);
  }
  public function edit($tabel, $isi, $where){
    return $this->db->table($tabel)
                    ->update($isi,$where);
  }
  
  public function hapus($tabel, $where){
    return $this->db->table($tabel)
                    ->delete($where);
                    
  }
  public function getLastOrderNumber($tanggal)
{
    // Query untuk mendapatkan nomor urut terakhir pada hari tertentu
    $query = $this->db->table('pesanan')
                      ->select('kode_pesanan')
                      ->like('kode_pesanan', $tanggal, 'after')
                      ->orderBy('kode_pesanan', 'DESC')
                      ->get()
                      ->getRow();

    if ($query) {
        // Ambil 3 digit terakhir dari kode_pesanan
        return (int)substr($query->kode_pesanan, -3);
    } else {
        // Jika tidak ada pesanan pada hari tersebut, kembalikan 0
        return 0;
    }
}

public function getWhere2($table, $conditions)
{
    return $this->db->table($table)->where($conditions)->get();
}

public function getWhere3($table, $where)
{
    return $this->db->table($table)->where($where)->get()->getResult();
}
public function getActivityLogs()
{
    return $this->db->table('activity_log')
                    ->join('user', 'activity_log.id_user = user.id_user', 'left')
                    ->select('activity_log.*, user.nama_user')
                    ->orderBy('activity_log.timestamp', 'DESC')
                    ->get()
                    ->getResult();
}




}