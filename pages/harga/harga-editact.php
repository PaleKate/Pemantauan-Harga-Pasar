<?php
session_start();
error_reporting(0);
include('../includes/config.php');
include('harga.php');
$tgl=$_POST['tgl'];
$pasar=$_SESSION['login_saharga'];
$beras_p=$_POST['beras_p'];
$beras_m=$_POST['beras_m'];
$gula=$_POST['gula'];
$bimoli=$_POST['bimoli'];
$minyak_c=$_POST['minyak_c'];
$minyak_k=$_POST['minyak_k'];
$sapi=$_POST['sapi'];
$ayam_b=$_POST['ayam_b'];
$ayam_k=$_POST['ayam_k'];
$telur=$_POST['telur'];
$susu_b=$_POST['susu_b'];
$susu_i=$_POST['susu_i'];
$susu_d=$_POST['susu_d'];
$jagung_p=$_POST['jagung_p'];
$jagung_t=$_POST['jagung_t'];
$garam=$_POST['garam'];
$tepung=$_POST['tepung'];
$kacang_k=$_POST['kacang_k'];
$kacang_h=$_POST['kacang_h'];
$kacang_t=$_POST['kacang_t'];
$blueband=$_POST['blueband'];
$mie=$_POST['mie'];
$cabe_mb=$_POST['cabe_mb'];
$cabe_hb=$_POST['cabe_hb'];
$cabe_rh=$_POST['cabe_rh'];
$cabe_rm=$_POST['cabe_rm'];
$wortel=$_POST['wortel'];
$kol=$_POST['kol'];
$buncis=$_POST['buncis'];
$bawang_m=$_POST['bawang_m'];
$bawang_p=$_POST['bawang_p'];
$ikan=$_POST['ikan'];
$kentang=$_POST['kentang'];
$gula_merah=$_POST['gula_merah'];
$kelapa=$_POST['kelapa'];
$gas=$_POST['gas'];
$id=$_POST['id'];
$sql="UPDATE harga SET beras_p='$beras_p', beras_m='$beras_m', gula='$gula', bimoli='$bimoli', minyak_c='$minyak_c', minyak_k='$minyak_k',
	  sapi='$sapi', ayam_b='$ayam_b', ayam_k='$ayam_k', telur='$telur', susu_b='$susu_b', susu_i='$susu_i', susu_d='$susu_d', jagung_p='$jagung_p',
	  jagung_t='$jagung_t', garam='$garam', tepung='$tepung', kacang_k='$kacang_k', kacang_h='$kacang_h', kacang_t='$kacang_t', blueband='$blueband',
	  mie='$mie', cabe_mb='$cabe_mb', cabe_hb='$cabe_hb', cabe_rh='$cabe_rh', cabe_rm='$cabe_rm', wortel='$wortel', kol='$kol', buncis='$buncis', bawang_m='$bawang_m',
	  bawang_p='$bawang_p', ikan_asin='$ikan', kentang='$kentang', gula_merah='$gula_merah', kelapa='$kelapa', gas='$gas' 
	  WHERE id_bahan='$id' AND pasar='$pasar'";
$query 	= mysqli_query($koneksidb,$sql);
if($query){
	echo "<script type='text/javascript'>
			Swal.fire({
			  icon: 'success',
			  title: 'Done',
			  text: 'Data Berhasil Diupdate'
			}).then(function() {
				window.location = 'harga.php';
			});
		</script>";
}else {
	echo "<script type='text/javascript'>
			Swal.fire({
			  icon: 'warning',
			  title: 'Oops',
			  text: 'Terjadi Kesalahan Update Data!'
			}).then(function() {
				window.location = 'harga.php';
			});
		</script>";
	}
?>