<?php

namespace App\Models;

use CodeIgniter\Model;

class JabatanModel extends Model
{
    protected $db;
    protected $table = "jabatan";
    protected $allowedFields = ['kode_jabatan', 'nama_jabatan'];

    public function getAllJabatan()
    {
        return $this->select("*")->where(["nama_jabatan!=" => '-'])->findAll();
    }
    public function getJabatanById($id)
    {
        return $this->select("*")->where(["id=" => $id])->first();
    }
}
