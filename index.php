<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Form input Recap Gaji Karyawan</title>
    <style>
        .container {
            max-width: 550px;
            margin: 0 auto;
        }

        .container-table {
            margin-right: 50px;
            margin-left: 50px;
        }
    </style>
</head>

<body>

</body>
<div class="container">
    <h1>Input Data Karyawan</h1>
    <form action="" method="post">
        <div class="form-group">
            <label for="nama">Nama :</label>
            <input type="text" class="form-control" id="nama" name="nama">
        </div>
        <div class="form-group">
            <label for="nip">NIP :</label>
            <input type="number" class="form-control" id="nip" name="nip">
        </div>
        <div class="form-group">
            <label for="status">Status :</label>
            <select class="form-control" name="status" id="status">
                <option value="" hidden>--Pilih Status--</option>
                <option value="menikah">Menikah</option>
                <option value="belum">Belum Menikah</option>
            </select>
        </div>
        <div class="form-group">
            <label for="anak">Jumlah Anak :</label>
            <input type="number" class="form-control" id="anak" name="anak">
        </div>
        <div class="form-group">
            <label for="grade">Grade :</label>
            <select class="form-control" name="grade" id="grade">
                <option value="" hidden>--Pilih Grade--</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>
        <div class="btn-group">
            <input type="submit" class="btn btn-primary" style="margin-right: 10px;" name="submit" value="Submit">
        </div>
    </form>
</div>

<!-- php -->
<?php
$name = "";
$nip = "";
$anak = "";
$t_anak = "";
$status = "";
$grade = "";

if (isset($_POST['submit'])) {
    $name = $_POST['nama'];
    $nip = $_POST['nip'];
    $anak = $_POST['anak'];
    $status = $_POST['status'];
    $grade = $_POST['grade'];
}

// gaji pokok
switch ($grade) {
    case 1:
        $gapok = 5000000;
        break;
    case 2:
        $gapok = 3500000;
        break;
    case 3:
        $gapok = 2500000;
        break;
    case 4:
        $gapok = 2000000;
        break;
    case 5:
        $gapok = 1000000;
        break;
    default:
        $gapok = 0;
        break;
}

//tunjangan istri atau suami
if ($status == 'menikah') {
    switch ($grade) {
        case 1:
            $pasangan = 1500000;
            break;
        case 2:
            $pasangan = 1050000;
            break;
        case 3:
            $pasangan = 750000;
            break;
        case 4:
            $pasangan = 600000;
            break;
        case 5:
            $pasangan = 300000;
            break;
        default:
            $pasangan = 0;
            break;
    }
} else {
    $pasangan = 0;
}

//tunjangan anak
if ($status == "menikah") {
    if ($anak <= 3) {
        switch ($grade) {
            case 1:
                $t_anak = 500000 * $anak;
                break;
            case 2:
                $t_anak = 350000 * $anak;
                break;
            case 3:
                $t_anak = 250000 * $anak;
                break;
            case 4:
                $t_anak = 200000 * $anak;
                break;
            case 5:
                $t_anak = 100000 * $anak;
                break;
            default:
                $t_anak = 0;
                break;
        }
    } else {
        switch ($grade) {
            case 1:
                $t_anak = 500000 * 3;
                break;
            case 2:
                $t_anak = 350000 * 3;
                break;
            case 3:
                $t_anak = 250000 * 3;
                break;
            case 4:
                $t_anak = 200000 * 3;
                break;
            case 5:
                $t_anak = 100000 * 3;
                break;
            default:
                $t_anak = 0;
                break;
        }
    }
} else {
    $t_anak = 0;
}

// tunjangan jabatan
switch ($grade) {
    case 1:
        $jabatan = 1000000;
        break;
    case 2:
        $jabatan = 700000;
        break;
    case 3:
        $jabatan = 500000;
        break;
    case 4:
        $jabatan = 400000;
        break;
    case 5:
        $jabatan = 200000;
        break;
    default:
        $jabatan = 0;
        break;
}

