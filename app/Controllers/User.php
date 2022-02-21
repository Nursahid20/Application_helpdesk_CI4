<?php

namespace App\Controllers;

use App\Models\adminModel;
use App\Models\karyawanModel;
use App\Models\UserRequest;
use App\Models\RequestEvaluation;
use App\Models\PrioritasModel;
use App\Models\KategoriModel;
use App\Models\InformasiModel;
use App\Models\lampiranModel;


class User extends BaseController
{
    protected $adminModel;
    protected $userRequest;

    public function __construct()
    {
        $this->adminModel = new adminModel();
        $this->karyawanModel = new karyawanModel();
        $this->userRequest = new UserRequest();
        $this->lampiranModel = new lampiranModel();
        $this->informasiModel = new informasiModel();
        $this->kategoriModel = new kategoriModel();
        $this->prioritasModel = new prioritasModel();
        $this->requestEvaluation = new requestEvaluation();
    }

    public function informasi()
    {
        $session = session();
        $nik = $session->get('nik');
        $levelUser = $this->adminModel->getNIK($nik);

        $dataInformasi = $this->informasiModel->getAllInformasi();
        $data = [
            "data" => $dataInformasi,
            'name' => $levelUser['nama'],
            "levelUser" => $levelUser['level_user']
        ];
        return view('user/informasi', $data);
    }

    public function account()
    {
        $session = session();
        $nik = $session->get('nik');
        $levelUser = $this->adminModel->getNIK($nik);

        $dataKaryawan = $this->karyawanModel->getIdKaryawan($nik);

        $data = [
            'validation' => \Config\Services::validation(),
            "dataKaryawan" => $dataKaryawan[0],
            'name' => $levelUser['nama'],
            "levelUser" => $levelUser['level_user'],
        ];
        return view('user/account', $data);
    }

