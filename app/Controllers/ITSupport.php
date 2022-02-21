<?php

namespace App\Controllers;

use App\Models\adminModel;
use App\Models\informasiModel;
use App\Models\itSupportModel;
use App\Models\UserRequest;
use App\Models\requestEvaluation;


class ITSupport extends BaseController
{
    protected $adminModel;
    public function __construct()
    {
        $this->adminModel = new adminModel();
        $this->itSupportModel = new itSupportModel();
        $this->informasiModel = new informasiModel();
        $this->requestEvaluation = new requestEvaluation();
        $this->userRequest = new UserRequest();
    }

    public function account()
    {
        $session = session();
        $nik = $session->get('nik');
        $levelUser = $this->adminModel->getNIK($nik);

        $dataITSupport = $this->itSupportModel->getNik($nik);

        $data = [
            'validation' => \Config\Services::validation(),
            "dataITSupport" => $dataITSupport,
            'name' => $levelUser['nama'],
            "levelUser" => $levelUser['level_user'],
        ];
        return view('ITSupport/account', $data);
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
            return redirect()->to('ITSupport/account/')->withInput();
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

        $this->itSupportModel->save(
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
        return redirect()->to('ITSupport/account/');
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
        return view('ITSupport/changePassword', $data);
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
            return redirect()->to('ITSupport/changePassword/')->withInput();
        }


        $this->adminModel->save(
            [
                'id' => $id,
                'password_hash' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
            ]
        );

        session()->setFlashdata('pesan', 'Password berhasil diubah.');
        return redirect()->to('ITSupport/changePassword/');
    }

    public function userRequest()
    {
        $session = session();
        $nik = $session->get('nik');
        $levelUser = $this->adminModel->getNIK($nik);
        $dataUser1 = $this->itSupportModel->getIdITSupport($nik);
        $dataUser2 = $this->userRequest->getUserRequestForITSupport($dataUser1[0]['id']);
        $number = count($dataUser2);
        $data = [
            'levelUser' => $levelUser['level_user'],
            'name' => $levelUser['nama'],
            'dataUser' => $dataUser2,
            'number' => $number
        ];
        return view('ITSupport/userRequest', $data);
    }

    public function saveProgress($id)
    {
        if ($this->request->getVar('progress') == '100') {
            $this->requestEvaluation->save(
                [
                    'id' => $id,
                    'progress' => $this->request->getVar('progress')
                ]
            );
            $this->userRequest->save(
                [
                    'id' => $this->request->getVar('id_permintaan'),
                    'id_status' => 2
                ]
            );
        } else {
            $this->requestEvaluation->save(
                [
                    'id' => $id,
                    'progress' => $this->request->getVar('progress')
                ]
            );
        }

        session()->setFlashdata('pesan', 'Progress berhasil di isi');
        return redirect()->to('ITSupport/userRequest');
    }

    public function accept($id)
    {
        $this->userRequest->save(
            [
                'id' => $id,
                'id_status' => 1
            ]
        );

        session()->setFlashdata('pesan', 'Permintaan Diterima');
        return redirect()->to('ITSupport/userRequest');
    }

    public function reject($id)
    {
        $this->userRequest->save(
            [
                'id' => $id,
                'id_status' => 3
            ]
        );

        session()->setFlashdata('pesan', 'Permintaan Ditolak');
        return redirect()->to('ITSupport/userRequest');
    }

    public function printRequest()
    {
        $session = session();
        $nik = $session->get('nik');
        $levelUser = $this->adminModel->getNIK($nik);
        $data = [
            'validation' => \Config\Services::validation(),
            'levelUser' => $levelUser['level_user'],
            'name' => $levelUser['nama']
        ];
        return view('ITSupport/filterRequest', $data);
    }

    public function printRequestFeedback()
    {
        $session = session();
        $nik = $session->get('nik');
        $levelUser = $this->adminModel->getNIK($nik);

        $data = [
            'validation' => \Config\Services::validation(),
            "levelUser" => $levelUser['level_user'],
            'name' => $levelUser['nama']
        ];
        return view('ITSupport/filterFeedback', $data);
    }

    public function requestFeedbackPDF()
    {
        $session = session();
        $nik = $session->get('nik');
        $levelUser = $this->adminModel->getNIK($nik);
        $dataRequest1 = $this->itSupportModel->getIdITSupport($nik);
        $dataRequest2 = $this->userRequest->getUserRequestForITSupport($dataRequest1[0]['id']);
        $data = [
            'levelUser' => $levelUser['level_user'],
            'name' => $levelUser['nama'],
            'dataRequest' => $dataRequest2
        ];
        return view('ITSupport/printFeedback', $data);
    }

    public function printRequestFeedbackPDF()
    {
        $session = session();
        $nik = $session->get('nik');
        $levelUser = $this->adminModel->getNIK($nik);
        $dataRequest1 = $this->itSupportModel->getIdITSupport($nik);
        $tahun = $_POST['tahun'];
        $bulan = $_POST['bulan'];
        $dataRequest = $this->userRequest->getRequestForITSupport($bulan, $tahun, $dataRequest1[0]['id']);

        $data = [
            'dataRequest' => $dataRequest,
        ];

        return view('ITSupport/printRequestFeedbackFilter', $data);
    }

    public function printRequestPDF()
    {
        $tahun = $_POST['tahun'];
        $bulan = $_POST['bulan'];
        $dataRequest = $this->userRequest->getRequest($bulan, $tahun);

        $data = [
            'dataRequest' => $dataRequest,
        ];

        return view('ITSupport/printRequestFilter', $data);
    }

    public function requestPDF()
    {
        $session = session();
        $nik = $session->get('nik');
        $levelUser = $this->adminModel->getNIK($nik);
        $dataRequest1 = $this->itSupportModel->getIdITSupport($nik);
        $dataRequest2 = $this->userRequest->getUserRequestForITSupport($dataRequest1[0]['id']);
        $data = [
            'levelUser' => $levelUser['level_user'],
            'name' => $levelUser['nama'],
            'dataRequest' => $dataRequest2
        ];
        return view('ITSupport/printRequest', $data);
    }

    public function requestAcceptPDF()
    {
        $session = session();
        $nik = $session->get('nik');
        $dataRequest1 = $this->itSupportModel->getIdITSupport($nik);
        $dataRequest2 = $this->userRequest->getUserRequestForITSupportAccept($dataRequest1[0]['id']);
        $data = [
            'dataRequest' => $dataRequest2
        ];

        return view('ITSupport/printRequestAccept', $data);
    }

    public function requestDeniedPDF()
    {
        $session = session();
        $nik = $session->get('nik');
        $dataRequest1 = $this->itSupportModel->getIdITSupport($nik);
        $dataRequest2 = $this->userRequest->getUserRequestForITSupportDenied($dataRequest1[0]['id']);
        $data = [
            'dataRequest' => $dataRequest2
        ];

        return view('ITSupport/printRequestDenied', $data);
    }
}
