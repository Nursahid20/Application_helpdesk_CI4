<?php

namespace App\Models;

use CodeIgniter\Model;

class KaryawanModel extends Model
{
    protected $db;
    protected $table = "karyawan";
    protected $useTimestamps = true;
    protected $allowedFields = ['email', 'id_jabatan', 'tanggal_lahir', 'tempat_lahir', 'id_departemen', 'nama', 'nik', 'alamat',  'perusahaan', 'jk', 'no_telepon', 'foto_profile', 'slug'];

    public function getAllKaryawan()
    {
        return $this->select("karyawan.*, jabatan.nama_jabatan, departemen.nama_departemen")
            ->join("jabatan", 'jabatan.id=karyawan.id_jabatan')
            ->join("departemen", 'departemen.id=karyawan.id_departemen')
            ->findAll();
    }

    public function getIdKaryawan($nik)
    {
        return $this->select("karyawan.*, jabatan.nama_jabatan, departemen.nama_departemen")
            ->join("jabatan", 'jabatan.id=karyawan.id_jabatan')
            ->join("departemen", 'departemen.id=karyawan.id_departemen')
            ->where(['karyawan.nik=' => $nik])
            ->findAll();
    }

    public function getKaryawan($perusahaan, $departemen)
    {
        return $this->select("karyawan.*, jabatan.nama_jabatan, departemen.nama_departemen")
            ->join("jabatan", 'jabatan.id=karyawan.id_jabatan')
            ->join("departemen", 'departemen.id=karyawan.id_departemen')
            ->where(['karyawan.perusahaan=' => $perusahaan])
            ->where(['karyawan.id_departemen=' => $departemen])
            ->findAll();
    }

    public function getId($id)
    {
        $builder = $this->db->table('karyawan');
        $builder->select('*');
        $builder->where('id', $id);
        $query = $builder->get()->getResult();
        return $query;
    }

    public function getKaryawanById($id = false)
    {
        return $this->select("karyawan.*, jabatan.nama_jabatan,  departemen.nama_departemen")->join("jabatan", 'jabatan.id=karyawan.id_jabatan')->join("departemen", 'departemen.id=karyawan.id_departemen')->where(['karyawan.id' => $id])->first();
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
        return $this->select("*")->where(['karyawan.nik' => $nik])->first();
    }
}
