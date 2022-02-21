<?php $this->extend('layout/template'); ?>

<?= $this->section('content');  ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <div class="position-relative mb-3">
            <div class="row g-3 justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0">Informasi Baru</h1>
                </div>
            </div>
        </div>

        <?php foreach ($data as $data) { ?>
            <div class="app-card app-card-notification shadow-sm mb-4">
                <div class="app-card-header px-4 py-3">
                    <div class="row g-3 align-items-center">
                        <div class="col-12 col-lg-auto text-center text-lg-start">
                            <?php
                            $subject = substr($data['subject'], 0, 25);
                            if (strlen($data['subject']) <= 25) {
                            ?>
                                <h4 class="notification-title mb-1"><?= $subject; ?></h4>
                            <?php } else { ?>
                                <h4 class="notification-title mb-1"><?= $subject; ?> .....</h4>
                            <?php } ?>
                            <ul class="notification-meta list-inline mb-0">

                                <?php

                                switch ($data['selisih']) {
                                    case "0":
                                ?>
                                        <li class="list-inline-item">Today</li>
                                    <?php
                                        break;
                                    case "-1":
                                    ?>
                                        <li class="list-inline-item">Yesterday</li>
                                    <?php
                                        break;
                                    case "-2":
                                    ?>
                                        <li class="list-inline-item">Two day ago</li>
                                    <?php
                                        break;
                                    case "-3":
                                    ?>
                                        <li class="list-inline-item">Three day ago</li>
                                    <?php
                                        break;
                                    case "-4":
                                    ?>
                                        <li class="list-inline-item">Four day ago</li>
                                    <?php
                                        break;
                                    case "-5":
                                    ?>
                                        <li class="list-inline-item">Five day ago</li>
                                    <?php
                                        break;
                                    case "-6":
                                    ?>
                                        <li class="list-inline-item">Six day ago </li>
                                    <?php
                                        break;
                                    case "-7":
                                    ?>
                                        <li class="list-inline-item">One week ago</li>
                                    <?php
                                        break;
                                    default:
                                    ?>
                                        <li class="list-inline-item">One week ago</li>
                                <?php } ?>

                                <li class="list-inline-item">|</li>
                                <li class="list-inline-item"><?= $data['dari']; ?></li>
                            </ul>

                        </div>
                        <!--//col-->
                    </div>
                    <!--//row-->
                </div>
                <!--//app-card-header-->
                <div class="app-card-body p-4">
                    <?php
                    $pesan = substr($data['pesan'], 0, 450);
                    if (strlen($data['pesan']) <= 450) {
                    ?>
                        <div class="notification-content"><?= $pesan; ?></div>
                    <?php } else { ?>
                        <div class="notification-content"><?= $pesan; ?> .....</div>
                    <?php } ?>
                </div>
                <!--//app-card-body-->
                <div class="app-card-footer px-4 py-3">
                    <a class="action-link" href="#">View all<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right ms-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                        </svg></a>
                </div>
                <!--//app-card-footer-->
            </div>
            <!--//app-card-->
        <?php } ?>

    </div>
    <!--//container-fluid-->
</div>
<!--//app-content-->

<?= $this->endSection();  ?>