<?php

namespace App\Controllers;

use App\Models\adminModel;
use App\Models\karyawanModel;
use App\Models\jabatanModel;
use App\Models\itSupportModel;
use App\Models\departemenModel;
use App\Models\subRequestModel;
use App\Models\informasiModel;
use App\Models\UserRequest;

class Admin extends BaseController
{
    protected $adminModel;

    public function __construct()
    {
        $this->adminModel = new adminModel();
        $this->karyawanModel = new karyawanModel();
        $this->itSupportModel = new itSupportModel();
        $this->subRequestModel = new subRequestModel();
        $this->informasiModel = new informasiModel();
        $this->departemenModel = new departemenModel();
        $this->jabatanModel = new jabatanModel();
        $this->userRequest = new UserRequest();
    }

    public function index()
    {
        $session = session();
        $nik = $session->get('nik');
        $levelUser = $this->adminModel->getNIK($nik);

        $datas = $this->adminModel->getAllUserByLevelUser();
        $number = count($datas);
        $data = [
            "data" => $datas,
            "number" => $number,
            "levelUser" => $levelUser['level_user'],
            'name' => $levelUser['nama']
        ];
        return view('admin/index', $data);
    }

    public function informasi()
    {
        $session = session();
        $nik = $session->get('nik');
        $levelUser = $this->adminModel->getNIK($nik);

        $datas = $this->informasiModel->getAllInformasi();
        $number = count($datas);
        $data = [
            "data" => $datas,
            "number" => $number,
            "levelUser" => $levelUser['level_user'],
            'name' => $levelUser['nama']
        ];
        return view('informasi/index', $data);
    }

    public function addInformasi()
    {
        $session = session();
        $nik = $session->get('nik');
        $levelUser = $this->adminModel->getNIK($nik);

        $data = [
            'validation' => \Config\Services::validation(),
            "levelUser" => $levelUser['level_user'],
            'name' => $levelUser['nama'],
        ];
        return view('informasi/add', $data);
    }

