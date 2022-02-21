<?php $this->extend('layout/template'); ?>

<?= $this->section('content');  ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <h2 class="app-page-title">Edit IT Support</h2>
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
            <form action="/admin/updateITSupport/<?= $dataITSupport['id']; ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" value="<?= $dataITSupport['foto_profile']; ?>" name="foto_profile_yang_dulu" id="foto_profile_yang_dulu">
                <div class="row pb-2">
                    <label for="foto_profile" class="form-label ml-3">Foto Profil</label>
                    <div class="col-sm-2">
                        <img src="/images/<?= $dataITSupport['foto_profile']; ?>" style="width: 140px; height: 160px;" class="img-thumbnail img-preview">
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
                        <input type="text" class="form-control <?= ($validation->hasError('nik')) ? 'is-invalid' : ''; ?>" id="nik" name="nik" value="<?= $dataITSupport['nik']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nik'); ?>
                        </div>
                    </div>
                    <div class="col-sm-4 pb-2">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?= $dataITSupport['email']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('email'); ?>
                        </div>
                    </div>
                    <div class="col-sm-4 pb-2">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" value="<?= $dataITSupport['nama']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama'); ?>
                        </div>
                    </div>
                    <div class="col-sm-4 pb-2">
                        <label for="tempat_lahir" class="form-label">Nomor telepon</label>
                        <input type="text" class="form-control <?= ($validation->hasError('no_telepon')) ? 'is-invalid' : ''; ?>" id="no_telepon" name="no_telepon" value="<?= $dataITSupport['no_telepon']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('no_telepon'); ?>
                        </div>
                    </div>
                    <div class="col-sm-4 pb-2">
                        <label for="jk" class="form-label">Jenis Kelamin</label>
                        <select class="form-control form-select <?= ($validation->hasError('jk')) ? 'is-invalid' : ''; ?>" id="jk" name="jk" value="<?= $dataITSupport['jk']; ?>">
                            <?php if ($dataITSupport['jk'] == 'Laki-laki') { ?>
                                <option selected><?= $dataITSupport['jk']; ?></option>
                                <option value="P">Perempuan</option>
                            <?php } else { ?>
                                <option selected><?= $dataITSupport['jk']; ?></option>
                                <option value="L">Laki-laki</option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('jk'); ?>
                        </div>
                    </div>
                    <div class="col-sm-4 pb-2">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control <?= ($validation->hasError('tanggal_lahir')) ? 'is-invalid' : ''; ?>" id="tanggal_lahir" name="tanggal_lahir" value="<?= $dataITSupport['tanggal_lahir']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('tanggal_lahir'); ?>
                        </div>
                    </div>
                    <div class="col-sm-8 pb-2">
                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control <?= ($validation->hasError('tempat_lahir')) ? 'is-invalid' : ''; ?>" id="tempat_lahir" name="tempat_lahir" value="<?= $dataITSupport['tempat_lahir']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('tempat_lahir'); ?>
                        </div>
                    </div>
                    <div class="col-sm-4 pb-2">
                        <label for="perusahaan" class="form-label">Perusahaan</label>
                        <select class="form-control form-select <?= ($validation->hasError('perusahaan')) ? 'is-invalid' : ''; ?>" id="perusahaan" name="perusahaan" value="<?= $dataITSupport['perusahaan']; ?>">
                            <?php if ($dataITSupport['perusahaan'] == 'BMB') { ?>
                                <option selected><?= $dataITSupport['perusahaan']; ?></option>
                                <option value="BMBBD">BMBBD</option>
                            <?php } else { ?>
                                <option selected><?= $dataITSupport['perusahaan']; ?></option>
                                <option value="BMB">BMB</option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('perusahaan'); ?>
                        </div>
                    </div>
                    <div class="col-sm-6 pb-2">
                        <label for="departemen" class="form-label">Departemen</label>
                        <input type="text" class="form-control" id="departemen" readonly name="departemen" value="<?= $dataITSupport['departemen']; ?>">
                    </div>
                    <div class="col-sm-6 pb-2">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <input type="text" class="form-control" id="jabatan" readonly name="jabatan" value="<?= $dataITSupport['jabatan']; ?>">
                    </div>
                    <div class="col-sm-12 pb-2">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" id="alamat" name="alamat" value="<?= $dataITSupport['alamat']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('alamat'); ?>
                        </div>
                    </div>


                </div>

                <br>
                <button type="submit" class="btn btn-success">Simpan</button>
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