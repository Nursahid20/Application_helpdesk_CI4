<?php

namespace App\Models;

use CodeIgniter\Model;

class StatusModel extends Model
{
    protected $db;
    protected $table = "status_permintaan";
    protected $allowedFields = ['status'];

    public function getAllStatus()
    {
        return $this->select("*")->findAll();
    }

    public function getStatusById($id)
    {
        return $this->select("*")->where(["id=" => $id])->first();
    }
}
