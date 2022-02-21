<?php $this->extend('layout/template'); ?>

<?= $this->section('content');  ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <h2 class="app-page-title">Tambah User</h2>
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
            <form action="/admin/saveUser" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="row">
                    <div class="col-sm-6 pb-2">
                        <label for="nik_dan_nama" class="form-label">NIK dan Nama</label>
                        <select class="form-control form-select <?= ($validation->hasError('nik_dan_nama')) ? 'is-invalid' : ''; ?>" id="nik_dan_nama" name="nik_dan_nama">
                            <option selected></option>
                            <?php for ($i = 0; $i < $number1; $i++) { ?>
                                <option value="<?= $dataKaryawan[$i]['nik']; ?> - <?= $dataKaryawan[$i]['nama']; ?>"><?= $dataKaryawan[$i]['nik']; ?> - <?= $dataKaryawan[$i]['nama']; ?></option>
                            <?php } ?>
                            <?php for ($i = 0; $i < $number2; $i++) { ?>
                                <option value="<?= $dataITSupport[$i]['nik']; ?> - <?= $dataITSupport[$i]['nama']; ?>"><?= $dataITSupport[$i]['nik']; ?> - <?= $dataITSupport[$i]['nama']; ?></option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('nik_dan_nama'); ?>
                        </div>
                    </div>
                    <div class="col-sm-12 pb-2">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" value="<?= old('password'); ?>">
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
                    <div class="col-sm-12 pb-2">
                        <label for="level_user" class="form-label">Level User</label>
                        <select class="form-control form-select <?= ($validation->hasError('level_user')) ? 'is-invalid' : ''; ?>" id="level_user" name="level_user" value="<?= old('level_user'); ?>">
                            <option selected></option>
                            <option value="admin">admin</option>
                            <option value="user(Karyawan)">user(Karyawan)</option>
                            <option value="user(IT)">user(IT)</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('level_user'); ?>
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