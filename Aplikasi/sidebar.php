<?php
    if(!isset($_SESSION['usp']) && !isset($_SESSION['lvs'])){
        echo "<script>
			document.location.href='login.php';
		</script>"; 
    }
?>
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-industry"></i>
    </div>
    <div class="sidebar-brand-text mx-3">MONEV<sup>FTI</sup></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="<?= base_url() ?>">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>

<?php if ($_SESSION["lvs"] === "Administrator") {?>
    <!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Interface
</div>
<!-- Nav Item - Tables -->
<!-- <li class="nav-item">
    <a class="nav-link" href="monev.php">
        <i class="fas fa-fw fa-table"></i>
        <span>Monitoring Evaluasi</span></a>
</li> -->
<li class="nav-item">
    <a class="nav-link" href="jadwal.php">
        <i class="fas fa-fw fa-table"></i>
        <span>Jadwal</span></a>
</li>
<?php }?>

<?php if ($_SESSION["lvs"] === "Administrator") {?>
<!-- Divider -->
<hr class="sidebar-divider">
<!-- Heading -->
<div class="sidebar-heading">
    Data
</div>
<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
        aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-folder"></i>
        <span>Data Pages</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Base Data:</h6>
            <!-- <a class="collapse-item" href="jadwal.php"> Jadwal</a> -->
            <a class="collapse-item" href="matakuliah.php">Mata Kuliah</a>
            <a class="collapse-item" href="plotkelas.php">Plotting Mahasiswa</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Other:</h6>
            <a class="collapse-item" href="mahasiswa.php">Data Mahasiswa</a>
            <a class="collapse-item" href="dosen.php">Data Dosen</a>
            <a class="collapse-item" href="jurusan.php">Data Jurusan</a>
            <a class="collapse-item" href="kelas.php">Data Kelas</a>
        </div>
    </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider">
<!-- Heading -->
<div class="sidebar-heading">
    Report
</div>
<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesReport"
        aria-expanded="true" aria-controls="collapsePagesReport">
        <i class="fas fa-fw fa-folder"></i>
        <span>Report Pages</span>
    </a>
    <div id="collapsePagesReport" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Report Data:</h6>
            <a class="collapse-item" href="monitoring.php"> Monitoring</a>
            <a class="collapse-item" href="evadom.php">Evadom</a>
        </div>
    </div>
</li>
<?php }?>

<!-- Nav Item - Charts -->
<!-- <li class="nav-item">
    <a class="nav-link" href="#">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Report</span></a>
</li> -->


</ul>
<!-- End of Sidebar -->