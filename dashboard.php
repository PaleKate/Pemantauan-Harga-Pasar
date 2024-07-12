<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/format_rupiah.php');
include('includes/library.php');
if(strlen($_SESSION['login_saharga'])==0){	
header('location: index.php');
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
        <?php include('includes/head.php'); ?>

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
					<?php include ('includes/header.php'); ?>
					<?php include ('includes/sidebar.php'); ?>
                    <!-- end Topbar -->
					</header>
					
                    <!-- Start Content-->
                    <div class="container-fluid" style="margin-top:10%;">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="row">
										<div class="col-sm-6">
											<h4 class="page-title">Dashboard</h4>
										</div>
										<div class="col-sm-6">
										<form method="POST" name="periode" onSubmit="return valid();">
											<div class="row gy-2 gx-2">
												<div class="col-sm-4 mt-4">
													<select class="form-control select2" data-toggle="select2" name="komoditas">
														<option value="beras_p">Beras Premium</option>
														<option value="beras_m">Beras Medium</option>
														<option value="gula">Gula Pasir Dalam Negeri</option>
														<option value="bimoli">Minyak Goreng Bimoli</option>
														<option value="minyak_c">Minyak Goreng Curah</option>
														<option value="minyak_k">Minyak Goreng Kemasan Sederhana</option>
														<option value="sapi">Daging Sapi</option>
														<option value="ayam_b">Daging Ayam Broiler</option>
														<option value="ayam_k">Daging Ayam Kampung</option>
														<option value="telur">Telur Ayam Ras</option>
														<option value="susu_b">Susu Kental Manis Merk Bendera</option>
														<option value="susu_i">Susu Kental Manis Merk Indomilk</option>
														<option value="susu_d">Susu Bubuk Dancow Fuel Cream</option>
														<option value="jagung_p">Jagung Pipilan</option>
														<option value="jagung_t">Jagung Tingkat Peternak</option>
														<option value="garam">Garam Beryodium</option>
														<option value="tepung">Tepung Terigu Cap Segitiga Biru</option>
														<option value="kacang_k">Kacang Kedelai Lokal</option>
														<option value="kacang_h">Kacang Hijau</option>
														<option value="kacang_t">Kacang Tanah</option>
														<option value="blueband">Blue Band Margarin</option>
														<option value="mie">Indomie Rasa Ayam Bawang</option>
														<option value="cabe_mb">Cabe Merah Biasa</option>
														<option value="cabe_hb">Cabe Hijau Biasa</option>
														<option value="cabe_rm">Cabe Rawit Merah</option>
														<option value="cabe_rh">Cabe Rawit Hijau</option>
														<option value="wortel">Wortel</option>
														<option value="kol">Kol</option>
														<option value="buncis">Buncis</option>
														<option value="bawang_m">Bawang Merah</option>
														<option value="bawang_p">Bawang Putih Impor</option>
														<option value="ikan_asin">Ikan Asin Teri</option>
														<option value="kentang">Kentang</option>
														<option value="gula_merah">Gula Merah Kelapa</option>
														<option value="kelapa">Kelapa</option>
														<option value="gas">Gas Elpiji 3 Kg</option>
													</select>
												</div>
												<div class="col-sm-3 mt-4">
													<input type="text" class="form-control" name="dari" placeholder="Pilih Tanggal" onfocus="(this.type='date')" required>
												</div>
												<div class="col-sm-3 mt-4">
													<input type="text" class="form-control" name="sampai" placeholder="Pilih Tanggal" onfocus="(this.type='date')" required>
												</div>
												<div class="col-sm-2 mt-4">
													<label class="form-label"></label>
													<button type="submit" class="btn btn-primary" name="cari">Cari</button>
												</div>
											</div>
										</form>
										</div>
									</div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
										<?php 
											if(isset($_POST['cari'])){
												$dari = $_POST['dari'];
												$sampai = $_POST['sampai'];
												$komoditas = $_POST['komoditas'];
												if($komoditas=="beras_p"){
													$bahan="Beras Premium";
												}else if($komoditas=="beras_m"){
													$bahan="Beras Medium";
												}else if($komoditas=="gula"){
													$bahan="Gula Pasir Dalam Negeri";
												}else if($komoditas=="bimoli"){
													$bahan="Minyak Goreng Bimoli";
												}else if($komoditas=="minyak_c"){
													$bahan="Minyak Goreng Curah";
												}else if($komoditas=="minyak_k"){
													$bahan="Minyak Goreng Kemasan";
												}else if($komoditas=="sapi"){
													$bahan="Daging Sapi";
												}else if($komoditas=="ayam_b"){
													$bahan="Daging Ayam Broiler";
												}else if($komoditas=="ayam_k"){
													$bahan="Daging Ayam Kampung";
												}else if($komoditas=="telur"){
													$bahan="Telur Ayam Ras";
												}else if($komoditas=="susu_b"){
													$bahan="Susu Kental Manis Bendera";
												}else if($komoditas=="susu_i"){
													$bahan="Susu Kental Manis Indomilk";
												}else if($komoditas=="susu_d"){
													$bahan="Susu Bubuk Dancow";
												}else if($komoditas=="jagung_p"){
													$bahan="Jagung Pipilan";
												}else if($komoditas=="jagung_t"){
													$bahan="Jagung Tingkat Peternak";
												}else if($komoditas=="garam"){
													$bahan="Garam Beryodium";
												}else if($komoditas=="tepung"){
													$bahan="Tepung Terigu Cap Segitiga Biru";
												}else if($komoditas=="kacang_k"){
													$bahan="Kacang Kedelai Lokal";
												}else if($komoditas=="kacang_h"){
													$bahan="Kacang Hijau";
												}else if($komoditas=="kacang_t"){
													$bahan="Kacang Tanah";
												}else if($komoditas=="blueband"){
													$bahan="Blue Band Margarin";
												}else if($komoditas=="mie"){
													$bahan="Indomie Rasa Ayam Bawang";
												}else if($komoditas=="cabe_mb"){
													$bahan="Cabe Merah Biasa";
												}else if($komoditas=="cabe_hb"){
													$bahan="Cabe Hijau Biasa";
												}else if($komoditas=="cabe_rm"){
													$bahan="Cabe Rawit Merah";
												}else if($komoditas=="cabe_rh"){
													$bahan="Cabe Rawit Hijau";
												}else if($komoditas=="wortel"){
													$bahan="Wortel";
												}else if($komoditas=="kol"){
													$bahan="Kol";
												}else if($komoditas=="buncis"){
													$bahan="Buncis";
												}else if($komoditas=="bawang_m"){
													$bahan="Bawang Merah";
												}else if($komoditas=="bawang_p"){
													$bahan="Bawang Putih Impor";
												}else if($komoditas=="ikan_asin"){
													$bahan="Ikan Asin";
												}else if($komoditas=="kentang"){
													$bahan="Kentang";
												}else if($komoditas=="gula_merah"){
													$bahan="Gula Merah";
												}else if($komoditas=="kelapa"){
													$bahan="Kelapa";
												}else if($komoditas=="gas"){
													$bahan="Gas Elpiji 3 Kg";
												}
											}?>
                                        <div class="chart-content-bg">
                                            <div class="row text-center">
                                                <div class="col-md-6">
                                                    <p class="text-muted mb-0 mt-3">HARGA RATA-RATA</p>
                                                    <p class="text-muted mb-0">(<?php echo Indonesia2Tgl($sampai); ?>)</p>
                                                    <h2 class="fw-normal mb-3">
													<?php 
														if(isset($_POST['cari'])){
															$dari = $_POST['dari'];
															$sampai = $_POST['sampai'];
															$komoditas = $_POST['komoditas'];
															
															$sqldari = "SELECT SUM(".$komoditas.") AS jumlah FROM harga WHERE tgl ='$sampai'";
																$querydari = mysqli_query($koneksidb,$sqldari);
																$resultdari = mysqli_fetch_array($querydari);
																$rata2dari = $resultdari['jumlah']/5; 
													?>
                                                        <small class="mdi mdi-checkbox-blank-circle text-primary align-middle me-1"></small>
                                                        <span><?php echo format_rupiah($rata2dari);?></span>
														<?php }?>
                                                    </h2>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="text-muted mb-0 mt-3">Harga Eceran Tertinggi</p>
                                                    <p class="text-muted mb-0">(HET)</p>
                                                    <h2 class="fw-normal mb-3">
													<?php 
														if(isset($_POST['cari'])){
															$dari = $_POST['dari'];
															$sampai = $_POST['sampai'];
															$komoditas = $_POST['komoditas'];
															
															$sqlhet = "SELECT * FROM het";
																$queryhet = mysqli_query($koneksidb,$sqlhet);
																$het = mysqli_fetch_array($queryhet);
													?>
                                                        <small class="mdi mdi-checkbox-blank-circle text-success align-middle me-1"></small>
                                                        <span><?php echo format_rupiah($het[$komoditas]);?></span>
														<?php }?>
                                                    </h2>
                                                </div>
                                            </div>
                                        </div>

                                        <div dir="ltr">
                                            <div id="revenue-chart" class="apex-charts mt-3" data-colors="#727cf5,#0acf97,#fa5c7c,#ffbc00,#5F9EA0"></div>
                                        </div>
                                        
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->
                        </div>
                        <!-- end row -->
						
						<div class="row">

                            <div class="col-xl-5 col-lg-6">
								<div class="row">
									<div class="col-lg-6">
										<div class="card tilebox-one">
											<div class="card-body">
												<i class='uil uil-users-alt float-end'></i>
												<h6 class="text-uppercase mt-0">Active Users</h6>
												<h2 class="my-2" id="active-users-count">121</h2>
												<p class="mb-0 text-muted">
													<span class="text-success me-2"><span class="mdi mdi-arrow-up-bold"></span> 5.27%</span>
													<span class="text-nowrap">Since last month</span>  
												</p>
											</div> <!-- end card-body-->
										</div>
									</div>
									<!--end card-->

									<div class="col-lg-6">
										<div class="card tilebox-one">
											<div class="card-body">
												<i class='uil uil-window-restore float-end'></i>
												<h6 class="text-uppercase mt-0">Views per minute</h6>
												<h2 class="my-2" id="active-views-count">560</h2>
												<p class="mb-0 text-muted">
													<span class="text-danger me-2"><span class="mdi mdi-arrow-down-bold"></span> 1.08%</span>
													<span class="text-nowrap">Since previous week</span>
												</p>
											</div> <!-- end card-body-->
										</div>
									</div>
									<!--end card-->
									
									<div class="col-lg-6">
										<div class="card tilebox-one">
											<div class="card-body">
												<i class='uil uil-users-alt float-end'></i>
												<h6 class="text-uppercase mt-0">Active Users</h6>
												<h2 class="my-2" id="active-users-count2">121</h2>
												<p class="mb-0 text-muted">
													<span class="text-success me-2"><span class="mdi mdi-arrow-up-bold"></span> 5.27%</span>
													<span class="text-nowrap">Since last month</span>  
												</p>
											</div> <!-- end card-body-->
										</div>
									</div>
									<!--end card-->

									<div class="col-lg-6">
										<div class="card tilebox-one">
											<div class="card-body">
												<i class='uil uil-window-restore float-end'></i>
												<h6 class="text-uppercase mt-0">Views per minute</h6>
												<h2 class="my-2" id="active-views-count2">560</h2>
												<p class="mb-0 text-muted">
													<span class="text-danger me-2"><span class="mdi mdi-arrow-down-bold"></span> 1.08%</span>
													<span class="text-nowrap">Since previous week</span>
												</p>
											</div> <!-- end card-body-->
										</div>
									</div>
									<!--end card-->
								
									<div class="col-lg-12">
										<div class="card">
											<div class="card-body">
												<a href="" class="btn btn-sm btn-link float-end">Export
													<i class="mdi mdi-download ms-1"></i>
												</a>
												<?php 
													if(isset($_POST['cari'])){
														$dari = $_POST['dari'];
														$sampai = $_POST['sampai'];
														$komoditas = $_POST['komoditas'];
														if($komoditas=="beras_p"){
															$bahan="Beras Premium";
														}else if($komoditas=="beras_m"){
															$bahan="Beras Medium";
														}else if($komoditas=="gula"){
															$bahan="Gula Pasir Dalam Negeri";
														}else if($komoditas=="bimoli"){
															$bahan="Minyak Goreng Bimoli";
														}else if($komoditas=="minyak_c"){
															$bahan="Minyak Goreng Curah";
														}else if($komoditas=="minyak_k"){
															$bahan="Minyak Goreng Kemasan";
														}else if($komoditas=="sapi"){
															$bahan="Daging Sapi";
														}else if($komoditas=="ayam_b"){
															$bahan="Daging Ayam Broiler";
														}else if($komoditas=="ayam_k"){
															$bahan="Daging Ayam Kampung";
														}else if($komoditas=="telur"){
															$bahan="Telur Ayam Ras";
														}else if($komoditas=="susu_b"){
															$bahan="Susu Kental Manis Bendera";
														}else if($komoditas=="susu_i"){
															$bahan="Susu Kental Manis Indomilk";
														}else if($komoditas=="susu_d"){
															$bahan="Susu Bubuk Dancow";
														}else if($komoditas=="jagung_p"){
															$bahan="Jagung Pipilan";
														}else if($komoditas=="jagung_t"){
															$bahan="Jagung Tingkat Peternak";
														}else if($komoditas=="garam"){
															$bahan="Garam Beryodium";
														}else if($komoditas=="tepung"){
															$bahan="Tepung Terigu Cap Segitiga Biru";
														}else if($komoditas=="kacang_k"){
															$bahan="Kacang Kedelai Lokal";
														}else if($komoditas=="kacang_h"){
															$bahan="Kacang Hijau";
														}else if($komoditas=="kacang_t"){
															$bahan="Kacang Tanah";
														}else if($komoditas=="blueband"){
															$bahan="Blue Band Margarin";
														}else if($komoditas=="mie"){
															$bahan="Indomie Rasa Ayam Bawang";
														}else if($komoditas=="cabe_mb"){
															$bahan="Cabe Merah Biasa";
														}else if($komoditas=="cabe_hb"){
															$bahan="Cabe Hijau Biasa";
														}else if($komoditas=="cabe_rm"){
															$bahan="Cabe Rawit Merah";
														}else if($komoditas=="cabe_rh"){
															$bahan="Cabe Rawit Hijau";
														}else if($komoditas=="wortel"){
															$bahan="Wortel";
														}else if($komoditas=="kol"){
															$bahan="Kol";
														}else if($komoditas=="buncis"){
															$bahan="Buncis";
														}else if($komoditas=="bawang_m"){
															$bahan="Bawang Merah";
														}else if($komoditas=="bawang_p"){
															$bahan="Bawang Putih Impor";
														}else if($komoditas=="ikan_asin"){
															$bahan="Ikan Asin";
														}else if($komoditas=="kentang"){
															$bahan="Kentang";
														}else if($komoditas=="gula_merah"){
															$bahan="Gula Merah";
														}else if($komoditas=="kelapa"){
															$bahan="Kelapa";
														}else if($komoditas=="gas"){
															$bahan="Gas Elpiji 3 Kg";
														}
												?>
												<h4 class="header-title mt-2">Harga Komoditas <?php echo $bahan; ?> Tertinggi dan Terendah</h4>
												<?php }else{?>
												<h4 class="header-title mt-2">Perbandingan Harga Beras Premium</h4>
												<?php }?>
												<div class="table-responsive">
													<table class="table table-striped table-sm table-nowrap table-centered">
														<thead>
															<tr>
																<th>Indikator</th>
																<th>Harga</th>
																<th>Pasar</th>
																<th>Tanggal</th>
																<th></th>
															</tr>
														</thead>
														<tbody>
															<?php 
																if(isset($_POST['cari'])){
																	$dari = $_POST['dari'];
																	$sampai = $_POST['sampai'];
																	$komoditas = $_POST['komoditas'];
																	
																	$sqltinggi = "SELECT * FROM harga WHERE tgl BETWEEN '$dari' AND '$sampai' ORDER BY ".$komoditas." DESC limit 1";
																		$querytinggi = mysqli_query($koneksidb,$sqltinggi);
																		$resulttinggi = mysqli_fetch_array($querytinggi);
																	
																	$sqlrendah = "SELECT * FROM harga WHERE tgl BETWEEN '$dari' AND '$sampai' ORDER BY ".$komoditas." ASC LIMIT 1";
																		$queryrendah = mysqli_query($koneksidb,$sqlrendah);
																		$resultrendah = mysqli_fetch_array($queryrendah);
																	
																	$sqlrata = "SELECT SUM(".$komoditas.") AS jumlah FROM harga WHERE tgl='$sampai'";
																		$queryrata = mysqli_query($koneksidb,$sqlrata);
																		$resultrata = mysqli_fetch_array($queryrata);
																		$rata2 = $resultrata['jumlah']/5; 
															?>
															<tr>
																<td>
																	<h5 class="font-15 mb-1 fw-normal">Tertinggi</h5>
																</td>
																<td><?php echo format_rupiah($resulttinggi[$komoditas]);?></td>
																<td><?php echo $resulttinggi['pasar'];?></td>
																<td><?php echo Indonesia2Tgl($resulttinggi['tgl']);?></td>
															</tr>
															<tr>
																<td>
																	<h5 class="font-15 mb-1 fw-normal">Terendah</h5>
																</td>
																<td><?php echo format_rupiah($resultrendah[$komoditas]);?></td>
																<td><?php echo $resultrendah['pasar'];?></td>
																<td><?php echo Indonesia2Tgl($resultrendah['tgl']);?></td>
															</tr>
															<?php }else{?>
															<?php 
																$sqltinggi = "SELECT * FROM harga ORDER BY tgl DESC, beras_p DESC limit 1";
																	$querytinggi = mysqli_query($koneksidb,$sqltinggi);
																	$resulttinggi = mysqli_fetch_array($querytinggi);
																
																$sqlrendah = "SELECT * FROM harga ORDER BY tgl DESC, beras_p ASC LIMIT 1";
																	$queryrendah = mysqli_query($koneksidb,$sqlrendah);
																	$resultrendah = mysqli_fetch_array($queryrendah);
																
																$sqlrata = "SELECT tgl,SUM(beras_p) AS jumlah FROM harga ORDER BY tgl DESC";
																	$queryrata = mysqli_query($koneksidb,$sqlrata);
																	$resultrata = mysqli_fetch_array($queryrata);
																	$rata2 = $resultrata['jumlah']/5; 
															?>
															<tr>
																<td>
																	<h5 class="font-15 mb-1 fw-normal">Tertinggi</h5>
																</td>
																<td><?php echo format_rupiah($resulttinggi['beras_p']);?></td>
																<td><?php echo $resulttinggi['pasar'];?></td>
																<td><?php echo Indonesia2Tgl($resulttinggi['tgl']);?></td>
															</tr>
															<tr>
																<td>
																	<h5 class="font-15 mb-1 fw-normal">Terendah</h5>
																</td>
																<td><?php echo format_rupiah($resultrendah['beras_p']);?></td>
																<td><?php echo $resultrendah['pasar'];?></td>
																<td><?php echo Indonesia2Tgl($resultrendah['tgl']);?></td>
															</tr>
															<?php }?>
														</tbody>
													</table>
												</div> <!-- end table-responsive-->
											</div> <!-- end card-body-->
										</div> <!-- end card-->
									</div>
                                </div> <!-- end row-->

                            </div> <!-- end col -->
							
							<div class="col-xl-7 col-lg-6">

                                <div class="row">
									<div class="card">
										<div class="card-body">
											<div dir="ltr">
												<div id="basic-bar" class="apex-charts" data-colors="#39afd1"></div>
											</div>
										</div>
										<!-- end card body-->
									</div>
									<!-- end card -->
                                </div> <!-- end row -->

                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div>
                    <!-- container -->

                </div>
                <!-- content -->

                <!-- Footer Start -->
                <?php include ('includes/footer.php'); ?>
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

        <?php include ('includes/script.php'); ?>
	<script>
	function number_format(number, decimals, dec_point, thousands_sep) {
	  // *     example: number_format(1234.56, 2, ',', ' ');
	  // *     return: '1 234,56'
	  number = (number + '').replace('.', '').replace(' ', '');
	  var n = !isFinite(+number) ? 0 : +number,
		prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
		sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
		dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
		s = '',
		toFixedFix = function(n, prec) {
		  var k = Math.pow(10, prec);
		  return '' + Math.round(n * k) / k;
		};
	  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
	  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
	  if (s[0].length > 3) {
		s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
	  }
	  if ((s[1] || '').length < prec) {
		s[1] = s[1] || '';
		s[1] += new Array(prec - s[1].length + 1).join('0');
	  }
	  return s.join(dec);
	}
	!function(o){"use strict";
		function e(){
			this.$body=o("body"),
			this.charts=[]
				}
			e.prototype.initCharts=function(){
				window.Apex={
					chart:{
						parentHeightOffset:0
						},
					grid:{
						padding:{
							left:0,
							right:0
							}
						},
					colors:["#727cf5","#0acf97","#fa5c7c","#ffbc00","#5F9EA0"]
				};
			var e=["#727cf5","#0acf97","#fa5c7c","#ffbc00","#5F9EA0"],
				t=o("#revenue-chart").data("colors");
				t&&(e=t.split(","));
			var r={
				chart:{
					height:364,
					type:"line",
					dropShadow:{
						enabled:!0,
						opacity:.2,
						blur:7,
						left:-7,
						top:7
						}
					},
				dataLabels:{
					enabled:!1
					},
				title: {
				  text: 'Laju Pertumbuhan Harga Komoditas <?php echo $bahan; ?> Pasar Kabupaten Tasikmalaya (<?php echo Indonesia2Tgl($dari); ?> - <?php echo Indonesia2Tgl($sampai); ?>)',
				  align: 'center',
				},
				markers: {
					size: 4,
					},
				stroke:{
					curve:"smooth",
					width:4
					},
				series:[{
					<?php 
						if(isset($_POST['cari'])){
							$dari = $_POST['dari'];
							$sampai = $_POST['sampai'];
							$komoditas = $_POST['komoditas'];
							
							$sqlsingaparna = "SELECT * FROM harga WHERE tgl BETWEEN '$dari' AND '$sampai' AND pasar='Singaparna'";
						}else{
							$sqlsingaparna = "SELECT * FROM harga WHERE pasar='Singaparna' ORDER BY tgl ASC LIMIT 5";
						}
							$querysingaparna = mysqli_query($koneksidb,$sqlsingaparna);
					?>
					name:"Pasar Singaparna",
					data:[<?php while($singaparna = mysqli_fetch_array($querysingaparna)){ echo '"' . $singaparna[$komoditas] . '",';}?>]
					},{
					<?php 
						if(isset($_POST['cari'])){
							$dari = $_POST['dari'];
							$sampai = $_POST['sampai'];
							$komoditas = $_POST['komoditas'];
							
							$sqlciawi = "SELECT * FROM harga WHERE tgl BETWEEN '$dari' AND '$sampai' AND pasar='Ciawi'";
						}else{
							$sqlciawi = "SELECT * FROM harga WHERE pasar='Ciawi' ORDER BY tgl ASC LIMIT 5";
						}
							$queryciawi = mysqli_query($koneksidb,$sqlciawi);
					?>
					name:"Pasar Ciawi",
					data:[<?php while($ciawi = mysqli_fetch_array($queryciawi)){ echo '"' . $ciawi[$komoditas] . '",';}?>]
					},{
					<?php 
						if(isset($_POST['cari'])){
							$dari = $_POST['dari'];
							$sampai = $_POST['sampai'];
							$komoditas = $_POST['komoditas'];
							
							$sqlmanonjaya = "SELECT * FROM harga WHERE tgl BETWEEN '$dari' AND '$sampai' AND pasar='Manonjaya'";
						}else{
							$sqlmanonjaya = "SELECT * FROM harga WHERE pasar='Manonjaya' ORDER BY tgl ASC LIMIT 5";
						}
							$querymanonjaya = mysqli_query($koneksidb,$sqlmanonjaya);
					?>
					name:"Pasar Manonjaya",
					data:[<?php while($manonjaya = mysqli_fetch_array($querymanonjaya)){ echo '"' . $manonjaya[$komoditas] . '",';}?>]
					},{
					<?php 
						if(isset($_POST['cari'])){
							$dari = $_POST['dari'];
							$sampai = $_POST['sampai'];
							$komoditas = $_POST['komoditas'];
							
							$sqltaraju = "SELECT * FROM harga WHERE tgl BETWEEN '$dari' AND '$sampai' AND pasar='Taraju'";
						}else{
							$sqltaraju = "SELECT * FROM harga WHERE pasar='Taraju' ORDER BY tgl ASC LIMIT 5";
						}
							$querytaraju = mysqli_query($koneksidb,$sqltaraju);
					?>
					name:"Pasar Taraju",
					data:[<?php while($taraju = mysqli_fetch_array($querytaraju)){ echo '"' . $taraju[$komoditas] . '",';}?>]
					},{
					<?php 
						if(isset($_POST['cari'])){
							$dari = $_POST['dari'];
							$sampai = $_POST['sampai'];
							$komoditas = $_POST['komoditas'];
							
							$sqlcikatomas = "SELECT * FROM harga WHERE tgl BETWEEN '$dari' AND '$sampai' AND pasar='Cikatomas'";
						}else{
							$sqlcikatomas = "SELECT * FROM harga WHERE pasar='Cikatomas' ORDER BY tgl ASC LIMIT 5";
						}
							$querycikatomas = mysqli_query($koneksidb,$sqlcikatomas);
					?>
					name:"Pasar Cikatomas",
					data:[<?php while($cikatomas = mysqli_fetch_array($querycikatomas)){ echo '"' . $cikatomas[$komoditas] . '",';}?>]
					}],
				colors:e,
				zoom:{
					enabled:!1
					},
				legend:{
					display:true
					},
				xaxis:{
					type:"string",
					<?php 
						if(isset($_POST['cari'])){
							$dari = $_POST['dari'];
							$sampai = $_POST['sampai'];
							
							$sqltgl = "SELECT * FROM harga WHERE tgl BETWEEN '$dari' AND '$sampai' GROUP BY tgl ASC";
						}else{
							$sqltgl = "SELECT * FROM harga GROUP BY tgl ASC LIMIT 5";
						}
								$querytgl = mysqli_query($koneksidb,$sqltgl);
					?>
					categories:[<?php while($tgl = mysqli_fetch_array($querytgl)){ echo '"' . Indonesia2Tgl($tgl['tgl']) . '",';}?>],
					tooltip:{
						enabled:!1
						},
					axisBorder:{
						show:!1
						}
					},
				yaxis:{
					labels:{
						formatter:function(e){return "Rp."+number_format(e)},
						offsetX:-15
						}
					}
				};
			new ApexCharts(document.querySelector("#revenue-chart"),r).render();
			},
				e.prototype.init=function(){
					o("#dash-daterange").daterangepicker({
						singleDatePicker:!0
						}),
						this.initCharts(),
						this.initMaps()
					},
					o.Dashboard=new e,
					o.Dashboard.Constructor=e
		}(window.jQuery),
	function(t){"use strict";
		t(document).ready(function(e){
			t.Dashboard.init()
			})
		}(window.jQuery);
	</script>

	<script type="text/javascript">
	colors=["#39afd1"];
	(dataColors=$("#basic-bar").data("colors"))&&(colors=dataColors.split(","));
	options={
		chart:{
			height:550,
			type:"bar"
			},
		plotOptions:{
			bar:{
				horizontal:!0
				}
			},
		title: {
		  text: 'HARGA RATA-RATA KOMODITAS HARI INI (<?php echo Indonesia2Tgl(date('Y-m-d')); ?>)',
		  align: 'center',
		},
		dataLabels:{
			enabled:!0,
			style:{
				fontSize:"8px",
				colors:["#fff"]
				}
			},
		series:[{
			name:["Rata-rata"],
			<?php 
				$tgl = date("Y-m-d");
				$sqlberas_p = "SELECT SUM(beras_p) AS jumlah FROM harga WHERE tgl ='$tgl'";
				$queryberas_p = mysqli_query($koneksidb,$sqlberas_p);
					$resultberas_p = mysqli_fetch_array($queryberas_p);
					$beras_p = $resultberas_p['jumlah']/5; 
				
				$sqlberas_m = "SELECT SUM(beras_m) AS jumlah FROM harga WHERE tgl ='$tgl'";
				$queryberas_m = mysqli_query($koneksidb,$sqlberas_m);
					$resultberas_m = mysqli_fetch_array($queryberas_m);
					$beras_m = $resultberas_m['jumlah']/5; 
				
				$sqlgula = "SELECT SUM(gula) AS jumlah FROM harga WHERE tgl ='$tgl'";
				$querygula = mysqli_query($koneksidb,$sqlgula);
					$resultgula = mysqli_fetch_array($querygula);
					$gula = $resultgula['jumlah']/5; 
				
				$sqlbimoli = "SELECT SUM(bimoli) AS jumlah FROM harga WHERE tgl ='$tgl'";
				$querybimoli = mysqli_query($koneksidb,$sqlbimoli);
					$resultbimoli = mysqli_fetch_array($querybimoli);
					$bimoli = $resultbimoli['jumlah']/5; 
				
				$sqlminyak_c = "SELECT SUM(minyak_c) AS jumlah FROM harga WHERE tgl ='$tgl'";
				$queryminyak_c = mysqli_query($koneksidb,$sqlminyak_c);
					$resultminyak_c = mysqli_fetch_array($queryminyak_c);
					$minyak_c = $resultminyak_c['jumlah']/5; 
				
				$sqlminyak_k = "SELECT SUM(minyak_k) AS jumlah FROM harga WHERE tgl ='$tgl'";
				$queryminyak_k = mysqli_query($koneksidb,$sqlminyak_k);
					$resultminyak_k = mysqli_fetch_array($queryminyak_k);
					$minyak_k = $resultminyak_k['jumlah']/5; 
				
				$sqlsapi = "SELECT SUM(sapi) AS jumlah FROM harga WHERE tgl ='$tgl'";
				$querysapi = mysqli_query($koneksidb,$sqlsapi);
					$resultsapi = mysqli_fetch_array($querysapi);
					$sapi = $resultsapi['jumlah']/5; 
				
				$sqlayam_b = "SELECT SUM(ayam_b) AS jumlah FROM harga WHERE tgl ='$tgl'";
				$queryayam_b = mysqli_query($koneksidb,$sqlayam_b);
					$resultayam_b = mysqli_fetch_array($queryayam_b);
					$ayam_b = $resultayam_b['jumlah']/5; 
				
				$sqlayam_k = "SELECT SUM(ayam_k) AS jumlah FROM harga WHERE tgl ='$tgl'";
				$queryayam_k = mysqli_query($koneksidb,$sqlayam_k);
					$resultayam_k = mysqli_fetch_array($queryayam_k);
					$ayam_k = $resultayam_k['jumlah']/5; 
				
				$sqltelur = "SELECT SUM(telur) AS jumlah FROM harga WHERE tgl ='$tgl'";
				$querytelur = mysqli_query($koneksidb,$sqltelur);
					$resulttelur = mysqli_fetch_array($querytelur);
					$telur = $resulttelur['jumlah']/5; 
				
				$sqlsusu_b = "SELECT SUM(susu_b) AS jumlah FROM harga WHERE tgl ='$tgl'";
				$querysusu_b = mysqli_query($koneksidb,$sqlsusu_b);
					$resultsusu_b = mysqli_fetch_array($querysusu_b);
					$susu_b = $resultsusu_b['jumlah']/5; 
				
				$sqlsusu_i = "SELECT SUM(susu_i) AS jumlah FROM harga WHERE tgl ='$tgl'";
				$querysusu_i = mysqli_query($koneksidb,$sqlsusu_i);
					$resultsusu_i = mysqli_fetch_array($querysusu_i);
					$susu_i = $resultsusu_i['jumlah']/5; 
				
				$sqlsusu_d = "SELECT SUM(susu_d) AS jumlah FROM harga WHERE tgl ='$tgl'";
				$querysusu_d = mysqli_query($koneksidb,$sqlsusu_d);
					$resultsusu_d = mysqli_fetch_array($querysusu_d);
					$susu_d = $resultsusu_d['jumlah']/5; 
				
				$sqljagung_p = "SELECT SUM(jagung_p) AS jumlah FROM harga WHERE tgl ='$tgl'";
				$queryjagung_p = mysqli_query($koneksidb,$sqljagung_p);
					$resultjagung_p = mysqli_fetch_array($queryjagung_p);
					$jagung_p = $resultjagung_p['jumlah']/5; 
				
				$sqljagung_t = "SELECT SUM(jagung_t) AS jumlah FROM harga WHERE tgl ='$tgl'";
				$queryjagung_t = mysqli_query($koneksidb,$sqljagung_t);
					$resultjagung_t = mysqli_fetch_array($queryjagung_t);
					$jagung_t = $resultjagung_t['jumlah']/5; 
				
				$sqlgaram = "SELECT SUM(garam) AS jumlah FROM harga WHERE tgl ='$tgl'";
				$querygaram = mysqli_query($koneksidb,$sqlgaram);
					$resultgaram = mysqli_fetch_array($querygaram);
					$garam = $resultgaram['jumlah']/5; 
				
				$sqltepung = "SELECT SUM(tepung) AS jumlah FROM harga WHERE tgl ='$tgl'";
				$querytepung = mysqli_query($koneksidb,$sqltepung);
					$resulttepung = mysqli_fetch_array($querytepung);
					$tepung = $resulttepung['jumlah']/5; 
				
				$sqlkacang_k = "SELECT SUM(kacang_k) AS jumlah FROM harga WHERE tgl ='$tgl'";
				$querykacang_k = mysqli_query($koneksidb,$sqlkacang_k);
					$resultkacang_k = mysqli_fetch_array($querykacang_k);
					$kacang_k = $resultkacang_k['jumlah']/5; 
				
				$sqlkacang_h = "SELECT SUM(kacang_h) AS jumlah FROM harga WHERE tgl ='$tgl'";
				$querykacang_h = mysqli_query($koneksidb,$sqlkacang_h);
					$resultkacang_h = mysqli_fetch_array($querykacang_h);
					$kacang_h = $resultkacang_h['jumlah']/5; 
				
				$sqlkacang_t = "SELECT SUM(kacang_t) AS jumlah FROM harga WHERE tgl ='$tgl'";
				$querykacang_t = mysqli_query($koneksidb,$sqlkacang_t);
					$resultkacang_t = mysqli_fetch_array($querykacang_t);
					$kacang_t = $resultkacang_t['jumlah']/5; 
				
				$sqlblueband = "SELECT SUM(blueband) AS jumlah FROM harga WHERE tgl ='$tgl'";
				$queryblueband = mysqli_query($koneksidb,$sqlblueband);
					$resultblueband = mysqli_fetch_array($queryblueband);
					$blueband = $resultblueband['jumlah']/5; 
				
				$sqlmie = "SELECT SUM(mie) AS jumlah FROM harga WHERE tgl ='$tgl'";
				$querymie = mysqli_query($koneksidb,$sqlmie);
					$resultmie = mysqli_fetch_array($querymie);
					$mie = $resultmie['jumlah']/5; 
				
				$sqlcabe_mb = "SELECT SUM(cabe_mb) AS jumlah FROM harga WHERE tgl ='$tgl'";
				$querycabe_mb = mysqli_query($koneksidb,$sqlcabe_mb);
					$resultcabe_mb = mysqli_fetch_array($querycabe_mb);
					$cabe_mb = $resultcabe_mb['jumlah']/5; 
				
				$sqlcabe_hb = "SELECT SUM(cabe_hb) AS jumlah FROM harga WHERE tgl ='$tgl'";
				$querycabe_hb = mysqli_query($koneksidb,$sqlcabe_hb);
					$resultcabe_hb = mysqli_fetch_array($querycabe_hb);
					$cabe_hb = $resultcabe_hb['jumlah']/5; 
				
				$sqlcabe_rm = "SELECT SUM(cabe_rm) AS jumlah FROM harga WHERE tgl ='$tgl'";
				$querycabe_rm = mysqli_query($koneksidb,$sqlcabe_rm);
					$resultcabe_rm = mysqli_fetch_array($querycabe_rm);
					$cabe_rm = $resultcabe_rm['jumlah']/5; 
				
				$sqlcabe_rh = "SELECT SUM(cabe_rh) AS jumlah FROM harga WHERE tgl ='$tgl'";
				$querycabe_rh = mysqli_query($koneksidb,$sqlcabe_rh);
					$resultcabe_rh = mysqli_fetch_array($querycabe_rh);
					$cabe_rh = $resultcabe_rh['jumlah']/5; 
				
				$sqlwortel = "SELECT SUM(wortel) AS jumlah FROM harga WHERE tgl ='$tgl'";
				$querywortel = mysqli_query($koneksidb,$sqlwortel);
					$resultwortel = mysqli_fetch_array($querywortel);
					$wortel = $resultwortel['jumlah']/5; 
				
				$sqlkol = "SELECT SUM(kol) AS jumlah FROM harga WHERE tgl ='$tgl'";
				$querykol = mysqli_query($koneksidb,$sqlkol);
					$resultkol = mysqli_fetch_array($querykol);
					$kol = $resultkol['jumlah']/5; 
				
				$sqlbuncis = "SELECT SUM(buncis) AS jumlah FROM harga WHERE tgl ='$tgl'";
				$querybuncis = mysqli_query($koneksidb,$sqlbuncis);
					$resultbuncis = mysqli_fetch_array($querybuncis);
					$buncis = $resultbuncis['jumlah']/5; 
				
				$sqlbawang_m = "SELECT SUM(bawang_m) AS jumlah FROM harga WHERE tgl ='$tgl'";
				$querybawang_m = mysqli_query($koneksidb,$sqlbawang_m);
					$resultbawang_m = mysqli_fetch_array($querybawang_m);
					$bawang_m = $resultbawang_m['jumlah']/5; 
				
				$sqlbawang_p = "SELECT SUM(bawang_p) AS jumlah FROM harga WHERE tgl ='$tgl'";
				$querybawang_p = mysqli_query($koneksidb,$sqlbawang_p);
					$resultbawang_p = mysqli_fetch_array($querybawang_p);
					$bawang_p = $resultbawang_p['jumlah']/5; 
				
				$sqlikan_asin = "SELECT SUM(ikan_asin) AS jumlah FROM harga WHERE tgl ='$tgl'";
				$queryikan_asin = mysqli_query($koneksidb,$sqlikan_asin);
					$resultikan_asin = mysqli_fetch_array($queryikan_asin);
					$ikan_asin = $resultikan_asin['jumlah']/5; 
				
				$sqlkentang = "SELECT SUM(kentang) AS jumlah FROM harga WHERE tgl ='$tgl'";
				$querykentang = mysqli_query($koneksidb,$sqlkentang);
					$resultkentang = mysqli_fetch_array($querykentang);
					$kentang = $resultkentang['jumlah']/5; 
				
				$sqlgula_merah = "SELECT SUM(gula_merah) AS jumlah FROM harga WHERE tgl ='$tgl'";
				$querygula_merah = mysqli_query($koneksidb,$sqlgula_merah);
					$resultgula_merah = mysqli_fetch_array($querygula_merah);
					$gula_merah = $resultgula_merah['jumlah']/5; 
				
				$sqlkelapa = "SELECT SUM(kelapa) AS jumlah FROM harga WHERE tgl ='$tgl'";
				$querykelapa = mysqli_query($koneksidb,$sqlkelapa);
					$resultkelapa = mysqli_fetch_array($querykelapa);
					$kelapa = $resultkelapa['jumlah']/5; 
				
				$sqlgas = "SELECT SUM(gas) AS jumlah FROM harga WHERE tgl ='$tgl'";
				$querygas = mysqli_query($koneksidb,$sqlgas);
					$resultgas = mysqli_fetch_array($querygas);
					$gas = $resultgas['jumlah']/5; 
			?>
			data:[<?php echo $beras_p;?>,<?php echo $beras_m;?>,<?php echo $gula;?>,
				  <?php echo $bimoli;?>,<?php echo $minyak_c;?>,<?php echo $minyak_k;?>,
				  <?php echo $sapi;?>,<?php echo $ayam_b;?>,<?php echo $ayam_k;?>,
				  <?php echo $telur;?>,<?php echo $susu_b;?>,<?php echo $susu_i;?>,
				  <?php echo $susu_d;?>,<?php echo $jagung_p;?>,<?php echo $jagung_t;?>,
				  <?php echo $garam;?>,<?php echo $tepung;?>,<?php echo $kacang_k;?>,
				  <?php echo $kacang_h;?>,<?php echo $kacang_t;?>,<?php echo $blueband;?>,
				  <?php echo $mie;?>,<?php echo $cabe_mb;?>,<?php echo $cabe_hb;?>,
				  <?php echo $cabe_rm;?>,<?php echo $cabe_rh;?>,<?php echo $wortel;?>,
				  <?php echo $kol;?>,<?php echo $buncis;?>,<?php echo $bawang_m;?>,
				  <?php echo $bawang_p;?>,<?php echo $ikan_asin;?>,<?php echo $kentang;?>,
				  <?php echo $gula_merah;?>,<?php echo $kelapa;?>,<?php echo $gas;?>]
			}],
		colors:colors,
		xaxis:{
			categories:["Beras Premium","Beras Medium","Gula Pasir","Minyak Bimoli","Minyak Curah","Minyak Kemasan","Daging Sapi",
						"Daging Ayam Broiler","Daging Ayam Kampung","Telur Ayam Ras","Susu Bendera","Susu Indomilk","Susu Dancow",
						"Jagung Pipilan","Jagung Tingkat Peternak","Garam Beryodium","Tepung","Kacang Kedelai Lokal","Kacang Hijau",
						"Kacang Tanah","Blueband Margarin","Indomie Ayam Bawang","Cabe Merah Biasa","Cabe Hijau Biasa","Cabe Rawit Merah",
						"Cabe Rawit Hijau","Wortel","Kol","Buncis","Bawang Merah","Bawang Putih Impor","Ikan Asin Teri","Kentang",
						"Gula Merah Kelapa","Kelapa","Gas Elpiji"]
			},
		states:{
			hover:{
				filter:"none"
				}
			},
		grid:{
			borderColor:"#f1f3fa"
			}
		};
	var chart = new ApexCharts(document.querySelector("#basic-bar"), options);
        chart.render();
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
					window.location = 'dashboard.php';
			});
				return false;
			}

		return true;
		}
	</script>
    </body>
</html>
<?php }?>