// tunjangan transport
switch ($grade) {
    case 1:
        $transport = 250000;
        break;
    case 2:
        $transport = 175000;
        break;
    case 3:
        $transport = 125000;
        break;
    case 4:
        $transport = 100000;
        break;
    case 5:
        $transport = 50000;
        break;
    default:
        $transport = 0;
        break;
}

// tunjangan makan
switch ($grade) {
    case 1:
        $makan = 150000;
        break;
    case 2:
        $makan = 105000;
        break;
    case 3:
        $makan = 75000;
        break;
    case 4:
        $makan = 60000;
        break;
    case 5:
        $makan = 30000;
        break;
    default:
        $makan = 0;
        break;
}

$jumlah_tunjangan = $pasangan + $t_anak + $jabatan + $transport + $makan;
$gaji_kotor = $jumlah_tunjangan + $gapok;
$taspen = $gaji_kotor * 5 / 100;
$asuransi = $gaji_kotor * 2 / 100;
$pajak = $gaji_kotor * 15 / 100;
$gaji_bersih = $gaji_kotor - ($taspen + $asuransi + $pajak);
?>


<!-- table -->
<div class="container-table">
    <table class="table table-bordered mt-5">
        <thead class="thead-dark">
            <tr>
                <th scope="col" rowspan="2" class="text-center" style="vertical-align: middle;">No</th>
                <th scope="col" rowspan="2" class="text-center" style="vertical-align: middle;">Nama</th>
                <th scope="col" rowspan="2" class="text-center" style="vertical-align: middle;">NIP</th>
                <th scope="col" rowspan="2" class="text-center" style="vertical-align: middle;">Status</th>
                <th scope="col" rowspan="2" class="text-center" style="vertical-align: middle;">Jumlah Anak</th>
                <th scope="col" rowspan="2" class="text-center" style="vertical-align: middle;">Grade</th>
                <th scope="col" rowspan="2" class="text-center" style="vertical-align: middle;">Gaji Pokok</th>
                <th scope="col" colspan="5" class="text-center" style="vertical-align: middle;">Tunjangan</th>
                <th scope="col" rowspan="2" class="text-center" style="vertical-align: middle;">Jumlah Tunjangan</th>
                <th scope="col" rowspan="2" class="text-center" style="vertical-align: middle;">Gaji Kotor</th>
                <th scope="col" class="text-center">Taspen</th>
                <th scope="col" class="text-center">Asuransi</th>
                <th scope="col" class="text-center">Pajak</th>
                <th scope="col" rowspan="2" class="text-center" style="vertical-align: middle;">Gaji Bersih</th>
            </tr>
            <tr>
                <th class="text-center">Istri/Suami</th>
                <th class="text-center">Anak</th>
                <th class="text-center">Jabatan</th>
                <th class="text-center">Transport</th>
                <th class="text-center">Uang Makan</th>
                <th class="text-center">5%</th>
                <th class="text-center">2%</th>
                <th class="text-center">15%</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td><?= $name ?></td>
                <td><?= $nip ?></td>
                <td><?= $status ?></td>
                <td><?= $anak ?></td>
                <td><?= $grade ?></td>
                <td><?= number_format($gapok, 0, ',', '.') ?></td>
                <td><?= number_format($pasangan, 0, ',', '.') ?></td>
                <td><?= number_format($t_anak, 0, ',', '.') ?></td>
                <td><?= number_format($jabatan, 0, ',', '.') ?></td>
                <td><?= number_format($transport, 0, ',', '.') ?></td>
                <td><?= number_format($makan, 0, ',', '.') ?></td>
                <td><?= number_format($jumlah_tunjangan, 0, ',', '.') ?></td>
                <td><?= number_format($gaji_kotor, 0, ',', '.') ?></td>
                <td><?= number_format($taspen, 0, ',', '.') ?></td>
                <td><?= number_format($asuransi, 0, ',', '.') ?></td>
                <td><?= number_format($pajak, 0, ',', '.') ?></td>
                <td><?= number_format($gaji_bersih, 0, ',', '.') ?></td>
            </tr>
        </tbody>
    </table>
</div>


</html>