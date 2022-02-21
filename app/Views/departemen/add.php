<?php $this->extend('layout/template'); ?>

<?= $this->section('content');  ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <h2 class="app-page-title">Tambah Departemen</h2>
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
            <form action="/admin/saveDepartemen" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>

                <div class="row">
                    <div class="col-sm-3 pb-2">
                        <label for="kode_departemen" class="form-label">Kode Departemen</label>
                        <input type="text" class="form-control" id="kode_departemen" readonly name="kode_departemen" value="<?= $kodeDepartemen; ?>">
                    </div>
                    <div class="col-sm-12 pb-2">
                        <label for="nama_departemen" class="form-label">Nama Departemen</label>
                        <input type="text" class="form-control <?= ($validation->hasError('nama_departemen')) ? 'is-invalid' : ''; ?>" id="nama_departemen" name="nama_departemen" value="<?= old('nama_departemen'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_departemen'); ?>
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