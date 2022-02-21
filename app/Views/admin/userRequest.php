<?php $this->extend('layout/template'); ?>

<?= $this->section('content');  ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <h2 class="app-page-title">Manajemen Permintaan User</h2>
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

            <table id="example" class="stripe row-border order-coloumn table" style="width:100%">

                <thead>
                    <tr>
                        <th class="cell">Kode Permintaan</th>
                        <th class="cell">Tanggal</th>
                        <th class="cell">Level Urgensi</th>
                        <th class="cell">Jenis Permintaan</th>
                        <th class="cell">Nama Pemohon</th>
                        <th class="cell">nama_departemen</th>
                        <th class="cell">analisis</th>
                        <th class="cell">Status</th>
                        <th class="cell">Progress</th>
                        <th class="cell">Penilaian Pekerjaan</th>
                        <th class="cell">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for ($i = 0; $i < $number; $i++) { ?>
                        <tr>
                            <td class="cell"><?= $dataUser[$i]['kode_permintaan']; ?></td>
                            <td class="cell">
                                <?php
                                $d = explode('-',  $dataUser[$i]['created_at']);
                                $hari = $d[2];
                                $bulan = $d[1];
                                $tahun = $d[0];
                                $monthNum = sprintf("%02s", $bulan);
                                $monthName = date("F", strtotime($monthNum));

                                echo $tanggal = $hari . " " . $monthName . " " . $tahun;
                                ?>
                            </td>
                            <td class="cell"><?= $dataUser[$i]['prioritas']; ?></td>
                            <td class="cell"><?= $dataUser[$i]['kategori']; ?></td>
                            <td class="cell"><?= $dataUser[$i]['nama'] ?></td>
                            <td class="cell"><?= $dataUser[$i]['nama_departemen'] ?></td>
                            <td class="cell">
                                <?php if ($dataUser[$i]['analisis'] == 'Belum Ditanggapi') { ?>
                                    <a href="javascript:;" class='btn btn-danger respond' data-id="<?= $dataUser[$i]['id']; ?>" data-kode_permintaan="<?= $dataUser[$i]['kode_permintaan']; ?>" data-nama="<?= $dataUser[$i]['nama'] ?>" data-nama_departemen="<?= $dataUser[$i]['nama_departemen'] ?>" data-prioritas="<?= $dataUser[$i]['prioritas']; ?>" data-kategori="<?= $dataUser[$i]['kategori']; ?>" data-detail_masalah="<?= $dataUser[$i]['detail_masalah']; ?>" data-benefit="<?= $dataUser[$i]['benefit']; ?>" data-lampiran="<?= $dataUser[$i]['lampiran']; ?>" data-img_lampiran="<?= $dataUser[$i]['img_lampiran']; ?>" data-nama_it_support="<?= $dataUser[$i]['nama_it_support']; ?>" data-penilaian="<?= $dataUser[$i]['penilaian']; ?>" data-komentar="<?= $dataUser[$i]['komentar']; ?>" data-created_at="<?= $dataUser[$i]['created_at']; ?>" data-analisis="<?= $dataUser[$i]['analisis']; ?>" data-status="<?= $dataUser[$i]['status']; ?>" data-bs-toggle="modal" title="Tanggapi Sekarang" data-bs-target="#ModalRespond">Tanggapi</a>
                                <?php } else { ?>
                                    <a class="btn btn-outline-success">Selesai</a>
                                <?php } ?>
                            </td>
                            <td class="cell">
                                <?php if ($dataUser[$i]['status'] == 'Belum Ditanggapi') { ?>
                                    <a class="btn btn-outline-danger">Belum ditanggapi</a>
                                <?php } else if ($dataUser[$i]['status'] == 'Ditolak') { ?>
                                    <a class="btn btn-outline-danger">Ditolak</a>
                                <?php } else if ($dataUser[$i]['status'] == 'Selesai') { ?>
                                    <a class="btn btn-outline-success">Selesai</a>
                                <?php } else { ?>
                                    <a class="btn btn-outline-success">Diterima</a>
                                <?php } ?>
                            <td class="cell">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: <?= $dataUser[$i]['progress']; ?>%;" aria-valuenow="<?= $dataUser[$i]['progress']; ?>" aria-valuemin="0" aria-valuemax="100"><?= $dataUser[$i]['progress']; ?>%</div>
                                </div>
                            </td>
                            <td class="cell"><?= $dataUser[$i]['penilaian']; ?></td>
                            <td class="cell">
                                <a href="javascript:;" class='btn btn-outline-warning details' data-id="<?= $dataUser[$i]['id']; ?>" data-kode_permintaan="<?= $dataUser[$i]['kode_permintaan']; ?>" data-created_at="<?= $dataUser[$i]['created_at']; ?>" data-prioritas="<?= $dataUser[$i]['prioritas']; ?>" data-kategori="<?= $dataUser[$i]['kategori']; ?>" data-analisis="<?= $dataUser[$i]['analisis']; ?>" data-status="<?= $dataUser[$i]['status']; ?>" data-nama_departemen="<?= $dataUser[$i]['nama_departemen'] ?>" data-nama="<?= $dataUser[$i]['nama'] ?>" data-detail_masalah="<?= $dataUser[$i]['detail_masalah']; ?>" data-benefit="<?= $dataUser[$i]['benefit']; ?>" data-nama_it_support="<?= $dataUser[$i]['nama_it_support']; ?>" data-progress="<?= $dataUser[$i]['progress']; ?>" data-penilaian="<?= $dataUser[$i]['penilaian']; ?>" data-komentar="<?= $dataUser[$i]['komentar']; ?>" data-lampiran="<?= $dataUser[$i]['lampiran']; ?>" data-img_lampiran="<?= $dataUser[$i]['img_lampiran']; ?>" data-start_date="<?= $dataUser[$i]['start_date']; ?>" data-till_date="<?= $dataUser[$i]['till_date']; ?>" data-bs-toggle="modal" title="Details" data-bs-target="#ModalInfo"><i class="fas fa-info"></i></a>
                                <form action="/admin/userRequest/<?= $dataUser[$i]['id']; ?>" method="post" class="d-inline">
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
<div class="modal fade" id="ModalRespond" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
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
                                    <h4 class="text-right">Tanggapi Permintaan</h4>
                                </div>
                                <input type="hidden" name="id" id="id" value="">
                                <div class="row mt-2">
                                    <div class="col-md-4">
                                        <label for="id_it_support" class="form-label">Pilih IT Support</label>
                                        <select class="form-control form-select " id="id_it_support" name="id_it_support">
                                            <option selected></option>
                                            <?php for ($i = 0; $i < $number1; $i++) { ?>
                                                <option value=" <?= $data_staffit[$i]['id']; ?>"><?= $data_staffit[$i]['nama']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4"><label class="labels pb-2">Estimasti Waktu</label><input type="date" name="start_date" id="start_date" class="form-control" value="" placeholder=""></div>
                                    <div class="col-md-4"><label class="labels pb-2">Samapi Dengan</label><input type="date" name="till_date" id="till_date" class="form-control" value="" placeholder=""></div>
                                </div>
                                <br><br>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="text-right">Detail Permintaan</h4>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-md-4"><label class="labels">Kode Permintaan</label><input type="text" readonly name="kode_permintaan" id="kode_permintaan" class="form-control" value="" placeholder=""></div>
                                    <div class="col-md-4"><label class="labels">Nama Pengguna</label><input type="text" readonly name="nama" id="nama" class="form-control" value="" placeholder=""></div>
                                    <div class="col-md-4"><label class="labels">nama_departemen</label><input type="text" readonly name="nama_departemen" id="nama_departemen" class="form-control" value="" placeholder=""></div>
                                </div>
                                <div class="row mt-2">

                                    <div class="col-md-4"><label class="labels">Level Urgensi</label><input type="text" readonly name="prioritas" id="prioritas" class="form-control" value="" placeholder=""></div>
                                    <div class="col-md-4"><label class="labels">analisis</label><input type="text" readonly name="analisis" id="analisis" class="form-control" value="" placeholder=""></div>
                                    <div class="col-md-4"><label class="labels">Status</label><input type="text" readonly name="status" id="status" class="form-control" value="" placeholder=""></div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-4"><label class="labels">Jenis Permintaan</label><input type="text" readonly name="kategori" id="kategori" class="form-control" value="" placeholder=""></div>
                                    <div class="col-md-4"><label class="labels">Tanggal Permintaan</label><input type="text" readonly name="created_at" id="created_at" class="form-control" value="" placeholder=""></div>

                                </div>

                                <div class="row mt-2">
                                    <div class="col-md-12"><label class="labels">Uraian Kebutuhan</label><input type="text" readonly name="detail_masalah" id="detail_masalah" class="form-control" value="" placeholder=""></div>
                                    <div class="col-md-12"><label class="labels">Benefit</label><input type="text" readonly name="benefit" id="benefit" class="form-control" value="" placeholder=""></div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-md-4"><label class="labels">Lampiran</label><input type="text" readonly name="lampiran" id="lampiran" class="form-control" value="" placeholder=""></div>
                                    <div class="col-md-3">
                                        <div class="d-flex flex-column align-items-center text-center p-3 py-2">
                                            <img class="" width="180px" src="" name="img_lampiran" id="img_lampiran">
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" onclick="return confirm('apakah anda yakin sudah mengisi tanggapan?')" class="btn btn-primary" style="float: right;">Simpan Tanggapan</button>
                                <br>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalInfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="col-md-12">
                        <div class="p-3 py-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right">Detail Permintaan</h4>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-4"><label class="labels">Kode Permintaan</label><input type="text" readonly name="kode_permintaan" id="kode_permintaan" class="form-control" value="" placeholder=""></div>
                                <div class="col-md-4"><label class="labels">Nama Pengguna</label><input type="text" readonly name="nama" id="nama" class="form-control" value="" placeholder=""></div>
                                <div class="col-md-4"><label class="labels">nama_departemen</label><input type="text" readonly name="nama_departemen" id="nama_departemen" class="form-control" value="" placeholder=""></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-4"><label class="labels">IT Support</label><input type="text" readonly name="nama_it_support" id="nama_it_support" class="form-control" value="" placeholder=""></div>
                                <div class="col-md-4"><label class="labels">Jenis Permintaan</label><input type="text" readonly name="kategori" id="kategori" class="form-control" value="" placeholder=""></div>
                                <div class="col-md-4"><label class="labels">Level Urgensi</label><input type="text" readonly name="prioritas" id="prioritas" class="form-control" value="" placeholder=""></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-4"><label class="labels">Tanggal Permintaan</label><input type="text" readonly name="created_at" id="created_at" class="form-control" value="" placeholder=""></div>
                                <div class="col-md-4"><label class="labels">Estimasi Waktu</label><input type="text" readonly name="start_date" id="start_date" class="form-control" value="" placeholder=""></div>
                                <div class="col-md-4"><label class="labels">Sampai Dengan</label><input type="text" readonly name="till_date" id="till_date" class="form-control" value="" placeholder=""></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-4"><label class="labels">analisis</label><input type="text" readonly name="analisis" id="analisis" class="form-control" value="" placeholder=""></div>
                                <div class="col-md-4"><label class="labels">Status</label><input type="text" readonly name="status" id="status" class="form-control" value="" placeholder=""></div>
                                <div class="col-md-4"><label class="labels">Progress</label><input type="text" readonly name="progress" id="progress" class="form-control" value="" placeholder=""></div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-12"><label class="labels">Uraian Kebutuhan</label><input type="text" readonly name="detail_masalah" id="detail_masalah" class="form-control" value="" placeholder=""></div>
                                <div class="col-md-12"><label class="labels">Benefit</label><input type="text" readonly name="benefit" id="benefit" class="form-control" value="" placeholder=""></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-3"><label class="labels">Penilaian Pekerjaan</label><input type="text" readonly name="penilaian" id="penilaian" class="form-control" value="" placeholder=""></div>
                                <div class="col-md-9"><label class="labels">Komentar Penilaian User</label><input type="text" readonly name="komentar" id="komentar" class="form-control" value="" placeholder=""></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-4"><label class="labels">Lampiran</label><input type="text" readonly name="lampiran" id="lampiran" class="form-control" value="" placeholder=""></div>
                                <div class="col-md-3">
                                    <div class="d-flex flex-column align-items-center text-center p-3 py-2">
                                        <img class="" width="180px" src="" name="img_lampiran" id="img_lampiran">
                                    </div>
                                </div>
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
        // Untuk sunting

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


        $('#ModalRespond').on('show.bs.modal', function(event) {
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal = $(this)

            // Isi nilai pada field
            $('.modal-body form').attr('action', '/admin/saveRespond/' + div.data('id'));
            modal.find('#id').attr("value", div.data('id'));
            modal.find('#kode_permintaan').attr("value", div.data('kode_permintaan'));
            modal.find('#nama').attr("value", div.data('nama'));
            modal.find('#nama_departemen').attr("value", div.data('nama_departemen'));
            modal.find('#prioritas').attr("value", div.data('prioritas'));
            modal.find('#kategori').attr("value", div.data('kategori'));
            modal.find('#detail_masalah').attr("value", div.data('detail_masalah'));
            modal.find('#benefit').attr("value", div.data('benefit'));
            modal.find('#lampiran').attr("value", div.data('lampiran'));
            modal.find('#img_lampiran').attr("src", '/images/problem/' + div.data('img_lampiran'));

            modal.find('#created_at').attr("value", convertDate(div.data('created_at')));
            modal.find('#analisis').attr("value", div.data('analisis'));
            modal.find('#status').attr("value", div.data('status'));

        });

        $('#ModalInfo').on('show.bs.modal', function(event) {
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal = $(this)


            // Isi nilai pada field
            modal.find('#id').attr("value", div.data('id'));
            modal.find('#kode_permintaan').attr("value", div.data('kode_permintaan'));
            modal.find('#nama').attr("value", div.data('nama'));
            modal.find('#nama_departemen').attr("value", div.data('nama_departemen'));
            modal.find('#prioritas').attr("value", div.data('prioritas'));
            modal.find('#kategori').attr("value", div.data('kategori'));
            modal.find('#detail_masalah').attr("value", div.data('detail_masalah'));
            modal.find('#benefit').attr("value", div.data('benefit'));
            modal.find('#lampiran').attr("value", div.data('lampiran'));
            modal.find('#penilaian').attr("value", div.data('penilaian'));
            modal.find('#komentar').attr("value", div.data('komentar'));

            modal.find('#start_date').attr("value", convertDate(div.data('start_date')));
            modal.find('#till_date').attr("value", convertDate(div.data('till_date')));
            modal.find('#created_at').attr("value", convertDate(div.data('created_at')));

            modal.find('#nama_it_support').attr("value", div.data('nama_it_support'));
            modal.find('#analisis').attr("value", div.data('analisis'));
            modal.find('#status').attr("value", div.data('status'));
            modal.find('#progress').attr("value", div.data('progress'));
            modal.find('#img_lampiran').attr("src", '/images/problem/' + div.data('img_lampiran'));

        });

    });
</script>


<?= $this->endSection();  ?>