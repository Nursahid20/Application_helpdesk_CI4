<?php $this->extend('layout/template'); ?>

<?= $this->section('content');  ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <h2 class="app-page-title">Account</h2>
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
            <form action="/admin/updateAccount/<?= $dataKaryawan['id']; ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" value="<?= $dataKaryawan['foto_profile']; ?>" name="foto_profile_yang_dulu" id="foto_profile_yang_dulu">
                <div class="row pb-2">
                    <label for="foto_profile" class="form-label ml-3">Foto Profil</label>
                    <div class="col-sm-2">
                        <img src="/images/<?= $dataKaryawan['foto_profile']; ?>" style="width: 140px; height: 160px;" class="img-thumbnail img-preview">
                    </div>
                    <div class="col-sm-4">
                        <input type="file" aria-label="Upload" style="display: none;" class="form-control <?= ($validation->hasError('foto_profile')) ? 'is-invalid' : ''; ?>" onchange="previewImg()" id="foto_profile" name="foto_profile">
                        <div class="invalid-feedback">
                            <?= $validation->getError('foto_profile'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 pb-2">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" class="form-control <?= ($validation->hasError('nik')) ? 'is-invalid' : ''; ?>" readOnly id="nik" name="nik" value="<?= $dataKaryawan['nik']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nik'); ?>
                        </div>
                    </div>
                    <div class="col-sm-4 pb-2">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" readOnly id="email" name="email" value="<?= $dataKaryawan['email']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('email'); ?>
                        </div>
                    </div>
                    <div class="col-sm-4 pb-2">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" readOnly id="nama" name="nama" value="<?= $dataKaryawan['nama']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama'); ?>
                        </div>
                    </div>
                    <div class="col-sm-4 pb-2">
                        <label for="tempat_lahir" class="form-label">Nomor telepon</label>
                        <input type="text" class="form-control <?= ($validation->hasError('no_telepon')) ? 'is-invalid' : ''; ?>" readOnly id="no_telepon" name="no_telepon" value="<?= $dataKaryawan['no_telepon']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('no_telepon'); ?>
                        </div>
                    </div>
                    <div class="col-sm-4 pb-2">
                        <label for="jk" class="form-label">Jenis Kelamin</label>
                        <select disabled class="form-control  <?= ($validation->hasError('jk')) ? 'is-invalid' : ''; ?>" readOnly id="jk" name="jk" value="<?= $dataKaryawan['jk']; ?>">
                            <?php if ($dataKaryawan['jk'] == 'Laki-laki') { ?>
                                <option selected><?= $dataKaryawan['jk']; ?></option>
                                <option value="P">Perempuan</option>
                            <?php } else { ?>
                                <option selected><?= $dataKaryawan['jk']; ?></option>
                                <option value="L">Laki-laki</option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('jk'); ?>
                        </div>
                    </div>
                    <div class="col-sm-4 pb-2">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control <?= ($validation->hasError('tanggal_lahir')) ? 'is-invalid' : ''; ?>" readOnly id="tanggal_lahir" name="tanggal_lahir" value="<?= $dataKaryawan['tanggal_lahir']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('tanggal_lahir'); ?>
                        </div>
                    </div>
                    <div class="col-sm-8 pb-2">
                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control <?= ($validation->hasError('tempat_lahir')) ? 'is-invalid' : ''; ?>" readOnly id="tempat_lahir" name="tempat_lahir" value="<?= $dataKaryawan['tempat_lahir']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('tempat_lahir'); ?>
                        </div>
                    </div>
                    <div class="col-sm-4 pb-2">
                        <label for="perusahaan" class="form-label">Perusahaan</label>
                        <input type="text" class="form-control <?= ($validation->hasError('perusahaan')) ? 'is-invalid' : ''; ?>" readOnly id="perusahaan" name="perusahaan" value="<?= $dataKaryawan['perusahaan']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('perusahaan'); ?>
                        </div>
                    </div>
                    <div class="col-sm-6 pb-2">
                        <label for="id_departemen" class="form-label">Departemen</label>
                        <input type="text" class="form-control <?= ($validation->hasError('id_departemen')) ? 'is-invalid' : ''; ?>" readOnly id="id_departemen" name="id_departemen" value="<?= $dataKaryawan['nama_departemen']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('id_departemen'); ?>
                        </div>
                    </div>
                    <div class="col-sm-6 pb-2">
                        <label for="id_jabatan" class="form-label">Jabatan</label>
                        <input type="text" class="form-control <?= ($validation->hasError('id_jabatan')) ? 'is-invalid' : ''; ?>" readOnly id="id_jabatan" name="id_jabatan" value="<?= $dataKaryawan['nama_jabatan']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('id_jabatan'); ?>
                        </div>
                    </div>
                    <div class="col-sm-12 pb-2">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" readOnly id="alamat" name="alamat" value="<?= $dataKaryawan['alamat']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('alamat'); ?>
                        </div>
                    </div>
                    <br>
                </div>
                <br>

                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                    <label class="form-check-label" for="flexSwitchCheckChecked">Edit</label>
                </div>
                <button type="submit" id="save" style="display: none;" class="btn btn-success">Simpan</button>
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

    $("#flexSwitchCheckChecked").on('change', function() {
        if ($(this).is(':checked')) {
            $(this).attr('value', 'true');
            $("#foto_profile").show();
            $("#save").show();
            $("#jk").addClass('form-select');
            $("#jk").removeAttr('disabled');
            $("#nik").removeAttr('readonly');
            $("#nama").removeAttr('readonly');
            $("#email").removeAttr('readonly');
            $("#no_telepon").removeAttr('readonly');
            $("#jk").removeAttr('readonly');
            $("#tanggal_lahir").removeAttr('readonly');
            $("#tempat_lahir").removeAttr('readonly');
            $("#alamat").removeAttr('readonly');
            $("#alamat").removeAttr('readonly');
        } else {
            $(this).attr('value', 'false');
            $("#foto_profile").hide();
            $("#save").hide();
            $("#alamat").attr('readonly', true);
            $("#nik").attr('readonly', true);
            $("#nama").attr('readonly', true);
            $("#email").attr('readonly', true);
            $("#no_telepon").attr('readonly', true);
            $("#jk").attr('readonly', true);
            $("#tanggal_lahir").attr('readonly', true);
            $("#tempat_lahir").attr('readonly', true);
            $("#jk").removeClass('form-select');
        }
    });
</script>
<?= $this->endSection();  ?>