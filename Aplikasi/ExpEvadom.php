<?php
include('config/config.php');
?>
<!DOCTYPE html>
<html>

<head>
    <title>Export Evadom</title>
</head>

<body>

    <?php
    
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Data Evadom.xls");
    ?>

    <center>
        <h1>Export Data Evadom</h1>
    </center>

    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" border="1">
        <thead>
            <tr>
                <th>Mata Kuliah</th>
                <th>Nama Dosen</th>
                <th>Rata Rata Kuisoner Ke 1</th>
                <th>Rata Rata Kuisoner Ke 2</th>
                <th>Rata Rata Kuisoner Ke 3</th>
                <th>Rata Rata Kuisoner Ke 4</th>
                <th>Rata Rata Kuisoner Ke 5</th>
                <th>Rata Rata Kuisoner Ke 6</th>
                <th>Rata Rata Kuisoner Ke 7</th>
                <th>Rata Rata Kuisoner Ke 8</th>
                <th>Rata Rata Kuisoner Ke 9</th>
                <th>Rata Rata Kuisoner Ke 10</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            $dataKat = query("SELECT matakuliah.Nama_MataKuliah AS MataKuliah, dosen.nama AS Nama_Dosen, AVG(Q1) AS Q1, AVG(Q2) AS Q2, AVG(Q3) AS Q3, AVG(Q4) AS Q4, AVG(Q5) AS Q5, AVG(Q6) AS Q6, AVG(Q7) AS Q7, AVG(Q8) AS Q8, AVG(Q9) AS Q9,AVG(Q10) AS Q10, kuisoner.Keterangan FROM kuisoner LEFT JOIN matakuliah ON kuisoner.Kode_MataKuliah = matakuliah.Kode_MataKuliah LEFT JOIN jadwal ON jadwal.Kode_MataKuliah = matakuliah.Kode_MataKuliah LEFT JOIN dosen ON dosen.NIP = jadwal.NIP");
            foreach ($dataKat as $row) :
            ?>
                <tr>
                    <td><?= $row['MataKuliah']; ?></td>
                    <td><?= $row['Nama_Dosen']; ?></td>
                    <td><?= $row['Q1']; ?></td>
                    <td><?= $row['Q2']; ?></td>
                    <td><?= $row['Q3']; ?></td>
                    <td><?= $row['Q4']; ?></td>
                    <td><?= $row['Q5']; ?></td>
                    <td><?= $row['Q6']; ?></td>
                    <td><?= $row['Q7']; ?></td>
                    <td><?= $row['Q8']; ?></td>
                    <td><?= $row['Q9']; ?></td>
                    <td><?= $row['Q10']; ?></td>
                    <td><?= $row['Keterangan']; ?></td>
                </tr>
            <?php
            endforeach;
            ?>
        </tbody>
    </table>
</body>

</html>