    public function updateAccount($id)
    {
        //validasi
        if (!$this->validate([
            'foto_profile' => [
                'rules' => 'max_size[foto_profile,20000]|is_image[foto_profile]|mime_in[foto_profile,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Gambar Terlalu besar',
                    'is_image' => 'file bukan gambar',
                    'mime_in' => 'file bukan gambar'
                ]
            ],
            'nik' => [
                'rules' => 'required[karyawan.nik]',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'email' => [
                'rules' => 'required[karyawan.email]',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'nama' => [
                'rules' => 'required[karyawan.nama]',
                'errors' => [
                    'required' => 'Nama Lengkap harus diisi.'
                ]
            ],
            'alamat' => [
                'rules' => 'required[karyawan.alamat]',
                'errors' => [
                    'required' => 'Alamat harus diisi.'
                ]
            ],
            'no_telepon' => [
                'rules' => 'required[karyawan.no_telepon]',
                'errors' => [
                    'required' => 'Nomor Telepon harus diisi.'
                ]
            ],
            'jk' => [
                'rules' => 'required[karyawan.jk]',
                'errors' => [
                    'required' => 'Jenis Kelamin harus diisi.'
                ]
            ],
            'tanggal_lahir' => [
                'rules' => 'required[karyawan.tanggal_lahir]',
                'errors' => [
                    'required' => 'Tanggal Lahir harus diisi.'
                ]
            ],
            'tempat_lahir' => [
                'rules' => 'required[karyawan.tempat_lahir]',
                'errors' => [
                    'required' => 'Tempat Lahir harus diisi.'
                ]
            ]

        ])) {
            // validasi
            // mengirimkan data dengan chain input dan validasi
            return redirect()->to('user/account/')->withInput();
        }

        // ambil gambar
        $fileFoto = $this->request->getFile('foto_profile');

        if ($fileFoto->getError() == 4) {
            $namaFoto = $this->request->getVar('foto_profile_yang_dulu');
        } else {
            $namaFoto = $fileFoto->getRandomName();
            // pindahkan gambar
            $fileFoto->move('images', $namaFoto);
        }

        $this->karyawanModel->save(
            [
                'id' => $id,
                'foto_profile' => $namaFoto,
                'nama' => $this->request->getVar('nama'),
                'slug' => url_title($this->request->getVar('nama'), '-', true),
                'jk' => $this->request->getVar('jk'),
                'tempat_lahir' => $this->request->getVar('tempat_lahir'),
                'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
                'alamat' => $this->request->getVar('alamat'),
                'nik' => $this->request->getVar('nik'),
                'email' => $this->request->getVar('email'),
                'no_telepon' => $this->request->getVar('no_telepon')
            ]
        );

        session()->setFlashdata('pesan', 'Data berhasil diubah.');
        return redirect()->to('user/account/');
    }

    public function changePassword()
    {
        $session = session();
        $nik = $session->get('nik');
        $levelUser = $this->adminModel->getNIK($nik);

        $dataUser = $this->adminModel->getNik($nik);

        $data = [
            'validation' => \Config\Services::validation(),
            "levelUser" => $levelUser['level_user'],
            'name' => $levelUser['nama'],
            'dataUser' => $dataUser
        ];
        return view('user/changePassword', $data);
    }

    public function savePassword($id)
    {
        //validasi
        if (!$this->validate([
            'password' => [
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => 'Password harus diisi.',
                    'min_length' => 'Password terlalu singkat, minimal 8 digit'
                ]
            ],
            'konfirmasi_password' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Konfirmasi Password harus diisi.',
                    'matches' => 'Konfirmasi Password dan Password input tidak sama'
                ]
            ]
        ])) {
            // validasi
            // mengirimkan data dengan chain input dan validasi
            return redirect()->to('user/changePassword/')->withInput();
        }


        $this->adminModel->save(
            [
                'id' => $id,
                'password_hash' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
            ]
        );

        session()->setFlashdata('pesan', 'Password berhasil diubah.');
        return redirect()->to('user/changePassword/');
    }

    public function request()
    {
        $session = session();
        $nik = $session->get('nik');
        $levelUser = $this->adminModel->getNIK($nik);

        $dataUser = $this->userRequest->getUserRequestForKaryawan($nik);
        $number = count($dataUser);
        $data = [
            'levelUser' => $levelUser['level_user'],
            'name' => $levelUser['nama'],
            'dataUser' => $dataUser,
            'number' => $number
        ];
        return view('user/request', $data);
    }

    public function addRequest()
    {
        $session = session();
        $nik = $session->get('nik');
        $levelUser = $this->adminModel->getNIK($nik);
        $dataUser1 = $this->karyawanModel->getIdKaryawan($nik);
        $dataUser2 = $this->userRequest->getAllRequestById($dataUser1[0]['id']);
        $count = count($dataUser2) + 1;
        $dataPrioritas = $this->prioritasModel->getAllPrioritas();
        $dataLampiran = $this->lampiranModel->getAllLampiran();
        $dataKategori = $this->kategoriModel->getAllKategori();
        $number1 = count($dataKategori);
        $number2 = count($dataLampiran);
        $number3 = count($dataPrioritas);

        $kode_permintaan = "REQ-" . $nik . "-" . $count;
        $data = [
            'validation' => \Config\Services::validation(),
            "levelUser" => $levelUser['level_user'],
            'name' => $levelUser['nama'],
            'dataUser' => $dataUser1[0],
            "kode_permintaan" => $kode_permintaan,
            "dataPrioritas" => $dataPrioritas,
            "dataLampiran" => $dataLampiran,
            "dataKategori" => $dataKategori,
            "number1" => $number1,
            "number2" => $number2,
            "number3" => $number3,
        ];
        return view('user/addRequest', $data);
    }

    public function saveRequest()
    {
        //validasi
        if (!$this->validate([
            'img_lampiran' => [
                'rules' => 'max_size[img_lampiran,32000]|is_image[img_lampiran]|mime_in[img_lampiran,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Gambar Terlalu besar',
                    'is_image' => 'file bukan gambar',
                    'mime_in' => 'file bukan gambar'
                ]
            ],
            'id_prioritas' => [
                'rules' => 'required[permintaan.id_prioritas]',
                'errors' => [
                    'required' => 'level urgensi harus diisi.'
                ]
            ],
            'id_kategori' => [
                'rules' => 'required[permintaan.id_kategori]',
                'errors' => [
                    'required' => 'Jenis permintaan harus diisi.'
                ]
            ],
            'id_lampiran' => [
                'rules' => 'required[permintaan.id_lampiran]',
                'errors' => [
                    'required' => 'lampiran harus diisi.'
                ]
            ],
            'detail_masalah' => [
                'rules' => 'required[permintaan.detail_masalah]',
                'errors' => [
                    'required' => 'Uraian Kebutuhan harus diisi.'
                ]
            ],
            'benefit' => [
                'rules' => 'required[permintaan.benefit]',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]
        ])) {
            // validasi
            // mengirimkan data dengan chain input dan validasi
            return redirect()->to('user/addRequest')->withInput();
        }

        // ambil gambar
        $fileFoto = $this->request->getFile('img_lampiran');

        if ($fileFoto->getError() == 4) {
            $namaFoto = 'default.png';
        } else {
            $namaFoto = $fileFoto->getRandomName();
            // pindahkan gambar
            $fileFoto->move('images/problem', $namaFoto);
        }

        $this->userRequest->save(
            [
                'kode_permintaan' => $this->request->getVar('kode_permintaan'),
                'benefit' => $this->request->getVar('benefit'),
                'detail_masalah' => $this->request->getVar('detail_masalah'),
                'img_lampiran' => $namaFoto,
                'id_karyawan' => $this->request->getVar('id_karyawan'),
                'id_kategori' => $this->request->getVar('id_kategori'),
                'id_departemen' => $this->request->getVar('id_departemen'),
                'id_prioritas' => $this->request->getVar('id_prioritas'),
                'id_lampiran' => $this->request->getVar('id_lampiran'),
                'id_it_support' => 1,
                'id_analisis' => 4,
                'id_status' => 4
            ]
        );

        $last_id = $this->userRequest->getRequestLastId();


        $this->requestEvaluation->save(
            [
                'id_permintaan' => $last_id,
                'id_karyawan' => $this->request->getVar('id_karyawan')
            ]
        );

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('user/request');
    }

    public function editRequest($id)
    {
        $session = session();
        $nik = $session->get('nik');
        $levelUser = $this->adminModel->getNIK($nik);
        $request = $this->userRequest->getRequestById($id);

        $dataPrioritas = $this->userRequest->getPrioritas();
        $dataKategori = $this->userRequest->getKategori();
        $dataLampiran = $this->userRequest->getLampiran();

        $data = [
            'validation' => \Config\Services::validation(),
            "levelUser" => $levelUser['level_user'],
            'name' => $levelUser['nama'],
            'request' => $request[0],
            'dataPrioritas' => $dataPrioritas,
            'dataKategori' => $dataKategori,
            'dataLampiran' => $dataLampiran
        ];

        return view('user/editRequest', $data);
    }

    public function updateRequest($id)
    {
        //validasi
        if (!$this->validate([
            'img_lampiran' => [
                'rules' => 'max_size[img_lampiran,32000]|is_image[img_lampiran]|mime_in[img_lampiran,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Gambar Terlalu besar',
                    'is_image' => 'file bukan gambar',
                    'mime_in' => 'file bukan gambar'
                ]
            ],
            'id_prioritas' => [
                'rules' => 'required[permintaan.id_prioritas]',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'id_kategori' => [
                'rules' => 'required[permintaan.id_kategori]',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'detail_masalah' => [
                'rules' => 'required[permintaan.detail_masalah]',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'benefit' => [
                'rules' => 'required[permintaan.benefit]',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]
        ])) {
            // validasi
            // mengirimkan data dengan chain input dan validasi
            return redirect()->to('user/editRequest/' . $id)->withInput();
        }

        // ambil gambar
        $fileFoto = $this->request->getFile('img_lampiran');

        if ($fileFoto->getError() == 4) {
            $namaFoto = $this->request->getVar('old_image');
        } else {
            $namaFoto = $fileFoto->getRandomName();
            // pindahkan gambar
            $fileFoto->move('images/problem', $namaFoto);
        }

        $this->userRequest->save(
            [
                'id' => $id,
                'img_lampiran' => $namaFoto,
                'benefit' => $this->request->getVar('benefit'),
                'id_kategori' => $this->request->getVar('id_kategori'),
                'id_prioritas' => $this->request->getVar('id_prioritas'),
                'detail_masalah' => $this->request->getVar('detail_masalah'),
                'id_lampiran' => $this->request->getVar('id_lampiran')
            ]
        );

        session()->setFlashdata('pesan', 'Data berhasil diubah.');
        return redirect()->to('user/request');
    }

    public function userFeedback($id)
    {

        $data = $this->requestEvaluation->getIdEvaluation($id);
        $idP = $data[0]['id'];

        $this->requestEvaluation->save(
            [
                'id' => $idP,
                'penilaian' => $this->request->getVar('penilaian'),
                'komentar' => $this->request->getVar('komentar')
            ]
        );

        session()->setFlashdata('pesan', 'Feedback berhasil tersimpan.');
        return redirect()->to('user/request');
    }

    public function request_delete($id)
    {
        $data = $this->userRequest->getRequestById($id);

        $this->userRequest->delete($id);

        session()->setFlashdata('pesan', 'Data berhasil di hapus');

        return redirect()->to('user/request');
    }
}
