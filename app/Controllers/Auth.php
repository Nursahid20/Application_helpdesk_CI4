<?php

namespace App\Controllers;

use App\Models\AdminModel;

class Auth extends BaseController
{
    public function index()
    {
        $session = session();
        $data = [
            'session' => $session
        ];
        return view('auth/index', $data);
    }


    public function login()
    {
        $adminModel = new adminModel();

        $session = session();
        $nik = $this->request->getPost('nik');
        $password = $this->request->getPost('password');

        $cek = $adminModel->getNIK($nik);

        if (isset($cek['nik'])) {
            if ($cek['nik'] == $nik) {
                if ($cek['password_hash']) {
                    if (password_verify($password, $cek['password_hash'])) {
                        $ses_data = [
                            'nik' => $cek['nik'],
                            'logged_in' => TRUE
                        ];
                        $session->set($ses_data);

                        return redirect()->to('/');
                    } else {
                        session()->setFlashdata('pesan', 'NIK / Password Salah');
                        return redirect()->to('/auth');
                    }
                } else {
                    session()->setFlashdata('pesan', 'NIK / Password Salah');
                    return redirect()->to('/auth');
                }
            } else {
                session()->setFlashdata('pesan', 'NIK / Password Salah');
                return redirect()->to('/auth');
            }
        } else {
            session()->setFlashdata('pesan', 'NIK / Password Salah');
            return redirect()->to('/auth');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('auth');
    }
}
