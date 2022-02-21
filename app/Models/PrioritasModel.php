<?php

namespace App\Models;

use CodeIgniter\Model;

class PrioritasModel extends Model
{
    protected $db;
    protected $table = "prioritas_permintaan";
    protected $allowedFields = ['prioritas'];

    public function getAllPrioritas()
    {
        return $this->select("*")->findAll();
    }

    public function getPrioritasById($id)
    {
        return $this->select("*")->where(["id=" => $id])->first();
    }
}
