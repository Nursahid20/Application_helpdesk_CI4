<?php $this->extend('layout/template'); ?>

<?= $this->section('content');  ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <h2 class="app-page-title">Data User</h2>

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
            <a href="<?= base_url('/admin/addUser') ?>" class="btn btn-outline-success">
                <i class="fas fa-users"></i>
                Tambah Data User
            </a>
            <br><br>
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th class="cell">Nik</th>
                        <th class="cell">Nama</th>
                        <th class="cell">Level User</th>
                        <th class="cell">Tanggal Dibuat</th>
                        <th class="cell">Tanggal Diubah</th>
                        <th class="cell" style="padding-left: 30px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for ($i = 0; $i < $number; $i++) { ?>
                        <tr>
                            <td class="cell"><?= $data[$i]['nik']; ?></td>
                            <td class="cell"><?= $data[$i]['nama']; ?></td>
                            <td class="cell"><?= $data[$i]['level_user']; ?></td>
                            <td class="cell"><?= $data[$i]['created_at']; ?></td>
                            <td class="cell"><?= $data[$i]['updated_at']; ?></td>
                            <td class="cell">
                                <a href="javascript:;" class='btn  btn-outline-info edit' data-id="<?= $data[$i]['id']; ?>" data-nik="<?= $data[$i]['nik']; ?>" data-nama="<?= $data[$i]['nama']; ?>" data-level_users="<?= $data[$i]['level_user']; ?>" data-bs-toggle="modal" title="Edit Level User" data-bs-target="#ModalEdit"><i class="fa fa-edit"></i></a>
                                <a href="<?= base_url('/admin/changePasswordUser/' . $data[$i]['id']) ?>" class="btn btn-outline-danger" title="Ganti Password"><i class="fas fa-key"></i></a>
                                <form action="/admin/user/<?= $data[$i]['id']; ?>" method="post" class="d-inline">
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


<div class="modal fade" id="ModalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="p-3 py-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="text-right" style="text-align: center;">Edit Level User</h4>
                                </div>
                                <input type="hidden" name="id" id="id" value="">

                                <div class="row mt-2">
                                    <div class="col-md-12 mb-2"><label class="labels">NIK</label><input type="text" readonly name="nik" id="nik" class="form-control" value="" placeholder=""></div>
                                    <div class="col-md-12 mb-2"><label class="labels">Nama</label><input type="text" readonly name="nama" id="nama" class="form-control" value="" placeholder=""></div>
                                    <div class="col-md-12 mb-2">
                                        <label class="labels">Level User</label>
                                        <select class="form-control form-select" id="level_user" name="level_user">
                                            <option selected>
                                                <div id="level_users"></div>
                                            </option>
                                            <option value="admin">admin</option>
                                            <option value="user(IT)">user(IT)</option>
                                            <option value="user(Karyawan)">user(Karyawan)</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary" style="float: right;">Simpan</button>
                                <br>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        $('#ModalEdit').on('show.bs.modal', function(event) {
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal = $(this)

            // Isi nilai pada field
            $('.modal-body form').attr('action', '/admin/editUser/' + div.data('id'));
            modal.find('#nik').attr("value", div.data('nik'));
            modal.find('#nama').attr("value", div.data('nama'));
            modal.find('#level_users').attr("value", div.data('level_users'));
        });
    });
</script>

<?= $this->endSection();  ?>