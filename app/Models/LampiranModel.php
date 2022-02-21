<?php

namespace App\Models;

use CodeIgniter\Model;

class LampiranModel extends Model
{
    protected $db;
    protected $table = "lampiran_permintaan";
    protected $allowedFields = ['lampiran'];

    public function getAllLampiran()
    {
        return $this->select("*")->findAll();
    }

    public function getLampiranById($id)
    {
        return $this->select("*")->where(["id=" => $id])->first();
    }
}
