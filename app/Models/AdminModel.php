<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $db;
    protected $table = "users";
    protected $useTimestamps = true;
    protected $allowedFields = ['nama', 'nik', 'level_user', 'password_hash'];

    public function getAllUser()
    {
        return $this->select("*")
            ->where(['users.nama!=' => '-'])
            ->findAll();
    }

    public function getAllUserByLevelUser()
    {
        return $this->select("users.*, karyawan.foto_profile, karyawan.email, karyawan.perusahaan, jabatan.nama_jabatan, departemen.nama_departemen, karyawan.no_telepon, karyawan.tanggal_lahir, karyawan.jk, karyawan.alamat, karyawan.foto_profile, karyawan.tempat_lahir")
            ->join("karyawan", 'karyawan.nik=users.nik')
            ->join("jabatan", 'jabatan.id=karyawan.id_jabatan')
            ->join("departemen", 'departemen.id=karyawan.id_departemen')
            ->where(['users.nama!=' => '-'])
            ->where(['users.level_user=' => 'admin'])
            ->findAll();
    }

    public function getUserById($id)
    {
        return $this->select("*")
            ->where(['users.id=' => $id])
            ->findAll();
    }

    public function getJabatan()
    {
        $builder = $this->db->table('jabatan');
        $builder->select('*');
        $query = $builder->get()->getResult();
        return $query;
    }

    public function getDepartemen()
    {
        $builder = $this->db->table('departemen');
        $builder->select('*');
        $query = $builder->get()->getResult();
        return $query;
    }

    public function getNIK($nik)
    {
        return $this->select("*")->where(['users.nik' => $nik])->first();
    }

    public function getPassword($nik)
    {
        $builder = $this->db->table('users');
        $builder->select('password_hash');
        $builder->where('nik=', $nik);
        $query = $builder->get()->getResult();
        return $query;
    }
}
