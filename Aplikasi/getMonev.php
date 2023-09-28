<?php
require('config/config.php');
require('vendor/autoload.php');
$getid = $_POST["ID_Monev"];
$data = query("SELECT * FROM monev INNER JOIN matakuliah ON monev.Kode_MataKuliah = matakuliah.Kode_MataKuliah WHERE ID_Monev = '$getid'")[0];
echo json_encode($data);
return $data;
// var_dump($data);
// die;
?>