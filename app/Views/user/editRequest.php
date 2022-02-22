<?php $this->extend('layout/template'); ?>

<?= $this->section('content');  ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <h2 class="app-page-title">Edit Permintaan</h2>
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
            <form action="/user/updateRequest/<?= $request['id']; ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="old_image" id="old_image" value="<?= $request['img_lampiran']; ?>">

                <div class="row">
                    <div class="col-sm-6 pb-2">
                        <label for="kode_permintaan" class="form-label">Kode Permintaan</label>
                        <input type="text" class="form-control" id="kode_permintaan" readonly name="kode_permintaan" value="<?= $request['kode_permintaan']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('kode_permintaan'); ?>
                        </div>
                    </div>
                    <div class="col-sm-6 pb-2">
                        <label for="nama" class="form-label">Nama Pemohon</label>
                        <input type="text" class="form-control" id="nama" readonly name="nama" value="<?= $request['nama']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama'); ?>
                        </div>
                    </div>
                    <div class="col-sm-6 pb-2">
                        <label for="nama_departemen" class="form-label">Departemen</label>
                        <input type="text" class="form-control" readonly id="nama_departemen" name="nama_departemen" value="<?= $request['nama_departemen']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_departemen'); ?>
                        </div>
                    </div>
                    <div class="col-sm-6 pb-2">
                        <label for="id_kategori" class="form-label">Jenis Permintaan</label>
                        <select class="form-control form-select <?= ($validation->hasError('id_kategori')) ? 'is-invalid' : ''; ?>" id="id_kategori" name="id_kategori" value="">
                            <option selected disabled>Pilih Jenis Permintaan</option>
                            <?php foreach ($dataKategori as $j) : ?>
                                <?php if ($request['id_kategori'] == $j->id) : ?>
                                    <option selected value="<?= $j->id; ?>"><?= $j->kategori; ?></option>
                                <?php else : ?>
                                    <option value="<?= $j->id; ?>"><?= $j->kategori; ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('id_kategori'); ?>
                        </div>
                    </div>
                    <div class="col-sm-12 pb-2">
                        <label for="detail_masalah" class="form-label">Uraian Kebutuhan</label>
                        <input type="text" class="form-control <?= ($validation->hasError('detail_masalah')) ? 'is-invalid' : ''; ?>" id="detail_masalah" name="detail_masalah" value="<?= $request['detail_masalah']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('detail_masalah'); ?>
                        </div>
                    </div>
                    <div class="col-sm-12 pb-2">
                        <label for="benefit" class="form-label">Benefit</label>
                        <input type="text" class="form-control <?= ($validation->hasError('benefit')) ? 'is-invalid' : ''; ?>" id="benefit" name="benefit" value="<?= $request['benefit']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('benefit'); ?>
                        </div>
                    </div>
                    <div class="col-sm-4 pb-2">
                        <label for="id_lampiran" class="form-label">Lampiran</label>
                        <select class="form-control form-select <?= ($validation->hasError('id_lampiran')) ? 'is-invalid' : ''; ?>" id="id_lampiran" name="id_lampiran" value="">
                            <?php foreach ($dataLampiran as $j) : ?>
                                <?php if ($request['id_lampiran'] == $j->id) : ?>
                                    <option selected value="<?= $j->id; ?>"><?= $j->lampiran; ?></option>
                                <?php else : ?>
                                    <option value="<?= $j->id; ?>"><?= $j->lampiran; ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('id_lampiran'); ?>
                        </div>
                    </div>
                    <div class="col-sm-8 pb-2">
                        <div class="row">
                            <div class="col-5">
                                <label for="img_lampiran" class="form-label"> Lampiran Gambar (Optional)</label>
                                <input type="file" aria-label="Upload" class="form-control <?= ($validation->hasError('img_lampiran')) ? 'is-invalid' : ''; ?>" onchange="previewImg()" id="img_lampiran" name="img_lampiran">
                            </div>
                            <div class="col-3">
                                <img src="/images/problem/<?= $request['img_lampiran']; ?>" style="width: 140px; height: 160px;" class="img-thumbnail img-preview">
                            </div>
                            <div class="invalid-feedback">
                                <?= $validation->getError('img_lampiran'); ?>
                            </div>
                        </div>
                    </div>

                </div>

                <br>
                <button type="submit" class="btn btn-success">Simpan Data</button>
            </form>
        </div>
    </div>
</div>


<script>
    function previewImg() {
        const img = document.querySelector("#img_lampiran");
        const imgShow = document.querySelector(".img-preview");

        const fileImg = new FileReader();
        fileImg.readAsDataURL(img.files[0]);

        fileImg.onload = function(e) {
            imgShow.src = e.target.result;
        }
    }
</script>
<?= $this->endSection();  ?>