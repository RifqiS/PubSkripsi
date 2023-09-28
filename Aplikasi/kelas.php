<!DOCTYPE html>

<?php
require('config/config.php');
unset($_SESSION['edits']);
unset($_SESSION['editdata']);

$idgen = generateKode('kelas', 'Kode_Kelas', 'JRS', '3');

if (isset($_POST['save'])) {
    if (($_POST['edited'] == '0' ? inKelas($_POST) : editKelas($_POST)) > 0) {
        echo "<script type='text/javascript'>
                alert('Save Success !');
                window.location.href = 'kelas.php';
                </script>";
    } else {
        echo "<script type='text/javascript'>
                alert('Save Failed !');
                window.location.href = 'kelas.php';
                </script>";
    };
    unset($_SESSION['edits']);
    unset($_SESSION['editdata']);
}

if (isset($_POST['delete'])) {
    if (delKelas($_POST['idkat']) > 0) {
        echo "<script type='text/javascript'>
                alert('Data Has Deleted !');
                window.location.href = 'kelas.php';
                </script>";
    }
}

if (isset($_POST['edit'])) {
    if ($_POST['idkat'] != null) {
        $ids = $_POST['idkat'];
        $getKat = query("SELECT * FROM kelas WHERE Kode_Kelas  = '$ids'")[0];
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

    <title><?php echo $_SESSION['title'];?></title>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

    <?php include "sidebar.php";?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

            <?php include "topbar.php";?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Form Data Kelas</h1>
                    <!-- Collapsable Card Example -->
                    <div class="card shadow mb-4">
                        <!-- Card Header - Accordion -->
                        <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
                            role="button" aria-expanded="true" aria-controls="collapseCardExample">
                            <h6 class="m-0 font-weight-bold text-primary">Input Data Kelas</h6>
                        </a>
                        <!-- Card Content - Collapse -->
                        <div class="collapse show" id="collapseCardExample">
                            <div class="card-body">
                                <form method="POST" action="">
                                    <input type="hidden" name="edited" id="edited" value="<?= isset($_SESSION['editdata']) == true ? '1' : '0'; ?>">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="col">
                                                Kode Kelas
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="Kode_Kelas" name="Kode_Kelas" placeholder="Ex: P" value="<?= isset($_SESSION['editdata']) == true ? $_SESSION['editdata']['Kode_Kelas'] : $idgen; ?>" required readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="col">
                                                Nama Kelas
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="Nama_Kelas" name="Nama_Kelas" placeholder="Nama Kelas" value="<?= isset($_SESSION['editdata']) == true ? $_SESSION['editdata']['Nama_Kelas'] : ''; ?>" required>
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
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Kelas || <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#DetailImportXLSModal">Import Data</button></h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Kode Kelas</th>
                                            <th>Nama Kelas</th>
                                            <th>*</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        $dataKat = query("SELECT * FROM Kelas");
                                        foreach ($dataKat as $row) :
                                        ?>
                                            <tr>
                                                <td><?= $row['Kode_Kelas']; ?></td>
                                                <td><?= $row['Nama_Kelas']; ?></td>
                                                <td>
                                                    <form action="" method="post">
                                                        <input type="hidden" name="idkat" value="<?= $row['Kode_Kelas']; ?>">
                                                        <button id="delete" name="delete" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure ?')"><i class="fas fa-trash"></i></button>
                                                        <button id="edit" name="edit" class="btn btn-sm btn-outline-warning btn-lg"><i class="fas fa-edit"></i></button>
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
            <?php include 'footer.php';?>
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
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
            <form action="upKelas.php" method="POST" enctype="multipart/form-data">
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

</body>

</html>