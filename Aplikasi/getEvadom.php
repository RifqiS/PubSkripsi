<?php
require('config/config.php');
require('vendor/autoload.php');
$getid = $_POST["Kode_MataKuliah"];
$data = query("SELECT matakuliah.Nama_MataKuliah AS Matkul, AVG(Q1) AS Q1, AVG(Q2) AS Q2, AVG(Q3) AS Q3, AVG(Q4) AS Q4, AVG(Q5) AS Q5, AVG(Q6) AS Q6, AVG(Q7) AS Q7, AVG(Q8) AS Q8, AVG(Q9) AS Q9,AVG(Q10) AS Q10 FROM kuisoner LEFT JOIN matakuliah ON kuisoner.Kode_MataKuliah = matakuliah.Kode_MataKuliah WHERE kuisoner.Kode_MataKuliah = '$getid'")[0];
echo json_encode($data);
return $data;
// var_dump($data);
// die;
?>