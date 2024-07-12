<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/format_rupiah.php');
include('includes/library.php');
if(isset($_SESSION['login_saharga'])){
	header("location: dashboard.php");
	exit;
}
?>	
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Sign In | Aplikasi Harga Bahan Pokok</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
		<?php include('includes/head.php'); ?>
    </head>

    <body class="authentication-bg pb-0" data-layout-config='{"darkMode":false}'>

        <div class="auth-fluid">
            <!--Auth fluid left content -->
            <div class="auth-fluid-form-box">
                <div class="align-items-center d-flex h-100">
                    <div class="card-body">

                        <!-- title-->
							<a href="index.php" class="logo-dark">
                                <span><img src="assets/images/logo.png" alt="" height="50" style="display:block; margin:auto;"></span>
                            </a>
                        <h4 class="mt-2" align="center">Sign In</h4>
                        <p class="text-muted mb-4" align="center">Silahkan Sign In Terlebih Dahulu</p>

                        <!-- form -->
                        <form method="POST">
                            <div class="mb-3">
                                <label for="emailaddress" class="form-label">Alamat Email</label>
                                <input class="form-control" type="email" id="emailaddress" name="email" required="" placeholder="Masukan Alamat Email">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input class="form-control" type="password" name="password" required="" id="password" placeholder="Masukan password">
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <a href="pages/profil/forget-password.php" class="text-muted float-end"><p>Lupa password?</p></a>
                                </div>
                            </div>
                            <div class="d-grid mb-0 text-center">
                                <button class="btn btn-primary" type="submit" name="login"><i class="mdi mdi-login"></i> Login </button>
                            </div>
                        </form>
                        <!-- end form-->

                    </div> <!-- end .card-body -->
                </div> <!-- end .align-items-center.d-flex.h-100-->
            </div>
            <!-- end auth-fluid-form-box-->

            <!-- Auth fluid right content -->
            <div class="auth-fluid-right text-center">
                <div class="auth-user-testimonial">
                    <h2>Aplikasi Pantauan Harga Bahan Pokok Pasar</h2>
                    <h2 class="mb-3">Kabupaten Tasikmalaya</h2>
                    <p class="lead"><i class="mdi mdi-format-quote-open"></i> Pemantauan Harga Bahan Pokok Pasar Berbasis Digital <i class="mdi mdi-format-quote-close"></i>
                    </p>
                    <p>
                        - Bidang PSDA Bappelitbangda Kabupaten Tasikmalaya
                    </p>
                </div> <!-- end auth-user-testimonial-->
            </div>
            <!-- end Auth fluid right content -->
        </div>
        <!-- end auth-fluid-->

        <?php include('includes/script.php'); ?>

    </body>

</html>
<?php
if(isset($_POST['login']))
{
$email=$_POST['email'];
$password=$_POST['password'];
$sql = "SELECT * FROM administrator WHERE email='$email'";
$query = mysqli_query($koneksidb,$sql);
	if(mysqli_num_rows($query)>0){
		$row = mysqli_fetch_assoc($query);
		if(password_verify($password, $row['password'])){
			$_SESSION['login_saharga']=$row['level'];
			echo "<script type='text/javascript'>
				Swal.fire({
				  icon: 'success',
				  title: 'Done',
				  text: 'Login Berhasil'
				}).then(function() {
					window.location = 'module=dashboard';
				});
			</script>";	
		}else{
			"<script type='text/javascript'>
				Swal.fire({
				  icon: 'warning',
				  title: 'Oops',
				  text: 'Username atau Password Salah'
				  }).then(function() {
					window.location = 'home';
				});
			</script>";	
		}
	}
}

?>