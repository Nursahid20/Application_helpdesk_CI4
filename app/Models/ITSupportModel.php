<?php

namespace App\Models;

use CodeIgniter\Model;

class ITSupportModel extends Model
{
    protected $db;
    protected $table = "it_support";
    protected $useTimestamps = true;
    protected $allowedFields = ['email', 'jabatan', 'tanggal_lahir', 'tempat_lahir', 'departemen', 'nama', 'nik', 'alamat',  'perusahaan', 'jk', 'no_telepon', 'foto_profile', 'slug'];

    public function getAllITSupport()
    {
        return $this->select("*")
            ->where(['it_support.nama!=' => '-'])
            ->findAll();
    }

    public function getIdITSupport($nik)
    {
        return $this->select("*")
            ->where(['it_support.nik=' => $nik])
            ->findAll();
    }

    public function getStaffIT()
    {
        return $this->select("it_support.*, jabatan.nama_jabatan, departemen.nama_departemen")
            ->join("jabatan", 'jabatan.id=it_support.id_jabatan')
            ->join("departemen", 'departemen.id=it_support.id_departemen')
            ->where(['it_support.level_user!=' => 'admin'])
            ->where(['it_support.level_user!=' => 'user(Employe)'])
            ->findAll();
    }

    public function getAdmin()
    {
        return $this->select("it_support.*, jabatan.nama_jabatan, departemen.nama_departemen")
            ->join("jabatan", 'jabatan.id=it_support.id_jabatan')
            ->join("departemen", 'departemen.id=it_support.id_departemen')
            ->where(['it_support.level_user!=' => 'user(Employe)'])
            ->where(['it_support.level_user!=' => 'user(IT)'])
            ->where(['it_support.nama!=' => '-'])
            ->findAll();
    }

    public function getId($id)
    {
        $builder = $this->db->table('it_support');
        $builder->select('*');
        $builder->where('id', $id);
        $query = $builder->get()->getResult();
        return $query;
    }

    public function getITSupportById($id = false)
    {
        return $this->select("*")->where(['it_support.id' => $id])->first();
    }

    public function getJabatan()
    {
        $builder = $this->db->table('jabatan');
        $builder->select('*');
        $query = $builder->get()->getResult();
        return $query;
    }

    // public function getpositio($id = false)
    // {
    //     if ($id == false) {
    //         return $this->findAll();
    //     }

    //     return $this->where(['id' => $id])->first();
    // }

    public function getDepartemen()
    {
        $builder = $this->db->table('departemen');
        $builder->select('*');
        $query = $builder->get()->getResult();
        return $query;
    }

    public function getNIK($nik)
    {
        return $this->select("*")->where(['it_support.nik' => $nik])->first();
    }

    public function getPassword($nik)
    {
        $builder = $this->db->table('it_support');
        $builder->select('password_hash');
        $builder->where('nik=', $nik);
        $query = $builder->get()->getResult();
        return $query;
    }

    public function get_data($nik)
    {
        return $this->db->table('it_support')
            ->where(array('nik' => $nik))
            ->get()->getRowArray();
    }
}
