<?php
session_start();
require 'vendor/autoload.php';

$server = "localhost";
$user = "root";
$password = "";
$nama_database = "simonkbm";
$db = mysqli_connect($server, $user, $password, $nama_database);
if (!$db) {
    die("Error" . mysqli_connect_error());
}

function base_url()
{
    return 'http://localhost/tugasakhirrifqi/';
}

function query($query)
{
    global $db;
    $result = mysqli_query($db, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function cbarcode($kode)
{
    // $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
    // return $generator->getBarcode($kode, $generator::TYPE_CODE_128);
}

// APP Login
// $c_d = query("SELECT * FROM admin WHERE id = 'Un!X1d@4pp'")[0];
// $_SESSION['title_page'] = $c_d['TitleHome'];
// $_SESSION['logo'] = $c_d['logo'];


// Funtion CRUD

//Mahasiswa
function inMahasiswa($inMahasiswa)
{
    global $db;
    $NPM            = $inMahasiswa['NPM'];
    $Nama           = htmlspecialchars($inMahasiswa['Nama']);
    $Kode_Jurusan   = htmlspecialchars($inMahasiswa['Kode_Jurusan']);
    $Tahun_Angkatan = htmlspecialchars($inMahasiswa['Tahun_Angkatan']);

    $cekid = mysqli_query($db, "SELECT * FROM mahasiswa WHERE NPM = '$NPM'");
    if (mysqli_num_rows($cekid) > 0) {
        echo "<script type='text/javascript'>
                alert('NPM has been used ! Please insert new NPM');
                </script>";
    } else {
        $query = "INSERT INTO mahasiswa VALUES('','$NPM','$Nama','$Kode_Jurusan','$Tahun_Angkatan')";
        mysqli_query($db, $query);
        $Acc = generateKode('account', 'ID_Account', 'IDACC', '6');
        $password = md5($NPM);
        $queryacc    = "INSERT INTO account VALUES('$Acc','$NPM','$password', 'Mahasiswa')";
        mysqli_query($db, $queryacc);
        // $peg =  $_SESSION['usp'];
        // $loggen = generateKode('log', 'cuid', 'CUID', '3');
        // $query9 = "INSERT INTO log VALUES(NULL,'$loggen',NULL,$peg,'Create','Create Data $NIP from Pegawai')";
        // mysqli_query($db, $query9);
        return mysqli_affected_rows($db);
    }
}

function editMahasiswa($editMahasiswa)
{
    global $db;
    $NPM            = $editMahasiswa['NPM'];
    $Nama           = htmlspecialchars($editMahasiswa['Nama']);
    $Kode_Jurusan   = htmlspecialchars($editMahasiswa['Kode_Jurusan']);
    $Tahun_Angkatan = htmlspecialchars($editMahasiswa['Tahun_Angkatan']);

    $query = "UPDATE mahasiswa SET Nama = '$Nama', Kode_Jurusan = '$Kode_Jurusan', Tahun_Angkatan = '$Tahun_Angkatan' WHERE NPM = '$NPM'";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function delMahasiswa($delMahasiswa)
{
    global $db;

    $query = "DELETE FROM mahasiswa WHERE NPM = '$delMahasiswa'";
    mysqli_query($db, $query);
    $query1 = "DELETE FROM account WHERE username = '$delMahasiswa'";
    mysqli_query($db, $query1);
    
    return mysqli_affected_rows($db);
}
// End Mahasiswa

//Dosen
function inDosen($inDosen)
{
    global $db;
    $NIP        = $inDosen['NIP'];
    $Nama       = htmlspecialchars($inDosen['Nama']);
    $Kode_Dosen = htmlspecialchars($inDosen['Kode_Dosen']);
    $Kode_Jurusan = htmlspecialchars($inDosen['Kode_Jurusan']);

    $cekid = mysqli_query($db, "SELECT * FROM dosen WHERE NIP = '$NIP'");
    if (mysqli_num_rows($cekid) > 0) {
        echo "<script type='text/javascript'>
                alert('NIP has been used ! Please insert new NIP');
                </script>";
    } else {
        $query = "INSERT INTO dosen VALUES('', '$NIP','$Nama','$Kode_Dosen')";
        mysqli_query($db, $query);
        $Acc = generateKode('account', 'ID_Account', 'IDACC', '6');
        $password = md5($NIP);
        $queryacc    = "INSERT INTO account VALUES('$Acc','$NIP','$password', 'Dosen')";
        mysqli_query($db, $queryacc);
        // $peg =  $_SESSION['usp'];
        // $loggen = generateKode('log', 'cuid', 'CUID', '3');
        // $query9 = "INSERT INTO log VALUES(NULL,'$loggen',NULL,$peg,'Create','Create Data $NIP from Pegawai')";
        // mysqli_query($db, $query9);
        return mysqli_affected_rows($db);
    }
}

function editDosen($editDosen)
{
    global $db;
    $NIP        = $editDosen['NIP'];
    $Nama       = htmlspecialchars($editDosen['Nama']);
    $Kode_Dosen = htmlspecialchars($editDosen['Kode_Dosen']);
    $Kode_Jurusan = htmlspecialchars($editDosen['Kode_Jurusan']);

    $query = "UPDATE dosen SET Nama = '$Nama', Kode_Dosen = '$Kode_Dosen', Kode_Jurusan = '$Kode_Jurusan' WHERE NIP = '$NIP'";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function delDosen($delDosen)
{
    global $db;

    $query = "DELETE FROM dosen WHERE NIP = '$delDosen'";
    mysqli_query($db, $query);
    $query1 = "DELETE FROM account WHERE username = '$delDosen'";
    mysqli_query($db, $query1);
    return mysqli_affected_rows($db);
}
// End Dosen

// Kelas

function inKelas($inKelas)
{
    global $db;
    $Kode_Kelas  = $inKelas['Kode_Kelas'];
    $Nama_Kelas  = htmlspecialchars($inKelas['Nama_Kelas']);

    $cekid = mysqli_query($db, "SELECT * FROM kelas WHERE Kode_Kelas = '$Kode_Kelas'");
    if (mysqli_num_rows($cekid) > 0) {
        echo "<script type='text/javascript'>
                alert('Kode Kelas has been used ! Please insert new Kode Kelas');
                </script>";
    } else {
        $query = "INSERT INTO kelas VALUES('','$Kode_Kelas','$Nama_Kelas')";
        mysqli_query($db, $query);
        // $peg =  $_SESSION['usp'];
        // $loggen = generateKode('log', 'cuid', 'CUID', '3');
        // $query9 = "INSERT INTO log VALUES(NULL,'$loggen',NULL,$peg,'Create','Create Data $Kode_Kelas from Kelas')";
        // mysqli_query($db, $query9);
        return mysqli_affected_rows($db);
    }
}

function editKelas($editKelas)
{
    global $db;
    $Kode_Kelas    = $editKelas['Kode_Kelas'];
    $Nama_Kelas  = htmlspecialchars($editKelas['Nama_Kelas']);

    $query = "UPDATE kelas SET Nama_Kelas = '$Nama_Kelas' WHERE Kode_Kelas = '$Kode_Kelas'";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function delKelas($delKelas)
{
    global $db;

    $query = "DELETE FROM kelas WHERE Kode_Kelas = '$delKelas'";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// End Kelas


// Jurusan

function inJurusan($inJurusan)
{
    global $db;
    $Kode_Jurusan  = $inJurusan['Kode_Jurusan'];
    $Nama_Jurusan  = htmlspecialchars($inJurusan['Nama_Jurusan']);

    $cekid = mysqli_query($db, "SELECT * FROM jurusan WHERE Kode_Jurusan = '$Kode_Jurusan'");
    if (mysqli_num_rows($cekid) > 0) {
        echo "<script type='text/javascript'>
                alert('Kode Jurusan has been used ! Please insert new Kode Jurusan');
                </script>";
    } else {
        $query = "INSERT INTO jurusan VALUES('','$Kode_Jurusan','$Nama_Jurusan')";
        mysqli_query($db, $query);
        // $peg =  $_SESSION['usp'];
        // $loggen = generateKode('log', 'cuid', 'CUID', '3');
        // $query9 = "INSERT INTO log VALUES(NULL,'$loggen',NULL,$peg,'Create','Create Data $Kode_Jurusan from Jurusan')";
        // mysqli_query($db, $query9);
        return mysqli_affected_rows($db);
    }
}

function editJurusan($editJurusan)
{
    global $db;
    $Kode_Jurusan    = $editJurusan['Kode_Jurusan'];
    $Nama_Jurusan  = htmlspecialchars($editJurusan['Nama_Jurusan']);

    $query = "UPDATE jurusan SET Nama_Jurusan = '$Nama_Jurusan' WHERE Kode_Jurusan = '$Kode_Jurusan'";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function delJurusan($delJurusan)
{
    global $db;

    $query = "DELETE FROM jurusan WHERE Kode_Jurusan = '$delJurusan'";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// End Jurusan

// MataKuliah

function inMataKuliah($inMataKuliah)
{
    global $db;
    $Kode_MataKuliah  = $inMataKuliah['Kode_MataKuliah'];
    $Nama_MataKuliah  = htmlspecialchars($inMataKuliah['Nama_MataKuliah']);
    $SKS              = htmlspecialchars($inMataKuliah['SKS']);
    $Prasyarat        = htmlspecialchars($inMataKuliah['Prasyarat']);
    $Semester         = htmlspecialchars($inMataKuliah['Semester']);
    $Jenis_MataKuliah = htmlspecialchars($inMataKuliah['Jenis_MataKuliah']);

    $cekid = mysqli_query($db, "SELECT * FROM matakuliah WHERE Kode_MataKuliah = '$Kode_MataKuliah'");
    if (mysqli_num_rows($cekid) > 0) {
        echo "<script type='text/javascript'>
                alert('Kode MataKuliah has been used ! Please insert new Kode MataKuliah');
                </script>";
    } else {
        $query = "INSERT INTO matakuliah VALUES('','$Kode_MataKuliah','$Nama_MataKuliah','$SKS','$Prasyarat','$Semester','$Jenis_MataKuliah')";
        mysqli_query($db, $query);
        // $peg =  $_SESSION['usp'];
        // $loggen = generateKode('log', 'cuid', 'CUID', '3');
        // $query9 = "INSERT INTO log VALUES(NULL,'$loggen',NULL,$peg,'Create','Create Data $Kode_MataKuliah from MataKuliah')";
        // mysqli_query($db, $query9);
        return mysqli_affected_rows($db);
    }
}

function editMataKuliah($editMataKuliah)
{
    global $db;
    $Kode_MataKuliah  = $editMataKuliah['Kode_MataKuliah'];
    $Nama_MataKuliah  = htmlspecialchars($editMataKuliah['Nama_MataKuliah']);
    $SKS              = htmlspecialchars($editMataKuliah['SKS']);
    $Prasyarat        = htmlspecialchars($editMataKuliah['Prasyarat']);
    $Semester         = htmlspecialchars($editMataKuliah['Semester']);
    $Jenis_MataKuliah = htmlspecialchars($editMataKuliah['Jenis_MataKuliah']);

    $query = "UPDATE MataKuliah SET Nama_MataKuliah = '$Nama_MataKuliah', SKS = '$SKS', Prasyarat = '$Prasyarat', Semester = '$Semester', Jenis_MataKuliah = '$Jenis_MataKuliah' WHERE Kode_MataKuliah = '$Kode_MataKuliah'";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function delMataKuliah($delMataKuliah)
{
    global $db;

    $query = "DELETE FROM MataKuliah WHERE Kode_MataKuliah = '$delMataKuliah'";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// End MataKuliah

// plot mahasiswa

function inPlotKelas($inPlotKelas)
{
    global $db;
    // $ID_Join = $inPlotKelas['ID_Join']; 
    $Kelas  = htmlspecialchars($inPlotKelas['Kelas']);
    $NPM    = htmlspecialchars($inPlotKelas['NPM']);
    $Status    = htmlspecialchars($inPlotKelas['Status']);

    // $cekid = mysqli_query($db, "SELECT * FROM plotkelas WHERE ID_Join = '$ID_Join'");
    
        $query = "INSERT INTO plotkelas VALUES('','$Kelas','$NPM','$Status')";
        mysqli_query($db, $query);
        // $peg =  $_SESSION['usp'];
        // $loggen = generateKode('log', 'cuid', 'CUID', '3');
        // $query9 = "INSERT INTO log VALUES(NULL,'$loggen',NULL,$peg,'Create','Create Data $Kode_MataKuliah from MataKuliah')";
        // mysqli_query($db, $query9);
        return mysqli_affected_rows($db);
    
}

function editPlotKelas($editPlotKelas)
{
    global $db;
    $ID_Join = $editPlotKelas['ID_Join']; 
    $Kelas  = htmlspecialchars($editPlotKelas['Kelas']);
    $NPM    = htmlspecialchars($editPlotKelas['NPM']);
    $Status    = htmlspecialchars($editPlotKelas['Status']);

    $query = "UPDATE plotkelas SET Kelas = '$Kelas', NPM = '$NPM', Status = '$Status' WHERE ID_Join = '$ID_Join'";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function delPlotKelas($delPlotKelas)
{
    global $db;

    $query = "DELETE FROM plotkelas WHERE ID_Join = '$delPlotKelas'";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// End plot mahasiswa

// Jadwal

function inJadwal($inJadwal)
{
    global $db;
    $ID_Jadwal       = $inJadwal['ID_Jadwal'];
    $Kode_MataKuliah = htmlspecialchars($inJadwal['Kode_MataKuliah']);
    $NIP             = htmlspecialchars($inJadwal['NIP']);
    $Hari            = htmlspecialchars($inJadwal['Hari']);
    $Jam_Awal        = htmlspecialchars($inJadwal['Jam_Awal']);
    $Jam_Akhir       = htmlspecialchars($inJadwal['Jam_Akhir']);
    $Kelas           = htmlspecialchars($inJadwal['Kelas']);
    $Ruang           = htmlspecialchars($inJadwal['Ruang']);
    $Gabungan        = htmlspecialchars($inJadwal['Gabungan']);
    

    $cekid = mysqli_query($db, "SELECT * FROM jadwal WHERE ID_Jadwal = '$ID_Jadwal'");
    if (mysqli_num_rows($cekid) > 0) {
        echo "<script type='text/javascript'>
                alert('Kode MataKuliah has been used ! Please insert new Kode MataKuliah');
                </script>";
    } else {
        $query = "INSERT INTO jadwal VALUES('','$Kode_MataKuliah','$NIP','$Hari','$Jam_Awal','$Jam_Akhir','$Kelas','$Ruang','$Gabungan')";
        mysqli_query($db, $query);
        // $peg =  $_SESSION['usp'];
        // $loggen = generateKode('log', 'cuid', 'CUID', '3');
        // $query9 = "INSERT INTO log VALUES(NULL,'$loggen',NULL,$peg,'Create','Create Data $Kode_MataKuliah from MataKuliah')";
        // mysqli_query($db, $query9);
        return mysqli_affected_rows($db);
    }
}

function editjadwal($editjadwal)
{
    global $db;
    $ID_Jadwal       = $editjadwal['ID_Jadwal'];
    $Kode_MataKuliah = htmlspecialchars($editjadwal['Kode_m$Kode_MataKuliah']);
    $NIP             = htmlspecialchars($editjadwal['NIP']);
    $Hari            = htmlspecialchars($editjadwal['Hari']);
    $Jam_Awal        = htmlspecialchars($editjadwal['Jam_Awal']);
    $Jam_Akhir       = htmlspecialchars($editjadwal['Jam_Akhir']);
    $Kelas           = htmlspecialchars($editjadwal['Kelas']);
    $Ruang           = htmlspecialchars($editjadwal['Ruang']);
    $Gabungan        = htmlspecialchars($editjadwal['Gabungan']);

    $query = "UPDATE jadwal SET Kode_MataKuliah = '$Kode_MataKuliah', NIP = '$NIP', Hari = '$Hari', Jam_Awal = '$Jam_Awal', Jam_Akhir = '$Jam_Akhir', Kelas = '$Kelas', Ruang = '$Ruang', Gabungan = '$Gabungan' WHERE ID_Jadwal = '$ID_Jadwal'";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function delJadwal($delJadwal)
{
    global $db;

    $query = "DELETE FROM jadwal WHERE ID_Jadwal = '$delJadwal'";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// End plot mahasiswa

// Monev

function inMonev($inMonev)
{
    global $db;
    $ID_Monev            = $inMonev['ID_Monev'];
    $Kode_MataKuliah     = htmlspecialchars($inMonev['Kode_MataKuliah']);
    $Materi              = htmlspecialchars($inMonev['Materi']);
    $Hari_Pelaksanaan    = htmlspecialchars($inMonev['Hari_Pelaksanaan']);
    $Tanggal_Pelaksanaan = htmlspecialchars($inMonev['Tanggal_Pelaksanaan']);
    $Hari_Pengganti      = htmlspecialchars($inMonev['Hari_Pengganti']);
    $Tanggal_Pengganti   = htmlspecialchars($inMonev['Tanggal_Pengganti']);
    $Jenis_Materi        = htmlspecialchars($inMonev['Jenis_Materi']);
    $Platform            = htmlspecialchars($inMonev['Platform']);
    $Pelaksanaan         = htmlspecialchars($inMonev['Pelaksanaan']);
    $KM                  = query("SELECT plotkelas.NPM FROM jadwal INNER JOIN plotkelas ON jadwal.Kelas = plotkelas.Kelas WHERE plotkelas.Status = 'Leader'")[0];
    // var_dump($KM);
    // die();
    $NPM_1               = htmlspecialchars($KM['NPM']);
    $Status_1            = htmlspecialchars('Not Confirm');
    $C1_1                = htmlspecialchars('Tidak Ada Absensi');
    $C2_1                = htmlspecialchars('Tidak Ada Penyampaian Materi');
    $cek = query("SELECT NPM_2 FROM monev WHERE Kode_MataKuliah = '$Kode_MataKuliah'");
    $cek2 = [];
    foreach ($cek as $key) {

        array_push($cek2, $key['NPM_2']);
    }
    $cek3 = implode(",", $cek2 );
    $MB                  = query("SELECT plotkelas.NPM FROM jadwal INNER JOIN plotkelas ON jadwal.Kelas = plotkelas.Kelas WHERE plotkelas.Status = 'Mahasiswa' AND NPM NOT IN ('$cek3') ")[0];
    // var_dump($MB);
    // die();
    $NPM_2               = htmlspecialchars($MB['NPM']);
    $Status_2            = htmlspecialchars('Not Confirm');
    $C1_2                = htmlspecialchars('Tidak Ada Absensi');
    $C2_2                = htmlspecialchars('Tidak Ada Penyampaian Materi');

    $cekid = mysqli_query($db, "SELECT * FROM monev WHERE ID_Monev = '$ID_Monev'");
    if (mysqli_num_rows($cekid) > 0) {
        echo "<script type='text/javascript'>
                alert('Kode MataKuliah has been used ! Please insert new Kode MataKuliah');
                </script>";
    } else {
        $query = "INSERT INTO monev VALUES('$ID_Monev','$Kode_MataKuliah', '$Materi','$Hari_Pelaksanaan','$Tanggal_Pelaksanaan','$Hari_Pengganti','$Tanggal_Pengganti','$Jenis_Materi','$Platform','$Pelaksanaan','$NPM_1','$Status_1','$C1_1','$C2_1','$NPM_2','$Status_2','$C1_2','$C2_2')";
        mysqli_query($db, $query);
        // $peg =  $_SESSION['usp'];
        // $loggen = generateKode('log', 'cuid', 'CUID', '3');
        // $query9 = "INSERT INTO log VALUES(NULL,'$loggen',NULL,$peg,'Create','Create Data $Kode_MataKuliah from MataKuliah')";
        // mysqli_query($db, $query9);
        return mysqli_affected_rows($db);
    }
}

function editMonev($editMonev)
{
    global $db;
    $ID_Monev            = $editMonev['ID_Monev'];
    $Kode_MataKuliah     = htmlspecialchars($editMonev['Kode_MataKuliah']);
    $Materi              = htmlspecialchars($editMonev['Materi']);
    $Hari_Pelaksanaan    = htmlspecialchars($editMonev['Hari_Pelaksanaan']);
    $Tanggal_Pelaksanaan = htmlspecialchars($editMonev['Tanggal_Pelaksanaan']);
    $Hari_Pengganti      = htmlspecialchars($editMonev['Hari_Pengganti']);
    $Tanggal_Pengganti   = htmlspecialchars($editMonev['Tanggal_Pengganti']);
    $Jenis_Materi        = htmlspecialchars($editMonev['Jenis_Materi']);
    $Platform            = htmlspecialchars($editMonev['Platform']);
    $Pelaksanaan         = htmlspecialchars($editMonev['Pelaksanaan']);
    $NPM_1               = htmlspecialchars($editMonev['NPM_1']);
    $Status_1            = htmlspecialchars($editMonev['Status_1']);
    $NPM_2               = htmlspecialchars($editMonev['NPM_2']);
    $Status_2            = htmlspecialchars($editMonev['Status_2']);

    $query = "UPDATE monev SET Kode_MataKuliah = '$Kode_MataKuliah', Materi = '$Materi', Hari_Pelaksanaan = '$Hari_Pelaksanaan', Tanggal_Pelaksanaan = '$Tanggal_Pelaksanaan', Hari_Pengganti = '$Hari_Pengganti', Tanggal_Pengganti = '$Tanggal_Pengganti', Jenis_Materi = '$Jenis_Materi', Platform = '$Platform', Pelaksanaan = '$Pelaksanaan', NPM_1 = '$NPM_1', Status_1 = '$Status_1', NPM_2 = '$NPM_2', Status_2 = '$Status_2' WHERE ID_Monev = '$ID_Monev'";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}


function delMonev($delMonev)
{
    global $db;

    $query = "DELETE FROM monev WHERE ID_Monev = '$delMonev'";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// End Monev
function aprMonev($aprMonev){
    global $db;
    $ID_Monev  = $aprMonev['ID_Monev'];
    $Permis    = htmlspecialchars($aprMonev['Permis']);
    $Status    = htmlspecialchars($aprMonev['Status']);
    $C1        = htmlspecialchars($aprMonev['C1']);
    $C2        = htmlspecialchars($aprMonev['C2']);

    if ($Permis == "Leader") {
        $query = "UPDATE monev SET Status_1 = '$Status', C1_1 = '$C1', C1_2 = '$C2' WHERE ID_Monev = '$ID_Monev'";
    } else {
        $query = "UPDATE monev SET Status_2 = '$Status', C2_1 = '$C1', C2_2 = '$C2' WHERE ID_Monev = '$ID_Monev'";
    }
    // var_dump($query);
    // die;

    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}
function Kuisoner($Kuisoner){
    global $db;
    $ID_Kuis    = $Kuisoner['ID_Kuis'];
    $MHS        = htmlspecialchars($Kuisoner['MHS']);
    $Kode       = htmlspecialchars($Kuisoner['Kode']);
    $Q1         = htmlspecialchars($Kuisoner['Q1']);
    $Q2         = htmlspecialchars($Kuisoner['Q2']);
    $Q3         = htmlspecialchars($Kuisoner['Q3']);
    $Q4         = htmlspecialchars($Kuisoner['Q4']);
    $Q5         = htmlspecialchars($Kuisoner['Q5']);
    $Q6         = htmlspecialchars($Kuisoner['Q6']);
    $Q7         = htmlspecialchars($Kuisoner['Q7']);
    $Q8         = htmlspecialchars($Kuisoner['Q8']);
    $Q9         = htmlspecialchars($Kuisoner['Q9']);
    $Q10        = htmlspecialchars($Kuisoner['Q10']);
    $Keterangan = htmlspecialchars($Kuisoner['Keterangan']);

    $cekid = mysqli_query($db, "SELECT * FROM kuisoner WHERE ID_Kuis = '$ID_Kuis'");
    if (mysqli_num_rows($cekid) > 0) {
        echo "<script type='text/javascript'>
                alert('ID Kuisoner has been used ! Please insert new ID Kuisoner');
                </script>";
    } else {
        $query = "INSERT INTO kuisoner VALUES('','$MHS','$Kode', '$Q1','$Q2','$Q3','$Q4','$Q5','$Q6','$Q7','$Q8','$Q9','$Q10','$Keterangan')";
        mysqli_query($db, $query);
        return mysqli_affected_rows($db);
        var_dump($query);
        die;
    }
}

function login($ilog){
    // session_start();
    $user = htmlspecialchars($ilog['username']);
    $pass = htmlspecialchars(md5($ilog['password']));
    $cek = query("SELECT * FROM account WHERE Username = '$user' AND Password = '$pass'")[0];
    if ($cek != null) {
        $_SESSION['usp'] = $cek['Username'];
        $_SESSION['sr'] = $user;
        $_SESSION['lvs'] = $cek['Permission'];
        $_SESSION['title'] = "MONEV-FTI";
        // var_dump($_SESSION);
        // die();
        if (isset($ilog['ingat'])) {
            setcookie('inapp', $cek['Username'], time() + 86400, '/');
        }
        return true;
    }
    // if ($cek['user'] === $user && $cek['pass'] === $pass) {
    //     $_SESSION['inapp'] = 1;
    //     return true;
    // }
    return false;
}

function generateKode($tabel, $ids, $kodeawal, $jmlkodeawal){
    global $db;
    $query = mysqli_query($db, "SELECT max($ids) as kodeTerbesar FROM $tabel");
    $data = mysqli_fetch_array($query);
    $kodeBarang = $data['kodeTerbesar'];

    // mengambil angka dari kode barang terbesar, menggunakan fungsi substr
    // dan diubah ke integer dengan (int)
    $urutan = (int) substr($kodeBarang, 3, 6);

    // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
    $urutan++;

    // membentuk kode barang baru
    // perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
    // misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
    // angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
    $huruf = $kodeawal;
    $kodeBarang = $huruf . sprintf("%0" . $jmlkodeawal . "s", $urutan);
    return $kodeBarang;
}

function logout(){
    // $_SESSION['inapp'] = 0;
    session_unset();
    session_destroy();
    setcookie("inapp", "", time() - 3600);
    return true;
}

function upload($foto, $tem){
    // return false;
    $namafile   = $_FILES[$foto]['name'];
    $ukuranfile = $_FILES[$foto]['size'];
    $error      = $_FILES[$foto]['error'];
    $tmpname    = $_FILES[$foto]['tmp_name'];
    $lokasi     = "assets/img/$tem/";
    // var_dump($_POST);
    // var_dump($_FILES);
    // var_dump($ukuranfile);
    // die;

    // cek apakah tidak ada foto yang di upload
    if ($error === 4) {
        echo "
				<script>
					alert('masukkan foto terlebih dahulu!');
				</script>
			";
        return false;
    }

    // cek valid gambar
    $ekstensigambarvalid = ['jpg', 'jpeg', 'png', 'gif'];
    $ekstensigambar = explode('.', $namafile);
    $ekstensigambar = strtolower(end($ekstensigambar));
    if (!in_array($ekstensigambar, $ekstensigambarvalid)) {
        echo "
				<script>
					alert('yang anda masukkan bukan gambar!');
				</script>
			";
        return false;
    }


    // batas ukuran file
    if ($ukuranfile > 3050000) {
        echo "
				<script>
					alert('ukuran gambar terlalu besar! (Max 3MB)');
				</script>
			";
        return false;
    }

    // lolos pengecekan
    // generate nama baru
    $namafilebaru = uniqid();
    $namafilebaru .= '.';
    $namafilebaru .= $ekstensigambar;

    if (move_uploaded_file($tmpname, $lokasi . $namafilebaru)) {
        // echo "The file ". htmlspecialchars(basename($namafilebaru). " has been uploaded.";
    } else {
        echo "
				<script>
					alert('Upload gambar gagal!');
				</script>
			";
        return false;
    }

    return $namafilebaru;
}
