<?php $this->extend('layout/template'); ?>

<?= $this->section('content');  ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <h2 class="app-page-title">Data Karyawan</h2>
    <div class="app-card shadow-sm h-100">
        <div class="app-card-body p-3 p-lg-4">
            <?php if (session()->getFlashdata('pesan')) {  ?>
                <div class="alert alert-success" role="alert">
                    <?=
                    session()->getFlashdata('pesan');
                    session()->remove('pesan');
                    ?>
                </div>
            <?php } ?>


            <a href="<?= base_url('/admin/addKaryawan') ?>" class="btn btn-outline-success">
                <i class="fas fa-user-tie"></i>
                Tambah Data Karyawan
            </a>
            <br><br>
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th class="cell">Nik</th>
                        <th class="cell">Nama</th>
                        <th class="cell">Email</th>
                        <th class="cell">No telepon</th>
                        <th class="cell">Jabatan</th>
                        <th class="cell">Departemen</th>
                        <th class="cell">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for ($i = 0; $i < $number; $i++) { ?>
                        <tr>
                            <td class="cell"><?= $data[$i]['nik']; ?></td>
                            <td class="cell"><?= $data[$i]['nama']; ?></td>
                            <td class="cell"><?= $data[$i]['email']; ?></td>
                            <td class="cell"><?= $data[$i]['no_telepon']; ?></td>
                            <td class="cell"><?= $data[$i]['nama_jabatan']; ?></td>
                            <td class="cell"><?= $data[$i]['nama_departemen']; ?></td>
                            <td class="cell">
                                <a href="javascript:;" class='btn btn-outline-warning details' data-id="<?php echo $data[$i]['id']; ?>" data-nik="<?php echo $data[$i]['nik']; ?>" data-email="<?php echo $data[$i]['email']; ?>" data-nama="<?php echo $data[$i]['nama']; ?>" data-tanggal_lahir="<?php echo $data[$i]['tanggal_lahir']; ?>" data-tempat_lahir="<?php echo $data[$i]['tempat_lahir']; ?>" data-no_telepon="<?php echo $data[$i]['no_telepon']; ?>" data-jk="<?php echo $data[$i]['jk']; ?>" data-perusahaan="<?php echo $data[$i]['perusahaan']; ?>" data-nama_departemen="<?php echo $data[$i]['nama_departemen']; ?>" data-nama_jabatan="<?php echo $data[$i]['nama_jabatan']; ?>" data-alamat="<?php echo $data[$i]['alamat']; ?>" data-foto_profile="<?php echo $data[$i]['foto_profile']; ?>" data-bs-toggle="modal" title="Details" data-bs-target="#ModalInfo" data-id="<?= $data[$i]['id']; ?>"><i class="fas fa-info"></i></a>
                                <a href="<?= base_url('/admin/editKaryawan/' . $data[$i]['id']) ?>" class="btn btn-outline-info" title="Edit"><i class="fa fa-edit"></i></a>
                                <form action="/admin/karyawan/<?= $data[$i]['id']; ?>" method="post" class="d-inline">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-outline-danger" title="Hapus" onclick="return confirm('apakah anda yakin?')"><i class="far fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="ModalInfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-3 border-right">
                        <div class="d-flex flex-column align-items-center text-center p-3 py-2">
                            <img class="circle mt-5" width="150px" src="" name="foto_profile" id="foto_profile">
                            <span class="font-weight-bold" id="nama">

                            </span>
                            <span class="text-black-50" id="email">

                            </span>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="p-3 py-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right">Detail Profile</h4>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <label class="labels">NIK</label>
                                    <input type="text" readonly name="nik" id="nik" class="form-control" placeholder="" value="">
                                </div>
                                <div class="col-md-4">
                                    <label class="labels">Nomor Telepon</label>
                                    <input type="text" readonly name="no_telepon" id="no_telepon" class="form-control" placeholder="" value="">
                                </div>
                                <div class="col-md-4">
                                    <label class="labels">perusahaan</label>
                                    <input type="text" readonly name="perusahaan" id="perusahaan" class="form-control" value="" placeholder="">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <label class="labels">Jenis Kelamin</label>
                                    <input type="text" readonly name="jk" id="jk" class="form-control" value="" placeholder="">
                                </div>
                                <div class="col-md-4">
                                    <label class="labels">Tempat Lahir</label>
                                    <input type="text" readonly name="tempat_lahir" id="tempat_lahir" class="form-control" placeholder="" value="">
                                </div>
                                <div class="col-md-4">
                                    <label class="labels">Tanggal Lahir</label>
                                    <input type="text" readonly name="tanggal_lahir" id="tanggal_lahir" class="form-control" placeholder="" value="">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">Jabatan</label>
                                    <input type="text" readonly name="nama_jabatan" id="nama_jabatan" class="form-control" placeholder="" value="">
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">Departemen</label>
                                    <input type="text" readonly name="nama_departemen" id="nama_departemen" class="form-control" value="" placeholder="">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12"><label class="labels">alamat</label><input type="text" readonly name="alamat" id="alamat" class="form-control" value="" placeholder=""></div>
                            </div>
                            <div class="row mt-2">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        function convertDate(tanggal) {
            // contoh : 2019-01-30

            bulanIndo = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

            t = tanggal.split("-");

            if (t[2] == '00') {
                return "-";
            } else {

                hari = t[2];
                bulan = parseInt(t[1]);
                tahun = t[0];
                var namaBulan = bulanIndo[bulan];

                return hari + " " + namaBulan + " " + tahun;
            }
        }
        // Untuk sunting
        $('#ModalInfo').on('show.bs.modal', function(event) {
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal = $(this)

            // Isi nilai pada field
            modal.find('#id').attr("value", div.data('id'));
            modal.find('#foto_profile').attr("src", '/images/' + div.data('foto_profile'));
            modal.find('#nama').text(div.data('nama'));
            modal.find('#email').text(div.data('email'));
            modal.find('#jk').attr("value", div.data('jk'));
            modal.find('#tanggal_lahir').attr("value", convertDate(div.data('tanggal_lahir')));
            modal.find('#tempat_lahir').attr("value", div.data('tempat_lahir'));
            modal.find('#no_telepon').attr("value", div.data('no_telepon'));
            modal.find('#perusahaan').attr("value", div.data('perusahaan'));
            modal.find('#nama_jabatan').attr("value", div.data('nama_jabatan'));
            modal.find('#nama_departemen').attr("value", div.data('nama_departemen'));
            modal.find('#alamat').attr("value", div.data('alamat'));
            modal.find('#nik').attr("value", div.data('nik'));
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Untuk sunting
        $('#formModal').on('show.bs.modal', function(event) {
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal = $(this)

            // Isi nilai pada field
            modal.find('#nama').attr("value", div.data('nama'));
            modal.find('#npm').attr("value", div.data('npm'));
            modal.find('#email').attr("value", div.data('email'));
            modal.find('#jurusan').attr("value", div.data('jurusan'));
        });
    });
</script>


<?= $this->endSection();  ?>