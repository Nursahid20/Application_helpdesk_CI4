<?php $this->extend('layout/template'); ?>

<?= $this->section('content');  ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <h2 class="app-page-title">Data Prioritas</h2>

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
            <a href="javascript:;" class='btn btn-success' data-id="" data-bs-toggle="modal" title="Add" data-bs-target="#ModalAdd"><i class="fa fa-plus"></i> Tambah Prioritas</a>
            <br><br>
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th class="cell">No</th>
                        <th class="cell">Prioritas</th>
                        <th class="cell" style="padding-left: 30px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($dataPrioritas as $dataPrioritas) { ?>
                        <tr>
                            <td class="cell"><?= $i + 1; ?></td>
                            <td class="cell"><?= $dataPrioritas['prioritas']; ?></td>
                            <td class="cell">
                                <a href="javascript:;" class='btn btn-outline-info' data-id="<?= $dataPrioritas['id']; ?>" data-prioritas="<?= $dataPrioritas['prioritas']; ?>" data-bs-toggle="modal" title="Edit" data-bs-target="#ModalEdit"><i class="fa fa-edit"></i></a>
                                <form action="/admin/prioritas/<?= $dataPrioritas['id']; ?>" method="post" class="d-inline">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-outline-danger" title="Hapus" onclick="return confirm('apakah anda yakin?')"><i class="far fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    <?php $i++;
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalEdit" tabindex="-1" aria-labelledby="exampleModalLabe2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
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
                                    <h4 style="text-align: center;">Edit Prioritas</h4>
                                </div>
                                <div class="col-sm-12 pb-2">
                                    <label for="prioritas" class="form-label">Prioritas</label>
                                    <input type="text" class="form-control" id="prioritas" name="prioritas">
                                </div>
                                <br>

                                <button type="submit" class="btn btn-success">Simpan</button>
                                <br>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalAdd" tabindex="-1" aria-labelledby="exampleModalLabe2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
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
                                    <h4 style="text-align: center;">Tambah Prioritas</h4>
                                </div>
                                <div class="col-sm-12 pb-2">
                                    <label for="prioritas" class="form-label">Prioritas</label>
                                    <input type="text" class="form-control" id="prioritas" name="prioritas">
                                </div>
                                <br>

                                <button type="submit" class="btn btn-success">Simpan</button>
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

        $('#ModalAdd').on('show.bs.modal', function(event) {
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal = $(this)
            $('.modal-body form').attr('action', '/admin/savePrioritas');

        });
        $('#ModalEdit').on('show.bs.modal', function(event) {
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal = $(this)
            $('.modal-body form').attr('action', '/admin/updatePrioritas/' + div.data('id'));
            modal.find('#prioritas').attr("value", div.data('prioritas'));

        });

    });
</script>

<?= $this->endSection();  ?>