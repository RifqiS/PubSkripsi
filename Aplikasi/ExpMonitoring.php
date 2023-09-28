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
    header("Content-Disposition: attachment; filename=Data Hasil Monitoring.xls");
    ?>

    <center>
        <h1>Export Data Evadom</h1>
    </center>

    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" border="1">
        <thead>
            <tr>
                <th>Mata Kuliah</th>
                <th>Nama Dosen</th>
                <th>Materi</th>
                <th>Hari Pelaksanaan</th>
                <th>Tanggal Pelaksanaan</th>
                <th>Hari Pengganti</th>
                <th>Tanggal Pengganti</th>
                <th>Jenis Materi</th>
                <th>Platform Pelaksanaan</th>
                <th>Pelaksanaan</th>
                <th>Konfirmasi dari Ketua Kelas</th>
                <th>Konfirmasi Absensi dari Ketua Kelas</th>
                <th>Konfirmasi Penyampaian Materi dari Ketua Kelas</th>
                <th>Konfirmasi dari Perwakilan Mahasiswa</th>
                <th>Konfirmasi Absensi dari Perwakilan Mahasiswa</th>
                <th>Konfirmasi Penyampaian Materi dari Perwakilan Mahasiswa</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            $dataKat = query("SELECT matakuliah.Nama_MataKuliah AS MataKuliah, dosen.Nama AS NamaDosen, monev.Materi, monev.Hari_Dilaksanakan AS HariPelaksanaan, monev.Tanggal_Dilaksanakan AS TglPelaksanaan, monev.Hari_Pengganti AS HariPengganti, monev.Tanggal_Pengganti AS TglPengganti, monev.Jenis_Materi, monev.Platform, monev.Pelaksanaan, monev.Status_1 AS Confirmasi_KetuaKelas, monev.C1_1 AS Check_Absensi_KetuaKelas, monev.C1_2 AS Check_PenyapaianMateri_KetuaKelas, monev.Status_2 AS Confirmasi_Perwakilan, monev.C2_1 AS Check_Absensi_Perwakilan, monev.C2_2 AS Check_PenyampaianMateri_Pewakilan FROM jadwal LEFT JOIN matakuliah ON jadwal.Kode_MataKuliah = matakuliah.Kode_Matakuliah LEFT JOIN dosen ON jadwal.NIP = dosen.NIP LEFT JOIN monev ON jadwal.Kode_MataKuliah = monev.Kode_MataKuliah;");
            foreach ($dataKat as $row) :
            ?>
                <tr>
                    <td><?= $row['MataKuliah']; ?></td>
                    <td><?= $row['Nama_Dosen']; ?></td>
                    <td><?= $row['Materi']; ?></td>
                    <td><?= $row['HariPelaksanaan']; ?></td>
                    <td><?= $row['TglPelaksanaan']; ?></td>
                    <td><?= $row['HariPengganti']; ?></td>
                    <td><?= $row['TglPengganti']; ?></td>
                    <td><?= $row['Jenis_Materi']; ?></td>
                    <td><?= $row['Platform']; ?></td>
                    <td><?= $row['Pelaksanaan']; ?></td>
                    <td><?= $row['Confirmasi_KetuaKelas']; ?></td>
                    <td><?= $row['Check_Absensi_KetuaKelas']; ?></td>
                    <td><?= $row['Check_PenyampaianMateri_KetuaKelas']; ?></td>
                    <td><?= $row['Confirmasi_Perwakilan']; ?></td>
                    <td><?= $row['Check_Absensi_Perwakilan']; ?></td>
                    <td><?= $row['Check_PenyampaianMateri_Perwakilan']; ?></td>
                </tr>
            <?php
            endforeach;
            ?>
        </tbody>
    </table>
</body>

</html>