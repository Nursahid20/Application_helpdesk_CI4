<?php

$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$ex = explode("/", $actual_link);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>BMB</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="/assets/js/jquery.dataTables.min.js"></script>
    <script src="/assets/js/dataTables.bootstrap5.min.js"></script>

    <!-- FontAwesome JS-->
    <script defer src="/assets/plugins/fontawesome/js/all.min.js"></script>

    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="/assets/css/portal.css">
    <link id="theme-style" rel="stylesheet" href="/assets/css/style.css">
    <link id="theme-style" rel="stylesheet" href="/assets/css/circle.css">
    <style>
        th,
        td {
            white-space: nowrap;
        }

        div.dataTables_wraper {
            width: 800px;
            margin: 0 auto;
        }

        tr {
            height: 50px;
        }
    </style>

</head>

<body class="app  fadeinups">
    <header class="app-header fixed-top">
        <div class="app-header-inner">
            <div class="container-fluid py-2">
                <div class="app-header-content">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" role="img">
                                    <title>Menu</title>
                                    <path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" d="M4 7h22M4 15h22M4 23h22"></path>
                                </svg>
                            </a>
                        </div>

                        <div class="app-utilities col-auto">
                            <?php echo $name; ?>
                            <div class="app-utility-item app-user-dropdown dropdown">
                                <a class="dropdown-toggle" id="user-dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><img src="https://img.icons8.com/external-kiranshastry-lineal-kiranshastry/50/000000/external-user-interface-kiranshastry-lineal-kiranshastry.png" /></a>
                                <ul class="dropdown-menu" aria-labelledby="user-dropdown-toggle">
                                    <?php if ($levelUser == 'admin') { ?>
                                        <li><a class="dropdown-item" href="<?= base_url('/admin/account') ?>">Account</a></li>
                                    <?php } else if ($levelUser == 'user(Karyawan)') {  ?>
                                        <li><a class="dropdown-item" href="<?= base_url('/user/account') ?>">Account</a></li>
                                    <?php } else {  ?>
                                        <li><a class="dropdown-item" href="<?= base_url('/itsupport/account') ?>">Account</a></li>
                                    <?php }  ?>

                                    <?php if ($levelUser == 'admin') { ?>
                                        <li><a class="dropdown-item" href="<?= base_url('/admin/changePassword') ?>">Ganti Password</a></li>
                                    <?php } else if ($levelUser == 'user(Karyawan)') {  ?>
                                        <li><a class="dropdown-item" href="<?= base_url('/user/changePassword') ?>">Ganti Password</a></li>
                                    <?php } else {  ?>
                                        <li><a class="dropdown-item" href="<?= base_url('/itsupport/changePassword') ?>">Ganti Password</a></li>
                                    <?php }  ?>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="/auth/logout">Log Out</a></li>
                                </ul>
                            </div>
                            <!--//app-user-dropdown-->
                        </div>
                        <!--//app-utilities-->
                    </div>
                    <!--//row-->
                </div>
                <!--//app-header-content-->
            </div>
            <!--//container-fluid-->
        </div>
        <!--//app-header-inner-->
        <div id="app-sidepanel" class="app-sidepanel">
            <div id="sidepanel-drop" class="sidepanel-drop"></div>
            <div class="sidepanel-inner d-flex flex-column">
                <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
                <div class="app-branding">
                    <img width="120px" height="50px" style="margin-left:25px;" src="/images/bmb_logo.png" alt="logo">
                </div>
                <!--//app-branding-->

                <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
                    <ul class="app-menu list-unstyled accordion" id="menu-accordion">
                        <br>
                        <li class="nav-item">
                            <a class="nav-link active" id="home" href="/">
                                <span class="nav-icon" style="padding-top: 3px;padding-left:2px;">
                                    <i class="fas fa-home"></i>
                                </span>
                                <span class="nav-link-text">Dashboard</span>
                            </a>

                        </li>

                        <?php if ($levelUser == 'admin') { ?>


                            <li class="nav-item">
                                <a class="nav-link" id="user" href="<?= base_url('/admin/user') ?>">
                                    <span class="nav-icon" style="padding-top: 3px;padding-left:2px;">
                                        <i class="fas fa-users"></i>
                                    </span>
                                    <span class="nav-link-text">User</span>
                                </a>
                            </li>

                            <!-- <li class="nav-item">
                                <a class="nav-link" id="admin" href="<?= base_url('/admin/index') ?>">
                                    <span class="nav-icon" style="padding-top: 3px;padding-left:2px;">
                                        <i class="fas fa-user-tie"></i>
                                    </span>
                                    <span class="nav-link-text">Admin</span>
                                </a>
                            </li> -->

                            <li class="nav-item">
                                <a class="nav-link" id="karyawan" href="<?= base_url('/admin/karyawan') ?>">
                                    <span class="nav-icon" style="padding-top: 3px;padding-left:2px;">
                                        <i class="fas fa-user-tie"></i>
                                    </span>
                                    <span class="nav-link-text">Karyawan</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="ITSupport" href="<?= base_url('/admin/ITSupport') ?>">
                                    <span class="nav-icon" style="padding-top: 3px;padding-left:2px;">
                                        <i class="fas fa-user-tie"></i>
                                    </span>
                                    <span class="nav-link-text">IT Support</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="jabatan" href="<?= base_url('/admin/jabatan') ?>">
                                    <span class="nav-icon" style="padding-top: 3px;padding-left:2px;">
                                        <i class="fas fa-pen-nib"></i>
                                    </span>
                                    <span class="nav-link-text">Jabatan</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="departemen" href="<?= base_url('/admin/departemen') ?>">
                                    <span class="nav-icon" style="padding-top: 3px;padding-left:2px;">
                                        <i class="fas fa-th-large"></i>
                                    </span>
                                    <span class="nav-link-text">Departemen</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="userRequest" href="<?= base_url('/admin/userRequest') ?>">
                                    <span class="nav-icon" style="padding-top: 3px;padding-left:2px;">
                                        <i class="fas fa-ticket-alt"></i>
                                    </span>
                                    <span class="nav-link-text">Manajemen Permintaan</span>
                                </a>
                            </li>

                            <li class="nav-item has-submenu">
                                <a class="nav-link submenu-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-4" aria-expanded="false" aria-controls="submenu-4">
                                    <span class="nav-icon" style="padding-top: 3px;padding-left:2px;">
                                        <i class="fas fa-clipboard-list"></i>
                                    </span>
                                    <span class="nav-link-text">Sub Permintaan</span>
                                    <span class="submenu-arrow">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                                        </svg>
                                    </span>
                                </a>

                                <div id="submenu-4" class="collapse submenu submenu-4" data-bs-parent="#menu-accordion">
                                    <ul class="submenu-list list-unstyled">

                                        <li class="submenu-item"><a class="submenu-link" href="<?= base_url('/admin/kategori'); ?>" id="kategori">Data Kategori</a></li>
                                        <li class="submenu-item"><a class="submenu-link" href="<?= base_url('/admin/status'); ?>" id="status">Data Status</a></li>
                                        <li class="submenu-item"><a class="submenu-link" href="<?= base_url('/admin/lampiran'); ?>" id="lampiran">Data Lampiran</a></li>
                                        <li class="submenu-item"><a class="submenu-link" href="<?= base_url('/admin/prioritas'); ?>" id="prioritas">Data Prioritas</a></li>

                                    </ul>
                                </div>
                            </li>

                            <li class="nav-item has-submenu">
                                <a class="nav-link submenu-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-3" aria-expanded="false" aria-controls="submenu-3">
                                    <span class="nav-icon" style="padding-top: 3px;padding-left:2px;">
                                        <i class="fas fa-tasks"></i>
                                    </span>
                                    <span class="nav-link-text">Laporan</span>
                                    <span class="submenu-arrow">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                                        </svg>
                                    </span>
                                </a>

                                <div id="submenu-3" class="collapse submenu submenu-3" data-bs-parent="#menu-accordion">
                                    <ul class="submenu-list list-unstyled">

                                        <li class="submenu-item"><a class="submenu-link" href="<?= base_url('/admin/userPDF'); ?>" target="_blank">Data User</a></li>
                                        <!-- <li class="submenu-item"><a class="submenu-link" href="<?= base_url('/admin/adminPDF'); ?>" target="_blank">Data Admin</a></li> -->
                                        <li class="submenu-item"><a class="submenu-link" href="<?= base_url('/admin/printKaryawan'); ?>">Data Karyawan</a></li>
                                        <li class="submenu-item"><a class="submenu-link" href="<?= base_url('/admin/itSupportPDF'); ?>" target="_blank">Data IT Support</a></li>
                                        <li class="submenu-item"><a class="submenu-link" href="<?= base_url('/admin/printRequest'); ?>">Data Permintaan Karyawan</a></li>
                                        <li class="submenu-item"><a class="submenu-link" href="<?= base_url('/admin/printRequestFeedback'); ?>">Data Kritik/Saran Permintaan Karyawan</a></li>
                                        <li class="submenu-item"><a class="submenu-link" href="<?= base_url('/admin/departemenPDF'); ?>" target="_blank">Data Departemen</a></li>
                                        <li class="submenu-item"><a class="submenu-link" href="<?= base_url('/admin/jabatanPDF'); ?>" target="_blank">Data Jabatan</a></li>
                                    </ul>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="informasi" href="<?= base_url('/admin/informasi') ?>">
                                    <span class="nav-icon" style="padding-top: 3px;padding-left:2px;">
                                        <i class="fas fa-bullhorn"></i>
                                    </span>
                                    <span class="nav-link-text">Informasi</span>
                                </a>
                            </li>

                        <?php } else if ($levelUser == 'user(Karyawan)') { ?>

                            <li class="nav-item">
                                <a class="nav-link" id="request" href="<?= base_url('/user/request') ?>">
                                    <span class="nav-icon" style="padding-top: 3px;padding-left:2px;">
                                        <i class="fas fa-ticket-alt"></i>
                                    </span>
                                    <span class="nav-link-text">Manajemen Permintaan</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="informasi" href="<?= base_url('/user/informasi') ?>">
                                    <span class="nav-icon" style="padding-top: 3px;padding-left:2px;">
                                        <i class="fas fa-bullhorn"></i>
                                    </span>
                                    <span class="nav-link-text">Informasi</span>
                                </a>
                            </li>

                        <?php } else if ($levelUser == 'user(IT)') { ?>

                            <li class="nav-item">
                                <a class="nav-link" id="userRequest" href="<?= base_url('/itsupport/userRequest') ?>">
                                    <span class="nav-icon" style="padding-top: 3px;padding-left:2px;">
                                        <i class="fas fa-ticket-alt"></i>
                                    </span>
                                    <span class="nav-link-text">Manajemen Permintaan</span>
                                </a>
                            </li>

                            <li class="nav-item has-submenu">
                                <a class="nav-link submenu-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-3" aria-expanded="false" aria-controls="submenu-3">
                                    <span class="nav-icon" style="padding-top: 3px;padding-left:2px;">
                                        <i class="fas fa-tasks"></i>
                                    </span>
                                    <span class="nav-link-text">Laporan</span>
                                    <span class="submenu-arrow">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                                        </svg>
                                    </span>
                                </a>

                                <div id="submenu-3" class="collapse submenu submenu-3" data-bs-parent="#menu-accordion">
                                    <ul class="submenu-list list-unstyled">
                                        <li class="submenu-item"><a class="submenu-link" href="<?= base_url('/itsupport/printRequest'); ?>">Data Permintaan Karyawan</a></li>
                                        <li class="submenu-item"><a class="submenu-link" href="<?= base_url('/itsupport/printRequestFeedback'); ?>">Data Kritik/Saran Permintaan Karyawan</a></li>
                                    </ul>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="informasi" href="<?= base_url('/itsupport/informasi') ?>">
                                    <span class="nav-icon" style="padding-top: 3px;padding-left:2px;">
                                        <i class="fas fa-bullhorn"></i>
                                    </span>
                                    <span class="nav-link-text">Informasi</span>
                                </a>
                            </li>



                        <?php } ?>





                    </ul>
                    <!--//app-menu-->
                </nav>


            </div>
            <!--//sidepanel-inner-->
        </div>
        <!--//app-sidepanel-->
    </header>

    <div class="app-wrapper">

        <?= $this->renderSection('content');  ?>

        <!-- <footer class="app-footer">
			<div class="container text-center py-3">
				<small class="copyright">Designed with <i class="fas fa-heart" style="color: #fb866a;"></i> by <a class="app-link" href="http://themes.3rdwavemedia.com" target="_blank">Xiaoying Riley</a> for developers</small>

			</div>
		</footer> -->
        <!--//app-footer-->

    </div>
    <!--//app-wrapper-->

    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable({
                "scrollX": true,
                "scrollCollapse": true,
                "fixedColoumns": {
                    heightMatch: 'none'
                }
            });

            $('#example2').DataTable({
                "scrollX": true
            });
        });

        //ambil link diatas
        const page = window.location.href.split('/');

        function pager(pages) {
            if (page[4] == pages) {
                document.getElementById(pages).className += " active";
                document.getElementById("home").classList.remove('active');
            }
        }

        function pagerKaryawan(pages) {
            if (page[4] == pages) {
                document.getElementById('karyawan').className += " active";
                document.getElementById("home").classList.remove('active');
            }
        }

        function pagerUser(pages) {
            if (page[4] == pages) {
                document.getElementById('user').className += " active";
                document.getElementById("home").classList.remove('active');
            }
        }

        function pagerITSupport(pages) {
            if (page[4] == pages) {
                document.getElementById('ITSupport').className += " active";
                document.getElementById("home").classList.remove('active');
            }
        }

        function pagerDepartemen(pages) {
            if (page[4] == pages) {
                document.getElementById('departemen').className += " active";
                document.getElementById("home").classList.remove('active');
            }
        }

        function pagerJabatan(pages) {
            if (page[4] == pages) {
                document.getElementById('jabatan').className += " active";
                document.getElementById("home").classList.remove('active');
            }
        }

        function pagerSub(pages) {
            if (page[4] == pages) {
                document.getElementById(pages).className += " active";
                document.getElementById("home").classList.remove('active');
                document.getElementById("submenu-4").className += " show";
            }
        }

        if (page[4] == 'account') {
            document.getElementById("home").classList.remove('active');
        }

        pagerSub('kategori');
        pagerSub('status');
        pagerSub('prioritas');
        pagerSub('lampiran');

        pager('karyawan');
        pager('ITSupport');
        pager('user');
        pager('jabatan');
        pager('printRequestFeedback');
        pager('departemen');
        pager('userRequest');
        pager('request');
        pager('admin');
        pager('informasi');
        pagerKaryawan('addKaryawan');
        pagerKaryawan('saveKaryawan');
        pagerKaryawan('updateKaryawan');
        pagerKaryawan('editKaryawan');
        pagerITSupport('addITSupport');
        pagerITSupport('saveITSupport');
        pagerITSupport('updateITSupport');
        pagerITSupport('editITSupport');
        pagerUser('addUser');
        pagerUser('saveUser');
        pagerUser('updateUser');
        pagerDepartemen('editDepartemen');
        pagerDepartemen('addDepartemen');
        pagerDepartemen('saveDepartemen');
        pagerDepartemen('updateDepartemen');
        pagerJabatan('editJabatan');
        pagerJabatan('addJabatan');
        pagerJabatan('saveJabatan');
        pagerJabatan('updateJabatan');
    </script>

    <!-- Javascript -->
    <script src="/assets/plugins/popper.min.js"></script>
    <script src="/assets/plugins/bootstrap/js/bootstrap.min.js"></script>


    <!-- Charts JS -->
    <script src="/assets/plugins/chart.js/chart.min.js"></script>
    <script src="/assets/js/index-charts.js"></script>

    <!-- Page Specific JS -->
    <script src="/assets/js/app.js"></script>
</body>

</html>