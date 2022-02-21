<?php $this->extend('layout/template'); ?>

<?= $this->section('content');  ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <h2 class="app-page-title">Edit Informasi</h2>
    <?php if (session()->getFlashdata('pesan')) {  ?>
        <div class="alert alert-success" role="alert">
            <?=
            session()->getFlashdata('pesan');
            session()->remove('pesan');
            ?>
        </div>
    <?php } ?>
    <div class="app-card shadow-sm h-100">
        <div class="app-card-body p-3 p-lg-4">
            <form action="/admin/updateInformasi/<?= $data['id']; ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>

                <div class="row">
                    <?php
                    $date = $data['tanggal'];
                    $d = explode('-',  $date);
                    $hari = $d[2];
                    $bulan = $d[1];
                    $tahun = $d[0];
                    $monthNum = sprintf("%02s", $bulan);
                    $monthName = date("F", strtotime($monthNum));

                    $tanggal = $hari . " " . $monthName . " " . $tahun;
                    ?>
                    <div class="col-sm-6 pb-2">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="text" class="form-control" id="tanggal" readonly name="tanggal" value="<?= $tanggal; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('tanggal'); ?>
                        </div>
                    </div>
                    <div class="col-sm-6 pb-2">
                        <label for="dari" class="form-label">By</label>
                        <input type="text" class="form-control" id="dari" readonly name="dari" value="<?= $data['dari']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('dari'); ?>
                        </div>
                    </div>
                    <div class="col-sm-12 pb-2">
                        <label for="subject" class="form-label">Subject</label>
                        <input type="text" class="form-control <?= ($validation->hasError('subject')) ? 'is-invalid' : ''; ?>" id="subject" name="subject" value="<?= $data['subject']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('subject'); ?>
                        </div>
                    </div>
                    <div class="col-sm-12 pb-2">
                        <label for="pesan" class="form-label">Pesan</label>
                        <input type="text" class="form-control <?= ($validation->hasError('pesan')) ? 'is-invalid' : ''; ?>" id="pesan" name="pesan" value="<?= $data['pesan']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('pesan'); ?>
                        </div>
                    </div>
                </div>

                <br>
                <button type="submit" class="btn btn-success">Tambah Data</button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection();  ?>