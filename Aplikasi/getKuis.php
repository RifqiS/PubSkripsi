<?php
require('config/config.php');
require('vendor/autoload.php');
$getid = $_POST["ID_Jadwal"];
$data = query("SELECT jadwal.ID_Jadwal AS ID, matakuliah.Nama_MataKuliah AS Matkul, dosen.nama AS Dosen, jadwal.Kode_MataKuliah AS Kode  FROM jadwal INNER JOIN matakuliah ON jadwal.Kode_MataKuliah = matakuliah.Kode_MataKuliah LEFT JOIN dosen ON jadwal.NIP = dosen.NIP WHERE jadwal.ID_Jadwal = '$getid'")[0];
echo json_encode($data);
return $data;
// var_dump($data);
// die;
?>