<?php $this->extend('layout/template'); ?>

<?= $this->section('content');  ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <h2 class="app-page-title">Saran/Kritik Permintaan Karyawan</h2>
    <a href="<?= base_url('/itsupport/requestFeedbackPDF'); ?>" target="_blank" class="btn btn-outline-info"><i class="fas fa-print"></i></a>&nbsp Cetak Saran/Kritik Permintaan Karyawan
    <br><br><br>
    <h3 class="app-page-title">Filter laporan Saran/Kritik Permintaan Karyawan</h3>

    <form action="/itsupport/printRequestFeedbackPDF/" method="POST" target="_blank">
        <div class="row">
            <div class="col-sm-4 pb-2">
                <label for="bulan" class="form-label">Bulan</label>
                <select class="form-control form-select <?= ($validation->hasError('bulan')) ? 'is-invalid' : ''; ?>" id="bulan" name="bulan" value="<?= old('bulan'); ?>">
                    <option selected disabled>Pilih Bulan</option>
                    <option value="01">1</option>
                    <option value="02">2</option>
                    <option value="03">3</option>
                    <option value="04">4</option>
                    <option value="05">5</option>
                    <option value="06">6</option>
                    <option value="07">7</option>
                    <option value="08">8</option>
                    <option value="09">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>
                <div class="invalid-feedback">
                    <?= $validation->getError('bulan'); ?>
                </div>
            </div>
            <div class="col-sm-4 pb-2">
                <label for="tahun" class="form-label">Tahun</label>
                <select class="form-control form-select <?= ($validation->hasError('tahun')) ? 'is-invalid' : ''; ?>" id="tahun" name="tahun" value="<?= old('tahun'); ?>">
                    <option selected disabled>Pilih Tahun</option>
                    <?php
                    for ($i = date('Y'); $i >= date('Y') - 32; $i -= 1) {
                        echo "<option value='$i'> $i </option>";
                    }
                    ?>
                </select>
                <div class="invalid-feedback">
                    <?= $validation->getError('tahun'); ?>
                </div>
            </div>
            <div class="col-sm-4 pb-2">
                <button type="submit" class="btn btn-outline-info" style="margin-top: 30px; margin-left:10px;"><i class="fas fa-print"></i> Cetak</button>
            </div>
        </div><br>
    </form>


</div>
<?= $this->endSection();  ?>