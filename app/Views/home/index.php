<?php $this->extend('layout/template'); ?>

<?= $this->section('content');  ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <h2 class="app-page-title">Dashboard</h2>
    <div class="row g-4 mb-4">
        <div class="col-6 col-lg-3">
            <div class="app-card app-card-stat shadow-sm h-100">
                <div class="app-card-body p-3 p-lg-4">
                    <h4 class="stats-type mb-1">Total Karyawan</h4>
                    <div class="stats-figure"><?= count($karyawan); ?></div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="app-card app-card-stat shadow-sm h-100">
                <div class="app-card-body p-3 p-lg-4">
                    <h4 class="stats-type mb-1">Total Pengguna</h4>
                    <div class="stats-figure"><?= count($user); ?></div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="app-card app-card-stat shadow-sm h-100">
                <div class="app-card-body p-3 p-lg-4">
                    <h4 class="stats-type mb-1">Total IT Support</h4>
                    <div class="stats-figure"><?= count($ITSupport); ?></div>
                </div>
            </div>
        </div>

        <?php if ($levelUser == 'admin') { ?>
            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100">
                    <div class="app-card-body p-3 p-lg-4">
                        <h4 class="stats-type mb-1">Total Permintaan</h4>
                        <div class="stats-figure"><?= count($userRequest); ?></div>
                    </div>
                </div>
            </div>
    </div>
    <div class="row g-4 mb-4">
        <div class="col-3 col-lg-3">
            <div class="app-card app-card-chart h-100 shadow-sm">
                <div class="app-card-header p-3">
                    <div class="align-items-center">
                        <div class="col-auto" style="text-align: center;">
                            <h3 class="app-card-title">Permintaan Selesai</h3>
                        </div>
                    </div>
                </div>
                <div class="clearfix" style="margin-top:10px; margin-left:85px;">
                    <div class="c100 p<?= count($requestDone); ?>">
                        <span><?= count($requestDone); ?>%</span>
                        <div class="slice">
                            <div class="bar"></div>
                            <div class="fill"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3 col-lg-3">
            <div class="app-card app-card-chart h-100 shadow-sm">
                <div class="app-card-header p-3">
                    <div class="align-items-center">
                        <div class="col-auto" style="text-align: center;">
                            <h3 class="app-card-title">Permintaan Dalam Proses</h3>
                        </div>
                    </div>
                </div>
                <div class="clearfix" style="margin-top:10px; margin-left:85px;">
                    <div class="c100 p<?= count($requestProses); ?>">
                        <span><?= count($requestProses); ?>%</span>
                        <div class="slice">
                            <div class="bar"></div>
                            <div class="fill"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3 col-lg-3">
            <div class="app-card app-card-chart h-100 shadow-sm">
                <div class="app-card-header p-3">
                    <div class="align-items-center">
                        <div class="col-auto" style="text-align: center;">
                            <h3 class="app-card-title">Permintaan Menunggu Persetujuan admin</h3>
                        </div>
                    </div>
                </div>
                <div class="clearfix" style="margin-top:10px; margin-left:85px;">
                    <div class="c100 p<?= count($requestAdmin); ?>">
                        <span><?= count($requestAdmin); ?>%</span>
                        <div class="slice">
                            <div class="bar"></div>
                            <div class="fill"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3 col-lg-3">
            <div class="app-card app-card-chart h-100 shadow-sm">
                <div class="app-card-header p-3">
                    <div class="align-items-center">
                        <div class="col-auto" style="text-align: center;">
                            <h3 class="app-card-title">Permintaan Menunggu Persetujuan IT Support</h3>
                        </div>
                    </div>
                </div>
                <div class="clearfix" style="margin-top:10px; margin-left:85px;">
                    <div class="c100 p<?= count($requestITSupport); ?>">
                        <span><?= count($requestITSupport); ?>%</span>
                        <div class="slice">
                            <div class="bar"></div>
                            <div class="fill"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } else if ($levelUser == 'user(Karyawan)') { ?>
    <div class="col-6 col-lg-3">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-1">Total Permintaan</h4>
                <div class="stats-figure"><?= count($userRequest_user); ?></div>
            </div>
        </div>
    </div>
</div>
<div class="row g-4 mb-4">
    <div class="col-3 col-lg-3">
        <div class="app-card app-card-chart h-100 shadow-sm">
            <div class="app-card-header p-3">
                <div class="align-items-center">
                    <div class="col-auto" style="text-align: center;">
                        <h3 class="app-card-title">Permintaan Selesai</h3>
                    </div>
                </div>
            </div>
            <div class="clearfix" style="margin-top:10px; margin-left:85px;">
                <div class="c100 p<?= count($requestDone_user); ?>">
                    <span><?= count($requestDone_user); ?>%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3 col-lg-3">
        <div class="app-card app-card-chart h-100 shadow-sm">
            <div class="app-card-header p-3">
                <div class="align-items-center">
                    <div class="col-auto" style="text-align: center;">
                        <h3 class="app-card-title">Permintaan Dalam Proses</h3>
                    </div>
                </div>
            </div>
            <div class="clearfix" style="margin-top:10px; margin-left:85px;">
                <div class="c100 p<?= count($requestProses_user); ?>">
                    <span><?= count($requestProses_user); ?>%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3 col-lg-3">
        <div class="app-card app-card-chart h-100 shadow-sm">
            <div class="app-card-header p-3">
                <div class="align-items-center">
                    <div class="col-auto" style="text-align: center;">
                        <h3 class="app-card-title">Permintaan Menunggu Persetujuan admin</h3>
                    </div>
                </div>
            </div>
            <div class="clearfix" style="margin-top:10px; margin-left:85px;">
                <div class="c100 p<?= count($requestAdmin_user); ?>">
                    <span><?= count($requestAdmin_user); ?>%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3 col-lg-3">
        <div class="app-card app-card-chart h-100 shadow-sm">
            <div class="app-card-header p-3">
                <div class="align-items-center">
                    <div class="col-auto" style="text-align: center;">
                        <h3 class="app-card-title">Permintaan Menunggu Persetujuan IT Support</h3>
                    </div>
                </div>
            </div>
            <div class="clearfix" style="margin-top:10px; margin-left:85px;">
                <div class="c100 p<?= count($requestITSupport_user); ?>">
                    <span><?= count($requestITSupport_user); ?>%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } else if ($levelUser == 'user(IT)') { ?>
    <div class="col-6 col-lg-3">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-1">Total Permintaan</h4>
                <div class="stats-figure"><?= $userRequest_itsupport; ?></div>
            </div>
        </div>
    </div>
    </div>
    <div class="row g-4 mb-4">
        <div class="col-3 col-lg-3">
            <div class="app-card app-card-chart h-100 shadow-sm">
                <div class="app-card-header p-3">
                    <div class="align-items-center">
                        <div class="col-auto" style="text-align: center;">
                            <h3 class="app-card-title">Permintaan Selesai</h3>
                        </div>
                    </div>
                </div>
                <div class="clearfix" style="margin-top:10px; margin-left:85px;">
                    <div class="c100 p<?= $requestDone_itsupport; ?>">
                        <span><?= $requestDone_itsupport; ?>%</span>
                        <div class="slice">
                            <div class="bar"></div>
                            <div class="fill"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3 col-lg-3">
            <div class="app-card app-card-chart h-100 shadow-sm">
                <div class="app-card-header p-3">
                    <div class="align-items-center">
                        <div class="col-auto" style="text-align: center;">
                            <h3 class="app-card-title">Permintaan Dalam Proses</h3>
                        </div>
                    </div>
                </div>
                <div class="clearfix" style="margin-top:10px; margin-left:85px;">
                    <div class="c100 p<?= $requestProses_itsupport; ?>">
                        <span><?= $requestProses_itsupport; ?>%</span>
                        <div class="slice">
                            <div class="bar"></div>
                            <div class="fill"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3 col-lg-3">
            <div class="app-card app-card-chart h-100 shadow-sm">
                <div class="app-card-header p-3">
                    <div class="align-items-center">
                        <div class="col-auto" style="text-align: center;">
                            <h3 class="app-card-title">Permintaan Menunggu Persetujuan admin</h3>
                        </div>
                    </div>
                </div>
                <div class="clearfix" style="margin-top:10px; margin-left:85px;">
                    <div class="c100 p<?= $requestAdmin_itsupport; ?>">
                        <span><?= $requestAdmin_itsupport; ?>%</span>
                        <div class="slice">
                            <div class="bar"></div>
                            <div class="fill"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3 col-lg-3">
            <div class="app-card app-card-chart h-100 shadow-sm">
                <div class="app-card-header p-3">
                    <div class="align-items-center">
                        <div class="col-auto" style="text-align: center;">
                            <h3 class="app-card-title">Permintaan Menunggu Persetujuan IT Support</h3>
                        </div>
                    </div>
                </div>
                <div class="clearfix" style="margin-top:10px; margin-left:85px;">
                    <div class="c100 p<?= $requestITSupport_itsupport; ?>">
                        <span><?= $requestITSupport_itsupport; ?>%</span>
                        <div class="slice">
                            <div class="bar"></div>
                            <div class="fill"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
</div>
<?= $this->endSection();  ?>