<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Nilai Mahasiswa</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>

<?php
    $nim = $_GET['nim'];
    $kode_mk = $_GET['kode_mk'];
    $nilai = $_GET['nilai'];

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    // Pastikan sesuai dengan alamat endpoint dari REST API
    curl_setopt($curl, CURLOPT_URL, 'http://localhost/UTS_PSAIT_2024/sait_db_api/sait_db_api.php?nim=' . $nim . '&kode_mk=' . $kode_mk);
    // var_dump($nim);
    // var_dump($kode_mk);
    // var_dump($nilai);
    $res = curl_exec($curl);
    $json = json_decode($res, true);
?>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Update Nilai Mahasiswa</h2>
                    </div>
                    <p>Please fill this form and submit to update student's score in the database.</p>
                    <form action="updateNilaiDo.php" method="POST">
                    <input type="hidden" name="nim" value="<?php echo $nim; ?>">
                    <input type="hidden" name="kode_mk" value="<?php echo $kode_mk; ?>">
                    <div class="form-group">
                        <label>Nilai</label>
                        <input type="text" name="nilai" class="form-control" value="<?php echo $nilai ?>">
                    </div>
                    <input type="submit" class="btn btn-primary" name="submit" value="submit">
                </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>