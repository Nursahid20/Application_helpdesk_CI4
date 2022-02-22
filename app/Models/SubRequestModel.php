<?php

namespace App\Models;

use CodeIgniter\Model;

class SubRequestModel extends Model
{
    protected $db;
    protected $table = "sub_permintaan";
    protected $allowedFields = ['kategori', 'lampiran', 'status', 'prioritas'];

    public function getKategori()
    {
        return $this->select("*")
            ->where(['kategori!=' => ''])
            ->findAll();
    }

    public function getLampiran()
    {
        return $this->select("*")
            ->where(['lampiran!=' => ''])
            ->findAll();
    }

    public function getStatus()
    {
        return $this->select("*")
            ->where(['status!=' => ''])
            ->findAll();
    }

    public function getPrioritas()
    {
        return $this->select("*")
            ->where(['prioritas!=' => ''])
            ->where(['prioritas!=' => '-'])
            ->findAll();
    }

    public function getById($id)
    {
        return $this->select("*")->where(["id=" => $id])->first();
    }
}
