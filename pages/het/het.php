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
                                        <h4 class="header-title text-center">Pantauan Harga Eceran Tertinggi (HET)</h4>
                                        <h4 class="header-title text-center">Per-Komoditas</h4>
                                        <h4 class="header-title text-center">Kabupaten Tasikmalaya</h4>
										
                                        <ul class="nav nav-tabs nav-bordered mb-3">
                                            <li class="nav-item">
                                                <a href="#data-het" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                                                    Data Harga Eceran Tertinggi (HET)
                                                </a>
                                            </li>
                                        </ul> <!-- end nav-->
                                        
										<div class="tab-content">
											<div class="tab-pane show active" id="data-het">
                                                <div class="row mb-2">
													<div class="col-sm-6">
														<a href="javascript:void(0);" class="btn btn-danger mb-2 mt-2"><i class="mdi mdi-plus-circle me-2"></i> PDF</a>&nbsp;&nbsp;
														<button type="submit" onclick="window.open('het-excel.php')" class="btn btn-success mb-2 mt-2"><i class="mdi mdi-microsoft-excel"></i> Excel</button>&nbsp;&nbsp;
														<a href="#modal-lg-edit" class="btn btn-warning mb-2 mt-2 text-white" data-bs-toggle="modal"><i class="mdi mdi-pencil-circle text-white me-2"></i> Edit</a>
													</div>
												</div>
												<div class="table-responsive">
												<table id="scroll-horizontal-datatable2" class="table table-striped table-bordered table-hover nowrap w-100">
													<thead>
                                                        <tr>
                                                            <th class="text-center" width="30">No</th>
                                                            <th class="text-center">Nama Bahan Pokok</th>
                                                            <th class="text-center">Satuan</th>
                                                            <th class="text-center">Harga HET (Rp)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
														<?php 
															$sqlkat = "SELECT * FROM het WHERE id_het='42fdd66d9a7ba8e267e844c9578c69883fd3a0loe'";
															$querykat = mysqli_query($koneksidb,$sqlkat);
															$result = mysqli_fetch_array($querykat);															
																?>
                                                        <tr><?php $nomor = 1; ?>
                                                            <td align="center"><?php echo $nomor++;?></td>
															<td>Beras Premium</td>
                                                            <td class="text-center">Kg</td>
															<td class="text-center"><?php echo htmlentities(format_angka($result['beras_p']));?></td>
                                                        </tr>
														<tr>
                                                            <td align="center"><?php echo $nomor++;?></td>
															<td>Beras Medium</td>
                                                            <td class="text-center">Kg</td>
															<td class="text-center"><?php echo htmlentities(format_angka($result['beras_m']));?></td>
                                                        </tr>
														<tr>
                                                            <td align="center"><?php echo $nomor++;?></td>
															<td>Gula Pasir Dalam Negeri</td>
                                                            <td class="text-center">Kg</td>
															<td class="text-center"><?php echo htmlentities(format_angka($result['gula']));?></td>
                                                        </tr>
														<tr>
                                                            <td align="center"><?php echo $nomor++;?></td>
															<td>Minyak Goreng Bimoli Kemasan</td>
                                                            <td class="text-center">Liter</td>
															<td class="text-center"><?php echo htmlentities(format_angka($result['bimoli']));?></td>
                                                        </tr>
														<tr>
                                                            <td align="center"><?php echo $nomor++;?></td>
															<td>Minyak Goreng Curah</td>
                                                            <td class="text-center">Liter</td>
															<td class="text-center"><?php echo htmlentities(format_angka($result['minyak_c']));?></td>
                                                        </tr>
														<tr>
                                                            <td align="center"><?php echo $nomor++;?></td>
															<td>Minyak Goreng Kemasan Sederhana</td>
                                                            <td class="text-center">Liter</td>
															<td class="text-center"><?php echo htmlentities(format_angka($result['minyak_k']));?></td>
                                                        </tr>
														<tr>
                                                            <td align="center"><?php echo $nomor++;?></td>
															<td>Daging Sapi</td>
                                                            <td class="text-center">Kg</td>
															<td class="text-center"><?php echo htmlentities(format_angka($result['sapi']));?></td>
                                                        </tr>
														<tr>
                                                            <td align="center"><?php echo $nomor++;?></td>
															<td>Daging Ayam Broiler</td>
                                                            <td class="text-center">Kg</td>
															<td class="text-center"><?php echo htmlentities(format_angka($result['ayam_b']));?></td>
                                                        </tr>
														<tr>
                                                            <td align="center"><?php echo $nomor++;?></td>
															<td>Daging Ayam Kampung</td>
                                                            <td class="text-center">Kg</td>
															<td class="text-center"><?php echo htmlentities(format_angka($result['ayam_k']));?></td>
                                                        </tr>
														<tr>
                                                            <td align="center"><?php echo $nomor++;?></td>
															<td>Telur Ayam Ras</td>
                                                            <td class="text-center">Kg</td>
															<td class="text-center"><?php echo htmlentities(format_angka($result['telur']));?></td>
                                                        </tr>
														<tr>
                                                            <td align="center"><?php echo $nomor++;?></td>
															<td>Susu Kental Manis Merk Bendera</td>
                                                            <td class="text-center">Kaleng</td>
															<td class="text-center"><?php echo htmlentities(format_angka($result['susu_b']));?></td>
                                                        </tr>
														<tr>
                                                            <td align="center"><?php echo $nomor++;?></td>
															<td>Susu Kental Manis Merk Indomilk</td>
                                                            <td class="text-center">Kaleng</td>
															<td class="text-center"><?php echo htmlentities(format_angka($result['susu_i']));?></td>
                                                        </tr>
														<tr>
                                                            <td align="center"><?php echo $nomor++;?></td>
															<td>Susu Bubuk Dancow</td>
                                                            <td class="text-center">200 Gr</td>
															<td class="text-center"><?php echo htmlentities(format_angka($result['susu_d']));?></td>
                                                        </tr>
														<tr>
                                                            <td align="center"><?php echo $nomor++;?></td>
															<td>Jagung Pipilan</td>
                                                            <td class="text-center">Kg</td>
															<td class="text-center"><?php echo htmlentities(format_angka($result['jagung_p']));?></td>
                                                        </tr>
														<tr>
                                                            <td align="center"><?php echo $nomor++;?></td>
															<td>Jagung Tingkat Peternak</td>
                                                            <td class="text-center">Kg</td>
															<td class="text-center"><?php echo htmlentities(format_angka($result['jagung_t']));?></td>
                                                        </tr>
														<tr>
                                                            <td align="center"><?php echo $nomor++;?></td>
															<td>Garam Beryodium</td>
                                                            <td class="text-center">250 Gr</td>
															<td class="text-center"><?php echo htmlentities(format_angka($result['garam']));?></td>
                                                        </tr>
														<tr>
                                                            <td align="center"><?php echo $nomor++;?></td>
															<td>Tepung Terigu Cap Segitiga Biru</td>
                                                            <td class="text-center">Kg</td>
															<td class="text-center"><?php echo htmlentities(format_angka($result['tepung']));?></td>
                                                        </tr>
														<tr>
                                                            <td align="center"><?php echo $nomor++;?></td>
															<td>Kacang Kedelai Lokal</td>
                                                            <td class="text-center">Kg</td>
															<td class="text-center"><?php echo htmlentities(format_angka($result['kacang_k']));?></td>
                                                        </tr>
														<tr>
                                                            <td align="center"><?php echo $nomor++;?></td>
															<td>Kacang Hijau</td>
                                                            <td class="text-center">Kg</td>
															<td class="text-center"><?php echo htmlentities(format_angka($result['kacang_h']));?></td>
                                                        </tr>
														<tr>
                                                            <td align="center"><?php echo $nomor++;?></td>
															<td>Kacang Tanah</td>
                                                            <td class="text-center">Kg</td>
															<td class="text-center"><?php echo htmlentities(format_angka($result['kacang_t']));?></td>
                                                        </tr>
														<tr>
                                                            <td align="center"><?php echo $nomor++;?></td>
															<td>Blue Band Margarin</td>
                                                            <td class="text-center">Kg</td>
															<td class="text-center"><?php echo htmlentities(format_angka($result['blueband']));?></td>
                                                        </tr>
														<tr>
                                                            <td align="center"><?php echo $nomor++;?></td>
															<td>Indomie Rasa Ayam Bawang</td>
                                                            <td class="text-center">Dus</td>
															<td class="text-center"><?php echo htmlentities(format_angka($result['mie']));?></td>
                                                        </tr>
														<tr>
                                                            <td align="center"><?php echo $nomor++;?></td>
															<td>Cabe Merah Biasa</td>
                                                            <td class="text-center">Kg</td>
															<td class="text-center"><?php echo htmlentities(format_angka($result['cabe_mb']));?></td>
                                                        </tr>
														<tr>
                                                            <td align="center"><?php echo $nomor++;?></td>
															<td>Cabe Hijau Biasa</td>
                                                            <td class="text-center">Kg</td>
															<td class="text-center"><?php echo htmlentities(format_angka($result['cabe_hb']));?></td>
                                                        </tr>
														<tr>
                                                            <td align="center"><?php echo $nomor++;?></td>
															<td>Cabe Rawit Merah</td>
                                                            <td class="text-center">Kg</td>
															<td class="text-center"><?php echo htmlentities(format_angka($result['cabe_rm']));?></td>
                                                        </tr>
														<tr>
                                                            <td align="center"><?php echo $nomor++;?></td>
															<td>Cabe Rawit Hijau</td>
                                                            <td class="text-center">Kg</td>
															<td class="text-center"><?php echo htmlentities(format_angka($result['cabe_rh']));?></td>
                                                        </tr>
														<tr>
                                                            <td align="center"><?php echo $nomor++;?></td>
															<td>Wortel</td>
                                                            <td class="text-center">Kg</td>
															<td class="text-center"><?php echo htmlentities(format_angka($result['wortel']));?></td>
                                                        </tr>
														<tr>
                                                            <td align="center"><?php echo $nomor++;?></td>
															<td>Kol</td>
                                                            <td class="text-center">Kg</td>
															<td class="text-center"><?php echo htmlentities(format_angka($result['kol']));?></td>
                                                        </tr>
														<tr>
                                                            <td align="center"><?php echo $nomor++;?></td>
															<td>Buncis</td>
                                                            <td class="text-center">Kg</td>
															<td class="text-center"><?php echo htmlentities(format_angka($result['buncis']));?></td>
                                                        </tr>
														<tr>
                                                            <td align="center"><?php echo $nomor++;?></td>
															<td>Bawang Merah</td>
                                                            <td class="text-center">Kg</td>
															<td class="text-center"><?php echo htmlentities(format_angka($result['bawang_m']));?></td>
                                                        </tr>
														<tr>
                                                            <td align="center"><?php echo $nomor++;?></td>
															<td>Bawang Putih Impor</td>
                                                            <td class="text-center">Kg</td>
															<td class="text-center"><?php echo htmlentities(format_angka($result['bawang_p']));?></td>
                                                        </tr>
														<tr>
                                                            <td align="center"><?php echo $nomor++;?></td>
															<td>Ikan Asin Teri</td>
                                                            <td class="text-center">Kg</td>
															<td class="text-center"><?php echo htmlentities(format_angka($result['ikan_asin']));?></td>
                                                        </tr>
														<tr>
                                                            <td align="center"><?php echo $nomor++;?></td>
															<td>Kentang</td>
                                                            <td class="text-center">Kg</td>
															<td class="text-center"><?php echo htmlentities(format_angka($result['kentang']));?></td>
                                                        </tr>
														<tr>
                                                            <td align="center"><?php echo $nomor++;?></td>
															<td>Gula Merah Kelapa</td>
                                                            <td class="text-center">Kg</td>
															<td class="text-center"><?php echo htmlentities(format_angka($result['gula_merah']));?></td>
                                                        </tr>
														<tr>
                                                            <td align="center"><?php echo $nomor++;?></td>
															<td>Kelapa</td>
                                                            <td class="text-center">Butir</td>
															<td class="text-center"><?php echo htmlentities(format_angka($result['kelapa']));?></td>
                                                        </tr>
														<tr>
                                                            <td align="center"><?php echo $nomor++;?></td>
															<td>Gas Elpiji 3 Kg</td>
                                                            <td class="text-center">Tabung</td>
															<td class="text-center"><?php echo htmlentities(format_angka($result['gas']));?></td>
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
		<?php include ('het-edit.php'); ?>
		<!-- #END# Form Edit -->
	
        <?php include ('../includes/script.php'); ?>
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