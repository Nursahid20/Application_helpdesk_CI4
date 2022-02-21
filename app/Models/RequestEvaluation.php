<?php

namespace App\Models;

use CodeIgniter\Model;

class RequestEvaluation extends Model
{
    protected $db;
    protected $table = 'penilaian_permintaan';
    protected $allowedFields = ['id_karyawan', 'id_permintaan', 'penilaian', 'progress', 'komentar'];

    public function getEvaluation()
    {
        return $this->select("*")->findAll();
    }

    public function getIdEvaluation($id)
    {
        return $this->select("*")->where(["id_permintaan=" => $id])->findAll();
    }
}
