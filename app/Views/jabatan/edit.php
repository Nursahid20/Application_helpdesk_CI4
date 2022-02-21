<?php $this->extend('layout/template'); ?>

<?= $this->section('content');  ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <h2 class="app-page-title">Edit Jabatan</h2>
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
            <form action="/admin/updateJabatan/<?= $dataJabatan['id']; ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>

                <div class="row">
                    <div class="col-sm-3 pb-2">
                        <label for="kode_jabatan" class="form-label">Kode Jabatan</label>
                        <input type="text" class="form-control" id="kode_jabatan" readonly name="kode_jabatan" value="<?= $dataJabatan['kode_jabatan']; ?>">
                    </div>
                    <div class="col-sm-12 pb-2">
                        <label for="nama_jabatan" class="form-label">Nama Jabatan</label>
                        <input type="text" class="form-control <?= ($validation->hasError('nama_jabatan')) ? 'is-invalid' : ''; ?>" id="nama_jabatan" name="nama_jabatan" value="<?= $dataJabatan['nama_jabatan']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_jabatan'); ?>
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