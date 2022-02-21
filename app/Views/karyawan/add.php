<?php $this->extend('layout/template'); ?>

<?= $this->section('content');  ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <h2 class="app-page-title">Tambah Karyawan</h2>
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
            <form action="/admin/saveKaryawan" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="row pb-2">
                    <label for="foto_profile" class="form-label ml-3">Foto Profil</label>
                    <div class="col-sm-2">
                        <img src="/images/default.png" style="width: 140px; height: 160px;" class="img-thumbnail img-preview">
                    </div>
                    <div class="col-sm-4">
                        <input type="file" aria-label="Upload" class="form-control <?= ($validation->hasError('foto_profile')) ? 'is-invalid' : ''; ?>" onchange="previewImg()" id="foto_profile" name="foto_profile">
                        <div class="invalid-feedback">
                            <?= $validation->getError('foto_profile'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 pb-2">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" class="form-control <?= ($validation->hasError('nik')) ? 'is-invalid' : ''; ?>" id="nik" name="nik" value="<?= old('nik'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nik'); ?>
                        </div>
                    </div>
                    <div class="col-sm-4 pb-2">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?= old('email'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('email'); ?>
                        </div>
                    </div>
                    <div class="col-sm-4 pb-2">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" value="<?= old('nama'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama'); ?>
                        </div>
                    </div>
                    <div class="col-sm-4 pb-2">
                        <label for="tempat_lahir" class="form-label">Nomor telepon</label>
                        <input type="text" class="form-control <?= ($validation->hasError('no_telepon')) ? 'is-invalid' : ''; ?>" id="no_telepon" name="no_telepon" value="<?= old('no_telepon'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('no_telepon'); ?>
                        </div>
                    </div>
                    <div class="col-sm-4 pb-2">
                        <label for="jk" class="form-label">Jenis Kelamin</label>
                        <select class="form-control form-select <?= ($validation->hasError('jk')) ? 'is-invalid' : ''; ?>" id="jk" name="jk" value="<?= old('jk'); ?>">
                            <option selected></option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('jk'); ?>
                        </div>
                    </div>
                    <div class="col-sm-4 pb-2">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control <?= ($validation->hasError('tanggal_lahir')) ? 'is-invalid' : ''; ?>" id="tanggal_lahir" name="tanggal_lahir" value="<?= old('tanggal_lahir'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('tanggal_lahir'); ?>
                        </div>
                    </div>
                    <div class="col-sm-8 pb-2">
                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control <?= ($validation->hasError('tempat_lahir')) ? 'is-invalid' : ''; ?>" id="tempat_lahir" name="tempat_lahir" value="<?= old('tempat_lahir'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('tempat_lahir'); ?>
                        </div>
                    </div>
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
                    <div class="col-sm-6 pb-2">
                        <label for="id_departemen" class="form-label">Departemen</label>
                        <select class="form-control form-select <?= ($validation->hasError('id_departemen')) ? 'is-invalid' : ''; ?>" id="id_departemen" name="id_departemen" value="<?= old('id_departemen'); ?>">
                            <option selected></option>
                            <?php for ($i = 0; $i < $number1; $i++) { ?>
                                <option value="<?= $data1[$i]->id; ?>"><?= $data1[$i]->nama_departemen; ?></option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('id_departemen'); ?>
                        </div>
                    </div>
                    <div class="col-sm-6 pb-2">
                        <label for="id_jabatan" class="form-label">Jabatan</label>
                        <select class="form-control form-select <?= ($validation->hasError('id_jabatan')) ? 'is-invalid' : ''; ?>" id="id_jabatan" name="id_jabatan" value="<?= old('id_jabatan'); ?>">
                            <option selected></option>
                            <?php for ($i = 0; $i < $number; $i++) { ?>
                                <option value="<?= $data[$i]->id; ?>"><?= $data[$i]->nama_jabatan; ?></option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('id_jabatan'); ?>
                        </div>
                    </div>
                    <div class="col-sm-12 pb-2">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" id="alamat" name="alamat" value="<?= old('alamat'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('alamat'); ?>
                        </div>
                    </div>


                </div>

                <br>
                <button type="submit" class="btn btn-success">Tambah Data</button>
            </form>
        </div>
    </div>
</div>


<script>
    function previewImg() {
        const img = document.querySelector("#foto_profile");
        const imgShow = document.querySelector(".img-preview");


        const fileImg = new FileReader();
        fileImg.readAsDataURL(img.files[0]);

        fileImg.onload = function(e) {
            imgShow.src = e.target.result;
        }
    }
</script>
<?= $this->endSection();  ?>