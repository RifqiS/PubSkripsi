<?php
require('config/config.php');
if (isset($_POST['Approve'])) {
    if (aprMonev($_POST) > 0) {
        echo "<script type='text/javascript'>
                    alert('Approve Success !');
                    window.location.href = 'index.php';
                    </script>";
    } else {
        echo "<script type='text/javascript'>
                    alert('Approve Failed !');
                    window.location.href = 'index.php';
                    </script>";
    };
    unset($_SESSION['edits']);
    unset($_SESSION['editdata']);
}

if (isset($_POST['InMonev'])) {
    if (inMonev($_POST) > 0) {
        echo "<script type='text/javascript'>
                    alert('Add Data Success !');
                    window.location.href = 'index.php';
                    </script>";
    } else {
        echo "<script type='text/javascript'>
                    alert('Add Data Failed !');
                    window.location.href = 'index.php';
                    </script>";
    };
    unset($_SESSION['edits']);
    unset($_SESSION['editdata']);
}

if ($_SESSION["lvs"] == "Mahasiswa") {
    $ft = $_SESSION['usp'];
    $permis = query("SELECT plotkelas.Status FROM plotkelas WHERE NPM = $ft")[0];
}
// $idkuis = generateKode('jurusan', 'Kode_Jurusan','IDK', '3');
// var_dump($permis);
if (isset($_POST['Kuis'])) {
    if (Kuisoner($_POST) > 0) {
        echo "<script type='text/javascript'>
                    alert('Kuisoner Send Success !');
                    window.location.href = 'index.php';
                    </script>";
    } else {
        echo "<script type='text/javascript'>
                    alert('Kuisoner Send Failed !');
                    window.location.href = 'index.php';
                    </script>";
    };
    unset($_SESSION['edits']);
    unset($_SESSION['editdata']);
}
$dd = "MNV".''.date("md");
$idgen = generateKode('monev', 'ID_Monev', $dd, 3);
// echo $idgen;
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $_SESSION['title']; ?></title>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- Boostrapselect -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css" integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include "sidebar.php"; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include "topbar.php"; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-5 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-s font-weight-bold text-primary text-uppercase mb-1">
                                                Selamat Datang!</div>
                                            <div class="h4 mb-0 font-weight-bold text-gray-800"><?php echo $user['nm']; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <?php if (isset($permis)) { ?>
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">DataTables Hasil KBM </h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Mata Kuliah</th>
                                                <th>Materi</th>
                                                <!-- <th>Status</th> -->
                                                <th>*</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            // var_dump($permis);
                                            // die;
                                            if (isset($permis)) {
                                                # code...
                                                if ($permis['Status'] == "Leader") {
                                                    # code...
                                                    $dataKat = query("SELECT * FROM monev INNER JOIN matakuliah ON monev.Kode_MataKuliah = matakuliah.Kode_MataKuliah WHERE monev.NPM_1 = $ft AND Status_1 = 'Not Confirm'");
                                                } elseif ($permis['Status'] == "Mahasiswa") {
                                                    # code...
                                                    $dataKat = query("SELECT * FROM monev INNER JOIN matakuliah ON monev.Kode_MataKuliah = matakuliah.Kode_MataKuliah WHERE monev.NPM_2 = $ft AND Status_2 = 'Not Confirm'");
                                                    // var_dump($dataKat);
                                                } else {
                                                    # code...
                                                    $dataKat = query("SELECT * FROM monev INNER JOIN matakuliah ON monev.Kode_MataKuliah = matakuliah.Kode_MataKuliah");
                                                }
                                            } else {
                                                # code...
                                                $dataKat = query("SELECT * FROM monev INNER JOIN matakuliah ON monev.Kode_MataKuliah = matakuliah.Kode_MataKuliah");
                                            }

                                            foreach ($dataKat as $row) :
                                            ?>
                                                <tr>
                                                    <td><?= $row['Nama_MataKuliah']; ?></td>
                                                    <td><?= $row['Materi']; ?></td>
                                                    <td>
                                                        <form action="" method="post">
                                                            <input type="hidden" name="ID_Monev" value="<?= $row['ID_Monev']; ?>">
                                                            <button id="show-monev" name="show-monev" class="btn btn-sm btn-outline-info" data-id="<?= $row['ID_Monev']; ?>"><i class="fas fa-eye"> View</i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php
                                            endforeach;
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Jadwal Mata Kuliah</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Mata Kuliah</th>
                                            <!-- <th>Dosen</th> -->
                                            <th>Hari</th>
                                            <th>Jam Mulai</th>
                                            <th>Jam Selesai</th>
                                            <th>Kelas</th>
                                            <th>Ruangan</th>
                                            <!-- <th>Kelas Gabungan</th> -->
                                            <th>*</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        $ID = $_SESSION['usp'];
                                        // var_dump($NPM);
                                        // die();
                                        if ($_SESSION["lvs"] === "Mahasiswa") {
                                            $dataKat = query("SELECT * FROM jadwal INNER JOIN matakuliah ON jadwal.Kode_MataKuliah = matakuliah.Kode_Matakuliah JOIN plotkelas ON plotkelas.Kelas = jadwal.Kelas WHERE NPM = $ID");
                                        } elseif ($_SESSION["lvs"] === "Dosen") {
                                            $dataKat = query("SELECT * FROM jadwal INNER JOIN matakuliah ON jadwal.Kode_MataKuliah = matakuliah.Kode_Matakuliah WHERE NIP = $ID");
                                        } else {
                                            $dataKat = query("SELECT * FROM jadwal INNER JOIN matakuliah ON jadwal.Kode_MataKuliah = matakuliah.Kode_Matakuliah");
                                        }
                                        foreach ($dataKat as $row) :
                                        ?>
                                            <tr>
                                                <td><?= $row['Nama_MataKuliah']; ?></td>
                                                <!-- <td><?= $row['Nama']; ?></td> -->
                                                <td><?= $row['Hari']; ?></td>
                                                <td><?= $row['Jam_Awal']; ?></td>
                                                <td><?= $row['Jam_Akhir']; ?></td>
                                                <td><?= $row['Kelas']; ?></td>
                                                <td><?= $row['Ruang']; ?></td>
                                                <!-- <td><?= $row['Gabungan']; ?></td> -->
                                                <td>
                                                    <form action="" method="post">
                                                        <input type="hidden" name="ID_Jadwal" value="<?= $row['ID_Jadwal']; ?>">
                                                        <input type="hidden" name="Kode_MataKuliah" value="<?= $row['Kode_MataKuliah']; ?>">
                                                        <?php
                                                        // $cr = query("SELECT * FROM `kuisoner` WHERE NPM = '$ft'");
                                                        if ($_SESSION["lvs"] == "Mahasiswa") {
                                                        ?>
                                                            <button id="show-kuis" name="show-kuis" class="btn btn-sm btn-outline-info" data-id="<?= $row['ID_Jadwal']; ?>"><i class="fas fa-eye"> Quisoner</i></button>
                                                        <?php } elseif ($_SESSION["lvs"] == "Dosen") { ?>
                                                            <button id="show-inMonev" name="show-inMonev" class="btn btn-sm btn-outline-info" data-id="<?= $row['ID_Jadwal']; ?>"><i class="fas fa-eye"> Input Hasil KBM</i></button>
                                                        <?php } ?>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php
                                        endforeach;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include 'footer.php'; ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Approve Modal-->
    <div class="modal fade" id="DetailMonevModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="DetailMonevModalLabel"></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="" method="POST">
                <div class="modal-body">
                    <table>
                        <tr>
                            <td>Mata Kuliah</td>
                            <td>:</td>
                            <td>
                                <div id="Nama_MataKuliah"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Materi</td>
                            <td>:</td>
                            <td>
                                <div id="Materi"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Hari Pelaksanaan</td>
                            <td>:</td>
                            <td>
                                <div id="Hari_Pelaksanaan"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Tanggal Pelaksanaan</td>
                            <td>:</td>
                            <td>
                                <div id="Tanggal_Pelaksanaan"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Hari Pengganti</td>
                            <td>:</td>
                            <td>
                                <div id="Hari_Pengganti"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Tanggal Pengganti</td>
                            <td>:</td>
                            <td>
                                <div id="Tanggal_Pengganti"></div>
                            </td>
                        <tr>
                            <td>Jenis Materi</td>
                            <td>:</td>
                            <td>
                                <div id="Jenis_Materi"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Platform</td>
                            <td>:</td>
                            <td>
                                <div id="Platform"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Pelaksanaan</td>
                            <td>:</td>
                            <td>
                                <div id="Pelaksanaan"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Ketua Kelas</td>
                            <td>:</td>
                            <td>
                                <div id="KK"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Perwakilan Mahasiswa</td>
                            <td>:</td>
                            <td>
                                <div id="PM"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Presensi</td>
                            <td>:</td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Absensi" id="C1" name="C1">
                                    <label class="form-check-label" for="C1">
                                        Absensi
                                    </label>
                                    <br>
                                    <input class="form-check-input" type="checkbox" value="Penyampaian Materi" id="C2" name="C2">
                                    <label class="form-check-label" for="C2">
                                        Penyampaian Materi
                                    </label>
                                    <!-- <br>
                                    <input class="form-check-input" type="checkbox" value="" id="C3">
                                    <label class="form-check-label" for="C3">
                                        Default checkbox
                                    </label> -->
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <input type="hidden" id="ID_Monev" name="ID_Monev" value="">
                    <input type="hidden" id="Permis" name="Permis" value="<?= $permis['Status']; ?>">
                    <input type="hidden" id="Status" name="Status" value="Confirmed">
                    <?php if (isset($permis)) { ?>
                        <button class="btn btn-primary" type="submit" id="Approve" name="Approve">Approve</button>
                    <?php } ?>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Kuis Modal-->
    <div class="modal fade" id="DetailKuisModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form action="" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="KuisModalLabel"></h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- <p> ID_Jadwal   : <div id="ID_Jadwal"></div></p> -->
                        <!-- <p> Mata Kuliah : <div id="Nama_MataKuliah"></div></p>
                    <p> Nama Dosen  : <div id="Nama"></div></p> -->
                        <table>
                            <!-- <tr>
                            <td>Mata Kuliah</td>
                            <td>:</td>
                            <td><div id="ID_Jadwal"></div></td>
                        </tr> -->
                            <tr>
                                <td>Mata Kuliah</td>
                                <td>:</td>
                                <td>
                                    <div id="Matkul"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>Dosen</td>
                                <td>:</td>
                                <td>
                                    <div id="Nama"></div>
                                </td>

                            </tr>
                        </table>
                        <table border="1" align="center" class="table">
                            <tr>
                                <td align="center">Pertanyaan</td>
                                <td align="center">Sangat Buruk</td>
                                <td align="center">Buruk</td>
                                <td align="center">Cukup</td>
                                <td align="center">Baik</td>
                                <td align="center">Sangat Baik</td>
                            </tr>
                            <tr>
                                <td>Dosen memberikan materi kuliah dengan jelas dan sistematis.</td>
                                <td align="center"><input type="radio" required name="Q1" id="Q1" value="1"></td>
                                <td align="center"><input type="radio" required name="Q1" id="Q1" value="2"></td>
                                <td align="center"><input type="radio" required name="Q1" id="Q1" value="3"></td>
                                <td align="center"><input type="radio" required name="Q1" id="Q1" value="4"></td>
                                <td align="center"><input type="radio" required name="Q1" id="Q1" value="5"></td>
                            </tr>
                            <tr>
                                <td>Dosen mendorong diskusi dan interaksi dalam kelas.</td>
                                <td align="center"><input type="radio" required name="Q2" id="Q2" value="1"></td>
                                <td align="center"><input type="radio" required name="Q2" id="Q2" value="2"></td>
                                <td align="center"><input type="radio" required name="Q2" id="Q2" value="3"></td>
                                <td align="center"><input type="radio" required name="Q2" id="Q2" value="4"></td>
                                <td align="center"><input type="radio" required name="Q2" id="Q2" value="5"></td>
                            </tr>
                            <tr>
                                <td>Dosen memberikan umpan balik (feedback) konstruktif terhadap tugas dan pertanyaan mahasiswa.</td>
                                <td align="center"><input type="radio" required name="Q3" id="Q3" value="1"></td>
                                <td align="center"><input type="radio" required name="Q3" id="Q3" value="2"></td>
                                <td align="center"><input type="radio" required name="Q3" id="Q3" value="3"></td>
                                <td align="center"><input type="radio" required name="Q3" id="Q3" value="4"></td>
                                <td align="center"><input type="radio" required name="Q3" id="Q3" value="5"></td>
                            </tr>
                            <tr>
                                <td>Dosen memiliki pengetahuan yang mendalam tentang materi kuliah.</td>
                                <td align="center"><input type="radio" required name="Q4" id="Q4" value="1"></td>
                                <td align="center"><input type="radio" required name="Q4" id="Q4" value="2"></td>
                                <td align="center"><input type="radio" required name="Q4" id="Q4" value="3"></td>
                                <td align="center"><input type="radio" required name="Q4" id="Q4" value="4"></td>
                                <td align="center"><input type="radio" required name="Q4" id="Q4" value="5"></td>
                            </tr>
                            <tr>
                                <td>Dosen memberikan bahan bacaan yang relevan dan mendukung pembelajaran.</td>
                                <td align="center"><input type="radio" required name="Q5" id="Q5" value="1"></td>
                                <td align="center"><input type="radio" required name="Q5" id="Q5" value="2"></td>
                                <td align="center"><input type="radio" required name="Q5" id="Q5" value="3"></td>
                                <td align="center"><input type="radio" required name="Q5" id="Q5" value="4"></td>
                                <td align="center"><input type="radio" required name="Q5" id="Q5" value="5"></td>
                            </tr>
                            <tr>
                                <td>Dosen memiliki kemampuan mengelola kelas dengan baik.</td>
                                <td align="center"><input type="radio" required name="Q6" id="Q6" value="1"></td>
                                <td align="center"><input type="radio" required name="Q6" id="Q6" value="2"></td>
                                <td align="center"><input type="radio" required name="Q6" id="Q6" value="3"></td>
                                <td align="center"><input type="radio" required name="Q6" id="Q6" value="4"></td>
                                <td align="center"><input type="radio" required name="Q6" id="Q6" value="5"></td>
                            </tr>
                            <tr>
                                <td>Dosen datang tepat waktu dan mematuhi jadwal perkuliahan.</td>
                                <td align="center"><input type="radio" required name="Q7" id="Q7" value="1"></td>
                                <td align="center"><input type="radio" required name="Q7" id="Q7" value="2"></td>
                                <td align="center"><input type="radio" required name="Q7" id="Q7" value="3"></td>
                                <td align="center"><input type="radio" required name="Q7" id="Q7" value="4"></td>
                                <td align="center"><input type="radio" required name="Q7" id="Q7" value="5"></td>
                            </tr>
                            <tr>
                                <td>Dosen merespons pertanyaan dan konsultasi di luar kelas dengan baik.</td>
                                <td align="center"><input type="radio" required name="Q8" id="Q8" value="1"></td>
                                <td align="center"><input type="radio" required name="Q8" id="Q8" value="2"></td>
                                <td align="center"><input type="radio" required name="Q8" id="Q8" value="3"></td>
                                <td align="center"><input type="radio" required name="Q8" id="Q8" value="4"></td>
                                <td align="center"><input type="radio" required name="Q8" id="Q8" value="5"></td>
                            </tr>
                            <tr>
                                <td>Dosen memiliki sikap profesional terhadap mahasiswa.</td>
                                <td align="center"><input type="radio" required name="Q9" id="Q9" value="1"></td>
                                <td align="center"><input type="radio" required name="Q9" id="Q9" value="2"></td>
                                <td align="center"><input type="radio" required name="Q9" id="Q9" value="3"></td>
                                <td align="center"><input type="radio" required name="Q9" id="Q9" value="4"></td>
                                <td align="center"><input type="radio" required name="Q9" id="Q9" value="5"></td>
                            </tr>
                            <tr>
                                <td>Dosen memberikan informasi yang jelas tentang penilaian dan kriteria penilaian.</td>
                                <td align="center"><input type="radio" required name="Q10" id="Q10" value="1"></td>
                                <td align="center"><input type="radio" required name="Q10" id="Q10" value="2"></td>
                                <td align="center"><input type="radio" required name="Q10" id="Q10" value="3"></td>
                                <td align="center"><input type="radio" required name="Q10" id="Q10" value="4"></td>
                                <td align="center"><input type="radio" required name="Q10" id="Q10" value="5"></td>
                            </tr>
                            <tr>
                                <td>Keterangan :</td>
                                <td colspan="5"><textarea class="form-control" id="Keterangan" name="Keterangan" placeholder="Evaluasi lain" required></textarea></td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                        <input type="hidden" id="ID_Jadwal" name="ID_Jadwal" value="">
                        <input type="text" id="ID_Kuis" name="ID_Kuis" value="<?= $idkuis; ?>">
                        <input type="hidden" id="Kode" name="Kode" value="">
                        <input type="hidden" id="MHS" name="MHS" value="<?= $ft; ?>">
                        <!-- <input type="hidden" id="Status" name="Status" value="Confirmed"> -->
                        <button class="btn btn-primary" type="submit" id="Kuis" name="Kuis">Submit Kuisoner</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <!-- Monev Modal-->
    <div class="modal fade" id="DetailInputMonevModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form action="" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="InputMonevModalLabel"></h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table>
                            <tr>
                                <td>Mata Kuliah</td>
                                <td>:</td>
                                <td>
                                    <div id="MK"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>Dosen</td>
                                <td>:</td>
                                <td>
                                    <div id="NM"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>Kode Mata Kuliah</td>
                                <td>:</td>
                                <td>
                                    <div id="KMK"></div>
                                    <input type="hidden" class="form-control" id="Kode_MataKuliah" name="Kode_MataKuliah" placeholder="" required>
                                </td>
                            </tr>
                        </table>
                        <div class="col">
                            <div class="col">
                                Judul Materi
                            </div>
                            <div class="col">
                                <input type="Text" class="form-control" id="Materi" name="Materi" placeholder="" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="col">
                                Pilih Hari Pelaksanaan
                            </div>
                            <div class="col">
                                <select class="form-control selectpicker" name="Hari_Pelaksanaan" id="Hari_Pelaksanaan" data-live-search="true">
                                    <option value="">Pilih Hari Pelaksanaan</option>
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                    <option value="Sunday">Sunday</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="col">
                                Tanggal Pelaksanaan
                            </div>
                            <div class="col">
                                <input type="date" class="form-control" id="Tanggal_Pelaksanaan" name="Tanggal_Pelaksanaan" placeholder="">
                            </div>
                        </div>
                        <div class="col">
                            <div class="col">
                                Pilih Hari Pengganti
                            </div>
                            <div class="col">
                                <select class="form-control selectpicker" name="Hari_Pengganti" id="Hari_Pengganti" data-live-search="true">
                                    <option value="">Pilih Hari Pengganti</option>
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                    <option value="Sunday">Sunday</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="col">
                                Tanggal Pengganti
                            </div>
                            <div class="col">
                                <input type="date" class="form-control" id="Tanggal_Pengganti" name="Tanggal_Pengganti" placeholder="">
                            </div>
                        </div>
                        <div class="col">
                            <div class="col">
                                Jenis Materi
                            </div>
                            <div class="col">
                                <select class="form-control selectpicker" name="Jenis_Materi" id="Jenis_Materi" data-live-search="true" required>
                                    <option value="">Pilih Pelaksanaan</option>
                                    <option value="File Text">File Text</option>
                                    <option value="File Text & Audio Video">File Text & Audio Video</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="col">
                                Platform
                            </div>
                            <div class="col">
                                <select class="form-control selectpicker" name="Platform" id="Platform" data-live-search="true" required>
                                    <option value="">Pilih Pelaksanaan</option>
                                    <option value="E-Learning UNIBI">E-Learning UNIBI</option>
                                    <option value="E-Learning UNIBI & GMeet">E-Learning UNIBI & GMeet</option>
                                    <option value="E-Learning UNIBI & Zoom">E-Learning UNIBI & Zoom</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="col">
                                Pilih Pelaksanaan
                            </div>
                            <div class="col">
                                <select class="form-control selectpicker" name="Pelaksanaan" id="Pelaksanaan" data-live-search="true" required>
                                    <option value="">Pilih Pelaksanaan</option>
                                    <option value="Synchronus">Synchronus</option>
                                    <option value="Asynchronus">Asynchronus</option>
                                    <option value="Offline">Offline</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                        <input type="hidden" id="ID_Monev" name="ID_Monev" value="<?=$idgen;?>">
                        <button class="btn btn-primary" type="submit" id="InMonev" name="InMonev">Submit</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="assets/vendor/chart.js/Chart.min.js"></script>
    <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="assets/js/demo/chart-area-demo.js"></script>
    <script src="assets/js/demo/chart-pie-demo.js"></script>
    <script src="assets/js/demo/datatables-demo.js"></script>

    <!-- Boostrapselect -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js" integrity="sha512-yDlE7vpGDP7o2eftkCiPZ+yuUyEcaBwoJoIhdXv71KZWugFqEphIS3PU60lEkFaz8RxaVsMpSvQxMBaKVwA5xg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        const view = document.getElementById('show-monev');
        $("#show-monev").on("click", function() {
            event.preventDefault();
            const id = $(this).data("id");
            // alert($(this).data('id'));
            $.ajax({
                method: 'post',
                url: 'getMonev.php',
                data: {
                    ID_Monev: id
                }
            }).done((data) => {
                data = JSON.parse(data);
                console.log(data);
                console.log(data.ID_Monev);
                $("#DetailMonevModalLabel").html("<b>Hasil Kegiatan Belajar Mengajar</b>");
                $('#ID_Monev').val(data.ID_Monev);
                $('#Nama_MataKuliah').html(data.Nama_MataKuliah);
                $('#Materi').html(data.Materi);
                $('#Hari_Pelaksanaan').html(data.Hari_Dilaksanakan);
                $('#Tanggal_Pelaksanaan').html(data.Tanggal_Dilaksanakan);
                $('#Hari_Pengganti').html(data.Hari_Pengganti);
                $('#Tanggal_Pengganti').html(data.Tanggal_Pengganti);
                $('#Jenis_Materi').html(data.Jenis_Materi);
                $('#Platform').html(data.Platform);
                $('#Pelaksanaan').html(data.Pelaksanaan);
                $('#KK').html(data.Status_1);
                $('#PM').html(data.Status_2);


                $('#DetailMonevModal').modal('toggle')
                if (data.data) {
                    data = data.data;
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: 'Data tidak valid.'
                    })
                }
            }).fail(($xhr) => {
                Toast.fire({
                    icon: 'error',
                    title: 'Gagal mendapatkan data.'
                })
            }).always(() => {
                setBtnLoading(data, '<i class="fa fa-edit"></i> Ubah', false);
            })
        });


        const viewkuis = document.getElementById('show-kuis');
        $("#show-kuis").on("click", function() {
            event.preventDefault();
            const id = $(this).data("id");
            // alert($(this).data('id'));
            $.ajax({
                method: 'post',
                url: 'getKuis.php',
                data: {
                    ID_Jadwal: id
                }
            }).done((data) => {
                data = JSON.parse(data);
                console.log(data);
                console.log(data.ID_Jadwal);
                $("#KuisModalLabel").html("<b>Kuisoner Evaluasi</b>");
                $('#ID_Jadwal').val(data.ID_Jadwal);
                $('#Kode').val(data.Kode);
                $('#Matkul').html(data.Matkul);
                $('#Nama').html(data.Dosen);

                $('#DetailKuisModal').modal('toggle')
                if (data.data) {
                    data = data.data;
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: 'Data tidak valid.'
                    })
                }
            }).fail(($xhr) => {
                Toast.fire({
                    icon: 'error',
                    title: 'Gagal mendapatkan data.'
                })
            }).always(() => {
                setBtnLoading(data, '<i class="fa fa-edit"></i> Ubah', false);
            })
        });

        const viewinputmonev = document.getElementById('show-inMonev');
        $("#show-inMonev").on("click", function() {
            event.preventDefault();
            const id = $(this).data("id");
            // alert($(this).data('id'));
            $.ajax({
                method: 'post',
                url: 'getKuis.php',
                data: {
                    ID_Jadwal: id
                }
            }).done((data) => {
                data = JSON.parse(data);
                console.log(data);
                console.log(data.ID_Jadwal);
                $("#InputMonevModalLabel").html("<b>Input Data Pembelajaran</b>");
                $('#ID').val(data.ID_Jadwal);
                $('#KMK').html(data.Kode);
                $('#Kode_MataKuliah').val(data.Kode);
                $('#MK').html(data.Matkul);
                $('#NM').html(data.Dosen);

                $('#DetailInputMonevModal').modal('toggle')
                if (data.data) {
                    data = data.data;
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: 'Data tidak valid.'
                    })
                }
            }).fail(($xhr) => {
                Toast.fire({
                    icon: 'error',
                    title: 'Gagal mendapatkan data.'
                })
            }).always(() => {
                setBtnLoading(data, '<i class="fa fa-edit"></i> Ubah', false);
            })
        });
    </script>
</body>

</html>