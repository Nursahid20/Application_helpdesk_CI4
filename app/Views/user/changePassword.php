<?php $this->extend('layout/template'); ?>

<?= $this->section('content');  ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <h2 class="app-page-title">Ganti Password</h2>
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
            <form action="/ITSupport/savePassword/<?= $dataUser['id']; ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="row">
                    <div class="col-sm-12 pb-2">
                        <label for="nik_dan_nama" class="form-label">NIK dan Nama</label>
                        <input type="nik_dan_nama" class="form-control <?= ($validation->hasError('nik_dan_nama')) ? 'is-invalid' : ''; ?>" id="nik_dan_nama" name="nik_dan_nama" readonly value="<?= $dataUser['nik']; ?> - <?= $dataUser['nama']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nik_dan_nama'); ?>
                        </div>
                    </div>
                    <div class="col-sm-12 pb-2">
                        <label for="password" class="form-label">Password Baru</label>
                        <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" value="<?= $dataUser['nik']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('password'); ?>
                        </div>
                    </div>
                    <div class="col-sm-12 pb-2">
                        <label for="konfirmasi_password" class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control <?= ($validation->hasError('konfirmasi_password')) ? 'is-invalid' : ''; ?>" id="konfirmasi_password" name="konfirmasi_password" value="<?= old('konfirmasi_password'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('konfirmasi_password'); ?>
                        </div>
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection();  ?>