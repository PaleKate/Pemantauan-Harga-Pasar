<?php
session_start();
error_reporting(0);
include('../includes/config.php');
include('../includes/format_rupiah.php');
include('../includes/library.php');
if(strlen($_SESSION['login_saharga'])==0){	
header('location: ../../index.php');
} else{
?>	
<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Admin Dashboard | Aplikasi Saharga</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
        <meta content="Coderthemes" name="author">
        <?php include('../includes/head.php'); ?>

    </head>

    <body class="loading" data-layout="topnav" data-layout-config='{"layoutBoxed":false,"darkMode":true}'>
        <!-- Begin page -->
        <div class="wrapper">

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
					<header class="fixed-top">
                    <!-- Topbar Start -->
					<?php include ('../includes/header.php'); ?>
					<?php include ('../includes/sidebar.php'); ?>
                    <!-- end Topbar -->
					</header>
					
                    <!-- Start Content-->
                    <div class="container-fluid" style="margin-top:10%;">


                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title text-center">Pantauan Harga Rata-rata</h4>
                                        <h4 class="header-title text-center">Bahan Pokok Pasar</h4>
                                        <h4 class="header-title text-center">Kabupaten Tasikmalaya</h4>
										
                                        <ul class="nav nav-tabs nav-bordered mb-3">
                                            <li class="nav-item">
                                                <a href="#basic-datatable-preview" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                                    Data Harga Komoditas
                                                </a>
                                            </li>
											<li class="nav-item">
                                                <a href="#data-pasar" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                                                    Data Harga Komoditas Per Pasar
                                                </a>
                                            </li>
											<?php if($_SESSION['login_saharga']){
												$id=$_SESSION['login_saharga'];
												$sql ="SELECT * FROM administrator WHERE level='$id'";
													$query = mysqli_query($koneksidb,$sql);
													$results = mysqli_fetch_array($query);
													if($results['level']!=="Admin"){?>
                                            <li class="nav-item">
                                                <a href="#basic-datatable-code" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                                                    Input Data Bahan Pokok
                                                </a>
                                            </li>
											<?php }}?>
                                        </ul> <!-- end nav-->
                                        
										<div class="tab-content">
                                            <div class="tab-pane show active" id="basic-datatable-preview">
                                                <div class="row mb-2">
													<div class="col-sm-6">
														<button type="button" onclick="generate()" class="btn btn-danger mb-2 mt-2"><i class="mdi mdi-pdf-box"></i> PDF</button>&nbsp;&nbsp;
														<button type="submit" onclick="window.open('harga-excel.php?dari=<?php echo $_POST['dari']; ?>&&sampai=<?php echo $_POST['sampai']; ?>')" class="btn btn-success mb-2 mt-2"><i class="mdi mdi-microsoft-excel"></i> Excel</button>
													</div>
													<div class="col-sm-6">
													<form method="POST" name="periode" onSubmit="return valid();">
														<div class="row gy-2 gx-2 align-items-center">
															<div class="col-sm-5 mt-3">
																<input type="text" class="form-control" name="dari" placeholder="Pilih Tanggal" onfocus="(this.type='date')" required>
															</div>
															<div class="col-sm-5 mt-3">
																<input type="text" class="form-control" name="sampai" placeholder="Pilih Tanggal" onfocus="(this.type='date')" required>
															</div>
															<div class="col-sm-2 mt-3">
																<label class="form-label"></label>
																<button type="submit" class="btn btn-primary" name="cari">Cari</button>
															</div>
														</div>
													</form>
													</div>
												</div>
												<div class="table-responsive">
												<table id="scroll-horizontal-datatable" class="table table-striped table-bordered table-hover nowrap w-100">
                                                    <thead>
                                                        <tr>
															<?php 
																if(isset($_POST['cari'])){
															?>
                                                            <th rowspan="2" class="text-center">NO</th>
                                                            <th rowspan="2" class="text-center">BAHAN POKOK</th>
                                                            <th rowspan="2" class="text-center">SATUAN</th>
																<?php }else{?>
															<th class="text-center">NO</th>
                                                            <th class="text-center">BAHAN POKOK</th>
                                                            <th class="text-center">SATUAN</th>
																<?php }?>
															<?php 
																if(isset($_POST['cari'])){
																	$dari = $_POST['dari'];
																	$sampai = $_POST['sampai'];
																	
																	$sqldari = "SELECT tgl FROM harga WHERE tgl='$dari'";
																		$querydari = mysqli_query($koneksidb,$sqldari);
																		$resultdari = mysqli_fetch_array($querydari);
																	
																	$sqlsampai = "SELECT tgl FROM harga WHERE tgl='$sampai'";
																		$querysampai = mysqli_query($koneksidb,$sqlsampai);
																		$resultsampai = mysqli_fetch_array($querysampai);
															?>
                                                            <th colspan="2" class="text-center">HARGA (Rp)</th>
                                                            <th colspan="2" class="text-center">PERUBAHAN</th>
                                                            <th colspan="2" class="text-center">KETERANGAN</th>
                                                        </tr>
                                                        <tr>
																<th class="text-center"><?php echo htmlentities(Indonesia2Tgl($resultdari['tgl']));?></th>
																<th class="text-center"><?php echo htmlentities(Indonesia2Tgl($resultsampai['tgl']));?></th>
                                                            <th>Rp</th>
                                                            <th>%</th>
                                                            <th>KET</th>
                                                            <th>HET (Rp)</th>
															<?php }?>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr><?php $nomor = 1; ?>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Beras Premium</td>
															<td class="text-center">Kg</td>
															<?php 
																if(isset($_POST['cari'])){
																	$dari = $_POST['dari'];
																	$sampai = $_POST['sampai'];
																	
																	$sqldari = "SELECT SUM(beras_p) AS jumlah FROM harga WHERE tgl ='$dari'";
																		$querydari = mysqli_query($koneksidb,$sqldari);
																		$resultdari = mysqli_fetch_array($querydari);
																		$rata2dari = $resultdari['jumlah']/5; 
																	
																	$sqlsampai = "SELECT SUM(beras_p) AS jumlah FROM harga WHERE tgl ='$sampai'";
																		$querysampai = mysqli_query($koneksidb,$sqlsampai);
																		$resultsampai = mysqli_fetch_array($querysampai);
																		$rata2sampai = $resultsampai['jumlah']/5; 
																	
																		$rpberas = $rata2sampai-$rata2dari;
																		if($rata2dari==0){
																		$persenberas = "NULL";
																		}else{
																		$persenberas = round(($rpberas/$rata2dari) *100,2);
																		}
																	
																	$sqlhet = "SELECT * FROM het";
																		$queryhet = mysqli_query($koneksidb,$sqlhet);
																		$resulthet = mysqli_fetch_array($queryhet);
															?>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2dari));?></td>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2sampai));?></td>
															<td class="text-center"><?php echo format_angka($rpberas);?></td>
															<td class="text-center"><?php echo $persenberas;?></td>
															<?php if($persenberas>0){?>
															<td class="text-center">Naik</td>
															<?php }else{ ?>
															
															<?php if($persenberas==0){?>
															<td class="text-center">Tetap</td>
															<?php }else{ ?>
															
															<?php if($persenberas<0){?>
															<td class="text-center">Turun</td>
																<?php }}}?>
															<td class="text-center"><?php echo format_angka($resulthet['beras_p']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Beras Medium</td>
															<td class="text-center">Kg</td>
															<?php 
																if(isset($_POST['cari'])){
																	$dari = $_POST['dari'];
																	$sampai = $_POST['sampai'];
																	
																	$sqldari = "SELECT SUM(beras_m) AS jumlah FROM harga WHERE tgl ='$dari'";
																		$querydari = mysqli_query($koneksidb,$sqldari);
																		$resultdari = mysqli_fetch_array($querydari);
																		$rata2dari = $resultdari['jumlah']/5; 
																	
																	$sqlsampai = "SELECT SUM(beras_m) AS jumlah FROM harga WHERE tgl ='$sampai'";
																		$querysampai = mysqli_query($koneksidb,$sqlsampai);
																		$resultsampai = mysqli_fetch_array($querysampai);
																		$rata2sampai = $resultsampai['jumlah']/5; 
																		
																		$rpberas = $rata2sampai-$rata2dari;
																		if($rata2dari==0){
																		$persenberas = "NULL";
																		}else{
																		$persenberas = round(($rpberas/$rata2dari) *100,2);
																		}
															?>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2dari));?></td>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2sampai));?></td>
															<td class="text-center"><?php echo format_angka($rpberas);?></td>
															<td class="text-center"><?php echo $persenberas;?></td>
															<?php if($persenberas>0){?>
															<td class="text-center">Naik</td>
															<?php }else{ ?>
															
															<?php if($persenberas==0){?>
															<td class="text-center">Tetap</td>
															<?php }else{ ?>
															
															<?php if($persenberas<0){?>
															<td class="text-center">Turun</td>
																<?php }}}?>
															<td class="text-center"><?php echo format_angka($resulthet['beras_m']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Gula Pasir Dalam Negeri</td>
															<td class="text-center">Kg</td>
															<?php 
																if(isset($_POST['cari'])){
																	$dari = $_POST['dari'];
																	$sampai = $_POST['sampai'];
																	
																	$sqldari = "SELECT SUM(gula) AS jumlah FROM harga WHERE tgl ='$dari'";
																		$querydari = mysqli_query($koneksidb,$sqldari);
																		$resultdari = mysqli_fetch_array($querydari);
																		$rata2dari = $resultdari['jumlah']/5; 
																	
																	$sqlsampai = "SELECT SUM(gula) AS jumlah FROM harga WHERE tgl ='$sampai'";
																		$querysampai = mysqli_query($koneksidb,$sqlsampai);
																		$resultsampai = mysqli_fetch_array($querysampai);
																		$rata2sampai = $resultsampai['jumlah']/5; 
																		
																		$rpberas = $rata2sampai-$rata2dari;
																		if($rata2dari==0){
																		$persenberas = "NULL";
																		}else{
																		$persenberas = round(($rpberas/$rata2dari) *100,2);
																		}
															?>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2dari));?></td>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2sampai));?></td>
															<td class="text-center"><?php echo format_angka($rpberas);?></td>
															<td class="text-center"><?php echo $persenberas;?></td>
															<?php if($persenberas>0){?>
															<td class="text-center">Naik</td>
															<?php }else{ ?>
															
															<?php if($persenberas==0){?>
															<td class="text-center">Tetap</td>
															<?php }else{ ?>
															
															<?php if($persenberas<0){?>
															<td class="text-center">Turun</td>
																<?php }}}?>
															<td class="text-center"><?php echo format_angka($resulthet['gula']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Minyak Goreng Bimoli</td>
															<td class="text-center">Liter</td>
															<?php 
																if(isset($_POST['cari'])){
																	$dari = $_POST['dari'];
																	$sampai = $_POST['sampai'];
																	
																	$sqldari = "SELECT SUM(bimoli) AS jumlah FROM harga WHERE tgl ='$dari'";
																		$querydari = mysqli_query($koneksidb,$sqldari);
																		$resultdari = mysqli_fetch_array($querydari);
																		$rata2dari = $resultdari['jumlah']/5; 
																	
																	$sqlsampai = "SELECT SUM(bimoli) AS jumlah FROM harga WHERE tgl ='$sampai'";
																		$querysampai = mysqli_query($koneksidb,$sqlsampai);
																		$resultsampai = mysqli_fetch_array($querysampai);
																		$rata2sampai = $resultsampai['jumlah']/5; 
																		
																		$rpberas = $rata2sampai-$rata2dari;
																		if($rata2dari==0){
																		$persenberas = "NULL";
																		}else{
																		$persenberas = round(($rpberas/$rata2dari) *100,2);
																		}
															?>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2dari));?></td>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2sampai));?></td>
															<td class="text-center"><?php echo format_angka($rpberas);?></td>
															<td class="text-center"><?php echo $persenberas;?></td>
															<?php if($persenberas>0){?>
															<td class="text-center">Naik</td>
															<?php }else{ ?>
															
															<?php if($persenberas==0){?>
															<td class="text-center">Tetap</td>
															<?php }else{ ?>
															
															<?php if($persenberas<0){?>
															<td class="text-center">Turun</td>
																<?php }}}?>
															<td class="text-center"><?php echo format_angka($resulthet['bimoli']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Minyak Goreng Curah</td>
															<td class="text-center">Liter</td>
															<?php 
																if(isset($_POST['cari'])){
																	$dari = $_POST['dari'];
																	$sampai = $_POST['sampai'];
																	
																	$sqldari = "SELECT SUM(minyak_c) AS jumlah FROM harga WHERE tgl ='$dari'";
																		$querydari = mysqli_query($koneksidb,$sqldari);
																		$resultdari = mysqli_fetch_array($querydari);
																		$rata2dari = $resultdari['jumlah']/5; 
																	
																	$sqlsampai = "SELECT SUM(minyak_c) AS jumlah FROM harga WHERE tgl ='$sampai'";
																		$querysampai = mysqli_query($koneksidb,$sqlsampai);
																		$resultsampai = mysqli_fetch_array($querysampai);
																		$rata2sampai = $resultsampai['jumlah']/5; 
																		
																		$rpberas = $rata2sampai-$rata2dari;
																		if($rata2dari==0){
																		$persenberas = "NULL";
																		}else{
																		$persenberas = round(($rpberas/$rata2dari) *100,2);
																		}
															?>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2dari));?></td>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2sampai));?></td>
															<td class="text-center"><?php echo format_angka($rpberas);?></td>
															<td class="text-center"><?php echo $persenberas;?></td>
															<?php if($persenberas>0){?>
															<td class="text-center">Naik</td>
															<?php }else{ ?>
															
															<?php if($persenberas==0){?>
															<td class="text-center">Tetap</td>
															<?php }else{ ?>
															
															<?php if($persenberas<0){?>
															<td class="text-center">Turun</td>
																<?php }}}?>
															<td class="text-center"><?php echo format_angka($resulthet['minyak_c']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Minyak Goreng Kemasan Sederhana</td>
															<td class="text-center">Liter</td>
															<?php 
																if(isset($_POST['cari'])){
																	$dari = $_POST['dari'];
																	$sampai = $_POST['sampai'];
																	
																	$sqldari = "SELECT SUM(minyak_k) AS jumlah FROM harga WHERE tgl ='$dari'";
																		$querydari = mysqli_query($koneksidb,$sqldari);
																		$resultdari = mysqli_fetch_array($querydari);
																		$rata2dari = $resultdari['jumlah']/5; 
																	
																	$sqlsampai = "SELECT SUM(minyak_k) AS jumlah FROM harga WHERE tgl ='$sampai'";
																		$querysampai = mysqli_query($koneksidb,$sqlsampai);
																		$resultsampai = mysqli_fetch_array($querysampai);
																		$rata2sampai = $resultsampai['jumlah']/5; 
																		
																		$rpberas = $rata2sampai-$rata2dari;
																		if($rata2dari==0){
																		$persenberas = "NULL";
																		}else{
																		$persenberas = round(($rpberas/$rata2dari) *100,2);
																		}
															?>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2dari));?></td>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2sampai));?></td>
															<td class="text-center"><?php echo format_angka($rpberas);?></td>
															<td class="text-center"><?php echo $persenberas;?></td>
															<?php if($persenberas>0){?>
															<td class="text-center">Naik</td>
															<?php }else{ ?>
															
															<?php if($persenberas==0){?>
															<td class="text-center">Tetap</td>
															<?php }else{ ?>
															
															<?php if($persenberas<0){?>
															<td class="text-center">Turun</td>
																<?php }}}?>
															<td class="text-center"><?php echo format_angka($resulthet['minyak_k']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Daging Sapi</td>
															<td class="text-center">Kg</td>
															<?php 
																if(isset($_POST['cari'])){
																	$dari = $_POST['dari'];
																	$sampai = $_POST['sampai'];
																	
																	$sqldari = "SELECT SUM(sapi) AS jumlah FROM harga WHERE tgl ='$dari'";
																		$querydari = mysqli_query($koneksidb,$sqldari);
																		$resultdari = mysqli_fetch_array($querydari);
																		$rata2dari = $resultdari['jumlah']/5; 
																	
																	$sqlsampai = "SELECT SUM(sapi) AS jumlah FROM harga WHERE tgl ='$sampai'";
																		$querysampai = mysqli_query($koneksidb,$sqlsampai);
																		$resultsampai = mysqli_fetch_array($querysampai);
																		$rata2sampai = $resultsampai['jumlah']/5; 
																		
																		$rpberas = $rata2sampai-$rata2dari;
																		if($rata2dari==0){
																		$persenberas = "NULL";
																		}else{
																		$persenberas = round(($rpberas/$rata2dari) *100,2);
																		}
															?>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2dari));?></td>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2sampai));?></td>
															<td class="text-center"><?php echo format_angka($rpberas);?></td>
															<td class="text-center"><?php echo $persenberas;?></td>
															<?php if($persenberas>0){?>
															<td class="text-center">Naik</td>
															<?php }else{ ?>
															
															<?php if($persenberas==0){?>
															<td class="text-center">Tetap</td>
															<?php }else{ ?>
															
															<?php if($persenberas<0){?>
															<td class="text-center">Turun</td>
																<?php }}}?>
															<td class="text-center"><?php echo format_angka($resulthet['sapi']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Daging Ayam Broiler</td>
															<td class="text-center">Kg</td>
															<?php 
																if(isset($_POST['cari'])){
																	$dari = $_POST['dari'];
																	$sampai = $_POST['sampai'];
																	
																	$sqldari = "SELECT SUM(ayam_b) AS jumlah FROM harga WHERE tgl ='$dari'";
																		$querydari = mysqli_query($koneksidb,$sqldari);
																		$resultdari = mysqli_fetch_array($querydari);
																		$rata2dari = $resultdari['jumlah']/5; 
																	
																	$sqlsampai = "SELECT SUM(ayam_b) AS jumlah FROM harga WHERE tgl ='$sampai'";
																		$querysampai = mysqli_query($koneksidb,$sqlsampai);
																		$resultsampai = mysqli_fetch_array($querysampai);
																		$rata2sampai = $resultsampai['jumlah']/5; 
																		
																		$rpberas = $rata2sampai-$rata2dari;
																		if($rata2dari==0){
																		$persenberas = "NULL";
																		}else{
																		$persenberas = round(($rpberas/$rata2dari) *100,2);
																		}
															?>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2dari));?></td>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2sampai));?></td>
															<td class="text-center"><?php echo format_angka($rpberas);?></td>
															<td class="text-center"><?php echo $persenberas;?></td>
															<?php if($persenberas>0){?>
															<td class="text-center">Naik</td>
															<?php }else{ ?>
															
															<?php if($persenberas==0){?>
															<td class="text-center">Tetap</td>
															<?php }else{ ?>
															
															<?php if($persenberas<0){?>
															<td class="text-center">Turun</td>
																<?php }}}?>
															<td class="text-center"><?php echo format_angka($resulthet['ayam_b']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Daging Ayam Kampung</td>
															<td class="text-center">Kg</td>
															<?php 
																if(isset($_POST['cari'])){
																	$dari = $_POST['dari'];
																	$sampai = $_POST['sampai'];
																	
																	$sqldari = "SELECT SUM(ayam_k) AS jumlah FROM harga WHERE tgl ='$dari'";
																		$querydari = mysqli_query($koneksidb,$sqldari);
																		$resultdari = mysqli_fetch_array($querydari);
																		$rata2dari = $resultdari['jumlah']/5; 
																	
																	$sqlsampai = "SELECT SUM(ayam_k) AS jumlah FROM harga WHERE tgl ='$sampai'";
																		$querysampai = mysqli_query($koneksidb,$sqlsampai);
																		$resultsampai = mysqli_fetch_array($querysampai);
																		$rata2sampai = $resultsampai['jumlah']/5; 
																		
																		$rpberas = $rata2sampai-$rata2dari;
																		if($rata2dari==0){
																		$persenberas = "NULL";
																		}else{
																		$persenberas = round(($rpberas/$rata2dari) *100,2);
																		}
															?>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2dari));?></td>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2sampai));?></td>
															<td class="text-center"><?php echo format_angka($rpberas);?></td>
															<td class="text-center"><?php echo $persenberas;?></td>
															<?php if($persenberas>0){?>
															<td class="text-center">Naik</td>
															<?php }else{ ?>
															
															<?php if($persenberas==0){?>
															<td class="text-center">Tetap</td>
															<?php }else{ ?>
															
															<?php if($persenberas<0){?>
															<td class="text-center">Turun</td>
																<?php }}}?>
															<td class="text-center"><?php echo format_angka($resulthet['ayam_k']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Telur Ayam Ras</td>
															<td class="text-center">Kg</td>
															<?php 
																if(isset($_POST['cari'])){
																	$dari = $_POST['dari'];
																	$sampai = $_POST['sampai'];
																	
																	$sqldari = "SELECT SUM(telur) AS jumlah FROM harga WHERE tgl ='$dari'";
																		$querydari = mysqli_query($koneksidb,$sqldari);
																		$resultdari = mysqli_fetch_array($querydari);
																		$rata2dari = $resultdari['jumlah']/5; 
																	
																	$sqlsampai = "SELECT SUM(telur) AS jumlah FROM harga WHERE tgl ='$sampai'";
																		$querysampai = mysqli_query($koneksidb,$sqlsampai);
																		$resultsampai = mysqli_fetch_array($querysampai);
																		$rata2sampai = $resultsampai['jumlah']/5; 
																		
																		$rpberas = $rata2sampai-$rata2dari;
																		if($rata2dari==0){
																		$persenberas = "NULL";
																		}else{
																		$persenberas = round(($rpberas/$rata2dari) *100,2);
																		}
															?>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2dari));?></td>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2sampai));?></td>
															<td class="text-center"><?php echo format_angka($rpberas);?></td>
															<td class="text-center"><?php echo $persenberas;?></td>
															<?php if($persenberas>0){?>
															<td class="text-center">Naik</td>
															<?php }else{ ?>
															
															<?php if($persenberas==0){?>
															<td class="text-center">Tetap</td>
															<?php }else{ ?>
															
															<?php if($persenberas<0){?>
															<td class="text-center">Turun</td>
																<?php }}}?>
															<td class="text-center"><?php echo format_angka($resulthet['telur']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Susu Kental Manis Merk Bendera</td>
															<td class="text-center">Kaleng</td>
															<?php 
																if(isset($_POST['cari'])){
																	$dari = $_POST['dari'];
																	$sampai = $_POST['sampai'];
																	
																	$sqldari = "SELECT SUM(susu_b) AS jumlah FROM harga WHERE tgl ='$dari'";
																		$querydari = mysqli_query($koneksidb,$sqldari);
																		$resultdari = mysqli_fetch_array($querydari);
																		$rata2dari = $resultdari['jumlah']/5; 
																	
																	$sqlsampai = "SELECT SUM(susu_b) AS jumlah FROM harga WHERE tgl ='$sampai'";
																		$querysampai = mysqli_query($koneksidb,$sqlsampai);
																		$resultsampai = mysqli_fetch_array($querysampai);
																		$rata2sampai = $resultsampai['jumlah']/5; 
																		
																		$rpberas = $rata2sampai-$rata2dari;
																		if($rata2dari==0){
																		$persenberas = "NULL";
																		}else{
																		$persenberas = round(($rpberas/$rata2dari) *100,2);
																		}
															?>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2dari));?></td>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2sampai));?></td>
															<td class="text-center"><?php echo format_angka($rpberas);?></td>
															<td class="text-center"><?php echo $persenberas;?></td>
															<?php if($persenberas>0){?>
															<td class="text-center">Naik</td>
															<?php }else{ ?>
															
															<?php if($persenberas==0){?>
															<td class="text-center">Tetap</td>
															<?php }else{ ?>
															
															<?php if($persenberas<0){?>
															<td class="text-center">Turun</td>
																<?php }}}?>
															<td class="text-center"><?php echo format_angka($resulthet['susu_b']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Susu Kental Manis Merk Indomilk</td>
															<td class="text-center">Kaleng</td>
															<?php 
																if(isset($_POST['cari'])){
																	$dari = $_POST['dari'];
																	$sampai = $_POST['sampai'];
																	
																	$sqldari = "SELECT SUM(susu_i) AS jumlah FROM harga WHERE tgl ='$dari'";
																		$querydari = mysqli_query($koneksidb,$sqldari);
																		$resultdari = mysqli_fetch_array($querydari);
																		$rata2dari = $resultdari['jumlah']/5; 
																	
																	$sqlsampai = "SELECT SUM(susu_i) AS jumlah FROM harga WHERE tgl ='$sampai'";
																		$querysampai = mysqli_query($koneksidb,$sqlsampai);
																		$resultsampai = mysqli_fetch_array($querysampai);
																		$rata2sampai = $resultsampai['jumlah']/5; 
																		
																		$rpberas = $rata2sampai-$rata2dari;
																		if($rata2dari==0){
																		$persenberas = "NULL";
																		}else{
																		$persenberas = round(($rpberas/$rata2dari) *100,2);
																		}
															?>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2dari));?></td>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2sampai));?></td>
															<td class="text-center"><?php echo format_angka($rpberas);?></td>
															<td class="text-center"><?php echo $persenberas;?></td>
															<?php if($persenberas>0){?>
															<td class="text-center">Naik</td>
															<?php }else{ ?>
															
															<?php if($persenberas==0){?>
															<td class="text-center">Tetap</td>
															<?php }else{ ?>
															
															<?php if($persenberas<0){?>
															<td class="text-center">Turun</td>
																<?php }}}?>
															<td class="text-center"><?php echo format_angka($resulthet['susu_i']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Susu Bubuk Dancow Fuel Cream</td>
															<td class="text-center">200 Gr</td>
															<?php 
																if(isset($_POST['cari'])){
																	$dari = $_POST['dari'];
																	$sampai = $_POST['sampai'];
																	
																	$sqldari = "SELECT SUM(susu_d) AS jumlah FROM harga WHERE tgl ='$dari'";
																		$querydari = mysqli_query($koneksidb,$sqldari);
																		$resultdari = mysqli_fetch_array($querydari);
																		$rata2dari = $resultdari['jumlah']/5; 
																	
																	$sqlsampai = "SELECT SUM(susu_d) AS jumlah FROM harga WHERE tgl ='$sampai'";
																		$querysampai = mysqli_query($koneksidb,$sqlsampai);
																		$resultsampai = mysqli_fetch_array($querysampai);
																		$rata2sampai = $resultsampai['jumlah']/5; 
																		
																		$rpberas = $rata2sampai-$rata2dari;
																		if($rata2dari==0){
																		$persenberas = "NULL";
																		}else{
																		$persenberas = round(($rpberas/$rata2dari) *100,2);
																		}
															?>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2dari));?></td>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2sampai));?></td>
															<td class="text-center"><?php echo format_angka($rpberas);?></td>
															<td class="text-center"><?php echo $persenberas;?></td>
															<?php if($persenberas>0){?>
															<td class="text-center">Naik</td>
															<?php }else{ ?>
															
															<?php if($persenberas==0){?>
															<td class="text-center">Tetap</td>
															<?php }else{ ?>
															
															<?php if($persenberas<0){?>
															<td class="text-center">Turun</td>
																<?php }}}?>
															<td class="text-center"><?php echo format_angka($resulthet['susu_d']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Jagung Pipilan</td>
															<td class="text-center">Kg</td>
															<?php 
																if(isset($_POST['cari'])){
																	$dari = $_POST['dari'];
																	$sampai = $_POST['sampai'];
																	
																	$sqldari = "SELECT SUM(jagung_p) AS jumlah FROM harga WHERE tgl ='$dari'";
																		$querydari = mysqli_query($koneksidb,$sqldari);
																		$resultdari = mysqli_fetch_array($querydari);
																		$rata2dari = $resultdari['jumlah']/5; 
																	
																	$sqlsampai = "SELECT SUM(jagung_p) AS jumlah FROM harga WHERE tgl ='$sampai'";
																		$querysampai = mysqli_query($koneksidb,$sqlsampai);
																		$resultsampai = mysqli_fetch_array($querysampai);
																		$rata2sampai = $resultsampai['jumlah']/5; 
																		
																		$rpberas = $rata2sampai-$rata2dari;
																		if($rata2dari==0){
																		$persenberas = "NULL";
																		}else{
																		$persenberas = round(($rpberas/$rata2dari) *100,2);
																		}
															?>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2dari));?></td>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2sampai));?></td>
															<td class="text-center"><?php echo format_angka($rpberas);?></td>
															<td class="text-center"><?php echo $persenberas;?></td>
															<?php if($persenberas>0){?>
															<td class="text-center">Naik</td>
															<?php }else{ ?>
															
															<?php if($persenberas==0){?>
															<td class="text-center">Tetap</td>
															<?php }else{ ?>
															
															<?php if($persenberas<0){?>
															<td class="text-center">Turun</td>
																<?php }}}?>
															<td class="text-center"><?php echo format_angka($resulthet['jagung_p']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Jagung Tingkat Peternak</td>
															<td class="text-center">Kg</td>
															<?php 
																if(isset($_POST['cari'])){
																	$dari = $_POST['dari'];
																	$sampai = $_POST['sampai'];
																	
																	$sqldari = "SELECT SUM(jagung_t) AS jumlah FROM harga WHERE tgl ='$dari'";
																		$querydari = mysqli_query($koneksidb,$sqldari);
																		$resultdari = mysqli_fetch_array($querydari);
																		$rata2dari = $resultdari['jumlah']/5; 
																	
																	$sqlsampai = "SELECT SUM(jagung_t) AS jumlah FROM harga WHERE tgl ='$sampai'";
																		$querysampai = mysqli_query($koneksidb,$sqlsampai);
																		$resultsampai = mysqli_fetch_array($querysampai);
																		$rata2sampai = $resultsampai['jumlah']/5; 
																		
																		$rpberas = $rata2sampai-$rata2dari;
																		if($rata2dari==0){
																		$persenberas = "NULL";
																		}else{
																		$persenberas = round(($rpberas/$rata2dari) *100,2);
																		}
															?>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2dari));?></td>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2sampai));?></td>
															<td class="text-center"><?php echo format_angka($rpberas);?></td>
															<td class="text-center"><?php echo $persenberas;?></td>
															<?php if($persenberas>0){?>
															<td class="text-center">Naik</td>
															<?php }else{ ?>
															
															<?php if($persenberas==0){?>
															<td class="text-center">Tetap</td>
															<?php }else{ ?>
															
															<?php if($persenberas<0){?>
															<td class="text-center">Turun</td>
																<?php }}}?>
															<td class="text-center"><?php echo format_angka($resulthet['jagung_t']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Garam Beryodium</td>
															<td class="text-center">250 Gr</td>
															<?php 
																if(isset($_POST['cari'])){
																	$dari = $_POST['dari'];
																	$sampai = $_POST['sampai'];
																	
																	$sqldari = "SELECT SUM(garam) AS jumlah FROM harga WHERE tgl ='$dari'";
																		$querydari = mysqli_query($koneksidb,$sqldari);
																		$resultdari = mysqli_fetch_array($querydari);
																		$rata2dari = $resultdari['jumlah']/5; 
																	
																	$sqlsampai = "SELECT SUM(garam) AS jumlah FROM harga WHERE tgl ='$sampai'";
																		$querysampai = mysqli_query($koneksidb,$sqlsampai);
																		$resultsampai = mysqli_fetch_array($querysampai);
																		$rata2sampai = $resultsampai['jumlah']/5; 
																		
																		$rpberas = $rata2sampai-$rata2dari;
																		if($rata2dari==0){
																		$persenberas = "NULL";
																		}else{
																		$persenberas = round(($rpberas/$rata2dari) *100,2);
																		}
															?>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2dari));?></td>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2sampai));?></td>
															<td class="text-center"><?php echo format_angka($rpberas);?></td>
															<td class="text-center"><?php echo $persenberas;?></td>
															<?php if($persenberas>0){?>
															<td class="text-center">Naik</td>
															<?php }else{ ?>
															
															<?php if($persenberas==0){?>
															<td class="text-center">Tetap</td>
															<?php }else{ ?>
															
															<?php if($persenberas<0){?>
															<td class="text-center">Turun</td>
																<?php }}}?>
															<td class="text-center"><?php echo format_angka($resulthet['garam']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Tepung Terigu Cap Segitiga Biru</td>
															<td class="text-center">Kg</td>
															<?php 
																if(isset($_POST['cari'])){
																	$dari = $_POST['dari'];
																	$sampai = $_POST['sampai'];
																	
																	$sqldari = "SELECT SUM(tepung) AS jumlah FROM harga WHERE tgl ='$dari'";
																		$querydari = mysqli_query($koneksidb,$sqldari);
																		$resultdari = mysqli_fetch_array($querydari);
																		$rata2dari = $resultdari['jumlah']/5; 
																	
																	$sqlsampai = "SELECT SUM(tepung) AS jumlah FROM harga WHERE tgl ='$sampai'";
																		$querysampai = mysqli_query($koneksidb,$sqlsampai);
																		$resultsampai = mysqli_fetch_array($querysampai);
																		$rata2sampai = $resultsampai['jumlah']/5; 
																		
																		$rpberas = $rata2sampai-$rata2dari;
																		if($rata2dari==0){
																		$persenberas = "NULL";
																		}else{
																		$persenberas = round(($rpberas/$rata2dari) *100,2);
																		}
															?>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2dari));?></td>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2sampai));?></td>
															<td class="text-center"><?php echo format_angka($rpberas);?></td>
															<td class="text-center"><?php echo $persenberas;?></td>
															<?php if($persenberas>0){?>
															<td class="text-center">Naik</td>
															<?php }else{ ?>
															
															<?php if($persenberas==0){?>
															<td class="text-center">Tetap</td>
															<?php }else{ ?>
															
															<?php if($persenberas<0){?>
															<td class="text-center">Turun</td>
																<?php }}}?>
															<td class="text-center"><?php echo format_angka($resulthet['tepung']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Kacang Kedelai Lokal</td>
															<td class="text-center">Kg</td>
															<?php 
																if(isset($_POST['cari'])){
																	$dari = $_POST['dari'];
																	$sampai = $_POST['sampai'];
																	
																	$sqldari = "SELECT SUM(kacang_k) AS jumlah FROM harga WHERE tgl ='$dari'";
																		$querydari = mysqli_query($koneksidb,$sqldari);
																		$resultdari = mysqli_fetch_array($querydari);
																		$rata2dari = $resultdari['jumlah']/5; 
																	
																	$sqlsampai = "SELECT SUM(kacang_k) AS jumlah FROM harga WHERE tgl ='$sampai'";
																		$querysampai = mysqli_query($koneksidb,$sqlsampai);
																		$resultsampai = mysqli_fetch_array($querysampai);
																		$rata2sampai = $resultsampai['jumlah']/5; 
																		
																		$rpberas = $rata2sampai-$rata2dari;
																		if($rata2dari==0){
																		$persenberas = "NULL";
																		}else{
																		$persenberas = round(($rpberas/$rata2dari) *100,2);
																		}
															?>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2dari));?></td>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2sampai));?></td>
															<td class="text-center"><?php echo format_angka($rpberas);?></td>
															<td class="text-center"><?php echo $persenberas;?></td>
															<?php if($persenberas>0){?>
															<td class="text-center">Naik</td>
															<?php }else{ ?>
															
															<?php if($persenberas==0){?>
															<td class="text-center">Tetap</td>
															<?php }else{ ?>
															
															<?php if($persenberas<0){?>
															<td class="text-center">Turun</td>
																<?php }}}?>
															<td class="text-center"><?php echo format_angka($resulthet['kacang_k']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Kacang Hijau</td>
															<td class="text-center">Kg</td>
															<?php 
																if(isset($_POST['cari'])){
																	$dari = $_POST['dari'];
																	$sampai = $_POST['sampai'];
																	
																	$sqldari = "SELECT SUM(kacang_h) AS jumlah FROM harga WHERE tgl ='$dari'";
																		$querydari = mysqli_query($koneksidb,$sqldari);
																		$resultdari = mysqli_fetch_array($querydari);
																		$rata2dari = $resultdari['jumlah']/5; 
																	
																	$sqlsampai = "SELECT SUM(kacang_h) AS jumlah FROM harga WHERE tgl ='$sampai'";
																		$querysampai = mysqli_query($koneksidb,$sqlsampai);
																		$resultsampai = mysqli_fetch_array($querysampai);
																		$rata2sampai = $resultsampai['jumlah']/5; 
																		
																		$rpberas = $rata2sampai-$rata2dari;
																		if($rata2dari==0){
																		$persenberas = "NULL";
																		}else{
																		$persenberas = round(($rpberas/$rata2dari) *100,2);
																		}
															?>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2dari));?></td>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2sampai));?></td>
															<td class="text-center"><?php echo format_angka($rpberas);?></td>
															<td class="text-center"><?php echo $persenberas;?></td>
															<?php if($persenberas>0){?>
															<td class="text-center">Naik</td>
															<?php }else{ ?>
															
															<?php if($persenberas==0){?>
															<td class="text-center">Tetap</td>
															<?php }else{ ?>
															
															<?php if($persenberas<0){?>
															<td class="text-center">Turun</td>
																<?php }}}?>
															<td class="text-center"><?php echo format_angka($resulthet['kacang_h']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Kacang Tanah</td>
															<td class="text-center">Kg</td>
															<?php 
																if(isset($_POST['cari'])){
																	$dari = $_POST['dari'];
																	$sampai = $_POST['sampai'];
																	
																	$sqldari = "SELECT SUM(kacang_t) AS jumlah FROM harga WHERE tgl ='$dari'";
																		$querydari = mysqli_query($koneksidb,$sqldari);
																		$resultdari = mysqli_fetch_array($querydari);
																		$rata2dari = $resultdari['jumlah']/5; 
																	
																	$sqlsampai = "SELECT SUM(kacang_t) AS jumlah FROM harga WHERE tgl ='$sampai'";
																		$querysampai = mysqli_query($koneksidb,$sqlsampai);
																		$resultsampai = mysqli_fetch_array($querysampai);
																		$rata2sampai = $resultsampai['jumlah']/5; 
																		
																		$rpberas = $rata2sampai-$rata2dari;
																		if($rata2dari==0){
																		$persenberas = "NULL";
																		}else{
																		$persenberas = round(($rpberas/$rata2dari) *100,2);
																		}
															?>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2dari));?></td>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2sampai));?></td>
															<td class="text-center"><?php echo format_angka($rpberas);?></td>
															<td class="text-center"><?php echo $persenberas;?></td>
															<?php if($persenberas>0){?>
															<td class="text-center">Naik</td>
															<?php }else{ ?>
															
															<?php if($persenberas==0){?>
															<td class="text-center">Tetap</td>
															<?php }else{ ?>
															
															<?php if($persenberas<0){?>
															<td class="text-center">Turun</td>
																<?php }}}?>
															<td class="text-center"><?php echo format_angka($resulthet['kacang_t']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Blue Band Margarin</td>
															<td class="text-center">200 Gr</td>
															<?php 
																if(isset($_POST['cari'])){
																	$dari = $_POST['dari'];
																	$sampai = $_POST['sampai'];
																	
																	$sqldari = "SELECT SUM(blueband) AS jumlah FROM harga WHERE tgl ='$dari'";
																		$querydari = mysqli_query($koneksidb,$sqldari);
																		$resultdari = mysqli_fetch_array($querydari);
																		$rata2dari = $resultdari['jumlah']/5; 
																	
																	$sqlsampai = "SELECT SUM(blueband) AS jumlah FROM harga WHERE tgl ='$sampai'";
																		$querysampai = mysqli_query($koneksidb,$sqlsampai);
																		$resultsampai = mysqli_fetch_array($querysampai);
																		$rata2sampai = $resultsampai['jumlah']/5; 
																		
																		$rpberas = $rata2sampai-$rata2dari;
																		if($rata2dari==0){
																		$persenberas = "NULL";
																		}else{
																		$persenberas = round(($rpberas/$rata2dari) *100,2);
																		}
															?>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2dari));?></td>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2sampai));?></td>
															<td class="text-center"><?php echo format_angka($rpberas);?></td>
															<td class="text-center"><?php echo $persenberas;?></td>
															<?php if($persenberas>0){?>
															<td class="text-center">Naik</td>
															<?php }else{ ?>
															
															<?php if($persenberas==0){?>
															<td class="text-center">Tetap</td>
															<?php }else{ ?>
															
															<?php if($persenberas<0){?>
															<td class="text-center">Turun</td>
																<?php }}}?>
															<td class="text-center"><?php echo format_angka($resulthet['blueband']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Indomie Rasa Ayam Bawang</td>
															<td class="text-center">Dus</td>
															<?php 
																if(isset($_POST['cari'])){
																	$dari = $_POST['dari'];
																	$sampai = $_POST['sampai'];
																	
																	$sqldari = "SELECT SUM(mie) AS jumlah FROM harga WHERE tgl ='$dari'";
																		$querydari = mysqli_query($koneksidb,$sqldari);
																		$resultdari = mysqli_fetch_array($querydari);
																		$rata2dari = $resultdari['jumlah']/5; 
																	
																	$sqlsampai = "SELECT SUM(mie) AS jumlah FROM harga WHERE tgl ='$sampai'";
																		$querysampai = mysqli_query($koneksidb,$sqlsampai);
																		$resultsampai = mysqli_fetch_array($querysampai);
																		$rata2sampai = $resultsampai['jumlah']/5; 
																		
																		$rpberas = $rata2sampai-$rata2dari;
																		if($rata2dari==0){
																		$persenberas = "NULL";
																		}else{
																		$persenberas = round(($rpberas/$rata2dari) *100,2);
																		}
															?>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2dari));?></td>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2sampai));?></td>
															<td class="text-center"><?php echo format_angka($rpberas);?></td>
															<td class="text-center"><?php echo $persenberas;?></td>
															<?php if($persenberas>0){?>
															<td class="text-center">Naik</td>
															<?php }else{ ?>
															
															<?php if($persenberas==0){?>
															<td class="text-center">Tetap</td>
															<?php }else{ ?>
															
															<?php if($persenberas<0){?>
															<td class="text-center">Turun</td>
																<?php }}}?>
															<td class="text-center"><?php echo format_angka($resulthet['mie']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Cabe Merah Biasa</td>
															<td class="text-center">Kg</td>
															<?php 
																if(isset($_POST['cari'])){
																	$dari = $_POST['dari'];
																	$sampai = $_POST['sampai'];
																	
																	$sqldari = "SELECT SUM(cabe_mb) AS jumlah FROM harga WHERE tgl ='$dari'";
																		$querydari = mysqli_query($koneksidb,$sqldari);
																		$resultdari = mysqli_fetch_array($querydari);
																		$rata2dari = $resultdari['jumlah']/5; 
																	
																	$sqlsampai = "SELECT SUM(cabe_mb) AS jumlah FROM harga WHERE tgl ='$sampai'";
																		$querysampai = mysqli_query($koneksidb,$sqlsampai);
																		$resultsampai = mysqli_fetch_array($querysampai);
																		$rata2sampai = $resultsampai['jumlah']/5; 
																		
																		$rpberas = $rata2sampai-$rata2dari;
																		if($rata2dari==0){
																		$persenberas = "NULL";
																		}else{
																		$persenberas = round(($rpberas/$rata2dari) *100,2);
																		}
															?>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2dari));?></td>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2sampai));?></td>
															<td class="text-center"><?php echo format_angka($rpberas);?></td>
															<td class="text-center"><?php echo $persenberas;?></td>
															<?php if($persenberas>0){?>
															<td class="text-center">Naik</td>
															<?php }else{ ?>
															
															<?php if($persenberas==0){?>
															<td class="text-center">Tetap</td>
															<?php }else{ ?>
															
															<?php if($persenberas<0){?>
															<td class="text-center">Turun</td>
																<?php }}}?>
															<td class="text-center"><?php echo format_angka($resulthet['cabe_mb']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Cabe Hijau Biasa</td>
															<td class="text-center">Kg</td>
															<?php 
																if(isset($_POST['cari'])){
																	$dari = $_POST['dari'];
																	$sampai = $_POST['sampai'];
																	
																	$sqldari = "SELECT SUM(cabe_hb) AS jumlah FROM harga WHERE tgl ='$dari'";
																		$querydari = mysqli_query($koneksidb,$sqldari);
																		$resultdari = mysqli_fetch_array($querydari);
																		$rata2dari = $resultdari['jumlah']/5; 
																	
																	$sqlsampai = "SELECT SUM(cabe_hb) AS jumlah FROM harga WHERE tgl ='$sampai'";
																		$querysampai = mysqli_query($koneksidb,$sqlsampai);
																		$resultsampai = mysqli_fetch_array($querysampai);
																		$rata2sampai = $resultsampai['jumlah']/5; 
																		
																		$rpberas = $rata2sampai-$rata2dari;
																		if($rata2dari==0){
																		$persenberas = "NULL";
																		}else{
																		$persenberas = round(($rpberas/$rata2dari) *100,2);
																		}
															?>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2dari));?></td>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2sampai));?></td>
															<td class="text-center"><?php echo format_angka($rpberas);?></td>
															<td class="text-center"><?php echo $persenberas;?></td>
															<?php if($persenberas>0){?>
															<td class="text-center">Naik</td>
															<?php }else{ ?>
															
															<?php if($persenberas==0){?>
															<td class="text-center">Tetap</td>
															<?php }else{ ?>
															
															<?php if($persenberas<0){?>
															<td class="text-center">Turun</td>
																<?php }}}?>
															<td class="text-center"><?php echo format_angka($resulthet['cabe_hb']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Cabe Rawit Merah</td>
															<td class="text-center">Kg</td>
															<?php 
																if(isset($_POST['cari'])){
																	$dari = $_POST['dari'];
																	$sampai = $_POST['sampai'];
																	
																	$sqldari = "SELECT SUM(cabe_rm) AS jumlah FROM harga WHERE tgl ='$dari'";
																		$querydari = mysqli_query($koneksidb,$sqldari);
																		$resultdari = mysqli_fetch_array($querydari);
																		$rata2dari = $resultdari['jumlah']/5; 
																	
																	$sqlsampai = "SELECT SUM(cabe_rm) AS jumlah FROM harga WHERE tgl ='$sampai'";
																		$querysampai = mysqli_query($koneksidb,$sqlsampai);
																		$resultsampai = mysqli_fetch_array($querysampai);
																		$rata2sampai = $resultsampai['jumlah']/5; 
																		
																		$rpberas = $rata2sampai-$rata2dari;
																		if($rata2dari==0){
																		$persenberas = "NULL";
																		}else{
																		$persenberas = round(($rpberas/$rata2dari) *100,2);
																		}
															?>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2dari));?></td>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2sampai));?></td>
															<td class="text-center"><?php echo format_angka($rpberas);?></td>
															<td class="text-center"><?php echo $persenberas;?></td>
															<?php if($persenberas>0){?>
															<td class="text-center">Naik</td>
															<?php }else{ ?>
															
															<?php if($persenberas==0){?>
															<td class="text-center">Tetap</td>
															<?php }else{ ?>
															
															<?php if($persenberas<0){?>
															<td class="text-center">Turun</td>
																<?php }}}?>
															<td class="text-center"><?php echo format_angka($resulthet['cabe_rm']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Cabe Rawit Hijau</td>
															<td class="text-center">Kg</td>
															<?php 
																if(isset($_POST['cari'])){
																	$dari = $_POST['dari'];
																	$sampai = $_POST['sampai'];
																	
																	$sqldari = "SELECT SUM(cabe_rh) AS jumlah FROM harga WHERE tgl ='$dari'";
																		$querydari = mysqli_query($koneksidb,$sqldari);
																		$resultdari = mysqli_fetch_array($querydari);
																		$rata2dari = $resultdari['jumlah']/5; 
																	
																	$sqlsampai = "SELECT SUM(cabe_rh) AS jumlah FROM harga WHERE tgl ='$sampai'";
																		$querysampai = mysqli_query($koneksidb,$sqlsampai);
																		$resultsampai = mysqli_fetch_array($querysampai);
																		$rata2sampai = $resultsampai['jumlah']/5; 
																		
																		$rpberas = $rata2sampai-$rata2dari;
																		if($rata2dari==0){
																		$persenberas = "NULL";
																		}else{
																		$persenberas = round(($rpberas/$rata2dari) *100,2);
																		}
															?>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2dari));?></td>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2sampai));?></td>
															<td class="text-center"><?php echo format_angka($rpberas);?></td>
															<td class="text-center"><?php echo $persenberas;?></td>
															<?php if($persenberas>0){?>
															<td class="text-center">Naik</td>
															<?php }else{ ?>
															
															<?php if($persenberas==0){?>
															<td class="text-center">Tetap</td>
															<?php }else{ ?>
															
															<?php if($persenberas<0){?>
															<td class="text-center">Turun</td>
																<?php }}}?>
															<td class="text-center"><?php echo format_angka($resulthet['cabe_rh']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Wortel</td>
															<td class="text-center">Kg</td>
															<?php 
																if(isset($_POST['cari'])){
																	$dari = $_POST['dari'];
																	$sampai = $_POST['sampai'];
																	
																	$sqldari = "SELECT SUM(wortel) AS jumlah FROM harga WHERE tgl ='$dari'";
																		$querydari = mysqli_query($koneksidb,$sqldari);
																		$resultdari = mysqli_fetch_array($querydari);
																		$rata2dari = $resultdari['jumlah']/5; 
																	
																	$sqlsampai = "SELECT SUM(wortel) AS jumlah FROM harga WHERE tgl ='$sampai'";
																		$querysampai = mysqli_query($koneksidb,$sqlsampai);
																		$resultsampai = mysqli_fetch_array($querysampai);
																		$rata2sampai = $resultsampai['jumlah']/5; 
																		
																		$rpberas = $rata2sampai-$rata2dari;
																		if($rata2dari==0){
																		$persenberas = "NULL";
																		}else{
																		$persenberas = round(($rpberas/$rata2dari) *100,2);
																		}
															?>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2dari));?></td>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2sampai));?></td>
															<td class="text-center"><?php echo format_angka($rpberas);?></td>
															<td class="text-center"><?php echo $persenberas;?></td>
															<?php if($persenberas>0){?>
															<td class="text-center">Naik</td>
															<?php }else{ ?>
															
															<?php if($persenberas==0){?>
															<td class="text-center">Tetap</td>
															<?php }else{ ?>
															
															<?php if($persenberas<0){?>
															<td class="text-center">Turun</td>
																<?php }}}?>
															<td class="text-center"><?php echo format_angka($resulthet['wortel']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Kol</td>
															<td class="text-center">Kg</td>
															<?php 
																if(isset($_POST['cari'])){
																	$dari = $_POST['dari'];
																	$sampai = $_POST['sampai'];
																	
																	$sqldari = "SELECT SUM(kol) AS jumlah FROM harga WHERE tgl ='$dari'";
																		$querydari = mysqli_query($koneksidb,$sqldari);
																		$resultdari = mysqli_fetch_array($querydari);
																		$rata2dari = $resultdari['jumlah']/5; 
																	
																	$sqlsampai = "SELECT SUM(kol) AS jumlah FROM harga WHERE tgl ='$sampai'";
																		$querysampai = mysqli_query($koneksidb,$sqlsampai);
																		$resultsampai = mysqli_fetch_array($querysampai);
																		$rata2sampai = $resultsampai['jumlah']/5; 
																		
																		$rpberas = $rata2sampai-$rata2dari;
																		if($rata2dari==0){
																		$persenberas = "NULL";
																		}else{
																		$persenberas = round(($rpberas/$rata2dari) *100,2);
																		}
															?>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2dari));?></td>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2sampai));?></td>
															<td class="text-center"><?php echo format_angka($rpberas);?></td>
															<td class="text-center"><?php echo $persenberas;?></td>
															<?php if($persenberas>0){?>
															<td class="text-center">Naik</td>
															<?php }else{ ?>
															
															<?php if($persenberas==0){?>
															<td class="text-center">Tetap</td>
															<?php }else{ ?>
															
															<?php if($persenberas<0){?>
															<td class="text-center">Turun</td>
																<?php }}}?>
															<td class="text-center"><?php echo format_angka($resulthet['kol']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Buncis</td>
															<td class="text-center">Kg</td>
															<?php 
																if(isset($_POST['cari'])){
																	$dari = $_POST['dari'];
																	$sampai = $_POST['sampai'];
																	
																	$sqldari = "SELECT SUM(buncis) AS jumlah FROM harga WHERE tgl ='$dari'";
																		$querydari = mysqli_query($koneksidb,$sqldari);
																		$resultdari = mysqli_fetch_array($querydari);
																		$rata2dari = $resultdari['jumlah']/5; 
																	
																	$sqlsampai = "SELECT SUM(buncis) AS jumlah FROM harga WHERE tgl ='$sampai'";
																		$querysampai = mysqli_query($koneksidb,$sqlsampai);
																		$resultsampai = mysqli_fetch_array($querysampai);
																		$rata2sampai = $resultsampai['jumlah']/5; 
																		
																		$rpberas = $rata2sampai-$rata2dari;
																		if($rata2dari==0){
																		$persenberas = "NULL";
																		}else{
																		$persenberas = round(($rpberas/$rata2dari) *100,2);
																		}
															?>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2dari));?></td>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2sampai));?></td>
															<td class="text-center"><?php echo format_angka($rpberas);?></td>
															<td class="text-center"><?php echo $persenberas;?></td>
															<?php if($persenberas>0){?>
															<td class="text-center">Naik</td>
															<?php }else{ ?>
															
															<?php if($persenberas==0){?>
															<td class="text-center">Tetap</td>
															<?php }else{ ?>
															
															<?php if($persenberas<0){?>
															<td class="text-center">Turun</td>
																<?php }}}?>
															<td class="text-center"><?php echo format_angka($resulthet['buncis']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Bawang Merah</td>
															<td class="text-center">Kg</td>
															<?php 
																if(isset($_POST['cari'])){
																	$dari = $_POST['dari'];
																	$sampai = $_POST['sampai'];
																	
																	$sqldari = "SELECT SUM(bawang_m) AS jumlah FROM harga WHERE tgl ='$dari'";
																		$querydari = mysqli_query($koneksidb,$sqldari);
																		$resultdari = mysqli_fetch_array($querydari);
																		$rata2dari = $resultdari['jumlah']/5; 
																	
																	$sqlsampai = "SELECT SUM(bawang_m) AS jumlah FROM harga WHERE tgl ='$sampai'";
																		$querysampai = mysqli_query($koneksidb,$sqlsampai);
																		$resultsampai = mysqli_fetch_array($querysampai);
																		$rata2sampai = $resultsampai['jumlah']/5; 
																		
																		$rpberas = $rata2sampai-$rata2dari;
																		if($rata2dari==0){
																		$persenberas = "NULL";
																		}else{
																		$persenberas = round(($rpberas/$rata2dari) *100,2);
																		}
															?>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2dari));?></td>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2sampai));?></td>
															<td class="text-center"><?php echo format_angka($rpberas);?></td>
															<td class="text-center"><?php echo $persenberas;?></td>
															<?php if($persenberas>0){?>
															<td class="text-center">Naik</td>
															<?php }else{ ?>
															
															<?php if($persenberas==0){?>
															<td class="text-center">Tetap</td>
															<?php }else{ ?>
															
															<?php if($persenberas<0){?>
															<td class="text-center">Turun</td>
																<?php }}}?>
															<td class="text-center"><?php echo format_angka($resulthet['bawang_m']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Bawang Putih Impor</td>
															<td class="text-center">Kg</td>
															<?php 
																if(isset($_POST['cari'])){
																	$dari = $_POST['dari'];
																	$sampai = $_POST['sampai'];
																	
																	$sqldari = "SELECT SUM(bawang_p) AS jumlah FROM harga WHERE tgl ='$dari'";
																		$querydari = mysqli_query($koneksidb,$sqldari);
																		$resultdari = mysqli_fetch_array($querydari);
																		$rata2dari = $resultdari['jumlah']/5; 
																	
																	$sqlsampai = "SELECT SUM(bawang_p) AS jumlah FROM harga WHERE tgl ='$sampai'";
																		$querysampai = mysqli_query($koneksidb,$sqlsampai);
																		$resultsampai = mysqli_fetch_array($querysampai);
																		$rata2sampai = $resultsampai['jumlah']/5; 
																		
																		$rpberas = $rata2sampai-$rata2dari;
																		if($rata2dari==0){
																		$persenberas = "NULL";
																		}else{
																		$persenberas = round(($rpberas/$rata2dari) *100,2);
																		}
															?>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2dari));?></td>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2sampai));?></td>
															<td class="text-center"><?php echo format_angka($rpberas);?></td>
															<td class="text-center"><?php echo $persenberas;?></td>
															<?php if($persenberas>0){?>
															<td class="text-center">Naik</td>
															<?php }else{ ?>
															
															<?php if($persenberas==0){?>
															<td class="text-center">Tetap</td>
															<?php }else{ ?>
															
															<?php if($persenberas<0){?>
															<td class="text-center">Turun</td>
																<?php }}}?>
															<td class="text-center"><?php echo format_angka($resulthet['bawang_p']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Ikan Asin Teri</td>
															<td class="text-center">Kg</td>
															<?php 
																if(isset($_POST['cari'])){
																	$dari = $_POST['dari'];
																	$sampai = $_POST['sampai'];
																	
																	$sqldari = "SELECT SUM(ikan_asin) AS jumlah FROM harga WHERE tgl ='$dari'";
																		$querydari = mysqli_query($koneksidb,$sqldari);
																		$resultdari = mysqli_fetch_array($querydari);
																		$rata2dari = $resultdari['jumlah']/5; 
																	
																	$sqlsampai = "SELECT SUM(ikan_asin) AS jumlah FROM harga WHERE tgl ='$sampai'";
																		$querysampai = mysqli_query($koneksidb,$sqlsampai);
																		$resultsampai = mysqli_fetch_array($querysampai);
																		$rata2sampai = $resultsampai['jumlah']/5; 
																		
																		$rpberas = $rata2sampai-$rata2dari;
																		if($rata2dari==0){
																		$persenberas = "NULL";
																		}else{
																		$persenberas = round(($rpberas/$rata2dari) *100,2);
																		}
															?>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2dari));?></td>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2sampai));?></td>
															<td class="text-center"><?php echo format_angka($rpberas);?></td>
															<td class="text-center"><?php echo $persenberas;?></td>
															<?php if($persenberas>0){?>
															<td class="text-center">Naik</td>
															<?php }else{ ?>
															
															<?php if($persenberas==0){?>
															<td class="text-center">Tetap</td>
															<?php }else{ ?>
															
															<?php if($persenberas<0){?>
															<td class="text-center">Turun</td>
																<?php }}}?>
															<td class="text-center"><?php echo format_angka($resulthet['ikan_asin']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Kentang</td>
															<td class="text-center">Kg</td>
															<?php 
																if(isset($_POST['cari'])){
																	$dari = $_POST['dari'];
																	$sampai = $_POST['sampai'];
																	
																	$sqldari = "SELECT SUM(kentang) AS jumlah FROM harga WHERE tgl ='$dari'";
																		$querydari = mysqli_query($koneksidb,$sqldari);
																		$resultdari = mysqli_fetch_array($querydari);
																		$rata2dari = $resultdari['jumlah']/5; 
																	
																	$sqlsampai = "SELECT SUM(kentang) AS jumlah FROM harga WHERE tgl ='$sampai'";
																		$querysampai = mysqli_query($koneksidb,$sqlsampai);
																		$resultsampai = mysqli_fetch_array($querysampai);
																		$rata2sampai = $resultsampai['jumlah']/5; 
																		
																		$rpberas = $rata2sampai-$rata2dari;
																		if($rata2dari==0){
																		$persenberas = "NULL";
																		}else{
																		$persenberas = round(($rpberas/$rata2dari) *100,2);
																		}
															?>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2dari));?></td>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2sampai));?></td>
															<td class="text-center"><?php echo format_angka($rpberas);?></td>
															<td class="text-center"><?php echo $persenberas;?></td>
															<?php if($persenberas>0){?>
															<td class="text-center">Naik</td>
															<?php }else{ ?>
															
															<?php if($persenberas==0){?>
															<td class="text-center">Tetap</td>
															<?php }else{ ?>
															
															<?php if($persenberas<0){?>
															<td class="text-center">Turun</td>
																<?php }}}?>
															<td class="text-center"><?php echo format_angka($resulthet['kentang']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Gula Merah Kelapa</td>
															<td class="text-center">Kg</td>
															<?php 
																if(isset($_POST['cari'])){
																	$dari = $_POST['dari'];
																	$sampai = $_POST['sampai'];
																	
																	$sqldari = "SELECT SUM(gula_merah) AS jumlah FROM harga WHERE tgl ='$dari'";
																		$querydari = mysqli_query($koneksidb,$sqldari);
																		$resultdari = mysqli_fetch_array($querydari);
																		$rata2dari = $resultdari['jumlah']/5; 
																	
																	$sqlsampai = "SELECT SUM(gula_merah) AS jumlah FROM harga WHERE tgl ='$sampai'";
																		$querysampai = mysqli_query($koneksidb,$sqlsampai);
																		$resultsampai = mysqli_fetch_array($querysampai);
																		$rata2sampai = $resultsampai['jumlah']/5; 
																		
																		$rpberas = $rata2sampai-$rata2dari;
																		if($rata2dari==0){
																		$persenberas = "NULL";
																		}else{
																		$persenberas = round(($rpberas/$rata2dari) *100,2);
																		}
															?>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2dari));?></td>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2sampai));?></td>
															<td class="text-center"><?php echo format_angka($rpberas);?></td>
															<td class="text-center"><?php echo $persenberas;?></td>
															<?php if($persenberas>0){?>
															<td class="text-center">Naik</td>
															<?php }else{ ?>
															
															<?php if($persenberas==0){?>
															<td class="text-center">Tetap</td>
															<?php }else{ ?>
															
															<?php if($persenberas<0){?>
															<td class="text-center">Turun</td>
																<?php }}}?>
															<td class="text-center"><?php echo format_angka($resulthet['gula_merah']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Kelapa</td>
															<td class="text-center">Butir</td>
															<?php 
																if(isset($_POST['cari'])){
																	$dari = $_POST['dari'];
																	$sampai = $_POST['sampai'];
																	
																	$sqldari = "SELECT SUM(kelapa) AS jumlah FROM harga WHERE tgl ='$dari'";
																		$querydari = mysqli_query($koneksidb,$sqldari);
																		$resultdari = mysqli_fetch_array($querydari);
																		$rata2dari = $resultdari['jumlah']/5; 
																	
																	$sqlsampai = "SELECT SUM(kelapa) AS jumlah FROM harga WHERE tgl ='$sampai'";
																		$querysampai = mysqli_query($koneksidb,$sqlsampai);
																		$resultsampai = mysqli_fetch_array($querysampai);
																		$rata2sampai = $resultsampai['jumlah']/5; 
																		
																		$rpberas = $rata2sampai-$rata2dari;
																		if($rata2dari==0){
																		$persenberas = "NULL";
																		}else{
																		$persenberas = round(($rpberas/$rata2dari) *100,2);
																		}
															?>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2dari));?></td>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2sampai));?></td>
															<td class="text-center"><?php echo format_angka($rpberas);?></td>
															<td class="text-center"><?php echo $persenberas;?></td>
															<?php if($persenberas>0){?>
															<td class="text-center">Naik</td>
															<?php }else{ ?>
															
															<?php if($persenberas==0){?>
															<td class="text-center">Tetap</td>
															<?php }else{ ?>
															
															<?php if($persenberas<0){?>
															<td class="text-center">Turun</td>
																<?php }}}?>
															<td class="text-center"><?php echo format_angka($resulthet['kelapa']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Gas Elpiji 3 Kg</td>
															<td class="text-center">Tabung</td>
															<?php 
																if(isset($_POST['cari'])){
																	$dari = $_POST['dari'];
																	$sampai = $_POST['sampai'];
																	
																	$sqldari = "SELECT SUM(gas) AS jumlah FROM harga WHERE tgl ='$dari'";
																		$querydari = mysqli_query($koneksidb,$sqldari);
																		$resultdari = mysqli_fetch_array($querydari);
																		$rata2dari = $resultdari['jumlah']/5; 
																	
																	$sqlsampai = "SELECT SUM(gas) AS jumlah FROM harga WHERE tgl ='$sampai'";
																		$querysampai = mysqli_query($koneksidb,$sqlsampai);
																		$resultsampai = mysqli_fetch_array($querysampai);
																		$rata2sampai = $resultsampai['jumlah']/5; 
																		
																		$rpberas = $rata2sampai-$rata2dari;
																		if($rata2dari==0){
																		$persenberas = "NULL";
																		}else{
																		$persenberas = round(($rpberas/$rata2dari) *100,2);
																		}
															?>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2dari));?></td>
															<td class="text-center"><?php echo htmlentities(format_angka($rata2sampai));?></td>
															<td class="text-center"><?php echo format_angka($rpberas);?></td>
															<td class="text-center"><?php echo $persenberas;?></td>
															<?php if($persenberas>0){?>
															<td class="text-center">Naik</td>
															<?php }else{ ?>
															
															<?php if($persenberas==0){?>
															<td class="text-center">Tetap</td>
															<?php }else{ ?>
															
															<?php if($persenberas<0){?>
															<td class="text-center">Turun</td>
																<?php }}}?>
															<td class="text-center"><?php echo format_angka($resulthet['gas']);?></td>
																<?php }?>
														</tr>
                                                    </tbody>
                                                </table>  
												</div>
                                            </div> <!-- end preview-->
											
											<div class="tab-pane" id="basic-datatable-code">
                                                <h4 class="header-title text-center mb-3">Form Input Harga Bahan Pokok Per-Pasar</h4>
													<form class="form-horizontal" method="POST" action="harga-inputact.php">
														<div class="row g-2">
															<div class="mb-3 col-md-12">
																<label class="form-label">Pilih Tanggal</label>
																	<input type="date" class="form-control" name="tgl" required>
															</div>
															<div class="mb-3 col-md-3">
																<label class="form-label">Beras Premium (Kg)</label>
																	<div class="input-group flex-nowrap">
																		<span class="input-group-text" id="basic-addon1">Rp</span>
																		<input type="number" class="form-control" name="beras_p" min=0 value="0">
																	</div>
															</div>
															<div class="mb-3 col-md-3">
																<label class="form-label">Beras Medium (Kg)</label>
																	<div class="input-group flex-nowrap">
																		<span class="input-group-text" id="basic-addon1">Rp</span>
																		<input type="number" class="form-control" name="beras_m" min=0 value="0">
																	</div>
															</div>
															<div class="mb-3 col-md-3">
																<label class="form-label">Gula Pasir (Kg)</label>
																	<div class="input-group flex-nowrap">
																		<span class="input-group-text" id="basic-addon1">Rp</span>
																		<input type="number" class="form-control" name="gula" min=0 value="0">
																	</div>
															</div>
															<div class="mb-3 col-md-3">
																<label class="form-label">Minyak Bimoli (Liter)</label>
																	<div class="input-group flex-nowrap">
																		<span class="input-group-text" id="basic-addon1">Rp</span>
																		<input type="number" class="form-control" name="bimoli" min=0 value="0">
																	</div>
															</div>
															<div class="mb-3 col-md-3">
																<label class="form-label">Minyak Goreng Curah (Liter)</label>
																	<div class="input-group flex-nowrap">
																		<span class="input-group-text" id="basic-addon1">Rp</span>
																		<input type="number" class="form-control" name="minyak_c" min=0 value="0">
																	</div>
															</div>
															<div class="mb-3 col-md-3">
																<label class="form-label">Minyak Goreng Kemasan (Liter)</label>
																	<div class="input-group flex-nowrap">
																		<span class="input-group-text" id="basic-addon1">Rp</span>
																		<input type="number" class="form-control" name="minyak_k" min=0 value="0">
																	</div>
															</div>
															<div class="mb-3 col-md-3">
																<label class="form-label">Daging Sapi (Kg)</label>
																	<div class="input-group flex-nowrap">
																		<span class="input-group-text" id="basic-addon1">Rp</span>
																		<input type="number" class="form-control" name="sapi" min=0 value="0">
																	</div>
															</div>
															<div class="mb-3 col-md-3">
																<label class="form-label">Daging Ayam Broiler (Kg)</label>
																	<div class="input-group flex-nowrap">
																		<span class="input-group-text" id="basic-addon1">Rp</span>
																		<input type="number" class="form-control" name="ayam_b" min=0 value="0">
																	</div>
															</div>
															<div class="mb-3 col-md-3">
																<label class="form-label">Daging Ayam Kampung (Kg)</label>
																	<div class="input-group flex-nowrap">
																		<span class="input-group-text" id="basic-addon1">Rp</span>
																		<input type="number" class="form-control" name="ayam_k" min=0 value="0">
																	</div>
															</div>
															<div class="mb-3 col-md-3">
																<label class="form-label">Harga Telur Ayam Ras (Kg)</label>
																	<div class="input-group flex-nowrap">
																		<span class="input-group-text" id="basic-addon1">Rp</span>
																		<input type="number" class="form-control" name="telur" min=0 value="0">
																	</div>
															</div>
															<div class="mb-3 col-md-3">
																<label class="form-label">Susu Kental Manis Merk Bendera (Kaleng)</label>
																	<div class="input-group flex-nowrap">
																		<span class="input-group-text" id="basic-addon1">Rp</span>
																		<input type="number" class="form-control" name="susu_b" min=0 value="0">
																	</div>
															</div>
															<div class="mb-3 col-md-3">
																<label class="form-label">Susu Kental Manis Merk Indomilk (Kaleng)</label>
																	<div class="input-group flex-nowrap">
																		<span class="input-group-text" id="basic-addon1">Rp</span>
																		<input type="number" class="form-control" name="susu_i" min=0 value="0">
																	</div>
															</div>
															<div class="mb-3 col-md-3">
																<label class="form-label">Susu Bubuk Dancow (200 Gr)</label>
																	<div class="input-group flex-nowrap">
																		<span class="input-group-text" id="basic-addon1">Rp</span>
																		<input type="number" class="form-control" name="susu_d" min=0 value="0">
																	</div>
															</div>
															<div class="mb-3 col-md-3">
																<label class="form-label">Jagung Pipilan (Kg)</label>
																	<div class="input-group flex-nowrap">
																		<span class="input-group-text" id="basic-addon1">Rp</span>
																		<input type="number" class="form-control" name="jagung_p" min=0 value="0">
																	</div>
															</div>
															<div class="mb-3 col-md-3">
																<label class="form-label">Jagung Tingkat Peternak (Kg)</label>
																	<div class="input-group flex-nowrap">
																		<span class="input-group-text" id="basic-addon1">Rp</span>
																		<input type="number" class="form-control" name="jagung_t" min=0 value="0">
																	</div>
															</div>
															<div class="mb-3 col-md-3">
																<label class="form-label">Garam Beryodium (250 Gr)</label>
																	<div class="input-group flex-nowrap">
																		<span class="input-group-text" id="basic-addon1">Rp</span>
																		<input type="number" class="form-control" name="garam" min=0 value="0">
																	</div>
															</div>
															<div class="mb-3 col-md-3">
																<label class="form-label">Tepung Terigu Cap Segitiga Biru (Kg)</label>
																	<div class="input-group flex-nowrap">
																		<span class="input-group-text" id="basic-addon1">Rp</span>
																		<input type="number" class="form-control" name="tepung" min=0 value="0">
																	</div>
															</div>
															<div class="mb-3 col-md-3">
																<label class="form-label">Kacang Kedelai Lokal (Kg)</label>
																	<div class="input-group flex-nowrap">
																		<span class="input-group-text" id="basic-addon1">Rp</span>
																		<input type="number" class="form-control" name="kacang_k" min=0 value="0">
																	</div>
															</div>
															<div class="mb-3 col-md-3">
																<label class="form-label">Kacang Hijau (Kg)</label>
																	<div class="input-group flex-nowrap">
																		<span class="input-group-text" id="basic-addon1">Rp</span>
																		<input type="number" class="form-control" name="kacang_h" min=0 value="0">
																	</div>
															</div>
															<div class="mb-3 col-md-3">
																<label class="form-label">Kacang Tanah (Kg)</label>
																	<div class="input-group flex-nowrap">
																		<span class="input-group-text" id="basic-addon1">Rp</span>
																		<input type="number" class="form-control" name="kacang_t" min=0 value="0">
																	</div>
															</div>
															<div class="mb-3 col-md-3">
																<label class="form-label">Blue Band Margarin (Kg)</label>
																	<div class="input-group flex-nowrap">
																		<span class="input-group-text" id="basic-addon1">Rp</span>
																		<input type="number" class="form-control" name="blueband" min=0 value="0">
																	</div>
															</div>
															<div class="mb-3 col-md-3">
																<label class="form-label">Indomie Rasa Ayam Bawang (Dus)</label>
																	<div class="input-group flex-nowrap">
																		<span class="input-group-text" id="basic-addon1">Rp</span>
																		<input type="number" class="form-control" name="mie" min=0 value="0">
																	</div>
															</div>
															<div class="mb-3 col-md-3">
																<label class="form-label">Cabe Merah Biasa (Kg)</label>
																	<div class="input-group flex-nowrap">
																		<span class="input-group-text" id="basic-addon1">Rp</span>
																		<input type="number" class="form-control" name="cabe_mb" min=0 value="0">
																	</div>
															</div>
															<div class="mb-3 col-md-3">
																<label class="form-label">Cabe Hijau Biasa (Kg)</label>
																	<div class="input-group flex-nowrap">
																		<span class="input-group-text" id="basic-addon1">Rp</span>
																		<input type="number" class="form-control" name="cabe_hb" min=0 value="0">
																	</div>
															</div>
															<div class="mb-3 col-md-3">
																<label class="form-label">Cabe Rawit Hijau (Kg)</label>
																	<div class="input-group flex-nowrap">
																		<span class="input-group-text" id="basic-addon1">Rp</span>
																		<input type="number" class="form-control" name="cabe_rh" min=0 value="0">
																	</div>
															</div>
															<div class="mb-3 col-md-3">
																<label class="form-label">Cabe Rawit Merah (Kg)</label>
																	<div class="input-group flex-nowrap">
																		<span class="input-group-text" id="basic-addon1">Rp</span>
																		<input type="number" class="form-control" name="cabe_rm" min=0 value="0">
																	</div>
															</div>
															<div class="mb-3 col-md-3">
																<label class="form-label">Wortel (Kg)</label>
																	<div class="input-group flex-nowrap">
																		<span class="input-group-text" id="basic-addon1">Rp</span>
																		<input type="number" class="form-control" name="wortel" min=0 value="0">
																	</div>
															</div>
															<div class="mb-3 col-md-3">
																<label class="form-label">Kol (Kg)</label>
																	<div class="input-group flex-nowrap">
																		<span class="input-group-text" id="basic-addon1">Rp</span>
																		<input type="number" class="form-control" name="kol" min=0 value="0">
																	</div>
															</div>
															<div class="mb-3 col-md-3">
																<label class="form-label">Buncis (Kg)</label>
																	<div class="input-group flex-nowrap">
																		<span class="input-group-text" id="basic-addon1">Rp</span>
																		<input type="number" class="form-control" name="buncis" min=0 value="0">
																	</div>
															</div>
															<div class="mb-3 col-md-3">
																<label class="form-label">Bawang Merah (Kg)</label>
																	<div class="input-group flex-nowrap">
																		<span class="input-group-text" id="basic-addon1">Rp</span>
																		<input type="number" class="form-control" name="bawang_m" min=0 value="0">
																	</div>
															</div>
															<div class="mb-3 col-md-3">
																<label class="form-label">Bawang Putih Impor (Kg)</label>
																	<div class="input-group flex-nowrap">
																		<span class="input-group-text" id="basic-addon1">Rp</span>
																		<input type="number" class="form-control" name="bawang_p" min=0 value="0">
																	</div>
															</div>
															<div class="mb-3 col-md-3">
																<label class="form-label">Ikan Asin Teri (Kg)</label>
																	<div class="input-group flex-nowrap">
																		<span class="input-group-text" id="basic-addon1">Rp</span>
																		<input type="number" class="form-control" name="ikan" min=0 value="0">
																	</div>
															</div>
															<div class="mb-3 col-md-3">
																<label class="form-label">Kentang (Kg)</label>
																	<div class="input-group flex-nowrap">
																		<span class="input-group-text" id="basic-addon1">Rp</span>
																		<input type="number" class="form-control" name="kentang" min=0 value="0">
																	</div>
															</div>
															<div class="mb-3 col-md-3">
																<label class="form-label">Gula Merah Kelapa (Kg)</label>
																	<div class="input-group flex-nowrap">
																		<span class="input-group-text" id="basic-addon1">Rp</span>
																		<input type="number" class="form-control" name="gula_merah" min=0 value="0">
																	</div>
															</div>
															<div class="mb-3 col-md-3">
																<label class="form-label">Kelapa (Butir)</label>
																	<div class="input-group flex-nowrap">
																		<span class="input-group-text" id="basic-addon1">Rp</span>
																		<input type="number" class="form-control" name="kelapa" min=0 value="0">
																	</div>
															</div>
															<div class="mb-3 col-md-3">
																<label class="form-label">Gas Elpiji 3 Kg (Tabung)</label>
																	<div class="input-group flex-nowrap">
																		<span class="input-group-text" id="basic-addon1">Rp</span>
																		<input type="number" class="form-control" name="gas" min=0 value="0">
																	</div>
															</div>
														</div>
																	
														<button type="submit" class="btn btn-primary" name="submit">Submit</button>
													</form>
                                            </div> <!-- end preview code-->
											<div class="tab-pane" id="data-pasar">
                                                <div class="row mb-2">
													<div class="col-sm-6">
														<button type="button" onclick="generate2()" class="btn btn-danger mb-2 mt-2"><i class="mdi mdi-pdf-box"></i> PDF</button>&nbsp;&nbsp;
														<button type="submit" onclick="window.open('harga-pasar-excel.php?tgl=<?php echo $_POST['tgl']; ?>')" class="btn btn-success mb-2 mt-2"><i class="mdi mdi-microsoft-excel"></i> Excel</button>&nbsp;&nbsp;
														<?php if($_SESSION['login_saharga']){
															$id=$_SESSION['login_saharga'];
															$sql ="SELECT * FROM administrator WHERE level='$id'";
																$query = mysqli_query($koneksidb,$sql);
																$results = mysqli_fetch_array($query);
																if($results['level']!=="Admin"){?>
														<a href="#modal-lg-edit" class="btn btn-warning mb-2 mt-2 text-white" data-bs-toggle="modal"><i class="mdi mdi-update text-white"></i> Edit</a>
														<?php }}?>
													</div>
													<div class="col-sm-6">
													<form method="POST">
														<div class="row gy-2 gx-2 align-items-center">
															<div class="col-sm-10 mt-3">
																<input type="text" class="form-control" name="tgl" placeholder="Pilih Tanggal" onfocus="(this.type='date')" required>
															</div>
															<div class="col-sm-2 mt-3">
																<label class="form-label"></label>
																<button type="submit" class="btn btn-primary" name="cari2">Cari</button>
															</div>
														</div>
													</form>
													</div>
												</div>
												<?php if(isset($_POST['cari2'])){ ?>
													<p class="text-muted font-32">
														Harga Bahan Pokok Per-Pasar Tanggal : <?php echo Indonesia2Tgl($_POST['tgl']); ?>
													</p>
													<?php }?>
												<div class="table-responsive">
												<table id="scroll-horizontal-datatable2" class="table table-striped table-bordered table-hover nowrap w-100">
													<thead>
                                                        <tr>
															<?php 
																if(!isset($_POST['cari2'])){
															?>
                                                            <th class="text-center">NO</th>
                                                            <th class="text-center">BAHAN POKOK</th>
                                                            <th class="text-center">SATUAN</th>
																<?php }else{?>
															<th rowspan="2" class="text-center">NO</th>
                                                            <th rowspan="2" class="text-center">BAHAN POKOK</th>
                                                            <th rowspan="2" class="text-center">SATUAN</th>
                                                            <th colspan="5" class="text-center">PASAR TRADISIONAL</th>
                                                            <th rowspan="2" class="text-center">RATA-RATA</th>
                                                            <th rowspan="2" class="text-center">HET</th>
                                                        </tr>
                                                        <tr>
																<th class="text-center">SINGAPARNA</th>
																<th class="text-center">CIAWI</th>
																<th class="text-center">TARAJU</th>
																<th class="text-center">MANONJAYA</th>
																<th class="text-center">CIKATOMAS</th>
																<?php }?>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr><?php $nomor = 1; ?>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Beras Premium</td>
															<td class="text-center">Kg</td>
															<?php 
																if(isset($_POST['cari2'])){
																	$tgl = $_POST['tgl'];
																	
																	$sqlsingaparna = "SELECT * FROM harga WHERE tgl='$tgl' AND pasar='Singaparna'";
																		$querysingaparna = mysqli_query($koneksidb,$sqlsingaparna);
																		$singaparna = mysqli_fetch_array($querysingaparna);
																	
																	$sqlciawi = "SELECT * FROM harga WHERE tgl='$tgl' AND pasar='Ciawi'";
																		$queryciawi = mysqli_query($koneksidb,$sqlciawi);
																		$ciawi = mysqli_fetch_array($queryciawi);
																		
																	$sqltaraju = "SELECT * FROM harga WHERE tgl='$tgl' AND pasar='Taraju'";
																		$querytaraju = mysqli_query($koneksidb,$sqltaraju);
																		$taraju = mysqli_fetch_array($querytaraju);
																		
																	$sqlmanonjaya = "SELECT * FROM harga WHERE tgl='$tgl' AND pasar='Manonjaya'";
																		$querymanonjaya = mysqli_query($koneksidb,$sqlmanonjaya);
																		$manonjaya = mysqli_fetch_array($querymanonjaya);
																		
																	$sqlcikatomas = "SELECT * FROM harga WHERE tgl='$tgl' AND pasar='Cikatomas'";
																		$querycikatomas = mysqli_query($koneksidb,$sqlcikatomas);
																		$cikatomas = mysqli_fetch_array($querycikatomas);
																			
																	$sqlsum = "SELECT SUM(beras_p) AS jumlah FROM harga WHERE tgl ='$tgl'";
																		$querysum = mysqli_query($koneksidb,$sqlsum);
																		$rata = mysqli_fetch_array($querysum);
																			$rata2 = $rata['jumlah']/5; 
																			
																	$sqlhet = "SELECT * FROM het";
																		$queryhet = mysqli_query($koneksidb,$sqlhet);
																		$resulthet = mysqli_fetch_array($queryhet);
															?>
															<td class="text-center"><?php if($singaparna['pasar']=="Singaparna"){?> 
																<?php echo format_rupiah($singaparna['beras_p']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($ciawi['pasar']=="Ciawi"){?> 
																<?php echo format_rupiah($ciawi['beras_p']);?>
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($taraju['pasar']=="Taraju"){?> 
																<?php echo format_rupiah($taraju['beras_p']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($manonjaya['pasar']=="Manonjaya"){?> 
																<?php echo format_rupiah($manonjaya['beras_p']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($cikatomas['pasar']=="Cikatomas"){?> 
																<?php echo format_rupiah($cikatomas['beras_p']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php echo format_rupiah($rata2);?></td>
															<td class="text-center"><?php echo format_rupiah($resulthet['beras_p']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Beras Medium</td>
															<td class="text-center">Kg</td>
															<?php 
																if(isset($_POST['cari2'])){
																	$tgl = $_POST['tgl'];
																	
																	$sqlsum = "SELECT SUM(beras_m) AS jumlah FROM harga WHERE tgl ='$tgl'";
																	$querysum = mysqli_query($koneksidb,$sqlsum);
																	$rata = mysqli_fetch_array($querysum);
																	$rata2 = $rata['jumlah']/5; 
															?>
															<td class="text-center"><?php if($singaparna['pasar']=="Singaparna"){?> 
																<?php echo format_rupiah($singaparna['beras_m']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($ciawi['pasar']=="Ciawi"){?> 
																<?php echo format_rupiah($ciawi['beras_m']);?>
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($taraju['pasar']=="Taraju"){?> 
																<?php echo format_rupiah($taraju['beras_m']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($manonjaya['pasar']=="Manonjaya"){?> 
																<?php echo format_rupiah($manonjaya['beras_m']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($cikatomas['pasar']=="Cikatomas"){?> 
																<?php echo format_rupiah($cikatomas['beras_m']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php echo format_rupiah($rata2);?></td>
															<td class="text-center"><?php echo format_rupiah($resulthet['beras_m']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Gula Pasir Dalam Negeri</td>
															<td class="text-center">Kg</td>
															<?php 
																if(isset($_POST['cari2'])){
																	$tgl = $_POST['tgl'];
																	
																	$sqlsum = "SELECT SUM(gula) AS jumlah FROM harga WHERE tgl ='$tgl'";
																	$querysum = mysqli_query($koneksidb,$sqlsum);
																	$rata = mysqli_fetch_array($querysum);
																	$rata2 = $rata['jumlah']/5; 
															?>
															<td class="text-center"><?php if($singaparna['pasar']=="Singaparna"){?> 
																<?php echo format_rupiah($singaparna['gula']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($ciawi['pasar']=="Ciawi"){?> 
																<?php echo format_rupiah($ciawi['gula']);?>
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($taraju['pasar']=="Taraju"){?> 
																<?php echo format_rupiah($taraju['gula']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($manonjaya['pasar']=="Manonjaya"){?> 
																<?php echo format_rupiah($manonjaya['gula']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($cikatomas['pasar']=="Cikatomas"){?> 
																<?php echo format_rupiah($cikatomas['gula']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php echo format_rupiah($rata2);?></td>
															<td class="text-center"><?php echo format_rupiah($resulthet['gula']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Minyak Goreng Bimoli Kemasan</td>
															<td class="text-center">Liter</td>
															<?php 
																if(isset($_POST['cari2'])){
																	$tgl = $_POST['tgl'];
																	
																	$sqlsum = "SELECT SUM(bimoli) AS jumlah FROM harga WHERE tgl ='$tgl'";
																	$querysum = mysqli_query($koneksidb,$sqlsum);
																	$rata = mysqli_fetch_array($querysum);
																	$rata2 = $rata['jumlah']/5; 
															?>
															<td class="text-center"><?php if($singaparna['pasar']=="Singaparna"){?> 
																<?php echo format_rupiah($singaparna['bimoli']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($ciawi['pasar']=="Ciawi"){?> 
																<?php echo format_rupiah($ciawi['bimoli']);?>
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($taraju['pasar']=="Taraju"){?> 
																<?php echo format_rupiah($taraju['bimoli']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($manonjaya['pasar']=="Manonjaya"){?> 
																<?php echo format_rupiah($manonjaya['bimoli']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($cikatomas['pasar']=="Cikatomas"){?> 
																<?php echo format_rupiah($cikatomas['bimoli']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php echo format_rupiah($rata2);?></td>
															<td class="text-center"><?php echo format_rupiah($resulthet['bimoli']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Minyak Goreng Curah</td>
															<td class="text-center">Liter</td>
															<?php 
																if(isset($_POST['cari2'])){
																	$tgl = $_POST['tgl'];
																	
																	$sqlsum = "SELECT SUM(minyak_c) AS jumlah FROM harga WHERE tgl ='$tgl'";
																	$querysum = mysqli_query($koneksidb,$sqlsum);
																	$rata = mysqli_fetch_array($querysum);
																	$rata2 = $rata['jumlah']/5; 
															?>
															<td class="text-center"><?php if($singaparna['pasar']=="Singaparna"){?> 
																<?php echo format_rupiah($singaparna['minyak_c']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($ciawi['pasar']=="Ciawi"){?> 
																<?php echo format_rupiah($ciawi['minyak_c']);?>
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($taraju['pasar']=="Taraju"){?> 
																<?php echo format_rupiah($taraju['minyak_c']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($manonjaya['pasar']=="Manonjaya"){?> 
																<?php echo format_rupiah($manonjaya['minyak_c']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($cikatomas['pasar']=="Cikatomas"){?> 
																<?php echo format_rupiah($cikatomas['minyak_c']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php echo format_rupiah($rata2);?></td>
															<td class="text-center"><?php echo format_rupiah($resulthet['minyak_c']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Minyak Goreng Kemasan Sederhana</td>
															<td class="text-center">Liter</td>
															<?php 
																if(isset($_POST['cari2'])){
																	$tgl = $_POST['tgl'];
																	
																	$sqlsum = "SELECT SUM(minyak_k) AS jumlah FROM harga WHERE tgl ='$tgl'";
																	$querysum = mysqli_query($koneksidb,$sqlsum);
																	$rata = mysqli_fetch_array($querysum);
																	$rata2 = $rata['jumlah']/5; 
															?>
															<td class="text-center"><?php if($singaparna['pasar']=="Singaparna"){?> 
																<?php echo format_rupiah($singaparna['minyak_k']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($ciawi['pasar']=="Ciawi"){?> 
																<?php echo format_rupiah($ciawi['minyak_k']);?>
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($taraju['pasar']=="Taraju"){?> 
																<?php echo format_rupiah($taraju['minyak_k']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($manonjaya['pasar']=="Manonjaya"){?> 
																<?php echo format_rupiah($manonjaya['minyak_k']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($cikatomas['pasar']=="Cikatomas"){?> 
																<?php echo format_rupiah($cikatomas['minyak_k']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php echo format_rupiah($rata2);?></td>
															<td class="text-center"><?php echo format_rupiah($resulthet['minyak_k']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Daging Sapi</td>
															<td class="text-center">Kg</td>
															<?php 
																if(isset($_POST['cari2'])){
																	$tgl = $_POST['tgl'];
																	
																	$sqlsum = "SELECT SUM(sapi) AS jumlah FROM harga WHERE tgl ='$tgl'";
																	$querysum = mysqli_query($koneksidb,$sqlsum);
																	$rata = mysqli_fetch_array($querysum);
																	$rata2 = $rata['jumlah']/5; 
															?>
															<td class="text-center"><?php if($singaparna['pasar']=="Singaparna"){?> 
																<?php echo format_rupiah($singaparna['sapi']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($ciawi['pasar']=="Ciawi"){?> 
																<?php echo format_rupiah($ciawi['sapi']);?>
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($taraju['pasar']=="Taraju"){?> 
																<?php echo format_rupiah($taraju['sapi']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($manonjaya['pasar']=="Manonjaya"){?> 
																<?php echo format_rupiah($manonjaya['sapi']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($cikatomas['pasar']=="Cikatomas"){?> 
																<?php echo format_rupiah($cikatomas['sapi']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php echo format_rupiah($rata2);?></td>
															<td class="text-center"><?php echo format_rupiah($resulthet['sapi']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Daging Ayam Broiler</td>
															<td class="text-center">Kg</td>
															<?php 
																if(isset($_POST['cari2'])){
																	$tgl = $_POST['tgl'];
																	
																	$sqlsum = "SELECT SUM(ayam_b) AS jumlah FROM harga WHERE tgl ='$tgl'";
																	$querysum = mysqli_query($koneksidb,$sqlsum);
																	$rata = mysqli_fetch_array($querysum);
																	$rata2 = $rata['jumlah']/5; 
															?>
															<td class="text-center"><?php if($singaparna['pasar']=="Singaparna"){?> 
																<?php echo format_rupiah($singaparna['ayam_b']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($ciawi['pasar']=="Ciawi"){?> 
																<?php echo format_rupiah($ciawi['ayam_b']);?>
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($taraju['pasar']=="Taraju"){?> 
																<?php echo format_rupiah($taraju['ayam_b']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($manonjaya['pasar']=="Manonjaya"){?> 
																<?php echo format_rupiah($manonjaya['ayam_b']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($cikatomas['pasar']=="Cikatomas"){?> 
																<?php echo format_rupiah($cikatomas['ayam_b']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php echo format_rupiah($rata2);?></td>
															<td class="text-center"><?php echo format_rupiah($resulthet['ayam_b']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Daging Ayam Kampung</td>
															<td class="text-center">Kg</td>
															<?php 
																if(isset($_POST['cari2'])){
																	$tgl = $_POST['tgl'];
																	
																	$sqlsum = "SELECT SUM(ayam_k) AS jumlah FROM harga WHERE tgl ='$tgl'";
																	$querysum = mysqli_query($koneksidb,$sqlsum);
																	$rata = mysqli_fetch_array($querysum);
																	$rata2 = $rata['jumlah']/5; 
															?>
															<td class="text-center"><?php if($singaparna['pasar']=="Singaparna"){?> 
																<?php echo format_rupiah($singaparna['ayam_k']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($ciawi['pasar']=="Ciawi"){?> 
																<?php echo format_rupiah($ciawi['ayam_k']);?>
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($taraju['pasar']=="Taraju"){?> 
																<?php echo format_rupiah($taraju['ayam_k']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($manonjaya['pasar']=="Manonjaya"){?> 
																<?php echo format_rupiah($manonjaya['ayam_k']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($cikatomas['pasar']=="Cikatomas"){?> 
																<?php echo format_rupiah($cikatomas['ayam_k']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php echo format_rupiah($rata2);?></td>
															<td class="text-center"><?php echo format_rupiah($resulthet['ayam_k']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Telur Ayam Ras</td>
															<td class="text-center">Kg</td>
															<?php 
																if(isset($_POST['cari2'])){
																	$tgl = $_POST['tgl'];
																	
																	$sqlsum = "SELECT SUM(telur) AS jumlah FROM harga WHERE tgl ='$tgl'";
																	$querysum = mysqli_query($koneksidb,$sqlsum);
																	$rata = mysqli_fetch_array($querysum);
																	$rata2 = $rata['jumlah']/5; 
															?>
															<td class="text-center"><?php if($singaparna['pasar']=="Singaparna"){?> 
																<?php echo format_rupiah($singaparna['telur']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($ciawi['pasar']=="Ciawi"){?> 
																<?php echo format_rupiah($ciawi['telur']);?>
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($taraju['pasar']=="Taraju"){?> 
																<?php echo format_rupiah($taraju['telur']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($manonjaya['pasar']=="Manonjaya"){?> 
																<?php echo format_rupiah($manonjaya['telur']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($cikatomas['pasar']=="Cikatomas"){?> 
																<?php echo format_rupiah($cikatomas['telur']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php echo format_rupiah($rata2);?></td>
															<td class="text-center"><?php echo format_rupiah($resulthet['telur']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Susu Kental Manis Merk Bendera</td>
															<td class="text-center">Kaleng</td>
															<?php 
																if(isset($_POST['cari2'])){
																	$tgl = $_POST['tgl'];
																	
																	$sqlsum = "SELECT SUM(susu_b) AS jumlah FROM harga WHERE tgl ='$tgl'";
																	$querysum = mysqli_query($koneksidb,$sqlsum);
																	$rata = mysqli_fetch_array($querysum);
																	$rata2 = $rata['jumlah']/5; 
															?>
															<td class="text-center"><?php if($singaparna['pasar']=="Singaparna"){?> 
																<?php echo format_rupiah($singaparna['susu_b']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($ciawi['pasar']=="Ciawi"){?> 
																<?php echo format_rupiah($ciawi['susu_b']);?>
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($taraju['pasar']=="Taraju"){?> 
																<?php echo format_rupiah($taraju['susu_b']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($manonjaya['pasar']=="Manonjaya"){?> 
																<?php echo format_rupiah($manonjaya['susu_b']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($cikatomas['pasar']=="Cikatomas"){?> 
																<?php echo format_rupiah($cikatomas['susu_b']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php echo format_rupiah($rata2);?></td>
															<td class="text-center"><?php echo format_rupiah($resulthet['susu_b']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Susu Kental Manis Merk Indomilk</td>
															<td class="text-center">Kaleng</td>
															<?php 
																if(isset($_POST['cari2'])){
																	$tgl = $_POST['tgl'];
																	
																	$sqlsum = "SELECT SUM(susu_i) AS jumlah FROM harga WHERE tgl ='$tgl'";
																	$querysum = mysqli_query($koneksidb,$sqlsum);
																	$rata = mysqli_fetch_array($querysum);
																	$rata2 = $rata['jumlah']/5; 
															?>
															<td class="text-center"><?php if($singaparna['pasar']=="Singaparna"){?> 
																<?php echo format_rupiah($singaparna['susu_i']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($ciawi['pasar']=="Ciawi"){?> 
																<?php echo format_rupiah($ciawi['susu_i']);?>
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($taraju['pasar']=="Taraju"){?> 
																<?php echo format_rupiah($taraju['susu_i']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($manonjaya['pasar']=="Manonjaya"){?> 
																<?php echo format_rupiah($manonjaya['susu_i']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($cikatomas['pasar']=="Cikatomas"){?> 
																<?php echo format_rupiah($cikatomas['susu_i']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php echo format_rupiah($rata2);?></td>
															<td class="text-center"><?php echo format_rupiah($resulthet['susu_i']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Susu Bubuk Dancow Fuel Cream</td>
															<td class="text-center">200 Gr</td>
															<?php 
																if(isset($_POST['cari2'])){
																	$tgl = $_POST['tgl'];
																	
																	$sqlsum = "SELECT SUM(susu_d) AS jumlah FROM harga WHERE tgl ='$tgl'";
																	$querysum = mysqli_query($koneksidb,$sqlsum);
																	$rata = mysqli_fetch_array($querysum);
																	$rata2 = $rata['jumlah']/5; 
															?>
															<td class="text-center"><?php if($singaparna['pasar']=="Singaparna"){?> 
																<?php echo format_rupiah($singaparna['susu_d']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($ciawi['pasar']=="Ciawi"){?> 
																<?php echo format_rupiah($ciawi['susu_d']);?>
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($taraju['pasar']=="Taraju"){?> 
																<?php echo format_rupiah($taraju['susu_d']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($manonjaya['pasar']=="Manonjaya"){?> 
																<?php echo format_rupiah($manonjaya['susu_d']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($cikatomas['pasar']=="Cikatomas"){?> 
																<?php echo format_rupiah($cikatomas['susu_d']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php echo format_rupiah($rata2);?></td>
															<td class="text-center"><?php echo format_rupiah($resulthet['susu_d']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Jagung Pipilan</td>
															<td class="text-center">Kg</td>
															<?php 
																if(isset($_POST['cari2'])){
																	$tgl = $_POST['tgl'];
																	
																	$sqlsum = "SELECT SUM(jagung_p) AS jumlah FROM harga WHERE tgl ='$tgl'";
																	$querysum = mysqli_query($koneksidb,$sqlsum);
																	$rata = mysqli_fetch_array($querysum);
																	$rata2 = $rata['jumlah']/5; 
															?>
															<td class="text-center"><?php if($singaparna['pasar']=="Singaparna"){?> 
																<?php echo format_rupiah($singaparna['jagung_p']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($ciawi['pasar']=="Ciawi"){?> 
																<?php echo format_rupiah($ciawi['jagung_p']);?>
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($taraju['pasar']=="Taraju"){?> 
																<?php echo format_rupiah($taraju['jagung_p']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($manonjaya['pasar']=="Manonjaya"){?> 
																<?php echo format_rupiah($manonjaya['jagung_p']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($cikatomas['pasar']=="Cikatomas"){?> 
																<?php echo format_rupiah($cikatomas['jagung_p']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php echo format_rupiah($rata2);?></td>
															<td class="text-center"><?php echo format_rupiah($resulthet['jagung_p']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Jagung Tingkat Peternak</td>
															<td class="text-center">Kg</td>
															<?php 
																if(isset($_POST['cari2'])){
																	$tgl = $_POST['tgl'];
																	
																	$sqlsum = "SELECT SUM(jagung_t) AS jumlah FROM harga WHERE tgl ='$tgl'";
																	$querysum = mysqli_query($koneksidb,$sqlsum);
																	$rata = mysqli_fetch_array($querysum);
																	$rata2 = $rata['jumlah']/5; 
															?>
															<td class="text-center"><?php if($singaparna['pasar']=="Singaparna"){?> 
																<?php echo format_rupiah($singaparna['jagung_t']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($ciawi['pasar']=="Ciawi"){?> 
																<?php echo format_rupiah($ciawi['jagung_t']);?>
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($taraju['pasar']=="Taraju"){?> 
																<?php echo format_rupiah($taraju['jagung_t']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($manonjaya['pasar']=="Manonjaya"){?> 
																<?php echo format_rupiah($manonjaya['jagung_t']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($cikatomas['pasar']=="Cikatomas"){?> 
																<?php echo format_rupiah($cikatomas['jagung_t']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php echo format_rupiah($rata2);?></td>
															<td class="text-center"><?php echo format_rupiah($resulthet['jagung_t']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Garam Beryodium</td>
															<td class="text-center">250 Gr</td>
															<?php 
																if(isset($_POST['cari2'])){
																	$tgl = $_POST['tgl'];
																	
																	$sqlsum = "SELECT SUM(garam) AS jumlah FROM harga WHERE tgl ='$tgl'";
																	$querysum = mysqli_query($koneksidb,$sqlsum);
																	$rata = mysqli_fetch_array($querysum);
																	$rata2 = $rata['jumlah']/5; 
															?>
															<td class="text-center"><?php if($singaparna['pasar']=="Singaparna"){?> 
																<?php echo format_rupiah($singaparna['garam']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($ciawi['pasar']=="Ciawi"){?> 
																<?php echo format_rupiah($ciawi['garam']);?>
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($taraju['pasar']=="Taraju"){?> 
																<?php echo format_rupiah($taraju['garam']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($manonjaya['pasar']=="Manonjaya"){?> 
																<?php echo format_rupiah($manonjaya['garam']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($cikatomas['pasar']=="Cikatomas"){?> 
																<?php echo format_rupiah($cikatomas['garam']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php echo format_rupiah($rata2);?></td>
															<td class="text-center"><?php echo format_rupiah($resulthet['garam']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Tepung Terigu Cap Segitiga Biru</td>
															<td class="text-center">Kg</td>
															<?php 
																if(isset($_POST['cari2'])){
																	$tgl = $_POST['tgl'];
																	
																	$sqlsum = "SELECT SUM(tepung) AS jumlah FROM harga WHERE tgl ='$tgl'";
																	$querysum = mysqli_query($koneksidb,$sqlsum);
																	$rata = mysqli_fetch_array($querysum);
																	$rata2 = $rata['jumlah']/5; 
															?>
															<td class="text-center"><?php if($singaparna['pasar']=="Singaparna"){?> 
																<?php echo format_rupiah($singaparna['tepung']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($ciawi['pasar']=="Ciawi"){?> 
																<?php echo format_rupiah($ciawi['tepung']);?>
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($taraju['pasar']=="Taraju"){?> 
																<?php echo format_rupiah($taraju['tepung']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($manonjaya['pasar']=="Manonjaya"){?> 
																<?php echo format_rupiah($manonjaya['tepung']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($cikatomas['pasar']=="Cikatomas"){?> 
																<?php echo format_rupiah($cikatomas['tepung']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php echo format_rupiah($rata2);?></td>
															<td class="text-center"><?php echo format_rupiah($resulthet['tepung']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Kacang Kedelai Lokal</td>
															<td class="text-center">Kg</td>
															<?php 
																if(isset($_POST['cari2'])){
																	$tgl = $_POST['tgl'];
																	
																	$sqlsum = "SELECT SUM(kacang_k) AS jumlah FROM harga WHERE tgl ='$tgl'";
																	$querysum = mysqli_query($koneksidb,$sqlsum);
																	$rata = mysqli_fetch_array($querysum);
																	$rata2 = $rata['jumlah']/5; 
															?>
															<td class="text-center"><?php if($singaparna['pasar']=="Singaparna"){?> 
																<?php echo format_rupiah($singaparna['kacang_k']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($ciawi['pasar']=="Ciawi"){?> 
																<?php echo format_rupiah($ciawi['kacang_k']);?>
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($taraju['pasar']=="Taraju"){?> 
																<?php echo format_rupiah($taraju['kacang_k']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($manonjaya['pasar']=="Manonjaya"){?> 
																<?php echo format_rupiah($manonjaya['kacang_k']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($cikatomas['pasar']=="Cikatomas"){?> 
																<?php echo format_rupiah($cikatomas['kacang_k']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php echo format_rupiah($rata2);?></td>
															<td class="text-center"><?php echo format_rupiah($resulthet['kacang_k']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Kacang Hijau</td>
															<td class="text-center">Kg</td>
															<?php 
																if(isset($_POST['cari2'])){
																	$tgl = $_POST['tgl'];
																	
																	$sqlsum = "SELECT SUM(kacang_h) AS jumlah FROM harga WHERE tgl ='$tgl'";
																	$querysum = mysqli_query($koneksidb,$sqlsum);
																	$rata = mysqli_fetch_array($querysum);
																	$rata2 = $rata['jumlah']/5; 
															?>
															<td class="text-center"><?php if($singaparna['pasar']=="Singaparna"){?> 
																<?php echo format_rupiah($singaparna['kacang_h']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($ciawi['pasar']=="Ciawi"){?> 
																<?php echo format_rupiah($ciawi['kacang_h']);?>
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($taraju['pasar']=="Taraju"){?> 
																<?php echo format_rupiah($taraju['kacang_h']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($manonjaya['pasar']=="Manonjaya"){?> 
																<?php echo format_rupiah($manonjaya['kacang_h']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($cikatomas['pasar']=="Cikatomas"){?> 
																<?php echo format_rupiah($cikatomas['kacang_h']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php echo format_rupiah($rata2);?></td>
															<td class="text-center"><?php echo format_rupiah($resulthet['kacang_h']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Kacang Tanah</td>
															<td class="text-center">Kg</td>
															<?php 
																if(isset($_POST['cari2'])){
																	$tgl = $_POST['tgl'];
																	
																	$sqlsum = "SELECT SUM(kacang_t) AS jumlah FROM harga WHERE tgl ='$tgl'";
																	$querysum = mysqli_query($koneksidb,$sqlsum);
																	$rata = mysqli_fetch_array($querysum);
																	$rata2 = $rata['jumlah']/5; 
															?>
															<td class="text-center"><?php if($singaparna['pasar']=="Singaparna"){?> 
																<?php echo format_rupiah($singaparna['kacang_t']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($ciawi['pasar']=="Ciawi"){?> 
																<?php echo format_rupiah($ciawi['kacang_t']);?>
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($taraju['pasar']=="Taraju"){?> 
																<?php echo format_rupiah($taraju['kacang_t']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($manonjaya['pasar']=="Manonjaya"){?> 
																<?php echo format_rupiah($manonjaya['kacang_t']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($cikatomas['pasar']=="Cikatomas"){?> 
																<?php echo format_rupiah($cikatomas['kacang_t']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php echo format_rupiah($rata2);?></td>
															<td class="text-center"><?php echo format_rupiah($resulthet['kacang_t']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Blue Band Margarin</td>
															<td class="text-center">200 Gr</td>
															<?php 
																if(isset($_POST['cari2'])){
																	$tgl = $_POST['tgl'];
																	
																	$sqlsum = "SELECT SUM(blueband) AS jumlah FROM harga WHERE tgl ='$tgl'";
																	$querysum = mysqli_query($koneksidb,$sqlsum);
																	$rata = mysqli_fetch_array($querysum);
																	$rata2 = $rata['jumlah']/5; 
															?>
															<td class="text-center"><?php if($singaparna['pasar']=="Singaparna"){?> 
																<?php echo format_rupiah($singaparna['blueband']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($ciawi['pasar']=="Ciawi"){?> 
																<?php echo format_rupiah($ciawi['blueband']);?>
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($taraju['pasar']=="Taraju"){?> 
																<?php echo format_rupiah($taraju['blueband']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($manonjaya['pasar']=="Manonjaya"){?> 
																<?php echo format_rupiah($manonjaya['blueband']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($cikatomas['pasar']=="Cikatomas"){?> 
																<?php echo format_rupiah($cikatomas['blueband']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php echo format_rupiah($rata2);?></td>
															<td class="text-center"><?php echo format_rupiah($resulthet['blueband']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Indomie Rasa Ayam Bawang</td>
															<td class="text-center">Dus</td>
															<?php 
																if(isset($_POST['cari2'])){
																	$tgl = $_POST['tgl'];
																	
																	$sqlsum = "SELECT SUM(mie) AS jumlah FROM harga WHERE tgl ='$tgl'";
																	$querysum = mysqli_query($koneksidb,$sqlsum);
																	$rata = mysqli_fetch_array($querysum);
																	$rata2 = $rata['jumlah']/5; 
															?>
															<td class="text-center"><?php if($singaparna['pasar']=="Singaparna"){?> 
																<?php echo format_rupiah($singaparna['mie']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($ciawi['pasar']=="Ciawi"){?> 
																<?php echo format_rupiah($ciawi['mie']);?>
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($taraju['pasar']=="Taraju"){?> 
																<?php echo format_rupiah($taraju['mie']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($manonjaya['pasar']=="Manonjaya"){?> 
																<?php echo format_rupiah($manonjaya['mie']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($cikatomas['pasar']=="Cikatomas"){?> 
																<?php echo format_rupiah($cikatomas['mie']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php echo format_rupiah($rata2);?></td>
															<td class="text-center"><?php echo format_rupiah($resulthet['mie']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Cabe Merah Biasa</td>
															<td class="text-center">Kg</td>
															<?php 
																if(isset($_POST['cari2'])){
																	$tgl = $_POST['tgl'];
																	
																	$sqlsum = "SELECT SUM(cabe_mb) AS jumlah FROM harga WHERE tgl ='$tgl'";
																	$querysum = mysqli_query($koneksidb,$sqlsum);
																	$rata = mysqli_fetch_array($querysum);
																	$rata2 = $rata['jumlah']/5; 
															?>
															<td class="text-center"><?php if($singaparna['pasar']=="Singaparna"){?> 
																<?php echo format_rupiah($singaparna['cabe_mb']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($ciawi['pasar']=="Ciawi"){?> 
																<?php echo format_rupiah($ciawi['cabe_mb']);?>
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($taraju['pasar']=="Taraju"){?> 
																<?php echo format_rupiah($taraju['cabe_mb']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($manonjaya['pasar']=="Manonjaya"){?> 
																<?php echo format_rupiah($manonjaya['cabe_mb']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($cikatomas['pasar']=="Cikatomas"){?> 
																<?php echo format_rupiah($cikatomas['cabe_mb']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php echo format_rupiah($rata2);?></td>
															<td class="text-center"><?php echo format_rupiah($resulthet['cabe_mb']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Cabe Hijau Biasa</td>
															<td class="text-center">Kg</td>
															<?php 
																if(isset($_POST['cari2'])){
																	$tgl = $_POST['tgl'];
																	
																	$sqlsum = "SELECT SUM(cabe_hb) AS jumlah FROM harga WHERE tgl ='$tgl'";
																	$querysum = mysqli_query($koneksidb,$sqlsum);
																	$rata = mysqli_fetch_array($querysum);
																	$rata2 = $rata['jumlah']/5; 
															?>
															<td class="text-center"><?php if($singaparna['pasar']=="Singaparna"){?> 
																<?php echo format_rupiah($singaparna['cabe_hb']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($ciawi['pasar']=="Ciawi"){?> 
																<?php echo format_rupiah($ciawi['cabe_hb']);?>
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($taraju['pasar']=="Taraju"){?> 
																<?php echo format_rupiah($taraju['cabe_hb']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($manonjaya['pasar']=="Manonjaya"){?> 
																<?php echo format_rupiah($manonjaya['cabe_hb']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($cikatomas['pasar']=="Cikatomas"){?> 
																<?php echo format_rupiah($cikatomas['cabe_hb']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php echo format_rupiah($rata2);?></td>
															<td class="text-center"><?php echo format_rupiah($resulthet['cabe_hb']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Cabe Rawit Merah</td>
															<td class="text-center">Kg</td>
															<?php 
																if(isset($_POST['cari2'])){
																	$tgl = $_POST['tgl'];
																	
																	$sqlsum = "SELECT SUM(cabe_rm) AS jumlah FROM harga WHERE tgl ='$tgl'";
																	$querysum = mysqli_query($koneksidb,$sqlsum);
																	$rata = mysqli_fetch_array($querysum);
																	$rata2 = $rata['jumlah']/5; 
															?>
															<td class="text-center"><?php if($singaparna['pasar']=="Singaparna"){?> 
																<?php echo format_rupiah($singaparna['cabe_rm']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($ciawi['pasar']=="Ciawi"){?> 
																<?php echo format_rupiah($ciawi['cabe_rm']);?>
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($taraju['pasar']=="Taraju"){?> 
																<?php echo format_rupiah($taraju['cabe_rm']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($manonjaya['pasar']=="Manonjaya"){?> 
																<?php echo format_rupiah($manonjaya['cabe_rm']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($cikatomas['pasar']=="Cikatomas"){?> 
																<?php echo format_rupiah($cikatomas['cabe_rm']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php echo format_rupiah($rata2);?></td>
															<td class="text-center"><?php echo format_rupiah($resulthet['cabe_rm']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Cabe Rawit Hijau</td>
															<td class="text-center">Kg</td>
															<?php 
																if(isset($_POST['cari2'])){
																	$tgl = $_POST['tgl'];
																	
																	$sqlsum = "SELECT SUM(cabe_rh) AS jumlah FROM harga WHERE tgl ='$tgl'";
																	$querysum = mysqli_query($koneksidb,$sqlsum);
																	$rata = mysqli_fetch_array($querysum);
																	$rata2 = $rata['jumlah']/5; 
															?>
															<td class="text-center"><?php if($singaparna['pasar']=="Singaparna"){?> 
																<?php echo format_rupiah($singaparna['cabe_rh']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($ciawi['pasar']=="Ciawi"){?> 
																<?php echo format_rupiah($ciawi['cabe_rh']);?>
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($taraju['pasar']=="Taraju"){?> 
																<?php echo format_rupiah($taraju['cabe_rh']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($manonjaya['pasar']=="Manonjaya"){?> 
																<?php echo format_rupiah($manonjaya['cabe_rh']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($cikatomas['pasar']=="Cikatomas"){?> 
																<?php echo format_rupiah($cikatomas['cabe_rh']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php echo format_rupiah($rata2);?></td>
															<td class="text-center"><?php echo format_rupiah($resulthet['cabe_rh']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Wortel</td>
															<td class="text-center">Kg</td>
															<?php 
																if(isset($_POST['cari2'])){
																	$tgl = $_POST['tgl'];
																	
																	$sqlsum = "SELECT SUM(wortel) AS jumlah FROM harga WHERE tgl ='$tgl'";
																	$querysum = mysqli_query($koneksidb,$sqlsum);
																	$rata = mysqli_fetch_array($querysum);
																	$rata2 = $rata['jumlah']/5; 
															?>
															<td class="text-center"><?php if($singaparna['pasar']=="Singaparna"){?> 
																<?php echo format_rupiah($singaparna['wortel']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($ciawi['pasar']=="Ciawi"){?> 
																<?php echo format_rupiah($ciawi['wortel']);?>
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($taraju['pasar']=="Taraju"){?> 
																<?php echo format_rupiah($taraju['wortel']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($manonjaya['pasar']=="Manonjaya"){?> 
																<?php echo format_rupiah($manonjaya['wortel']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($cikatomas['pasar']=="Cikatomas"){?> 
																<?php echo format_rupiah($cikatomas['wortel']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php echo format_rupiah($rata2);?></td>
															<td class="text-center"><?php echo format_rupiah($resulthet['wortel']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Kol</td>
															<td class="text-center">Kg</td>
															<?php 
																if(isset($_POST['cari2'])){
																	$tgl = $_POST['tgl'];
																	
																	$sqlsum = "SELECT SUM(kol) AS jumlah FROM harga WHERE tgl ='$tgl'";
																	$querysum = mysqli_query($koneksidb,$sqlsum);
																	$rata = mysqli_fetch_array($querysum);
																	$rata2 = $rata['jumlah']/5; 
															?>
															<td class="text-center"><?php if($singaparna['pasar']=="Singaparna"){?> 
																<?php echo format_rupiah($singaparna['kol']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($ciawi['pasar']=="Ciawi"){?> 
																<?php echo format_rupiah($ciawi['kol']);?>
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($taraju['pasar']=="Taraju"){?> 
																<?php echo format_rupiah($taraju['kol']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($manonjaya['pasar']=="Manonjaya"){?> 
																<?php echo format_rupiah($manonjaya['kol']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($cikatomas['pasar']=="Cikatomas"){?> 
																<?php echo format_rupiah($cikatomas['kol']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php echo format_rupiah($rata2);?></td>
															<td class="text-center"><?php echo format_rupiah($resulthet['kol']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Buncis</td>
															<td class="text-center">Kg</td>
															<?php 
																if(isset($_POST['cari2'])){
																	$tgl = $_POST['tgl'];
																	
																	$sqlsum = "SELECT SUM(buncis) AS jumlah FROM harga WHERE tgl ='$tgl'";
																	$querysum = mysqli_query($koneksidb,$sqlsum);
																	$rata = mysqli_fetch_array($querysum);
																	$rata2 = $rata['jumlah']/5; 
															?>
															<td class="text-center"><?php if($singaparna['pasar']=="Singaparna"){?> 
																<?php echo format_rupiah($singaparna['buncis']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($ciawi['pasar']=="Ciawi"){?> 
																<?php echo format_rupiah($ciawi['buncis']);?>
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($taraju['pasar']=="Taraju"){?> 
																<?php echo format_rupiah($taraju['buncis']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($manonjaya['pasar']=="Manonjaya"){?> 
																<?php echo format_rupiah($manonjaya['buncis']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($cikatomas['pasar']=="Cikatomas"){?> 
																<?php echo format_rupiah($cikatomas['buncis']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php echo format_rupiah($rata2);?></td>
															<td class="text-center"><?php echo format_rupiah($resulthet['buncis']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Bawang Merah</td>
															<td class="text-center">Kg</td>
															<?php 
																if(isset($_POST['cari2'])){
																	$tgl = $_POST['tgl'];
																	
																	$sqlsum = "SELECT SUM(bawang_m) AS jumlah FROM harga WHERE tgl ='$tgl'";
																	$querysum = mysqli_query($koneksidb,$sqlsum);
																	$rata = mysqli_fetch_array($querysum);
																	$rata2 = $rata['jumlah']/5; 
															?>
															<td class="text-center"><?php if($singaparna['pasar']=="Singaparna"){?> 
																<?php echo format_rupiah($singaparna['bawang_m']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($ciawi['pasar']=="Ciawi"){?> 
																<?php echo format_rupiah($ciawi['bawang_m']);?>
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($taraju['pasar']=="Taraju"){?> 
																<?php echo format_rupiah($taraju['bawang_m']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($manonjaya['pasar']=="Manonjaya"){?> 
																<?php echo format_rupiah($manonjaya['bawang_m']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($cikatomas['pasar']=="Cikatomas"){?> 
																<?php echo format_rupiah($cikatomas['bawang_m']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php echo format_rupiah($rata2);?></td>
															<td class="text-center"><?php echo format_rupiah($resulthet['bawang_m']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Bawang Putih</td>
															<td class="text-center">Kg</td>
															<?php 
																if(isset($_POST['cari2'])){
																	$tgl = $_POST['tgl'];
																	
																	$sqlsum = "SELECT SUM(bawang_p) AS jumlah FROM harga WHERE tgl ='$tgl'";
																	$querysum = mysqli_query($koneksidb,$sqlsum);
																	$rata = mysqli_fetch_array($querysum);
																	$rata2 = $rata['jumlah']/5; 
															?>
															<td class="text-center"><?php if($singaparna['pasar']=="Singaparna"){?> 
																<?php echo format_rupiah($singaparna['bawang_p']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($ciawi['pasar']=="Ciawi"){?> 
																<?php echo format_rupiah($ciawi['bawang_p']);?>
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($taraju['pasar']=="Taraju"){?> 
																<?php echo format_rupiah($taraju['bawang_p']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($manonjaya['pasar']=="Manonjaya"){?> 
																<?php echo format_rupiah($manonjaya['bawang_p']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($cikatomas['pasar']=="Cikatomas"){?> 
																<?php echo format_rupiah($cikatomas['bawang_p']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php echo format_rupiah($rata2);?></td>
															<td class="text-center"><?php echo format_rupiah($resulthet['bawang_p']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Ikan Asin Teri</td>
															<td class="text-center">Kg</td>
															<?php 
																if(isset($_POST['cari2'])){
																	$tgl = $_POST['tgl'];
																	
																	$sqlsum = "SELECT SUM(ikan_asin) AS jumlah FROM harga WHERE tgl ='$tgl'";
																	$querysum = mysqli_query($koneksidb,$sqlsum);
																	$rata = mysqli_fetch_array($querysum);
																	$rata2 = $rata['jumlah']/5; 
															?>
															<td class="text-center"><?php if($singaparna['pasar']=="Singaparna"){?> 
																<?php echo format_rupiah($singaparna['ikan_asin']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($ciawi['pasar']=="Ciawi"){?> 
																<?php echo format_rupiah($ciawi['ikan_asin']);?>
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($taraju['pasar']=="Taraju"){?> 
																<?php echo format_rupiah($taraju['ikan_asin']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($manonjaya['pasar']=="Manonjaya"){?> 
																<?php echo format_rupiah($manonjaya['ikan_asin']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($cikatomas['pasar']=="Cikatomas"){?> 
																<?php echo format_rupiah($cikatomas['ikan_asin']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php echo format_rupiah($rata2);?></td>
															<td class="text-center"><?php echo format_rupiah($resulthet['ikan_asin']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Kentang</td>
															<td class="text-center">Kg</td>
															<?php 
																if(isset($_POST['cari2'])){
																	$tgl = $_POST['tgl'];
																	
																	$sqlsum = "SELECT SUM(kentang) AS jumlah FROM harga WHERE tgl ='$tgl'";
																	$querysum = mysqli_query($koneksidb,$sqlsum);
																	$rata = mysqli_fetch_array($querysum);
																	$rata2 = $rata['jumlah']/5; 
															?>
															<td class="text-center"><?php if($singaparna['pasar']=="Singaparna"){?> 
																<?php echo format_rupiah($singaparna['kentang']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($ciawi['pasar']=="Ciawi"){?> 
																<?php echo format_rupiah($ciawi['kentang']);?>
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($taraju['pasar']=="Taraju"){?> 
																<?php echo format_rupiah($taraju['kentang']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($manonjaya['pasar']=="Manonjaya"){?> 
																<?php echo format_rupiah($manonjaya['kentang']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($cikatomas['pasar']=="Cikatomas"){?> 
																<?php echo format_rupiah($cikatomas['kentang']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php echo format_rupiah($rata2);?></td>
															<td class="text-center"><?php echo format_rupiah($resulthet['kentang']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Gula Merah Kelapa</td>
															<td class="text-center">Kg</td>
															<?php 
																if(isset($_POST['cari2'])){
																	$tgl = $_POST['tgl'];
																	
																	$sqlsum = "SELECT SUM(gula_merah) AS jumlah FROM harga WHERE tgl ='$tgl'";
																	$querysum = mysqli_query($koneksidb,$sqlsum);
																	$rata = mysqli_fetch_array($querysum);
																	$rata2 = $rata['jumlah']/5; 
															?>
															<td class="text-center"><?php if($singaparna['pasar']=="Singaparna"){?> 
																<?php echo format_rupiah($singaparna['gula_merah']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($ciawi['pasar']=="Ciawi"){?> 
																<?php echo format_rupiah($ciawi['gula_merah']);?>
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($taraju['pasar']=="Taraju"){?> 
																<?php echo format_rupiah($taraju['gula_merah']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($manonjaya['pasar']=="Manonjaya"){?> 
																<?php echo format_rupiah($manonjaya['gula_merah']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($cikatomas['pasar']=="Cikatomas"){?> 
																<?php echo format_rupiah($cikatomas['gula_merah']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php echo format_rupiah($rata2);?></td>
															<td class="text-center"><?php echo format_rupiah($resulthet['gula_merah']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Kelapa</td>
															<td class="text-center">Butir</td>
															<?php 
																if(isset($_POST['cari2'])){
																	$tgl = $_POST['tgl'];
																	
																	$sqlsum = "SELECT SUM(kelapa) AS jumlah FROM harga WHERE tgl ='$tgl'";
																	$querysum = mysqli_query($koneksidb,$sqlsum);
																	$rata = mysqli_fetch_array($querysum);
																	$rata2 = $rata['jumlah']/5; 
															?>
															<td class="text-center"><?php if($singaparna['pasar']=="Singaparna"){?> 
																<?php echo format_rupiah($singaparna['kelapa']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($ciawi['pasar']=="Ciawi"){?> 
																<?php echo format_rupiah($ciawi['kelapa']);?>
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($taraju['pasar']=="Taraju"){?> 
																<?php echo format_rupiah($taraju['kelapa']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($manonjaya['pasar']=="Manonjaya"){?> 
																<?php echo format_rupiah($manonjaya['kelapa']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($cikatomas['pasar']=="Cikatomas"){?> 
																<?php echo format_rupiah($cikatomas['kelapa']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php echo format_rupiah($rata2);?></td>
															<td class="text-center"><?php echo format_rupiah($resulthet['kelapa']);?></td>
																<?php }?>
														</tr>
														<tr>
															<td class="text-center"><?php echo $nomor++;?></td>
															<td>Gas Elpiji 3 Kg</td>
															<td class="text-center">Tabung</td>
															<?php 
																if(isset($_POST['cari2'])){
																	$tgl = $_POST['tgl'];
																	
																	$sqlsum = "SELECT SUM(gas) AS jumlah FROM harga WHERE tgl ='$tgl'";
																	$querysum = mysqli_query($koneksidb,$sqlsum);
																	$rata = mysqli_fetch_array($querysum);
																	$rata2 = $rata['jumlah']/5; 
															?>
															<td class="text-center"><?php if($singaparna['pasar']=="Singaparna"){?> 
																<?php echo format_rupiah($singaparna['gas']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($ciawi['pasar']=="Ciawi"){?> 
																<?php echo format_rupiah($ciawi['gas']);?>
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($taraju['pasar']=="Taraju"){?> 
																<?php echo format_rupiah($taraju['gas']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($manonjaya['pasar']=="Manonjaya"){?> 
																<?php echo format_rupiah($manonjaya['gas']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php if($cikatomas['pasar']=="Cikatomas"){?> 
																<?php echo format_rupiah($cikatomas['gas']);?>	
																<?php } else { ?> Kosong <?php } ?>
															</td>
															<td class="text-center"><?php echo format_rupiah($rata2);?></td>
															<td class="text-center"><?php echo format_rupiah($resulthet['gas']);?></td>
																<?php }?>
														</tr>
                                                    </tbody>
                                                </table>  
												</div>
                                            </div> <!-- end data pasar-->
                                        </div> <!-- end tab-content-->

                                    </div> <!-- end card body-->
                                </div> <!-- end card -->
                            </div><!-- end col-->
                        </div>
                        <!-- end row-->

                    </div>
                    <!-- container -->

                </div>
                <!-- content -->

                <!-- Footer Start -->
                <?php include ('../includes/footer.php'); ?>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->
		<!-- Right Sidebar -->
        <div class="end-bar">

            <div class="rightbar-title">
                <a href="javascript:void(0);" class="end-bar-toggle float-end">
                    <i class="dripicons-cross noti-icon"></i>
                </a>
                <h5 class="m-0">Pengaturan</h5>
            </div>

            <div class="rightbar-content h-100" data-simplebar="">

                <div class="p-3">

                    <!-- Settings -->
                    <h5>Warna Tema</h5>
                    <hr class="mt-1">

                    <div class="form-check form-switch mb-1">
                        <input class="form-check-input" type="checkbox" name="color-scheme-mode" value="light" id="light-mode-check" checked="">
                        <label class="form-check-label" for="light-mode-check">Light Mode</label>
                    </div>

                    <div class="form-check form-switch mb-1">
                        <input class="form-check-input" type="checkbox" name="color-scheme-mode" value="dark" id="dark-mode-check">
                        <label class="form-check-label" for="dark-mode-check">Dark Mode</label>
                    </div>
                </div> <!-- end padding-->

            </div>
        </div>
        <div class="rightbar-overlay"></div>
        <!-- /End-bar -->
		
		<!-- Form Edit -->
		<?php include ('harga-edit.php'); ?>
		<!-- #END# Form Edit -->
	
        <?php include ('../includes/script.php'); ?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>  
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.min.js"></script>  
	<script type="text/javascript">
	function generate() {  
		var doc = new jsPDF('l', 'mm', 'f4');  
		var htmlstring = '';  
		var tempVarToCheckPageHeight = 0;  
		var pageHeight = 0;  
		pageHeight = doc.internal.pageSize.height;  
		specialElementHandlers = {  
			// element with id of "bypass" - jQuery style selector  
			'#bypassme': function(element, renderer) {  
				// true = "handled elsewhere, bypass text extraction"  
				return true  
			}  
		};  
		margins = {  
			top: 10,  
			bottom: 10,  
			left: 10,  
			right: 10,  
			width: 600  
		};  

		var y = 20;  

		doc.setLineWidth(2);  

		doc.text(110, y = y + 3, "PANTAUAN HARGA RATA-RATA");  
		doc.text(122, y = y + 10, "BAHAN POKOK PASAR");  
		doc.text(115, y = y + 10, "KABUPATEN TASIKMALAYA");  

		doc.autoTable({  
			html: '#scroll-horizontal-datatable', 
			startY: 50,  
			theme: 'grid'
			
		})  
		doc.save('Harga Bahan Pokok Per Komoditas.pdf');  
	}
	</script>
	<script type="text/javascript">
	function generate2() {  
		var doc = new jsPDF('l', 'mm', 'f4');  
		var htmlstring = '';  
		var tempVarToCheckPageHeight = 0;  
		var pageHeight = 0;  
		pageHeight = doc.internal.pageSize.height;  
		specialElementHandlers = {  
			// element with id of "bypass" - jQuery style selector  
			'#bypassme': function(element, renderer) {  
				// true = "handled elsewhere, bypass text extraction"  
				return true  
			}  
		};  
		margins = {  
			top: 10,  
			bottom: 10,  
			left: 10,  
			right: 10,  
			width: 600  
		};  

		var y = 20;  

		doc.setLineWidth(2);  

		doc.text(110, y = y + 3, "PANTAUAN HARGA BAHAN POKOK");  
		doc.text(140, y = y + 10, "PER PASAR");  
		doc.text(120, y = y + 10, "KABUPATEN TASIKMALAYA");  

		doc.autoTable({  
			html: '#scroll-horizontal-datatable2', 
			startY: 50,  
			theme: 'grid'
			
		})  
		doc.save('Harga Komoditas Per Pasar.pdf');  
	}
	</script>
	<script type="text/javascript">
        $(function() {
            $('#scroll-horizontal-datatable').DataTable({
				lengthMenu:[
					[10,20,50,100,-1],
					[10,20,50,100,"All"]
					],
				buttons: [{
                extend: 'copyHtml5'
            },
            {
                extend: 'excelHtml5'
            },
            {
                extend: 'pdfHtml5',
				orientation: 'landscape'
            },
			{
                extend: 'print'
            }],
				dom: 
			"<'row'<'col-md-3'l><'col-md-5'B><'col-md-4'f>>" +
			"<'row'<'col-md-12'tr>>" +
			"<'row'<'col-md-5'i><'col-md-7'p>>"
            });
			table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );
        })
		
		$(function() {
            $('#scroll-horizontal-datatable2').DataTable({
				lengthMenu:[
					[10,20,50,100,-1],
					[10,20,50,100,"All"]
					],
				buttons: [{
                extend: 'copyHtml5'
            },
            {
                extend: 'excelHtml5'
            },
            {
                extend: 'pdfHtml5',
				orientation: 'landscape'
            },
			{
                extend: 'print'
            }],
				dom: 
			"<'row'<'col-md-3'l><'col-md-5'B><'col-md-4'f>>" +
			"<'row'<'col-md-12'tr>>" +
			"<'row'<'col-md-5'i><'col-md-7'p>>"
            });
			table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );
        })
    </script>
	<script type="text/javascript">
		function valid()
		{
			if(document.periode.sampai.value < document.periode.dari.value){
				Swal.fire({
			icon: 'warning',
			title: 'Oops',
			text: 'Tanggal sampai harus lebih besar dari tanggal dari!'
				}).then(function() {
					window.location = 'harga.php';
			});
				return false;
			}

		return true;
		}
	</script>
    </body>
</html>
<?php }?>