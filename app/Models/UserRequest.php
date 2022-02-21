<?php

namespace App\Models;

use CodeIgniter\Model;

class UserRequest extends Model
{
    protected $db;
    protected $table = 'permintaan';
    protected $useTimestamps = true;
    protected $allowedFields = ['kode_permintaan', 'start_date', 'till_date', 'id_it_support', 'id_karyawan', 'id_analisis', 'id_prioritas', 'id_kategori', 'detail_masalah', 'benefit', 'img_lampiran', 'id_status', 'id_lampiran'];

    // public function getUser($id)
    // {
    //     $builder = $this->db->table('permintaan');
    //     $builder->select('*');
    //     $builder->where('id_user=', $id);
    //     $query = $builder->get()->getResult();
    //     return $query;
    // }


    public function getUserRequestForAdmin()
    {
        return $this->select("
        permintaan.*, karyawan.nama, C.status as status, D.status as analisis, kategori_permintaan.kategori, prioritas_permintaan.prioritas, penilaian_permintaan.penilaian, penilaian_permintaan.komentar, penilaian_permintaan.progress, lampiran_permintaan.lampiran, departemen.nama_departemen, it_support.nama as nama_it_support")
            ->join("karyawan", 'karyawan.id=permintaan.id_karyawan')
            ->join("it_support", 'it_support.id=permintaan.id_it_support')
            ->join("departemen", 'departemen.id=karyawan.id_departemen')
            ->join("status_permintaan C", 'C.id=permintaan.id_status')
            ->join("status_permintaan D", 'D.id=permintaan.id_analisis')
            ->join("kategori_permintaan", 'kategori_permintaan.id=permintaan.id_kategori')
            ->join("prioritas_permintaan", 'prioritas_permintaan.id=permintaan.id_prioritas')
            ->join("penilaian_permintaan", 'penilaian_permintaan.id_permintaan=permintaan.id')
            ->join("lampiran_permintaan", 'lampiran_permintaan.id=permintaan.id_lampiran')
            ->findAll();
    }

    public function getUserRequestForAdminAccept()
    {
        return $this->select("
        permintaan.*, karyawan.nama, it_support.nama as nama_it_support, C.status as status, D.status as analisis, kategori_permintaan.kategori, prioritas_permintaan.prioritas, penilaian_permintaan.penilaian, penilaian_permintaan.komentar, penilaian_permintaan.progress, lampiran_permintaan.lampiran, departemen.nama_departemen")
            ->join("karyawan", 'karyawan.id=permintaan.id_karyawan')
            ->join("it_support", 'it_support.id=permintaan.id_it_support')
            ->join("status_permintaan C", 'C.id=permintaan.id_status')
            ->join("status_permintaan D", 'D.id=permintaan.id_analisis')
            ->join("kategori_permintaan", 'kategori_permintaan.id=permintaan.id_kategori')
            ->join("prioritas_permintaan", 'prioritas_permintaan.id=permintaan.id_prioritas')
            ->join("penilaian_permintaan", 'penilaian_permintaan.id_permintaan=permintaan.id')
            ->join("lampiran_permintaan", 'lampiran_permintaan.id=permintaan.id_lampiran')
            ->join("departemen", 'departemen.id=karyawan.id_departemen')
            ->where(['permintaan.id_status=' => 1])
            ->findAll();
    }

    public function getUserRequestForAdminDenied()
    {
        return $this->select("
        permintaan.*, karyawan.nama, it_support.nama as nama_it_support, C.status as status, D.status as analisis, kategori_permintaan.kategori, prioritas_permintaan.prioritas, penilaian_permintaan.penilaian, penilaian_permintaan.komentar, penilaian_permintaan.progress, lampiran_permintaan.lampiran, departemen.nama_departemen")
            ->join("karyawan", 'karyawan.id=permintaan.id_karyawan')
            ->join("it_support", 'it_support.id=permintaan.id_it_support')
            ->join("status_permintaan C", 'C.id=permintaan.id_status')
            ->join("status_permintaan D", 'D.id=permintaan.id_analisis')
            ->join("kategori_permintaan", 'kategori_permintaan.id=permintaan.id_kategori')
            ->join("prioritas_permintaan", 'prioritas_permintaan.id=permintaan.id_prioritas')
            ->join("penilaian_permintaan", 'penilaian_permintaan.id_permintaan=permintaan.id')
            ->join("lampiran_permintaan", 'lampiran_permintaan.id=permintaan.id_lampiran')
            ->join("departemen", 'departemen.id=karyawan.id_departemen')
            ->where(['permintaan.id_status=' => 3])
            ->findAll();
    }

    public function getUserRequestForKaryawan($nik)
    {
        return $this->select("
        permintaan.*, karyawan.nama ,it_support.nama as nama_it_support, C.status as status, D.status as analisis, kategori_permintaan.kategori, prioritas_permintaan.prioritas, penilaian_permintaan.penilaian, penilaian_permintaan.komentar, penilaian_permintaan.progress, lampiran_permintaan.lampiran, jabatan.nama_jabatan, departemen.nama_departemen")
            ->join("karyawan", 'karyawan.id=permintaan.id_karyawan')
            ->join("it_support", 'it_support.id=permintaan.id_it_support')
            ->join("status_permintaan C", 'C.id=permintaan.id_status')
            ->join("status_permintaan D", 'D.id=permintaan.id_analisis')
            ->join("kategori_permintaan", 'kategori_permintaan.id=permintaan.id_kategori')
            ->join("prioritas_permintaan", 'prioritas_permintaan.id=permintaan.id_prioritas')
            ->join("penilaian_permintaan", 'penilaian_permintaan.id_permintaan=permintaan.id')
            ->join("lampiran_permintaan", 'lampiran_permintaan.id=permintaan.id_lampiran')
            ->join("jabatan", 'jabatan.id=karyawan.id_jabatan')
            ->join("departemen", 'departemen.id=karyawan.id_departemen')
            ->where(['karyawan.nik=' => $nik])
            ->findAll();
    }

    public function getUserRequestForKaryawanDone($nik)
    {
        return $this->select("
        permintaan.*, karyawan.nama ,it_support.nama as nama_it_support, C.status as status, D.status as analisis, kategori_permintaan.kategori, prioritas_permintaan.prioritas, penilaian_permintaan.penilaian, penilaian_permintaan.komentar, penilaian_permintaan.progress, lampiran_permintaan.lampiran, jabatan.nama_jabatan, departemen.nama_departemen")
            ->join("karyawan", 'karyawan.id=permintaan.id_karyawan')
            ->join("it_support", 'it_support.id=permintaan.id_it_support')
            ->join("status_permintaan C", 'C.id=permintaan.id_status')
            ->join("status_permintaan D", 'D.id=permintaan.id_analisis')
            ->join("kategori_permintaan", 'kategori_permintaan.id=permintaan.id_kategori')
            ->join("prioritas_permintaan", 'prioritas_permintaan.id=permintaan.id_prioritas')
            ->join("penilaian_permintaan", 'penilaian_permintaan.id_permintaan=permintaan.id')
            ->join("lampiran_permintaan", 'lampiran_permintaan.id=permintaan.id_lampiran')
            ->join("jabatan", 'jabatan.id=karyawan.id_jabatan')
            ->join("departemen", 'departemen.id=karyawan.id_departemen')
            ->where(['karyawan.nik=' => $nik])
            ->where(['permintaan.id_status=' => 2])
            ->findAll();
    }

    public function getUserRequestForKaryawanProses($nik)
    {
        return $this->select("
        permintaan.*, karyawan.nama ,it_support.nama as nama_it_support, C.status as status, D.status as analisis, kategori_permintaan.kategori, prioritas_permintaan.prioritas, penilaian_permintaan.penilaian, penilaian_permintaan.komentar, penilaian_permintaan.progress, lampiran_permintaan.lampiran, jabatan.nama_jabatan, departemen.nama_departemen")
            ->join("karyawan", 'karyawan.id=permintaan.id_karyawan')
            ->join("it_support", 'it_support.id=permintaan.id_it_support')
            ->join("status_permintaan C", 'C.id=permintaan.id_status')
            ->join("status_permintaan D", 'D.id=permintaan.id_analisis')
            ->join("kategori_permintaan", 'kategori_permintaan.id=permintaan.id_kategori')
            ->join("prioritas_permintaan", 'prioritas_permintaan.id=permintaan.id_prioritas')
            ->join("penilaian_permintaan", 'penilaian_permintaan.id_permintaan=permintaan.id')
            ->join("lampiran_permintaan", 'lampiran_permintaan.id=permintaan.id_lampiran')
            ->join("jabatan", 'jabatan.id=karyawan.id_jabatan')
            ->join("departemen", 'departemen.id=karyawan.id_departemen')
            ->where(['karyawan.nik=' => $nik])
            ->where(['permintaan.id_status=' => 1])
            ->findAll();
    }

    public function getUserRequestForKaryawanByAdmin($nik)
    {
        return $this->select("
        permintaan.*, karyawan.nama ,it_support.nama as nama_it_support, C.status as status, D.status as analisis, kategori_permintaan.kategori, prioritas_permintaan.prioritas, penilaian_permintaan.penilaian, penilaian_permintaan.komentar, penilaian_permintaan.progress, lampiran_permintaan.lampiran, jabatan.nama_jabatan, departemen.nama_departemen")
            ->join("karyawan", 'karyawan.id=permintaan.id_karyawan')
            ->join("it_support", 'it_support.id=permintaan.id_it_support')
            ->join("status_permintaan C", 'C.id=permintaan.id_status')
            ->join("status_permintaan D", 'D.id=permintaan.id_analisis')
            ->join("kategori_permintaan", 'kategori_permintaan.id=permintaan.id_kategori')
            ->join("prioritas_permintaan", 'prioritas_permintaan.id=permintaan.id_prioritas')
            ->join("penilaian_permintaan", 'penilaian_permintaan.id_permintaan=permintaan.id')
            ->join("lampiran_permintaan", 'lampiran_permintaan.id=permintaan.id_lampiran')
            ->join("jabatan", 'jabatan.id=karyawan.id_jabatan')
            ->join("departemen", 'departemen.id=karyawan.id_departemen')
            ->where(['karyawan.nik=' => $nik])
            ->where(['permintaan.id_analisis=' => 4])
            ->findAll();
    }

    public function getUserRequestForKaryawanByITSupport($nik)
    {
        return $this->select("
        permintaan.*, karyawan.nama ,it_support.nama as nama_it_support, C.status as status, D.status as analisis, kategori_permintaan.kategori, prioritas_permintaan.prioritas, penilaian_permintaan.penilaian, penilaian_permintaan.komentar, penilaian_permintaan.progress, lampiran_permintaan.lampiran, jabatan.nama_jabatan, departemen.nama_departemen")
            ->join("karyawan", 'karyawan.id=permintaan.id_karyawan')
            ->join("it_support", 'it_support.id=permintaan.id_it_support')
            ->join("status_permintaan C", 'C.id=permintaan.id_status')
            ->join("status_permintaan D", 'D.id=permintaan.id_analisis')
            ->join("kategori_permintaan", 'kategori_permintaan.id=permintaan.id_kategori')
            ->join("prioritas_permintaan", 'prioritas_permintaan.id=permintaan.id_prioritas')
            ->join("penilaian_permintaan", 'penilaian_permintaan.id_permintaan=permintaan.id')
            ->join("lampiran_permintaan", 'lampiran_permintaan.id=permintaan.id_lampiran')
            ->join("jabatan", 'jabatan.id=karyawan.id_jabatan')
            ->join("departemen", 'departemen.id=karyawan.id_departemen')
            ->where(['karyawan.nik=' => $nik])
            ->where(['permintaan.id_status=' => 4])
            ->findAll();
    }

    public function getUserRequestForITSupport($id)
    {
        return $this->select("
        permintaan.*, karyawan.nama ,it_support.nama as nama_it_support, C.status as status, D.status as analisis, kategori_permintaan.kategori, prioritas_permintaan.prioritas, penilaian_permintaan.id as id_penilaian, penilaian_permintaan.penilaian, penilaian_permintaan.komentar, penilaian_permintaan.progress, lampiran_permintaan.lampiran, jabatan.nama_jabatan, departemen.nama_departemen")
            ->join("karyawan", 'karyawan.id=permintaan.id_karyawan')
            ->join("it_support", 'it_support.id=permintaan.id_it_support')
            ->join("status_permintaan C", 'C.id=permintaan.id_status')
            ->join("status_permintaan D", 'D.id=permintaan.id_analisis')
            ->join("kategori_permintaan", 'kategori_permintaan.id=permintaan.id_kategori')
            ->join("prioritas_permintaan", 'prioritas_permintaan.id=permintaan.id_prioritas')
            ->join("penilaian_permintaan", 'penilaian_permintaan.id_permintaan=permintaan.id')
            ->join("lampiran_permintaan", 'lampiran_permintaan.id=permintaan.id_lampiran')
            ->join("jabatan", 'jabatan.id=karyawan.id_jabatan')
            ->join("departemen", 'departemen.id=karyawan.id_departemen')
            ->where(['permintaan.id_it_support=' => $id])
            ->findAll();
    }

    public function getUserRequestForITSupportAccept($id)
    {
        return $this->select("
        permintaan.*, karyawan.nama, it_support.nama as nama_it_support, C.status as status, D.status as analisis, kategori_permintaan.kategori, prioritas_permintaan.prioritas, penilaian_permintaan.penilaian, penilaian_permintaan.komentar, penilaian_permintaan.progress, lampiran_permintaan.lampiran, departemen.nama_departemen")
            ->join("karyawan", 'karyawan.id=permintaan.id_karyawan')
            ->join("it_support", 'it_support.id=permintaan.id_it_support')
            ->join("status_permintaan C", 'C.id=permintaan.id_status')
            ->join("status_permintaan D", 'D.id=permintaan.id_analisis')
            ->join("kategori_permintaan", 'kategori_permintaan.id=permintaan.id_kategori')
            ->join("prioritas_permintaan", 'prioritas_permintaan.id=permintaan.id_prioritas')
            ->join("penilaian_permintaan", 'penilaian_permintaan.id_permintaan=permintaan.id')
            ->join("lampiran_permintaan", 'lampiran_permintaan.id=permintaan.id_lampiran')
            ->join("departemen", 'departemen.id=karyawan.id_departemen')
            ->where(['permintaan.id_status=' => 1])
            ->where(['permintaan.id_it_support=' => $id])
            ->findAll();
    }

    public function getUserRequestForITSupportDenied($id)
    {
        return $this->select("
        permintaan.*, karyawan.nama, it_support.nama as nama_it_support, C.status as status, D.status as analisis, kategori_permintaan.kategori, prioritas_permintaan.prioritas, penilaian_permintaan.penilaian, penilaian_permintaan.komentar, penilaian_permintaan.progress, lampiran_permintaan.lampiran, departemen.nama_departemen")
            ->join("karyawan", 'karyawan.id=permintaan.id_karyawan')
            ->join("it_support", 'it_support.id=permintaan.id_it_support')
            ->join("status_permintaan C", 'C.id=permintaan.id_status')
            ->join("status_permintaan D", 'D.id=permintaan.id_analisis')
            ->join("kategori_permintaan", 'kategori_permintaan.id=permintaan.id_kategori')
            ->join("prioritas_permintaan", 'prioritas_permintaan.id=permintaan.id_prioritas')
            ->join("penilaian_permintaan", 'penilaian_permintaan.id_permintaan=permintaan.id')
            ->join("lampiran_permintaan", 'lampiran_permintaan.id=permintaan.id_lampiran')
            ->join("departemen", 'departemen.id=karyawan.id_departemen')
            ->where(['permintaan.id_status=' => 3])
            ->where(['permintaan.id_it_support=' => $id])
            ->findAll();
    }


    public function getUserRequestForITSupportDone($id)
    {
        return $this->select("
        permintaan.*, karyawan.nama ,it_support.nama as nama_it_support, C.status as status, D.status as analisis, kategori_permintaan.kategori, prioritas_permintaan.prioritas, penilaian_permintaan.penilaian, penilaian_permintaan.komentar, penilaian_permintaan.progress, lampiran_permintaan.lampiran, jabatan.nama_jabatan, departemen.nama_departemen")
            ->join("karyawan", 'karyawan.id=permintaan.id_karyawan')
            ->join("it_support", 'it_support.id=permintaan.id_it_support')
            ->join("status_permintaan C", 'C.id=permintaan.id_status')
            ->join("status_permintaan D", 'D.id=permintaan.id_analisis')
            ->join("kategori_permintaan", 'kategori_permintaan.id=permintaan.id_kategori')
            ->join("prioritas_permintaan", 'prioritas_permintaan.id=permintaan.id_prioritas')
            ->join("penilaian_permintaan", 'penilaian_permintaan.id_permintaan=permintaan.id')
            ->join("lampiran_permintaan", 'lampiran_permintaan.id=permintaan.id_lampiran')
            ->join("jabatan", 'jabatan.id=karyawan.id_jabatan')
            ->join("departemen", 'departemen.id=karyawan.id_departemen')
            ->where(['permintaan.id_IT_support=' => $id])
            ->where(['permintaan.id_status=' => 2])
            ->findAll();
    }

    public function getUserRequestForITSupportProses($id)
    {
        return $this->select("
        permintaan.*, karyawan.nama ,it_support.nama as nama_it_support, C.status as status, D.status as analisis, kategori_permintaan.kategori, prioritas_permintaan.prioritas, penilaian_permintaan.penilaian, penilaian_permintaan.komentar, penilaian_permintaan.progress, lampiran_permintaan.lampiran, jabatan.nama_jabatan, departemen.nama_departemen")
            ->join("karyawan", 'karyawan.id=permintaan.id_karyawan')
            ->join("it_support", 'it_support.id=permintaan.id_it_support')
            ->join("status_permintaan C", 'C.id=permintaan.id_status')
            ->join("status_permintaan D", 'D.id=permintaan.id_analisis')
            ->join("kategori_permintaan", 'kategori_permintaan.id=permintaan.id_kategori')
            ->join("prioritas_permintaan", 'prioritas_permintaan.id=permintaan.id_prioritas')
            ->join("penilaian_permintaan", 'penilaian_permintaan.id_permintaan=permintaan.id')
            ->join("lampiran_permintaan", 'lampiran_permintaan.id=permintaan.id_lampiran')
            ->join("jabatan", 'jabatan.id=karyawan.id_jabatan')
            ->join("departemen", 'departemen.id=karyawan.id_departemen')
            ->where(['permintaan.id_IT_support=' => $id])
            ->where(['permintaan.id_status=' => 1])
            ->findAll();
    }

    public function getUserRequestForITSupportByITSupport($id)
    {
        return $this->select("
        permintaan.*, karyawan.nama ,it_support.nama as nama_it_support, C.status as status, D.status as analisis, kategori_permintaan.kategori, prioritas_permintaan.prioritas, penilaian_permintaan.penilaian, penilaian_permintaan.komentar, penilaian_permintaan.progress, lampiran_permintaan.lampiran, jabatan.nama_jabatan, departemen.nama_departemen")
            ->join("karyawan", 'karyawan.id=permintaan.id_karyawan')
            ->join("it_support", 'it_support.id=permintaan.id_it_support')
            ->join("status_permintaan C", 'C.id=permintaan.id_status')
            ->join("status_permintaan D", 'D.id=permintaan.id_analisis')
            ->join("kategori_permintaan", 'kategori_permintaan.id=permintaan.id_kategori')
            ->join("prioritas_permintaan", 'prioritas_permintaan.id=permintaan.id_prioritas')
            ->join("penilaian_permintaan", 'penilaian_permintaan.id_permintaan=permintaan.id')
            ->join("lampiran_permintaan", 'lampiran_permintaan.id=permintaan.id_lampiran')
            ->join("jabatan", 'jabatan.id=karyawan.id_jabatan')
            ->join("departemen", 'departemen.id=karyawan.id_departemen')
            ->where(['permintaan.id_IT_support=' => $id])
            ->where(['permintaan.id_status=' => 4])
            ->findAll();
    }

    public function getUserRequet()
    {
        $builder = $this->db->table('permintaan');
        $builder->select('*');
        $query = $builder->get()->getResult();
        return $query;
    }

    public function getPrioritas()
    {
        $builder = $this->db->table('prioritas_permintaan');
        $builder->select('*');
        $query = $builder->get()->getResult();
        return $query;
    }

    public function getKategori()
    {
        $builder = $this->db->table('kategori_permintaan');
        $builder->select('*');
        $query = $builder->get()->getResult();
        return $query;
    }

    public function getLampiran()
    {
        $builder = $this->db->table('lampiran_permintaan');
        $builder->select('*');
        $query = $builder->get()->getResult();
        return $query;
    }

    public function getRequest($bulan, $tahun)
    {
        return $this->select("
        permintaan.*, karyawan.nama, C.status as status, D.status as analisis, kategori_permintaan.kategori, prioritas_permintaan.prioritas, penilaian_permintaan.penilaian, penilaian_permintaan.komentar, penilaian_permintaan.progress, lampiran_permintaan.lampiran, departemen.nama_departemen, it_support.nama as nama_it_support")
            ->join("karyawan", 'karyawan.id=permintaan.id_karyawan')
            ->join("it_support", 'it_support.id=permintaan.id_it_support')
            ->join("departemen", 'departemen.id=karyawan.id_departemen')
            ->join("status_permintaan C", 'C.id=permintaan.id_status')
            ->join("status_permintaan D", 'D.id=permintaan.id_analisis')
            ->join("kategori_permintaan", 'kategori_permintaan.id=permintaan.id_kategori')
            ->join("prioritas_permintaan", 'prioritas_permintaan.id=permintaan.id_prioritas')
            ->join("penilaian_permintaan", 'penilaian_permintaan.id_permintaan=permintaan.id')
            ->join("lampiran_permintaan", 'lampiran_permintaan.id=permintaan.id_lampiran')
            ->where(['YEAR(permintaan.created_at)=' => $tahun])
            ->where(['MONTH(permintaan.created_at)=' => $bulan])
            ->findAll();
    }

    public function getRequestForITSupport($bulan, $tahun, $id)
    {
        return $this->select("
        permintaan.*, karyawan.nama, C.status as status, D.status as analisis, kategori_permintaan.kategori, prioritas_permintaan.prioritas, penilaian_permintaan.penilaian, penilaian_permintaan.komentar, penilaian_permintaan.progress, lampiran_permintaan.lampiran, departemen.nama_departemen, it_support.nama as nama_it_support")
            ->join("karyawan", 'karyawan.id=permintaan.id_karyawan')
            ->join("it_support", 'it_support.id=permintaan.id_it_support')
            ->join("departemen", 'departemen.id=karyawan.id_departemen')
            ->join("status_permintaan C", 'C.id=permintaan.id_status')
            ->join("status_permintaan D", 'D.id=permintaan.id_analisis')
            ->join("kategori_permintaan", 'kategori_permintaan.id=permintaan.id_kategori')
            ->join("prioritas_permintaan", 'prioritas_permintaan.id=permintaan.id_prioritas')
            ->join("penilaian_permintaan", 'penilaian_permintaan.id_permintaan=permintaan.id')
            ->join("lampiran_permintaan", 'lampiran_permintaan.id=permintaan.id_lampiran')
            ->where(['permintaan.id_IT_support=' => $id])
            ->where(['YEAR(permintaan.created_at)=' => $tahun])
            ->where(['MONTH(permintaan.created_at)=' => $bulan])
            ->findAll();
    }

    public function getRequestLastId()
    {
        return $this->select("*")->getInsertID();
    }

    public function getUserRequestDone()
    {
        return $this->select("*")
            ->where(['id_status=' => 2])
            ->findAll();
    }

    public function getUserRequestProses()
    {
        return $this->select("*")
            ->where(['id_status=' => 1])
            ->findAll();
    }

    public function getUserRequestAdmin()
    {
        return $this->select("*")
            ->where(['id_analisis=' => 4])
            ->findAll();
    }

    public function getUserRequestITSupport()
    {
        return $this->select("*")
            ->where(['id_status=' => 4])
            ->findAll();
    }

    public function getUserRequestFromAdmin($levelUser)
    {
        $builder = $this->db->table('permintaan');
        $builder->select('*');
        $builder->where('analisis=', 'Sudah Ditanggapi');
        $builder->where('id_itsupport=', $levelUser);
        $query = $builder->get()->getResult();
        return $query;
    }

    public function getRequestById($id)
    {
        return $this->select("
        permintaan.*, karyawan.nama, it_support.nama as nama_it_support, C.status as status, D.status as analisis, kategori_permintaan.kategori, prioritas_permintaan.prioritas, penilaian_permintaan.progress, penilaian_permintaan.penilaian, penilaian_permintaan.komentar, lampiran_permintaan.lampiran, jabatan.nama_jabatan, departemen.nama_departemen")
            ->join("karyawan", 'karyawan.id=permintaan.id_karyawan')
            ->join("it_support", 'it_support.id=permintaan.id_it_support')
            ->join("status_permintaan C", 'C.id=permintaan.id_status')
            ->join("status_permintaan D", 'D.id=permintaan.id_analisis')
            ->join("kategori_permintaan", 'kategori_permintaan.id=permintaan.id_kategori')
            ->join("prioritas_permintaan", 'prioritas_permintaan.id=permintaan.id_prioritas')
            ->join("penilaian_permintaan", 'penilaian_permintaan.id_permintaan=permintaan.id')
            ->join("lampiran_permintaan", 'lampiran_permintaan.id=permintaan.id_lampiran')
            ->join("jabatan", 'jabatan.id=karyawan.id_jabatan')
            ->join("departemen", 'departemen.id=karyawan.id_departemen')
            ->where(['permintaan.id=' => $id])
            ->findAll();
    }

    public function getAllRequestById($id)
    {
        return $this->select("
        permintaan.*, karyawan.nama, it_support.nama as nama_it_support, C.status as status, D.status as analisis, kategori_permintaan.kategori, prioritas_permintaan.prioritas, penilaian_permintaan.progress, penilaian_permintaan.penilaian, penilaian_permintaan.komentar, lampiran_permintaan.lampiran, jabatan.nama_jabatan, departemen.nama_departemen")
            ->join("karyawan", 'karyawan.id=permintaan.id_karyawan')
            ->join("it_support", 'it_support.id=permintaan.id_it_support')
            ->join("status_permintaan C", 'C.id=permintaan.id_status')
            ->join("status_permintaan D", 'D.id=permintaan.id_analisis')
            ->join("kategori_permintaan", 'kategori_permintaan.id=permintaan.id_kategori')
            ->join("prioritas_permintaan", 'prioritas_permintaan.id=permintaan.id_prioritas')
            ->join("penilaian_permintaan", 'penilaian_permintaan.id_permintaan=permintaan.id')
            ->join("lampiran_permintaan", 'lampiran_permintaan.id=permintaan.id_lampiran')
            ->join("jabatan", 'jabatan.id=karyawan.id_jabatan')
            ->join("departemen", 'departemen.id=karyawan.id_departemen')
            ->where(['permintaan.id_karyawan=' => $id])
            ->findAll();
    }
}
