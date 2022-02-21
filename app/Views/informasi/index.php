<?php $this->extend('layout/template'); ?>

<?= $this->section('content');  ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <h2 class="app-page-title">Data Informasi</h2>
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


            <a href="<?= base_url('/admin/addInformasi') ?>" class="btn btn-outline-success">
                <i class="fas fa-bullhorn"></i>
                Tambah Data Informasi
            </a>
            <br><br>
            <table id="example2" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th class="cell">No</th>
                        <th class="cell">Tanggal</th>
                        <th class="cell">Subject</th>
                        <th class="cell">Pesan</th>
                        <th class="cell">Dari</th>
                        <th class="cell">Dari</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for ($i = 0; $i < $number; $i++) { ?>
                        <tr>
                            <td><?php echo $i + 1; ?></td>
                            <td class="cell"><?= $data[$i]['tanggal']; ?></td>
                            <td class="cell"><?= $data[$i]['subject']; ?></td>
                            <td class="cell"><?= $data[$i]['pesan']; ?></td>
                            <td class="cell"><?= $data[$i]['dari']; ?></td>
                            <td class="cell">
                                <a href="<?= base_url('/admin/editInformasi/' . $data[$i]['id']) ?>" class="btn btn-outline-info" title="Edit"><i class="fa fa-edit"></i></a>
                                <form action="/admin/informasi/<?= $data[$i]['id']; ?>" method="post" class="d-inline">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-outline-danger" title="Hapus" onclick="return confirm('apakah anda yakin?')"><i class="far fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    <?php
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection();  ?>