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
                    <h1 class="h3 mb-2 text-gray-800">Page Evaluasi Dosen</h1>
                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Hasil Evaluasi Dosen
                            <a class="btn btn-info" target="_blank" href="ExpEvadom.php">EXPORT KE EXCEL</a>
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Mata Kuliah</th>
                                            <th>Dosen</th>
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
                            <td><div id="Matkul"></div></td>
                        </tr>
                        <!-- <tr>
                            <td>Dosen</td>
                            <td>:</td>
                            <td><div id="Nama"></div></td>
                            
                        </tr> -->
                    </table>
                    <table border="1" align="center" class="table">
                        <tr>
                            <td align="center">Pertanyaan</td>
                            <td align="center">Rata Rata Nilai</td>
                            <td align="center">Bobot Nilai</td>
                        </tr>
                        <tr>
                            <td>Dosen memberikan materi kuliah dengan jelas dan sistematis.</td>
                            <td><div id="Q1"></div></td>
                            <td><div id="B1"></div></td>
                        </tr>
                        <tr>
                            <td>Dosen mendorong diskusi dan interaksi dalam kelas.</td>
                            <td><div id="Q2"></div></td>
                            <td><div id="B2"></div></td>
                        </tr>
                        <tr>
                            <td>Dosen memberikan umpan balik (feedback) konstruktif terhadap tugas dan pertanyaan mahasiswa.</td>
                            <td><div id="Q3"></div></td>
                            <td><div id="B3"></div></td>
                        </tr>
                        <tr>
                            <td>Dosen memiliki pengetahuan yang mendalam tentang materi kuliah.</td>
                            <td><div id="Q4"></div></td>
                            <td><div id="B4"></div></td>
                        </tr>
                        <tr>
                            <td>Dosen memberikan bahan bacaan yang relevan dan mendukung pembelajaran.</td>
                            <td><div id="Q5"></div></td>
                            <td><div id="B5"></div></td>
                        </tr>
                        <tr>
                            <td>Dosen memiliki kemampuan mengelola kelas dengan baik.</td>
                            <td><div id="Q6"></div></td>
                            <td><div id="B6"></div></td>
                        </tr>
                        <tr>
                            <td>Dosen datang tepat waktu dan mematuhi jadwal perkuliahan.</td>
                            <td><div id="Q7"></div></td>
                            <td><div id="B7"></div></td>
                        </tr>
                        <tr>
                            <td>Dosen merespons pertanyaan dan konsultasi di luar kelas dengan baik.</td>
                            <td><div id="Q8"></div></td>
                            <td><div id="B8"></div></td>
                        </tr>
                        <tr>
                            <td>Dosen memiliki sikap profesional terhadap mahasiswa.</td>
                            <td><div id="Q9"></div></td>
                            <td><div id="B9"></div></td>
                        </tr>
                        <tr>
                            <td>Dosen memberikan informasi yang jelas tentang penilaian dan kriteria penilaian.</td>
                            <td><div id="Q10"></div></td>
                            <td><div id="B10"></div></td>
                        </tr>
                        <!-- <tr>
                            <td>Keterangan :</td>
                            <td colspan="5"><textarea class="form-control" id="Keterangan" name="Keterangan" placeholder="Evaluasi lain" required></textarea></td>
                        </tr> -->
                    </table>
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
                url: 'getEvadom.php',
                data: {
                    Kode_MataKuliah: id
                }
            }).done((data) => {
                data = JSON.parse(data);
                console.log(data);
                console.log(data.Kode_MataKuliah);
                // $("#tableRinci").find("tr:gt(0)").remove();
                $("#DetailMonevModalLabel").html("<b>Rincian Hasil Kegiatan Belajar Mengajar</b>");
                $('#Kode_MataKuliah').val(data.Kode_MataKuliah);
                $('#Kode').html(data.Kode);
                $('#Matkul').html(data.Matkul);
                // $('#Nama').html(data.Dosen);
                $('#Q1').html(data.Q1);
                $('#Q2').html(data.Q2);
                $('#Q3').html(data.Q3);
                $('#Q4').html(data.Q4);
                $('#Q5').html(data.Q5);
                $('#Q6').html(data.Q6);
                $('#Q7').html(data.Q7);
                $('#Q8').html(data.Q8);
                $('#Q9').html(data.Q9);
                $('#Q10').html(data.Q10);
                $('#B1').html(LogicBobot(data.Q1));
                $('#B2').html(LogicBobot(data.Q2));
                $('#B3').html(LogicBobot(data.Q3));
                $('#B4').html(LogicBobot(data.Q4));
                $('#B5').html(LogicBobot(data.Q5));
                $('#B6').html(LogicBobot(data.Q6));
                $('#B7').html(LogicBobot(data.Q7));
                $('#B8').html(LogicBobot(data.Q8));
                $('#B9').html(LogicBobot(data.Q9));
                $('#B10').html(LogicBobot(data.Q10));
                
                
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
        function LogicBobot(LogicBobot) {
            let text = '';
            if (LogicBobot >= 4.1 && LogicBobot <= 5) {
                text="Sangat Baik";
            }else if (LogicBobot >= 3.1 && LogicBobot <= 4) {
                text="Baik";
            }else if (LogicBobot >= 2.1 && LogicBobot <= 3) {
                text="Cukup";
            }else if (LogicBobot >= 1.1 && LogicBobot <= 2) {
                text=" Buruk";
            }else{
                text="Sangat Buruk";
            }
            return text;
        }
    </script>
</body>

</html>