<?php $this->extend('layout/template'); ?>

<?= $this->section('content');  ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <h2 class="app-page-title">Data Jabatan</h2>

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
            <a href="<?= base_url('/admin/addJabatan') ?>" class="btn btn-outline-success">
                <i class="fas fa-pen-nib"></i>
                Tambah Data Jabatan
            </a>
            <br><br>
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th class="cell">Kode Jabatan</th>
                        <th class="cell">Jabatan</th>
                        <th class="cell" style="padding-left: 30px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($dataJabatan as $dataJabatan) { ?>
                        <tr>
                            <td class="cell"><?= $dataJabatan['kode_jabatan']; ?></td>
                            <td class="cell"><?= $dataJabatan['nama_jabatan']; ?></td>
                            <td class="cell">
                                <a href="<?= base_url('/admin/editJabatan/' . $dataJabatan['id']) ?>" class="btn btn-outline-info" title="Edit"><i class="fas fa-edit"></i></a>
                                <form action="/admin/jabatan/<?= $dataJabatan['id']; ?>" method="post" class="d-inline">
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


<?= $this->endSection();  ?>