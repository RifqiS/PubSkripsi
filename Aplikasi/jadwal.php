<!DOCTYPE html>

<?php
require('config/config.php');
unset($_SESSION['edits']);
unset($_SESSION['editdata']);


// $idgen = generateKode('jadwal', 'ID_Jadwal', 'IJD', 6);

if (isset($_POST['save'])) {
    if (($_POST['edited'] == '0' ? inJadwal($_POST) : editJadwal($_POST)) > 0) {
        echo "<script type='text/javascript'>
                alert('Save Success !');
                window.location.href = 'jadwal.php';
                </script>";
    } else {
        echo "<script type='text/javascript'>
                alert('Save Failed !');
                window.location.href = 'jadwal.php';
                </script>";
    };
    unset($_SESSION['edits']);
    unset($_SESSION['editdata']);
}

if (isset($_POST['delete'])) {
    if (delJadwal($_POST['ID_Jadwal']) > 0) {
        echo "<script type='text/javascript'>
                alert('Data Has Deleted !');
                window.location.href = 'jadwal.php';
                </script>";
    }
}

if (isset($_POST['edit'])) {
    if ($_POST['ID_Jadwal'] != null) {
        $ids = $_POST['ID_Jadwal'];
        $getKat = query("SELECT * FROM jadwal WHERE ID_Jadwal = '$ids'")[0];
        $_SESSION['edits'] = true;
        $_SESSION['editdata'] = $getKat;
    }
}
if (isset($_POST['cancel'])) {
    unset($_SESSION['edits']);
    unset($_SESSION['editdata']);
}
?>

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
                    <h1 class="h3 mb-2 text-gray-800">Form Jadwal</h1>

                    <!-- Collapsable Card Example -->
                    <div class="card shadow mb-4">
                        <!-- Card Header - Accordion -->
                        <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                            <h6 class="m-0 font-weight-bold text-primary">Input Data Jadwal Mata Kuliah</h6>
                        </a>
                        <!-- Card Content - Collapse -->
                        <div class="collapse show" id="collapseCardExample">
                            <div class="card-body">
                                <form method="POST" action="">
                                    <input type="hidden" name="edited" id="edited" value="<?= isset($_SESSION['editdata']) == true ? '1' : '0'; ?>">
                                    <div class="row">
                                        <!-- <div class="col-md-6">
                                            <div class="col">
                                                ID Jadwal
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="ID_Jadwal" name="ID_Jadwal" placeholder="Ex: P" value="<?= isset($_SESSION['editdata']) == true ? $_SESSION['editdata']['ID_Jadwal'] : $idgen; ?>" required readonly>
                                            </div>
                                        </div> -->
                                        <div class="col-md-6">
                                            <div class="col">
                                                Mata Kuliah
                                            </div>
                                            <div class="col">
                                                <select class="form-control selectpicker" name="Kode_MataKuliah" id="Kode_MataKuliah" data-live-search="true" required>
                                                    <option value="">Pilih Kelas</option>
                                                    <?php
                                                    $getkatpro = query("SELECT * FROM matakuliah");
                                                    foreach ($getkatpro as $key) :
                                                    ?>
                                                        <option <?= isset($_SESSION['editdata']) == true ? ($_SESSION['editdata']['Kode_MataKuliah'] == $key['Kode_MataKuliah'] ? 'selected' : '') : ''; ?> value="<?= $key['Kode_MataKuliah']; ?>"><?= $key['Kode_MataKuliah']; ?> | <?= $key['Nama_MataKuliah']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="col">
                                                Pilih Dosen
                                            </div>
                                            <div class="col">
                                                <select class="form-control selectpicker" name="NIP" id="NIP" data-live-search="true" required>
                                                    <option value="">Pilih Dosen</option>
                                                    <?php
                                                    $getkatpro = query("SELECT * FROM dosen");
                                                    foreach ($getkatpro as $key) :
                                                    ?>
                                                        <option <?= isset($_SESSION['editdata']) == true ? ($_SESSION['editdata']['NIP'] == $key['NIP'] ? 'selected' : '') : ''; ?> value="<?= $key['NIP']; ?>"><?= $key['Kode_Dosen']; ?> | <?= $key['Nama']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="col">
                                                Pilih Hari Jadwal
                                            </div>
                                            <div class="col">
                                                <select class="form-control selectpicker" name="Hari" id="Hari" data-live-search="true" required>
                                                    <option value="">Pilih Hari</option>
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
                                        <div class="col-md-6">
                                            <div class="col">
                                                Jam Mulai
                                            </div>
                                            <div class="col">
                                                <input type="time" class="form-control" id="Jam_Awal" name="Jam_Awal" placeholder="Ex: 1xxx" value="<?= isset($_SESSION['editdata']) == true ? $_SESSION['editdata']['Jam_Awal'] : ''; ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="col">
                                                Jam Berakhir
                                            </div>
                                            <div class="col">
                                                <input type="time" class="form-control" id="Jam_Akhir" name="Jam_Akhir" placeholder="Ex: 1xxx" value="<?= isset($_SESSION['editdata']) == true ? $_SESSION['editdata']['Jam_Akhir'] : ''; ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="col">
                                                Pilih Kelas
                                            </div>
                                            <div class="col">
                                                <select class="form-control selectpicker" name="Kelas" id="Kelas" data-live-search="true" required>
                                                    <option value="">Pilih Kelas</option>
                                                    <?php
                                                    $getkatpro = query("SELECT * FROM kelas");
                                                    foreach ($getkatpro as $key) :
                                                    ?>
                                                        <option <?= isset($_SESSION['editdata']) == true ? ($_SESSION['editdata']['Kelas'] == $key['Kode_Kelas'] ? 'selected' : '') : ''; ?> value="<?= $key['Kode_Kelas']; ?>"><?= $key['Kode_Kelas']; ?> | <?= $key['Nama_Kelas']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="col">
                                                Ruangan
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="Ruang" name="Ruang" value="<?= isset($_SESSION['editdata']) == true ? $_SESSION['editdata']['Ruang'] : ''; ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="col">
                                                Pilih Kelas Gabungan
                                            </div>
                                            <div class="col">
                                                <select class="form-control selectpicker" name="Gabungan" id="Gabungan" data-live-search="true">
                                                    <option value="">Pilih Kelas</option>
                                                    <?php
                                                    $getkatpro = query("SELECT * FROM kelas");
                                                    foreach ($getkatpro as $key) :
                                                    ?>
                                                        <option <?= isset($_SESSION['editdata']) == true ? ($_SESSION['editdata']['Gabungan'] == $key['Kode_Kelas'] ? 'selected' : '') : ''; ?> value="<?= $key['Kode_Kelas']; ?>"><?= $key['Kode_Kelas']; ?> | <?= $key['Nama_Kelas']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mx-3 my-2">
                                            <button id="save" name="save" class="btn btn-success">Submit</button>
                                            <button type="reset" id="reset" name="reset" class="btn btn-warning">Clear</button>
                                            <?php if (isset($_SESSION['edits'])) {                                            ?>
                                                <button id="cancel" name="cancel" class="btn btn-danger" formnovalidate>Cancel</button>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Jadwal Mata Kuliah || <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#DetailImportXLSModal">Import Data</button></h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Mata Kuliah</th>
                                            <th>Dosen</th>
                                            <th>Hari</th>
                                            <th>Jam Mulai</th>
                                            <th>Jam Selesai</th>
                                            <th>Kelas</th>
                                            <th>Ruangan</th>
                                            <th>Kelas Gabungan</th>
                                            <th>*</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        $dataKat = query("SELECT * FROM jadwal INNER JOIN matakuliah ON jadwal.Kode_MataKuliah = matakuliah.Kode_Matakuliah INNER JOIN dosen ON jadwal.NIP = dosen.NIP");
                                        foreach ($dataKat as $row) :
                                        ?>
                                            <tr>
                                                <td><?= $row['Nama_MataKuliah']; ?></td>
                                                <td><?= $row['Nama']; ?></td>
                                                <td><?= $row['Hari']; ?></td>
                                                <td><?= $row['Jam_Awal']; ?></td>
                                                <td><?= $row['Jam_Akhir']; ?></td>
                                                <td><?= $row['Kelas']; ?></td>
                                                <td><?= $row['Ruang']; ?></td>
                                                <td><?= $row['Gabungan']; ?></td>
                                                <td>
                                                    <form action="" method="post">
                                                        <input type="hidden" name="ID_Jadwal" value="<?= $row['ID_Jadwal']; ?>">
                                                        <button id="delete" name="delete" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure ?')"><i class="fas fa-trash"></i></button>
                                                        <button id="edit" name="edit" class="btn btn-sm btn-outline-warning"><i class="fas fa-edit"></i></button>
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

    <!-- Import Modal-->
    <div class="modal fade" id="DetailImportXLSModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form action="upJadwal.php" method="POST" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ImportXLSModalLabel"> Import Data From XLS</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col">
                            <div class="col">
                                Pilih File XLS
                            </div>
                            <div class="col">
                                <input type="file" class="form-control" id="UpFile" name="UpFile" placeholder="" required>
                            </div>
                            <br>
                            <div class="col">
                                <span style="color: red;">
                                    <i class="fa fa-exclamation"></i> Important : Import dapat menyebabkan double data harap memeriksa sebelum melakukan import data.
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <button class="btn btn-primary" type="submit" id="upload" name="upload">Import</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
    <!-- End ofImport Modal-->

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
</body>

</html>