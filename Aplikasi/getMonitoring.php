<?php
require('config/config.php');
require('vendor/autoload.php');
$getid = $_POST["Kode_MataKuliah"];
$data = query("SELECT * FROM monev WHERE Kode_MataKuliah = '$getid'");
echo json_encode($data);
return $data;
// var_dump($data);
// die;
?>