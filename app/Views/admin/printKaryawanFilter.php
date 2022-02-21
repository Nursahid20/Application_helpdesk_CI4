<!DOCTYPE html>
<html lang="en">

<head>
    <title>Laporan Data Karyawan</title>
    <!-- App CSS -->

    <style type="text/css" media="print">
        @media print {
            @page {
                size: auto;
                margin: 0;
                size: landscape
            }

        }
    </style>

    <style type="text/css">
        body {
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        }

        hr {
            display: block;
            height: 1px;
            background: transparent;
            width: 100%;
            border: none;
            border-top: solid 1px #aaa;
        }

        .table-cetak2,
        .table-cetak2 tr,
        .table-cetak2 td,
        .table-cetak2 th {
            border: 1px solid #999;
            padding: 8px 10px;
            font-size: 13px;
            border-collapse: collapse;
        }

        .kop {
            line-height: 0px;
        }

        .kop-head1 {
            font-size: 20px;
            line-height: 15px;
        }

        .kop-head2 {
            margin-top: -10px;
            margin-bottom: -3px;
            font-size: 24px;
            font-weight: bold;
        }

        .kop3 {
            font-size: 13px;
            line-height: 6px;
        }

        table tr .text {
            text-align: center;
            font-size: 13px;
        }

        .ttd {
            width: 950;
            margin-left: 350px;
        }

        .top-text {
            width: 430px;
        }

        .text1 {
            line-height: 150px;
        }

        .text2 {
            line-height: 10px;
        }

        .text3 {
            line-height: 1px;
        }

        .laporan-judul {
            margin-top: 30px;
            margin-bottom: 30px;
            font-size: 16px;
        }
    </style>

</head>

<body style="padding-top: 15px;">
    <center>
        <div style="text-align: center">
            <img width="200px" height="84px" src="/images/bmb_logo.png">
            <h1 class="text2" style="font-weight: bold;">BMB BLOK DUA</h1>
            <h6 class="kop">Pualam Sari, Binuang, Kabupaten Tapin, Kalimantan Selatan 71183</h6>
            <h6 class="kop">https://www.bmbbd.com/</h6>
        </div>

        <hr>
        <h4 class="text3" style="font-weight: bold;">Laporan Data Karyawan</h4>

        <br>
        <table class="table-cetak2" width="95%" collspacing="0">
            <thead>
                <tr>
                    <th scope="coll">No</th>
                    <th scope="coll">NIK</th>
                    <th scope="coll">Nama</th>
                    <th scope="coll">Email</th>
                    <th scope="coll">Perusahaan</th>
                    <th scope="coll">Jabatan</th>
                    <th scope="coll">Departemen</th>
                    <th scope="coll">No Telepon</th>
                    <th scope="coll">Tempat Lahir</th>
                    <th scope="coll">Tanggal Lahir</th>
                    <th scope="coll">Jenis Kelamin</th>
                    <th scope="coll">Alamat</th>
                    <th scope="coll">Foto</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=0;
                foreach ($dataKaryawan as $dataKaryawan) { ?>
                    <tr>
                        <td><?= $i + 1; ?></td>
                        <td><?= $dataKaryawan['nik']; ?></td>
                        <td><?= $dataKaryawan['nama']; ?></td>
                        <td><?= $dataKaryawan['email']; ?></td>
                        <td><?= $dataKaryawan['perusahaan']; ?></td>
                        <td><?= $dataKaryawan['nama_jabatan']; ?></td>
                        <td><?= $dataKaryawan['nama_departemen']; ?></td>
                        <td><?= $dataKaryawan['no_telepon']; ?></td>
                        <td><?= $dataKaryawan['tempat_lahir']; ?></td>
                        <td>
                            <?php
                            $d = explode('-',  $dataKaryawan['tanggal_lahir']);
                            $hari = $d[2];
                            $bulan = $d[1];
                            $tahun = $d[0];
                            $monthNum = sprintf("%02s", $bulan);
                            $monthName = date("F", strtotime($monthNum));

                            echo $tanggal = $hari . " " . $monthName . " " . $tahun;
                            ?>
                        </td>
                        <td><?= $dataKaryawan['jk']; ?></td>
                        <td><?= $dataKaryawan['alamat']; ?></td>
                        <td>
                            <img src="/images/<?= $dataKaryawan['foto_profile']; ?>" style="width: 50px; height: 60px;">
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <br><br>
        <table class="ttd">
            <tr>
                <td class="top-text"></td>
                <td class="text">
                    <p class="text1">Kepala IT SUPPORT</p>
                    <p class="text2">Bapak Angga Saputra</p>
                    <p class="text3">18630101</p>
                </td>
            </tr>
        </table>

    </center>
    <script>
        window.print();
    </script>
</body>

</html>