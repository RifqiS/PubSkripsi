<!-- import excel ke mysql -->
<!-- www.malasngoding.com -->

<?php
// menghubungkan dengan koneksi
include 'config/config.php';
// menghubungkan dengan library excel reader
include "config/excel_reader2.php";
?>

<?php
// upload file xls
$target = basename($_FILES['UpFile']['name']);
move_uploaded_file($_FILES['UpFile']['tmp_name'], $target);

// beri permisi agar file xls dapat di baca
chmod($_FILES['UpFile']['name'], 0777);

// mengambil isi file xls
$data = new Spreadsheet_Excel_Reader($_FILES['UpFile']['name'], false);
// menghitung jumlah baris data yang ada
$jumlah_baris = $data->rowcount($sheet_index = 0);
// var_dump($jumlah_baris);
// die;

// jumlah default data yang berhasil di import
$berhasil = 0;
for ($i = 2; $i <= $jumlah_baris; $i++) {

	// menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
	$NIP   		= $data->val($i, 1);
	$Nama   	= $data->val($i, 2);
	$Kode_Dosen = $data->val($i, 3);
	$password = md5($NIP);

		
		if ($NIP != "" && $Nama != "" && $Kode_Dosen != "") {
			// input data ke database (table data_pegawai)
			$input = mysqli_query($db, "INSERT INTO dosen VALUES('','$NIP','$Nama','$Kode_Dosen')");
			$input2 = mysqli_query($db, "INSERT INTO account VALUES('','$NIP','$password','Dosen')");
			$berhasil++;
		}
}

// hapus kembali file .xls yang di upload tadi
unlink($_FILES['UpFile']['name']);

// alihkan halaman ke index.php
header("location:dosen.php?berhasil=$berhasil");
?>