<!DOCTYPE html>

<?php
require('config/config.php');
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

    <?php include "sidebar.php";?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

            <?php include "topbar.php";?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Page Monitoring</h1>
                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Jadwal</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Mata Kuliah</th>
                                            <th>Dosen</th>
                                            <th>Hari</th>
                                            <th>*</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        $dataKat = query("SELECT * FROM jadwal LEFT JOIN matakuliah ON jadwal.Kode_MataKuliah = matakuliah.Kode_Matakuliah LEFT JOIN dosen ON jadwal.NIP = dosen.NIP");
                                        foreach ($dataKat as $row) :
                                        ?>
                                            <tr>
                                                <td><?= $row['Nama_MataKuliah']; ?></td>
                                                <td><?= $row['Nama']; ?></td>
                                                <td><?= $row['Hari']; ?></td>
                                                <td>
                                                    <form action="" method="post">
                                                        <input type="hidden" name="ID_Jadwal" value="<?= $row['ID_Jadwal']; ?>">
                                                        <button id="show-monev" name="show-monev" class="btn btn-sm btn-outline-info" data-id="<?= $row['Kode_MataKuliah']; ?>"><i class="fas fa-eye"> View</i></button>
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
<!-- Approve Modal-->
<div class="modal fade" id="DetailMonevModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="DetailMonevModalLabel"></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tableRinci" width="100%" cellspacing="0">
                                <tr>
                                    <th>Materi</th>
                                    <th>Tanggal</th>
                                    <th>Jenis Materi</th>
                                    <th>Platform</th>
                                    <th>Pelaksanaan</th>
                                    <th>Ketua Kelas</th>
                                    <th>Perwakilan Kelas</th>
                                </tr>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
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
        $("#show-monev").on("click", function(){
            event.preventDefault();
            const id = $(this).data("id");
            // alert($(this).data('id'));
            $.ajax({
                method: 'post',
                url: 'getMonitoring.php',
                data: {
                    Kode_MataKuliah: id
                }
            }).done((data) => {
                data = JSON.parse(data);
                console.log(data);
                console.log(data.Kode_MataKuliah);
                $("#tableRinci").find("tr:gt(0)").remove();
                $("#DetailMonevModalLabel").html("<b>Rincian Hasil Kegiatan Belajar Mengajar</b>");
                //$('<thead><tr><th>Materi</th><th>Tanggal Dilaksanakan</th><th>Jenis Materi</th><th>Platform</th><th>Pelaksanaan</th><th>Ketua Kelas</th><th>Perwakilan Mahasiswa</th></tr></thead>');
                for (var i=0; i<data.length; i++) {
                    var row = $('<tr id="barisIsi"><td>' + 
                        data[i].Materi+ '</td><td>' + 
                        data[i].Tanggal_Dilaksanakan + '</td><td>' + 
                        data[i].Jenis_Materi + '</td><td>' + 
                        data[i].Platform + '</td><td>' + 
                        data[i].Pelaksanaan + '</td><td>' + 
                        data[i].Status_1 + '</td><td>' + 
                        data[i].Status_2 + '</td></tr>');
                    $('#tableRinci').append(row);
                }
                // $('#Kode_MataKuliah').val(data.Kode_MataKuliah);
                // $('#Nama_MataKuliah').val(data.Nama_MataKuliah);
                // $('#Materi').val(data.Materi);
                // $('#Hari_Pelaksanaan').val(data.Hari_Dilaksanakan);
                // $('#Tanggal_Pelaksanaan').val(data.Tanggal_Dilaksanakan);
                // $('#Hari_Pengganti').val(data.Hari_Pengganti);
                // $('#Tanggal_Pengganti').val(data.Tanggal_Pengganti);
                // $('#Jenis_Materi').val(data.Jenis_Materi);
                // $('#Platform').val(data.Platform);
                // $('#Pelaksanaan').val(data.Pelaksanaan);
                // $('#KK').val(data.Status_1);
                // $('#PM').val(data.Status_2);

                
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
                setBtnLoading(data, '<i class="fa fa-edit"></i> Ubah', false);
            })
        });
        
    </script>
</body>

</html>