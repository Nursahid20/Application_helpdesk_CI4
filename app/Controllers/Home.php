<?php

namespace App\Controllers;

use App\Models\adminModel;
use App\Models\karyawanModel;
use App\Models\jabatanModel;
use App\Models\itSupportModel;
use App\Models\departemenModel;
use App\Models\informasiModel;
use App\Models\subRequestModel;
use App\Models\UserRequest;

class Home extends BaseController
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

        $karyawan = $this->karyawanModel->getAllKaryawan();
        $ITSupport = $this->itSupportModel->getAllITSupport();
        $user = $this->adminModel->getAllUser();




        if ($levelUser['level_user'] == 'user(IT)') {
            // //it support
            $itsupport = $this->itSupportModel->getIdITSupport($nik);
            $userRequest_itsupport = $this->userRequest->getUserRequestForITSupport($itsupport[0]['id']);
            $requestDone_itsupport = $this->userRequest->getUserRequestForITSupportDone($itsupport[0]['id']);
            $requestProses_itsupport = $this->userRequest->getUserRequestForITSupportProses($itsupport[0]['id']);
            $requestAdmin_itsupport = $this->userRequest->getUserRequestAdmin();
            $requestITSupport_itsupport = $this->userRequest->getUserRequestForITSupportByITSupport($itsupport[0]['id']);

            $data = [
                'levelUser' => $levelUser['level_user'],
                'name' => $levelUser['nama'],
                'ITSupport' => $ITSupport,
                'karyawan' => $karyawan,
                'user' => $user,
                'userRequest_itsupport' => count($userRequest_itsupport),
                'requestITSupport_itsupport' => count($requestITSupport_itsupport),
                'requestAdmin_itsupport' => count($requestAdmin_itsupport),
                'requestProses_itsupport' => count($requestProses_itsupport),
                'requestDone_itsupport' => count($requestDone_itsupport),
            ];

            return view('home/index', $data);
        } else {
            //user
            $userRequest_user = $this->userRequest->getUserRequestForKaryawan($nik);
            $requestDone_user = $this->userRequest->getUserRequestForKaryawanDone($nik);
            $requestProses_user = $this->userRequest->getUserRequestForKaryawanProses($nik);
            $requestAdmin_user = $this->userRequest->getUserRequestForKaryawanByAdmin($nik);
            $requestITSupport_user = $this->userRequest->getUserRequestForKaryawanByITSupport($nik);
            //admin
            $userRequest = $this->userRequest->getUserRequet();
            $requestDone = $this->userRequest->getUserRequestDone();
            $requestProses = $this->userRequest->getUserRequestProses();
            $requestAdmin = $this->userRequest->getUserRequestAdmin();
            $requestITSupport = $this->userRequest->getUserRequestITSupport();
            $data = [
                'levelUser' => $levelUser['level_user'],
                'name' => $levelUser['nama'],
                'ITSupport' => $ITSupport,
                'karyawan' => $karyawan,
                'user' => $user,

                'userRequest' => $userRequest,
                'requestITSupport' => $requestITSupport,
                'requestAdmin' => $requestAdmin,
                'requestProses' => $requestProses,
                'requestDone' => $requestDone,

                'userRequest_user' => $userRequest_user,
                'requestITSupport_user' => $requestITSupport_user,
                'requestAdmin_user' => $requestAdmin_user,
                'requestProses_user' => $requestProses_user,
                'requestDone_user' => $requestDone_user,

            ];
            return view('home/index', $data);
        }
    }
}
