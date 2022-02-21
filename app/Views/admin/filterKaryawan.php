<?php $this->extend('layout/template'); ?>

<?= $this->section('content');  ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <h2 class="app-page-title">Cetak Seluruh Karyawan</h2>
    <a href="<?= base_url('/admin/karyawanPDF'); ?>" class="btn btn-info"><i class="fas fa-print"></i>Print</a>
    <br><br>
    <h2 class="app-page-title">Filter laporan Karyawan</h2>

    <form action="/admin/printKaryawanPDF/" method="POST" target="_blank">
        <div class="row">
            <div class="col-sm-4 pb-2">
                <label for="perusahaan" class="form-label">Perusahaan</label>
                <select class="form-control form-select <?= ($validation->hasError('perusahaan')) ? 'is-invalid' : ''; ?>" id="perusahaan" name="perusahaan" value="<?= old('perusahaan'); ?>">
                    <option selected></option>
                    <option value="BMB">BMB</option>
                    <option value="BMBBD">BMBBD</option>
                </select>
                <div class="invalid-feedback">
                    <?= $validation->getError('perusahaan'); ?>
                </div>
            </div>
            <div class="col-sm-4 pb-2">
                <label for="id_departemen" class="form-label">Departemen</label>
                <select class="form-control form-select <?= ($validation->hasError('id_departemen')) ? 'is-invalid' : ''; ?>" id="id_departemen" name="id_departemen" value="<?= old('id_departemen'); ?>">
                    <option selected></option>
                    <?php for ($i = 0; $i < $number1; $i++) { ?>
                        <option value="<?= $dataDepartemen[$i]->id; ?>"><?= $dataDepartemen[$i]->nama_departemen; ?></option>
                    <?php } ?>
                </select>
                <div class="invalid-feedback">
                    <?= $validation->getError('id_departemen'); ?>
                </div>
            </div>

        </div><br>
        <button type="submit" class="btn btn-info"><i class="fas fa-print"></i>Print</button>
    </form>


</div>
<?= $this->endSection();  ?>