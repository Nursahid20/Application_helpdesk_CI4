<?php $this->extend('layout/template'); ?>

<?= $this->section('content');  ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <h2 class="app-page-title">Data Departemen</h2>

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
            <a href="<?= base_url('/admin/addDepartemen') ?>" class="btn btn-outline-success">
                <i class="fas fa-th-large"></i>
                Tambah Data Departemen
            </a>
            <br><br>
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th class="cell">Kode Departemen</th>
                        <th class="cell">Departemen</th>
                        <th class="cell" style="padding-left: 30px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($dataDepartemen as $dataDepartemen) { ?>
                        <tr>
                            <td class="cell"><?= $dataDepartemen['kode_departemen']; ?></td>
                            <td class="cell"><?= $dataDepartemen['nama_departemen']; ?></td>
                            <td class="cell">
                                <a href="<?= base_url('/admin/editDepartemen/' . $dataDepartemen['id']) ?>" class="btn btn-outline-info" title="Edit"><i class="fas fa-edit"></i></a>
                                <form action="/admin/departemen/<?= $dataDepartemen['id']; ?>" method="post" class="d-inline">
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