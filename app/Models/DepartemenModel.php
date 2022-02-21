<?php

namespace App\Models;

use CodeIgniter\Model;

class DepartemenModel extends Model
{
    protected $db;
    protected $table = "departemen";
    protected $allowedFields = ['kode_departemen', 'nama_departemen'];

    public function getAllDepartemen()
    {
        return $this->select("*")->where(["nama_departemen!=" => '-'])->findAll();
    }

    public function getDepartemenById($id)
    {
        return $this->select("*")->where(["id=" => $id])->first();
    }
}
