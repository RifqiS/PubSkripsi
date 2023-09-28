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
	$Kode_MataKuliah   = $data->val($i, 1);
	$Nama_MataKuliah   = $data->val($i, 2);
	$SKS  			   = $data->val($i, 3);
	$Prasyarat  	   = $data->val($i, 4);
	$Semester  		   = $data->val($i, 5);
	$Jenis_MataKuliah  = $data->val($i, 6);

		// var_dump($Kode_MataKuliah);
		// var_dump($Nama_MataKuliah);
		// var_dump($SKS);
		// var_dump($Prasyarat);
		// var_dump($Semester);
		// var_dump($Jenis_MataKuliah);
		// die;
		if ($Kode_MataKuliah != "" && $Nama_MataKuliah != "" && $SKS != "" && $Semester != "") {
			// input data ke database (table data_pegawai)
			$input = mysqli_query($db, "INSERT INTO matakuliah VALUES('','$Kode_MataKuliah','$Nama_MataKuliah','$SKS','$Prasyarat','$Semester','$Jenis_MataKuliah')");
			$berhasil++;
		}
}

// hapus kembali file .xls yang di upload tadi
unlink($_FILES['UpFile']['name']);

// alihkan halaman ke index.php
header("location:matakuliah.php?berhasil=$berhasil");
?>