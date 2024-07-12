<?php
session_start();
error_reporting(0);
include('../includes/config.php');
include('profil.php');
$password=$_POST['password'];
$passwordlama=$_POST['passwordlama'];
$passwordbaru=$_POST['passwordbaru'];
$passwordkonfirm=$_POST['passwordkonfirm'];
$level=$_POST['level'];

if(password_verify($passwordlama,$password)){
	$sql="SELECT * FROM administrator WHERE level='$level' AND password='$password'";
	$query = mysqli_query($koneksidb,$sql);
	if(mysqli_num_rows($query)==1){
		if(strlen($passwordbaru) < 5){
			echo 
				"<script type='text/javascript'>
					Swal.fire({
					  icon: 'warning',
					  title: 'Oops',
					  text: 'Password Baru Minimal 6 Karakter!'
					  }).then(function() {
						window.location = 'profil.php';
					});
				</script>";	
		}else{
		if($passwordbaru==$passwordkonfirm){
			$passwordbaru=password_hash($passwordbaru, PASSWORD_DEFAULT);
			$sqlup="UPDATE administrator SET password='$passwordbaru' WHERE level='$level'";
			$queryup= mysqli_query($koneksidb,$sqlup);
			if($queryup){
				echo 
				"<script type='text/javascript'>
					Swal.fire({
					  icon: 'success',
					  title: 'Done',
					  text: 'Password Berhasil Diupdate'
					  }).then(function() {
						window.location = 'profil.php';
					});
				</script>";	
			}else{
				echo 
				"<script type='text/javascript'>
					Swal.fire({
					  icon: 'error',
					  title: 'Oops',
					  text: 'Gagal Update Password!'
					  }).then(function() {
						window.location = 'profil.php';
					});
				</script>";	
			}
		}else{
			echo 
				"<script type='text/javascript'>
					Swal.fire({
					  icon: 'warning',
					  title: 'Oops',
					  text: 'Password Baru Dan Konfirmasi Password Tidak Sama!'
					  }).then(function() {
						window.location = 'profil.php';
					});
				</script>";	
		}
	}
	}
}else{
		
		echo 
				"<script type='text/javascript'>
					Swal.fire({
					  icon: 'warning',
					  title: 'Oops',
					  text: 'Password Salah Atau Password Baru Dan Konfirmasi Password Tidak Sama!!'
					  }).then(function() {
						window.location = 'profil.php';
					});
				</script>";	
	}
?>