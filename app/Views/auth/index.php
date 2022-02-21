<?php
if (session()->get('logged_in') == TRUE) {
    header("location:" . base_url('/'));
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login | BMBBD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body style="background-image: url(/images/white.jpg); background-size: cover;">
    <div class="col d-flex justify-content-center">
        <div class="card  border-light" style="margin-top: 115px; padding:12px; width: 420px; height :420px; background: #FBFBFA; box-shadow: 0px 0px 25px 10px #EDEDEC; border-radius: 15px;">
            <div class="card-body">
                <img width="200px" height="84px" style="margin-left:90px;" src="/images/bmb_logo.png" alt="logo">
                <br>
                <h2 style="text-align:center;">Login</h2>

                <?php if (session()->getFlashdata('pesan')) {  ?>
                    <div class="alert alert-danger" style="height: 30px; font-size:15px; padding-top: 5px" role="alert">
                        <?=
                        session()->getFlashdata('pesan');
                        session()->remove('pesan');
                        ?>
                    </div>
                <?php } ?>
                <form action="/auth/login" method="post">
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" class="form-control" name="nik" id="nik" autocomplete="on" autofocus>
                    </div><br>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <br>
                    <button type="submit" name="submit" class="btn btn-success" style="float: right;">Masuk</button>
                </form>
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>