<?php

namespace App\Models;

use CodeIgniter\Model;

class InformasiModel extends Model
{
    protected $db;
    protected $table = "informasi";
    protected $useTimestamps = true;
    protected $allowedFields = ['dari', 'pesan', 'subject', 'tanggal'];

    public function getAllInformasi()
    {
        return $this->select("id ,subject, dari, pesan, tanggal, datediff(tanggal, current_date()) as selisih")->findAll();
    }

    public function getInformasiById($id)
    {
        return $this->select("*")->where(["id=" => $id])->first();
    }
}
