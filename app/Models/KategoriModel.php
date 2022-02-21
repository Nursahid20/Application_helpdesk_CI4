<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $db;
    protected $table = "kategori_permintaan";
    protected $allowedFields = ['kategori'];

    public function getAllKategori()
    {
        return $this->select("*")->findAll();
    }

    public function getKategoriById($id)
    {
        return $this->select("*")->where(["id=" => $id])->first();
    }
}