    public function saveInformasi()
    {
        //validasi
        if (!$this->validate([
            'subject' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'subject harus diisi.'
                ]
            ],
            'pesan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'pesan harus diisi.'
                ]
            ],
        ])) {
            // validasi
            // mengirimkan data dengan chain input dan validasi
            return redirect()->to('admin/addInformasi/')->withInput();
        }


        $this->informasiModel->save(
            [
                'tanggal' => date('Y-m-d'),
                'subject' => $this->request->getVar('subject'),
                'pesan' => $this->request->getVar('pesan'),
                'dari' => $this->request->getVar('dari'),
            ]
        );

        session()->setFlashdata('pesan', 'informasi berhasil ditambahkan.');
        return redirect()->to('admin/informasi/');
    }

    public function editInformasi($id)
    {
        $session = session();
        $nik = $session->get('nik');
        $levelUser = $this->adminModel->getNIK($nik);
        $datas = $this->informasiModel->getInformasiById($id);
        $data = [
            'validation' => \Config\Services::validation(),
            "levelUser" => $levelUser['level_user'],
            'name' => $levelUser['nama'],
            'data' => $datas
        ];
        return view('informasi/edit', $data);
    }

    public function updateInformasi($id)
    {
        //validasi
        if (!$this->validate([
            'subject' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'subject harus diisi.'
                ]
            ],
            'pesan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'pesan harus diisi.'
                ]
            ],
        ])) {
            // validasi
            // mengirimkan data dengan chain input dan validasi
            return redirect()->to('admin/editInformasi/' . $id)->withInput();
        }


        $this->informasiModel->save(
            [
                'id' => $id,
                'subject' => $this->request->getVar('subject'),
                'pesan' => $this->request->getVar('pesan'),
            ]
        );

        session()->setFlashdata('pesan', 'informasi berhasil ditambahkan.');
        return redirect()->to('admin/informasi/');
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
        return view('admin/account', $data);
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
            return redirect()->to('admin/account/')->withInput();
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
        return redirect()->to('admin/account/');
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
        return view('admin/changePassword', $data);
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
            return redirect()->to('admin/changePassword/')->withInput();
        }


        $this->adminModel->save(
            [
                'id' => $id,
                'password_hash' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
            ]
        );

        session()->setFlashdata('pesan', 'Password berhasil diubah.');
        return redirect()->to('admin/changePassword/');
    }

    public function User()
    {
        $session = session();
        $nik = $session->get('nik');
        $levelUser = $this->adminModel->getNIK($nik);

        $datas = $this->adminModel->getAllUser();
        $number = count($datas);
        $data = [
            "data" => $datas,
            "number" => $number,
            "levelUser" => $levelUser['level_user'],
            'name' => $levelUser['nama']
        ];
        return view('admin/user', $data);
    }

    public function addUser()
    {
        $session = session();
        $nik = $session->get('nik');
        $levelUser = $this->adminModel->getNIK($nik);

        $dataKaryawan = $this->karyawanModel->getAllKaryawan();
        $dataITSupport = $this->itSupportModel->getAllITSupport();

        $number1 = count($dataKaryawan);
        $number2 = count($dataITSupport);

        $data = [
            'validation' => \Config\Services::validation(),
            "levelUser" => $levelUser['level_user'],
            'name' => $levelUser['nama'],
            'dataKaryawan' => $dataKaryawan,
            'dataITSupport' => $dataITSupport,
            'number1' => $number1,
            'number2' => $number2
        ];
        return view('admin/addUser', $data);
    }

    public function saveUser()
    {
        //validasi
        if (!$this->validate([
            'nik_dan_nama' => [
                'rules' => 'required[users.nik_dan_nama]',
                'errors' => [
                    'required' => 'NIK dan Nama harus diisi.',
                ]
            ],
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
            ],
            'level_user' => [
                'rules' => 'required[users.level_user]',
                'errors' => [
                    'required' => 'Level User harus diisi.'
                ]
            ],


        ])) {
            // validasi
            // mengirimkan data dengan chain input dan validasi
            return redirect()->to('admin/addUser')->withInput();
        }

        $explode = explode(' - ', $this->request->getVar('nik_dan_nama'));
        $nik = $explode[0];
        $nama = $explode[1];
        var_dump($nik);
        var_dump($nama);
        $this->adminModel->save(
            [
                'nama' => $nama,
                'nik' => $nik,
                'level_user' => $this->request->getVar('level_user'),
                'password_hash' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            ]
        );

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        return redirect()->to('admin/user');
    }

    public function changePasswordUser($id)
    {
        $session = session();
        $nik = $session->get('nik');
        $levelUser = $this->adminModel->getNIK($nik);

        $dataUser = $this->adminModel->getUserById($id);

        $data = [
            'validation' => \Config\Services::validation(),
            "levelUser" => $levelUser['level_user'],
            'name' => $levelUser['nama'],
            'dataUser' => $dataUser[0]
        ];
        return view('admin/changePasswordUser', $data);
    }

    public function editUser($id)
    {
        $this->adminModel->save(
            [
                'id' => $id,
                'level_user' => $this->request->getVar('level_user')
            ]
        );

        session()->setFlashdata('pesan', 'Password berhasil diubah.');
        return redirect()->to('admin/user');
    }

    public function savePasswordUser($id)
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
            return redirect()->to('admin/changePasswordUser/' .  $id)->withInput();
        }


        $this->adminModel->save(
            [
                'id' => $id,
                'password_hash' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
            ]
        );

        session()->setFlashdata('pesan', 'Password berhasil diubah.');
        return redirect()->to('admin/user');
    }

    public function Karyawan()
    {
        $session = session();
        $nik = $session->get('nik');
        $levelUser = $this->adminModel->getNIK($nik);

        $datas = $this->karyawanModel->getAllKaryawan();
        $number = count($datas);
        $data = [
            "data" => $datas,
            "number" => $number,
            "levelUser" => $levelUser['level_user'],
            'name' => $levelUser['nama']
        ];
        return view('karyawan/index', $data);
    }

    public function addKaryawan()
    {
        $session = session();
        $nik = $session->get('nik');
        $levelUser = $this->adminModel->getNIK($nik);

        $datas = $this->karyawanModel->getJabatan();
        $datas1 = $this->karyawanModel->getDepartemen();
        $number = count($datas);
        $number1 = count($datas1);
        $data = [
            'validation' => \Config\Services::validation(),
            "data" => $datas,
            "data1" => $datas1,
            "number" => $number,
            "number1" => $number1,
            "levelUser" => $levelUser['level_user'],
            'name' => $levelUser['nama']
        ];
        return view('karyawan/add', $data);
    }

    public function saveKaryawan()
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
                'rules' => 'required|is_unique[karyawan.nik]',
                'errors' => [
                    'required' => 'NIK harus diisi.',
                    'is_unique' => 'NIK sudah terdaftar'
                ]
            ],
            'email' => [
                'rules' => 'required[karyawan.email]',
                'errors' => [
                    'required' => 'Email harus diisi.'
                ]
            ],
            'nama' => [
                'rules' => 'required[karyawan.nama]',
                'errors' => [
                    'required' => 'Nama Lengkap harus diisi.'
                ]
            ],
            'id_jabatan' => [
                'rules' => 'required[karyawan.id_jabatan]',
                'errors' => [
                    'required' => 'jabatan harus diisi.',
                    'is_unique' => 'jabatan sudah terdaftar'
                ]
            ],
            'alamat' => [
                'rules' => 'required[karyawan.alamat]',
                'errors' => [
                    'required' => 'Alamat harus diisi.'
                ]
            ],
            'tempat_lahir' => [
                'rules' => 'required[karyawan.tempat_lahir]',
                'errors' => [
                    'required' => 'Tempat Lahir harus diisi.'
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
            'perusahaan' => [
                'rules' => 'required[karyawan.perusahaan]',
                'errors' => [
                    'required' => 'Perusahaan harus diisi.'
                ]
            ],
            'id_departemen' => [
                'rules' => 'required[karyawan.id_departemen]',
                'errors' => [
                    'required' => 'Departemen harus diisi.'
                ]
            ]

        ])) {
            // validasi
            // mengirimkan data dengan chain input dan validasi
            return redirect()->to('admin/addKaryawan')->withInput();
        }

        // ambil gambar
        $fileFoto = $this->request->getFile('foto_profile');

        if ($fileFoto->getError() == 4) {
            $namaFoto = 'default.png';
        } else {
            $namaFoto = $fileFoto->getRandomName();
            // pindahkan gambar
            $fileFoto->move('images', $namaFoto);
        }


        $this->karyawanModel->save(
            [
                'foto_profile' => $namaFoto,
                'nama' => $this->request->getVar('nama'),
                'slug' => url_title($this->request->getVar('nama'), '-', true),
                'perusahaan' => $this->request->getVar('perusahaan'),
                'id_departemen' => $this->request->getVar('id_departemen'),
                'jk' => $this->request->getVar('jk'),
                'tempat_lahir' => $this->request->getVar('tempat_lahir'),
                'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
                'id_jabatan' => $this->request->getVar('id_jabatan'),
                'alamat' => $this->request->getVar('alamat'),
                'nik' => $this->request->getVar('nik'),
                'email' => $this->request->getVar('email'),
                'no_telepon' => $this->request->getVar('no_telepon')
            ]
        );

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        return redirect()->to('admin/karyawan');
    }

    public function editKaryawan($id)
    {
        $session = session();
        $nik = $session->get('nik');
        $levelUser = $this->adminModel->getNIK($nik);

        $dataKaryawan = $this->karyawanModel->getKaryawanById($id);

        $dataJabatan = $this->karyawanModel->getJabatan();
        $dataDepartemen = $this->karyawanModel->getDepartemen();

        $data = [
            'validation' => \Config\Services::validation(),
            "dataKaryawan" => $dataKaryawan,
            'dataDepartemen' => $dataDepartemen,
            'dataJabatan' => $dataJabatan,
            'name' => $levelUser['nama'],
            "levelUser" => $levelUser['level_user'],
        ];
        return view('karyawan/edit', $data);
    }

    public function updateKaryawan($id)
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
            'id_jabatan' => [
                'rules' => 'required[karyawan.id_jabatan]',
                'errors' => [
                    'required' => 'jabatan harus diisi.',
                    'is_unique' => 'jabatan sudah terdaftar'
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
            ],
            'perusahaan' => [
                'rules' => 'required[karyawan.perusahaan]',
                'errors' => [
                    'required' => 'Perusahaan harus diisi.'
                ]
            ],
            'id_departemen' => [
                'rules' => 'required[karyawan.id_departemen]',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]

        ])) {
            // validasi
            // mengirimkan data dengan chain input dan validasi
            return redirect()->to('admin/editKaryawan/' .  $id)->withInput();
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
                'perusahaan' => $this->request->getVar('perusahaan'),
                'id_departemen' => $this->request->getVar('id_departemen'),
                'jk' => $this->request->getVar('jk'),
                'tempat_lahir' => $this->request->getVar('tempat_lahir'),
                'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
                'id_jabatan' => $this->request->getVar('id_jabatan'),
                'alamat' => $this->request->getVar('alamat'),
                'nik' => $this->request->getVar('nik'),
                'email' => $this->request->getVar('email'),
                'no_telepon' => $this->request->getVar('no_telepon')
            ]
        );

        session()->setFlashdata('pesan', 'Data berhasil diubah.');
        return redirect()->to('admin/karyawan');
    }

    public function ITSupport()
    {
        $session = session();
        $nik = $session->get('nik');
        $levelUser = $this->adminModel->getNIK($nik);

        $datas = $this->itSupportModel->getAllITSupport();
        $number = count($datas);
        $data = [
            "data" => $datas,
            "number" => $number,
            "levelUser" => $levelUser['level_user'],
            'name' => $levelUser['nama']
        ];
        return view('ITSupport/index', $data);
    }

    public function addITSupport()
    {
        $session = session();
        $nik = $session->get('nik');
        $levelUser = $this->adminModel->getNIK($nik);

        $data = [
            'validation' => \Config\Services::validation(),
            "levelUser" => $levelUser['level_user'],
            'name' => $levelUser['nama']
        ];
        return view('ITSupport/add', $data);
    }

    public function saveITSupport()
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
                'rules' => 'required|is_unique[karyawan.nik]',
                'errors' => [
                    'required' => 'NIK harus diisi.',
                    'is_unique' => 'NIK sudah terdaftar'
                ]
            ],
            'email' => [
                'rules' => 'required[karyawan.email]',
                'errors' => [
                    'required' => 'Email harus diisi.'
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
            'tempat_lahir' => [
                'rules' => 'required[karyawan.tempat_lahir]',
                'errors' => [
                    'required' => 'Tempat Lahir harus diisi.'
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
            'perusahaan' => [
                'rules' => 'required[karyawan.perusahaan]',
                'errors' => [
                    'required' => 'Perusahaan harus diisi.'
                ]
            ]

        ])) {
            // validasi
            // mengirimkan data dengan chain input dan validasi
            return redirect()->to('admin/addITSupport')->withInput();
        }

        // ambil gambar
        $fileFoto = $this->request->getFile('foto_profile');

        if ($fileFoto->getError() == 4) {
            $namaFoto = 'default.png';
        } else {
            $namaFoto = $fileFoto->getRandomName();
            // pindahkan gambar
            $fileFoto->move('images', $namaFoto);
        }


        $this->itSupportModel->save(
            [
                'foto_profile' => $namaFoto,
                'nama' => $this->request->getVar('nama'),
                'slug' => url_title($this->request->getVar('nama'), '-', true),
                'perusahaan' => $this->request->getVar('perusahaan'),
                'jk' => $this->request->getVar('jk'),
                'jabatan' => $this->request->getVar('jabatan'),
                'departemen' => $this->request->getVar('departemen'),
                'tempat_lahir' => $this->request->getVar('tempat_lahir'),
                'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
                'alamat' => $this->request->getVar('alamat'),
                'nik' => $this->request->getVar('nik'),
                'email' => $this->request->getVar('email'),
                'no_telepon' => $this->request->getVar('no_telepon')
            ]
        );

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        return redirect()->to('admin/ITSupport');
    }

    public function editITSupport($id)
    {
        $session = session();
        $nik = $session->get('nik');
        $levelUser = $this->adminModel->getNIK($nik);

        $dataITSupport = $this->itSupportModel->getITSupportById($id);

        $data = [
            'validation' => \Config\Services::validation(),
            "dataITSupport" => $dataITSupport,
            'name' => $levelUser['nama'],
            "levelUser" => $levelUser['level_user'],
        ];
        return view('ITSupport/edit', $data);
    }

    public function updateITSupport($id)
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
            ],
            'perusahaan' => [
                'rules' => 'required[karyawan.perusahaan]',
                'errors' => [
                    'required' => 'Perusahaan harus diisi.'
                ]
            ]

        ])) {
            // validasi
            // mengirimkan data dengan chain input dan validasi
            return redirect()->to('admin/editITSupport/' .  $id)->withInput();
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
                'perusahaan' => $this->request->getVar('perusahaan'),
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
        return redirect()->to('admin/ITSupport');
    }

    public function userRequest()
    {
        $session = session();
        $nik = $session->get('nik');
        $levelUser = $this->adminModel->getNIK($nik);

        $dataUser = $this->userRequest->getUserRequestForAdmin();
        $staffit = $this->itSupportModel->getAllITSupport();
        $dataPrioritas = $this->subRequestModel->getPrioritas();
        $number = count($dataUser);
        $number1 = count($staffit);
        $number2 = count($dataPrioritas);

        $data = [
            'levelUser' => $levelUser['level_user'],
            'name' => $levelUser['nama'],
            "dataPrioritas" => $dataPrioritas,
            'dataUser' => $dataUser,
            'data_staffit' => $staffit,
            'number' => $number,
            'number1' => $number1,
            'number2' => $number2
        ];
        return view('admin/userRequest', $data);
    }

    public function saveRespond($id)
    {
        $this->userRequest->save(
            [
                'id' => $id,
                'id_it_support' => $this->request->getVar('id_it_support'),
                'id_prioritas' => $this->request->getVar('id_prioritas'),
                'id_analisis' => 2,
                'start_date' => $this->request->getVar('start_date'),
                'till_date' => $this->request->getVar('till_date')
            ]
        );

        session()->setFlashdata('pesan', 'Permintaan Telah Ditanggapi');

        return redirect()->to('admin/userRequest');
    }

    public function jabatan()
    {
        $session = session();
        $nik = $session->get('nik');
        $levelUser = $this->adminModel->getNIK($nik);

        $dataJabatan = $this->jabatanModel->getAllJabatan();

        $data = [
            'levelUser' => $levelUser['level_user'],
            'name' => $levelUser['nama'],
            'dataJabatan' => $dataJabatan
        ];
        return view('jabatan/index', $data);
    }

    public function addJabatan()
    {
        $session = session();
        $nik = $session->get('nik');
        $levelUser = $this->adminModel->getNIK($nik);


        $dataJabatan = $this->jabatanModel->getAllJabatan();
        $number = count($dataJabatan);
        $kodeJabatan = 'J0' .  $number + 1;

        $data = [
            'validation' => \Config\Services::validation(),
            'levelUser' => $levelUser['level_user'],
            'name' => $levelUser['nama'],
            'kodeJabatan' => $kodeJabatan
        ];
        return view('jabatan/add', $data);
    }

    public function saveJabatan()
    {
        //validasi
        if (!$this->validate([
            'nama_jabatan' => [
                'rules' => 'required[jabatan.nama_jabatan]',
                'errors' => [
                    'required' => 'jabatan harus diisi.'
                ]
            ]
        ])) {
            // validasi
            // mengirimkan data dengan chain input dan validasi
            return redirect()->to('admin/addJabatan')->withInput();
        }

        $this->jabatanModel->save(
            [
                'kode_jabatan' => $this->request->getVar('kode_jabatan'),
                'nama_jabatan' => $this->request->getVar('nama_jabatan')
            ]
        );

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        return redirect()->to('admin/jabatan');
    }

    public function editJabatan($id)
    {
        $session = session();
        $nik = $session->get('nik');
        $levelUser = $this->adminModel->getNIK($nik);

        $dataJabatan = $this->jabatanModel->getJabatanById($id);

        $data = [
            'validation' => \Config\Services::validation(),
            'name' => $levelUser['nama'],
            "levelUser" => $levelUser['level_user'],
            "dataJabatan" => $dataJabatan,
        ];
        return view('jabatan/edit', $data);
    }

    public function updateJabatan($id)
    {
        //validasi
        if (!$this->validate([
            'nama_jabatan' => [
                'rules' => 'required[jabatan.nama_jabatan]',
                'errors' => [
                    'required' => 'jabatan harus diisi.'
                ]
            ]
        ])) {
            // validasi
            // mengirimkan data dengan chain input dan validasi
            return redirect()->to('admin/editJabatan')->withInput();
        }

        $this->jabatanModel->save(
            [
                'id' => $id,
                'kode_jabatan' => $this->request->getVar('kode_jabatan'),
                'nama_jabatan' => $this->request->getVar('nama_jabatan')
            ]
        );

        session()->setFlashdata('pesan', 'Data berhasil diubah.');
        return redirect()->to('admin/jabatan');
    }

    public function departemen()
    {
        $session = session();
        $nik = $session->get('nik');
        $levelUser = $this->adminModel->getNIK($nik);

        $dataDepartemen = $this->departemenModel->getAllDepartemen();

        $data = [
            'levelUser' => $levelUser['level_user'],
            'name' => $levelUser['nama'],
            'dataDepartemen' => $dataDepartemen
        ];
        return view('Departemen/index', $data);
    }

    public function addDepartemen()
    {
        $session = session();
        $nik = $session->get('nik');
        $levelUser = $this->adminModel->getNIK($nik);

        $dataDepartemen = $this->departemenModel->getAllDepartemen();
        $number = count($dataDepartemen);
        $kodeDepartemen = 'D0' . 0 .  $number + 1;

        $data = [
            'validation' => \Config\Services::validation(),
            'levelUser' => $levelUser['level_user'],
            'name' => $levelUser['nama'],
            'kodeDepartemen' => $kodeDepartemen
        ];
        return view('departemen/add', $data);
    }

    public function saveDepartemen()
    {
        //validasi
        if (!$this->validate([
            'nama_departemen' => [
                'rules' => 'required[departemen.nama_departemen]',
                'errors' => [
                    'required' => 'departemen harus diisi.'
                ]
            ]
        ])) {
            // validasi
            // mengirimkan data dengan chain input dan validasi
            return redirect()->to('admin/addDepartemen')->withInput();
        }

        $this->departemenModel->save(
            [
                'kode_departemen' => $this->request->getVar('kode_departemen'),
                'nama_departemen' => $this->request->getVar('nama_departemen')
            ]
        );

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        return redirect()->to('admin/departemen');
    }

    public function editdepartemen($id)
    {
        $session = session();
        $nik = $session->get('nik');
        $levelUser = $this->adminModel->getNIK($nik);

        $dataDepartemen = $this->departemenModel->getDepartemenById($id);

        $data = [
            'validation' => \Config\Services::validation(),
            'name' => $levelUser['nama'],
            "levelUser" => $levelUser['level_user'],
            "dataDepartemen" => $dataDepartemen,
        ];
        return view('departemen/edit', $data);
    }

    public function updateDepartemen($id)
    {
        //validasi
        if (!$this->validate([
            'nama_departemen' => [
                'rules' => 'required[departemen.nama_departemen]',
                'errors' => [
                    'required' => 'departemen harus diisi.'
                ]
            ]
        ])) {
            // validasi
            // mengirimkan data dengan chain input dan validasi
            return redirect()->to('admin/editDepartemen')->withInput();
        }

        $this->departemenModel->save(
            [
                'id' => $id,
                'kode_departemen' => $this->request->getVar('kode_departemen'),
                'nama_departemen' => $this->request->getVar('nama_departemen')
            ]
        );

        session()->setFlashdata('pesan', 'Data berhasil diubah.');
        return redirect()->to('admin/departemen');
    }

    public function prioritas()
    {
        $session = session();
        $nik = $session->get('nik');
        $levelUser = $this->adminModel->getNIK($nik);

        $dataPrioritas = $this->subRequestModel->getPrioritas();

        $data = [
            'levelUser' => $levelUser['level_user'],
            'name' => $levelUser['nama'],
            'dataPrioritas' => $dataPrioritas
        ];
        return view('prioritas/index', $data);
    }

    public function savePrioritas()
    {
        $dataPrioritas = $this->subRequestModel->getPrioritas();
        $id = count($dataPrioritas) + 1;
        $this->subRequestModel->save(
            [
                'id' => $id,
                'prioritas' => $this->request->getVar('prioritas')
            ]
        );

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        return redirect()->to('admin/prioritas');
    }

    public function updatePrioritas($id)
    {
        $this->subRequestModel->save(
            [
                'id' => $id,
                'prioritas' => $this->request->getVar('prioritas')
            ]
        );

        session()->setFlashdata('pesan', 'Data berhasil diubah.');
        return redirect()->to('admin/prioritas');
    }

    public function kategori()
    {
        $session = session();
        $nik = $session->get('nik');
        $levelUser = $this->adminModel->getNIK($nik);

        $dataKategori = $this->subRequestModel->getKategori();

        $data = [
            'levelUser' => $levelUser['level_user'],
            'name' => $levelUser['nama'],
            'dataKategori' => $dataKategori
        ];
        return view('kategori/index', $data);
    }

    public function saveKategori()
    {
        $dataKategori = $this->subRequestModel->getKategori();
        $id = count($dataKategori) + 1;
        $this->subRequestModel->save(
            [
                'id' => $id,
                'kategori' => $this->request->getVar('kategori')
            ]
        );

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        return redirect()->to('admin/kategori');
    }

    public function updateKategori($id)
    {
        $this->subRequestModel->save(
            [
                'id' => $id,
                'kategori' => $this->request->getVar('kategori')
            ]
        );

        session()->setFlashdata('pesan', 'Data berhasil diubah.');
        return redirect()->to('admin/kategori');
    }

    public function lampiran()
    {
        $session = session();
        $nik = $session->get('nik');
        $levelUser = $this->adminModel->getNIK($nik);

        $dataLampiran = $this->subRequestModel->getLampiran();

        $data = [
            'levelUser' => $levelUser['level_user'],
            'name' => $levelUser['nama'],
            'dataLampiran' => $dataLampiran
        ];
        return view('lampiran/index', $data);
    }

    public function saveLampiran()
    {
        $dataLampiran = $this->subRequestModel->getLampiran();
        $id = count($dataLampiran) + 1;
        $this->subRequestModel->save(
            [
                'id' => $id,
                'lampiran' => $this->request->getVar('lampiran')
            ]
        );

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        return redirect()->to('admin/lampiran');
    }

    public function updateLampiran($id)
    {
        $this->subRequestModel->save(
            [
                'id' => $id,
                'lampiran' => $this->request->getVar('lampiran')
            ]
        );

        session()->setFlashdata('pesan', 'Data berhasil diubah.');
        return redirect()->to('admin/lampiran');
    }

    public function status()
    {
        $session = session();
        $nik = $session->get('nik');
        $levelUser = $this->adminModel->getNIK($nik);

        $dataStatus = $this->subRequestModel->getStatus();

        $data = [
            'levelUser' => $levelUser['level_user'],
            'name' => $levelUser['nama'],
            'dataStatus' => $dataStatus
        ];
        return view('status/index', $data);
    }

    public function saveStatus()
    {
        $dataStatus = $this->subRequestModel->getStatus();
        $id = count($dataStatus) + 1;
        $this->subRequestModel->save(
            [
                'id' => $id,
                'status' => $this->request->getVar('status')
            ]
        );

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        return redirect()->to('admin/status');
    }

    public function updateStatus($id)
    {
        $this->subRequestModel->save(
            [
                'id' => $id,
                'status' => $this->request->getVar('status')
            ]
        );

        session()->setFlashdata('pesan', 'Data berhasil diubah.');
        return redirect()->to('admin/status');
    }

    public function user_delete($id)
    {
        $this->adminModel->delete($id);

        session()->setFlashdata('pesan', 'Data berhasil di hapus');

        return redirect()->to('admin/user');
    }

    public function karyawan_delete($id)
    {
        $this->karyawanModel->delete($id);

        session()->setFlashdata('pesan', 'Data berhasil di hapus');

        return redirect()->to('admin/karyawan');
    }

    public function it_support_delete($id)
    {
        $this->itSupportModel->delete($id);

        session()->setFlashdata('pesan', 'Data berhasil di hapus');

        return redirect()->to('admin/ITSupport');
    }

    public function request_delete($id)
    {

        $this->userRequest->delete($id);

        session()->setFlashdata('pesan', 'Data berhasil di hapus');

        return redirect()->to('admin/userRequest');
    }

    public function jabatan_delete($id)
    {

        $this->jabatanModel->delete($id);

        session()->setFlashdata('pesan', 'Data berhasil di hapus');

        return redirect()->to('admin/jabatan');
    }

    public function departemen_delete($id)
    {

        $this->departemenModel->delete($id);

        session()->setFlashdata('pesan', 'Data berhasil di hapus');

        return redirect()->to('admin/departemen');
    }

    public function prioritas_delete($id)
    {
        $this->subRequestModel->save(
            [
                'id' => $id,
                'prioritas' => ''
            ]
        );

        session()->setFlashdata('pesan', 'Data berhasil di hapus');

        return redirect()->to('admin/prioritas');
    }

    public function kategori_delete($id)
    {
        $this->subRequestModel->save(
            [
                'id' => $id,
                'kategori' => ''
            ]
        );

        session()->setFlashdata('pesan', 'Data berhasil di hapus');

        return redirect()->to('admin/kategori');
    }

    public function lampiran_delete($id)
    {
        $this->subRequestModel->save(
            [
                'id' => $id,
                'lampiran' => ''
            ]
        );

        session()->setFlashdata('pesan', 'Data berhasil di hapus');

        return redirect()->to('admin/lampiran');
    }

    public function status_delete($id)
    {
        $this->subRequestModel->save(
            [
                'id' => $id,
                'status' => ''
            ]
        );

        session()->setFlashdata('pesan', 'Data berhasil di hapus');

        return redirect()->to('admin/status');
    }

    public function informasi_delete($id)
    {
        $this->informasiModel->delete($id);

        session()->setFlashdata('pesan', 'Data berhasil di hapus');

        return redirect()->to('admin/informasi');
    }

    public function printKaryawan()
    {
        $session = session();
        $nik = $session->get('nik');
        $levelUser = $this->adminModel->getNIK($nik);

        $dataKaryawan = $this->karyawanModel->getAllKaryawan();
        $dataDepartemen = $this->karyawanModel->getDepartemen();
        $number1 = count($dataDepartemen);
        $data = [
            'validation' => \Config\Services::validation(),
            "dataKaryawan" => $dataKaryawan,
            "dataDepartemen" => $dataDepartemen,
            "number1" => $number1,
            "levelUser" => $levelUser['level_user'],
            'name' => $levelUser['nama']
        ];
        return view('admin/filterKaryawan', $data);
    }

    public function printKaryawanPDF()
    {
        $perusahaan = $_POST['perusahaan'];
        $departemen = $_POST['id_departemen'];
        $dataKaryawan = $this->karyawanModel->getKaryawan($perusahaan, $departemen);
        $data = [
            "dataKaryawan" => $dataKaryawan,
        ];
        return view('admin/printKaryawanFilter', $data);
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
        return view('admin/filterFeedback', $data);
    }

    public function requestFeedbackPDF()
    {
        $dataUser = $this->userRequest->getUserRequestForAdmin();
        $number = count($dataUser);
        $data = [
            'dataUser' => $dataUser,
            'number' => $number
        ];

        return view('admin/printFeedback', $data);
    }

    public function printRequest()
    {
        $session = session();
        $nik = $session->get('nik');
        $levelUser = $this->adminModel->getNIK($nik);

        $data = [
            'validation' => \Config\Services::validation(),
            "levelUser" => $levelUser['level_user'],
            'name' => $levelUser['nama']
        ];
        return view('admin/filterRequest', $data);
    }

    public function printRequestPDF()
    {
        $tahun = $_POST['tahun'];
        $bulan = $_POST['bulan'];
        $dataRequest = $this->userRequest->getRequest($bulan, $tahun);

        $data = [
            'dataRequest' => $dataRequest,
        ];

        return view('admin/printRequestFilter', $data);
    }

    public function printRequestFeedbackPDF()
    {
        $tahun = $_POST['tahun'];
        $bulan = $_POST['bulan'];
        $dataRequest = $this->userRequest->getRequest($bulan, $tahun);

        $data = [
            'dataRequest' => $dataRequest,
        ];

        return view('admin/printRequestFeedbackFilter', $data);
    }

    public function userPDF()
    {
        $dataUser = $this->adminModel->getAllUser();
        $number = count($dataUser);
        $data = [
            "dataUser" => $dataUser,
            "number" => $number
        ];
        return view('admin/printUser', $data);
    }

    public function adminPDF()
    {
        $dataUser = $this->adminModel->getAllUserByLevelUser();
        $number = count($dataUser);
        $data = [
            "dataUser" => $dataUser,
            "number" => $number
        ];
        return view('admin/printAdmin', $data);
    }

    public function karyawanPDF()
    {
        $dataUser = $this->karyawanModel->getAllKaryawan();
        $number = count($dataUser);
        $data = [
            "dataUser" => $dataUser,
            "number" => $number
        ];
        return view('admin/printKaryawan', $data);
    }

    public function departemenPDF()
    {
        $dataDepartemen = $this->departemenModel->getAllDepartemen();
        $number = count($dataDepartemen);
        $data = [
            "dataDepartemen" => $dataDepartemen,
            "number" => $number
        ];
        return view('admin/printDepartemen', $data);
    }

    public function jabatanPDF()
    {
        $dataJabatan = $this->jabatanModel->getAllJabatan();
        $number = count($dataJabatan);
        $data = [
            "dataJabatan" => $dataJabatan,
            "number" => $number
        ];
        return view('admin/printjabatan', $data);
    }

    public function itSupportPDF()
    {
        $dataUser = $this->itSupportModel->getAllITSupport();
        $number = count($dataUser);
        $data = [
            "dataUser" => $dataUser,
            "number" => $number
        ];
        return view('admin/printITSupport', $data);
    }

    public function requestPDF()
    {
        $dataUser = $this->userRequest->getUserRequestForAdmin();
        $number = count($dataUser);
        $data = [
            'dataUser' => $dataUser,
            'number' => $number
        ];

        return view('admin/printRequest', $data);
    }

    public function requestAcceptPDF()
    {
        $dataUser = $this->userRequest->getUserRequestForAdminAccept();
        $number = count($dataUser);
        $data = [
            'dataUser' => $dataUser,
            'number' => $number
        ];

        return view('admin/printRequestAccept', $data);
    }

    public function requestDeniedPDF()
    {
        $dataUser = $this->userRequest->getUserRequestForAdminDenied();
        $number = count($dataUser);
        $data = [
            'dataUser' => $dataUser,
            'number' => $number
        ];

        return view('admin/printRequestDenied', $data);
    }
}
