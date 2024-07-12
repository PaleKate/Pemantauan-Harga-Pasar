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
										<?php
											$id=$_SESSION['login_saharga'];
											$sql ="SELECT * FROM administrator WHERE level='$id'";
												$query = mysqli_query($koneksidb,$sql);
												$results = mysqli_fetch_array($query);
										?>
										 <h4 class="header-title text-center">Profil Akun <?php echo $results['username'];?></h4>
										
                                        <ul class="nav nav-tabs nav-bordered mb-3">
                                            <li class="nav-item">
                                                <a href="#akun" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                                                    Data Akun
                                                </a>
                                            </li>
											<li class="nav-item">
                                                <a href="#password" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                                                    Update Password
                                                </a>
                                            </li>
                                        </ul> <!-- end nav-->
                                        
										<div class="tab-content">
											<div class="tab-pane show active" id="akun">
												<form class="form-horizontal" method="POST">
													<div class="row g-2">
														<div class="mb-3 col-md-6">
															<label class="form-label">Username</label>
																<div class="input-group flex-nowrap">
																	<span class="input-group-text" id="basic-addon1">
																		<i class="mdi mdi-account-circle"></i>
																	</span>
																	<input type="text" class="form-control" 
																		   value="<?php echo $results['username'];?>" readonly>
																</div>
														</div>
														<div class="mb-3 col-md-6">
															<label class="form-label">Email</label>
																<div class="input-group flex-nowrap">
																	<span class="input-group-text" id="basic-addon1">
																		<i class="mdi mdi-email"></i>
																	</span>
																	<input type="text" class="form-control"
																		   value="<?php echo $results['email'];?>" readonly>
																</div>
														</div>
													</div>
												</form>
                                            </div> 
											
											<div class="tab-pane" id="password">
												<form class="form-horizontal" method="POST" name="periode" onSubmit="return valid();" action="update-password.php">
													<div class="row g-2">
														<div class="mb-3 col-md-6">
															<label class="form-label">Password Lama</label>
																<div class="input-group flex-nowrap">
																	<span class="input-group-text" id="basic-addon1">
																		<i class="mdi mdi-lock"></i>
																	</span>
																	<input name="level" type="hidden" value="<?php echo $id;?>" required>
																	<input name="password" type="hidden" value="<?php echo $results['password'];?>" required>
																	<input type="password" class="form-control" name="passwordlama" required>
																</div>
														</div>
													</div>
													<div class="row g-2">
														<div class="mb-3 col-md-6">
															<label class="form-label">Password Baru</label>
																<div class="input-group flex-nowrap">
																	<span class="input-group-text" id="basic-addon1">
																		<i class="mdi mdi-lock"></i>
																	</span>
																	<input type="password" class="form-control" name="passwordbaru" required>
																</div>
														</div>
													</div>
													<div class="row g-2">
														<div class="mb-3 col-md-6">
															<label class="form-label">Konfirmasi Password</label>
																<div class="input-group flex-nowrap">
																	<span class="input-group-text" id="basic-addon1">
																		<i class="mdi mdi-lock"></i>
																	</span>
																	<input type="password" class="form-control" name="passwordkonfirm" required>
																</div>
														</div>
													</div>
													<button type="submit" class="btn btn-primary" name="submit">Submit</button>
												</form>
                                            </div> 
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
	<script type="text/javascript">
		function valid()
		{
			if(document.periode.passwordbaru.value < 6){
				Swal.fire({
			icon: 'warning',
			title: 'Oops',
			text: 'Password Baru Minimal 6 Karakter!'
				}).then(function() {
					window.location = 'profil.php';
			});
				return false;
			}

		return true;
		}
	</script>
    </body>
</html>
<?php }?>