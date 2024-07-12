<?php
session_start();
error_reporting(0);
include('../includes/config.php');
include('harga.php');
$id=bin2hex(random_bytes(20));
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
$sqlcek = "SELECT * FROM harga WHERE tgl='$tgl' AND pasar='$pasar'";
$querycek = mysqli_query($koneksidb,$sqlcek);
	if(mysqli_num_rows($querycek)>0){
		echo "<script type='text/javascript'>
					Swal.fire({
					  icon: 'warning',
					  title: 'Oops',
					  text: 'Data sudah ada, silahkan update data!'
					  }).then(function() {
					window.location = 'harga.php';
				});
				</script>";	
}else{
	$sqlpotensi = "INSERT INTO harga (id_bahan,tgl,pasar,beras_p,beras_m,gula,bimoli,minyak_c,minyak_k,sapi,ayam_b,ayam_k,telur,jagung_p,
					jagung_t,susu_b,susu_i,susu_d,garam,tepung,kacang_k,kacang_h,kacang_t,blueband,mie,cabe_mb,cabe_hb,cabe_rh,cabe_rm,wortel,
					kol,buncis,bawang_m,bawang_p,ikan_asin,kentang,gula_merah,kelapa,gas)
				VALUES ('$id','$tgl','$pasar','$beras_p','$beras_m','$gula','$bimoli','$minyak_c','$minyak_k','$sapi','$ayam_b','$ayam_k',
						'$telur','$jagung_p','$jagung_t','$susu_b','$susu_i','$susu_d','$garam','$tepung','$kacang_k','$kacang_h','$kacang_t',
						'$blueband','$mie','$cabe_mb','$cabe_hb','$cabe_rh','$cabe_rm','$wortel','$kol','$buncis','$bawang_m','$bawang_p',
						'$ikan','$kentang','$gula_merah','$kelapa','$gas')";
	$query = mysqli_query($koneksidb,$sqlpotensi);
if($query){
	$sqlhet = "SELECT * FROM het";
	$queryhet = mysqli_query($koneksidb,$sqlhet);
	$het = mysqli_fetch_array($queryhet);
	if($het['beras_p'] < $beras_p || $het['beras_m'] < $beras_m || $het['gula'] < $gula || $het['bimoli'] < $bimoli || 
	   $het['minyak_c'] < $minyak_c || $het['minyak_k'] < $minyak_k || $het['sapi'] < $sapi || $het['ayam_b'] < $ayam_b || 
	   $het['ayam_k'] < $ayam_k || $het['telur'] < $telur || $het['jagung_p'] < $jagung_p || $het['jagung_t'] < $jagung_t || 
	   $het['susu_b'] < $susu_b || $het['susu_i'] < $susu_i || $het['susu_d'] < $susu_d){
			$sqlpasar = "SELECT * FROM administrator WHERE level='$pasar'";
			$querypasar = mysqli_query($koneksidb,$sqlpasar);
			$wapasar = mysqli_fetch_array($querypasar);

			$sqlbidek = "SELECT * FROM administrator WHERE level='Bidek'";
			$querybidek = mysqli_query($koneksidb,$sqlbidek);
			$wabidek = mysqli_fetch_array($querybidek);

			$sqlekbang = "SELECT * FROM administrator WHERE level='Ekbang'";
			$queryekbang = mysqli_query($koneksidb,$sqlekbang);
			$waekbang = mysqli_fetch_array($queryekbang);
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://api.fonnte.com/send',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => array(
		'target' => "'" . $wapasar['wa'] . "," . $wabidek['wa'] . "," . $waekbang['wa'] . "'",
		'message' => "Terjadi Kenaikan Harga Pada Tanggal " . Indonesia2Tgl($tgl) . " Oleh Pasar " . $pasar . ""),
		  CURLOPT_HTTPHEADER => array(
			'Authorization: 4HmIsTP0AP+vrErEsdpv'
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		echo "<script type='text/javascript'>
				Swal.fire({
				  icon: 'success',
				  title: 'Done',
				  text: 'Data Berhasil diinput'
				}).then(function() {
					window.location = 'harga.php';
				});
			</script>";
	}else{
	echo "<script type='text/javascript'>
				Swal.fire({
				  icon: 'success',
				  title: 'Done',
				  text: 'Data Berhasil diinput'
				}).then(function() {
					window.location = 'harga.php';
				});
			</script>";
		}
	}else {
		echo "<script type='text/javascript'>
				Swal.fire({
				  icon: 'warning',
				  title: 'Oops',
				  text: 'Terjadi Kesalahan Input Data!'
				}).then(function() {
					window.location = 'harga.php';
				});
			</script>";
	
	}
}
?>