<!DOCTYPE html>
<html lang="en">

<head>
    <title>Laporan Data User</title>
    <!-- App CSS -->

    <style type="text/css" media="print">
        @media print {
            @page {
                size: auto;
                margin: 0;
                size: portrait
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
            margin-left: 150px;
        }

        .top-text {
            width: 430px;
        }

        .text1 {
            line-height: 100px;
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
            <h1 style="font-weight: bold; line-height: 10px;">BMB BLOK DUA</h1>
            <h6 class="kop">Pualam Sari, Binuang, Kabupaten Tapin, Kalimantan Selatan 71183</h6>
            <h6 class="kop">https://www.bmbbd.com/</h6>
        </div>

        <hr>
        <h4 style="font-weight: bold; line-height: 1px;">Laporan Data User</h4>

        <br>
        <table class="table-cetak2" width="95%" collspacing="0">
            <thead>
                <tr>
                    <th scope="coll">No</th>
                    <th scope="coll">NIK</th>
                    <th scope="coll">Nama</th>
                    <th scope="coll">Level Pengguna</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < $number; $i++) { ?>
                    <tr>
                        <td><?= $i + 1; ?></td>
                        <td><?= $dataUser[$i]['nik']; ?></td>
                        <td><?= $dataUser[$i]['nama']; ?></td>
                        <td>
                            <?php if ($dataUser[$i]['level_user'] == 'user(Employe)') { ?>
                                <?= 'Karyawan'; ?>
                            <?php } else if ($dataUser[$i]['level_user'] == 'user(IT)') { ?>
                                <?= 'IT Suport'; ?>
                            <?php } else { ?>
                                <?= $dataUser[$i]['level_user']; ?>
                            <?php } ?>
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