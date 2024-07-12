<?php
include('../includes/config.php');
include('../includes/format_rupiah.php');
include('../includes/library.php');
?>	
<div id="element">
<p align="center" style="font-weight:bold; font-size:16pt;">PANTAUAN HARGA RATA-RATA</P>
<p align="center" style="font-weight:bold; font-size:16pt;">BAHAN POKOK PASAR</P>
<p align="center" style="font-weight:bold; font-size:16pt;">KABUPATEN TASIKMALAYA</P>
	<table border="1">
		<thead>
			<tr>
				<?php 
					if(isset($_GET['dari'])){
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
					if(isset($_GET['dari'])){
						$dari = $_GET['dari'];
						$sampai = $_GET['sampai'];
						
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
					if(isset($_GET['dari'])){
						$dari = $_GET['dari'];
						$sampai = $_GET['sampai'];
						
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
					if(isset($_GET['dari'])){
						$dari = $_GET['dari'];
						$sampai = $_GET['sampai'];
						
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
					if(isset($_GET['dari'])){
						$dari = $_GET['dari'];
						$sampai = $_GET['sampai'];
						
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
					if(isset($_GET['dari'])){
						$dari = $_GET['dari'];
						$sampai = $_GET['sampai'];
						
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
					if(isset($_GET['dari'])){
						$dari = $_GET['dari'];
						$sampai = $_GET['sampai'];
						
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
					if(isset($_GET['dari'])){
						$dari = $_GET['dari'];
						$sampai = $_GET['sampai'];
						
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
					if(isset($_GET['dari'])){
						$dari = $_GET['dari'];
						$sampai = $_GET['sampai'];
						
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
					if(isset($_GET['dari'])){
						$dari = $_GET['dari'];
						$sampai = $_GET['sampai'];
						
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
					if(isset($_GET['dari'])){
						$dari = $_GET['dari'];
						$sampai = $_GET['sampai'];
						
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
					if(isset($_GET['dari'])){
						$dari = $_GET['dari'];
						$sampai = $_GET['sampai'];
						
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
					if(isset($_GET['dari'])){
						$dari = $_GET['dari'];
						$sampai = $_GET['sampai'];
						
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
					if(isset($_GET['dari'])){
						$dari = $_GET['dari'];
						$sampai = $_GET['sampai'];
						
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
					if(isset($_GET['dari'])){
						$dari = $_GET['dari'];
						$sampai = $_GET['sampai'];
						
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
					if(isset($_GET['dari'])){
						$dari = $_GET['dari'];
						$sampai = $_GET['sampai'];
						
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
					if(isset($_GET['dari'])){
						$dari = $_GET['dari'];
						$sampai = $_GET['sampai'];
						
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
					if(isset($_GET['dari'])){
						$dari = $_GET['dari'];
						$sampai = $_GET['sampai'];
						
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
					if(isset($_GET['dari'])){
						$dari = $_GET['dari'];
						$sampai = $_GET['sampai'];
						
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
					if(isset($_GET['dari'])){
						$dari = $_GET['dari'];
						$sampai = $_GET['sampai'];
						
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
					if(isset($_GET['dari'])){
						$dari = $_GET['dari'];
						$sampai = $_GET['sampai'];
						
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
					if(isset($_GET['dari'])){
						$dari = $_GET['dari'];
						$sampai = $_GET['sampai'];
						
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
					if(isset($_GET['dari'])){
						$dari = $_GET['dari'];
						$sampai = $_GET['sampai'];
						
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
					if(isset($_GET['dari'])){
						$dari = $_GET['dari'];
						$sampai = $_GET['sampai'];
						
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
					if(isset($_GET['dari'])){
						$dari = $_GET['dari'];
						$sampai = $_GET['sampai'];
						
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
					if(isset($_GET['dari'])){
						$dari = $_GET['dari'];
						$sampai = $_GET['sampai'];
						
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
					if(isset($_GET['dari'])){
						$dari = $_GET['dari'];
						$sampai = $_GET['sampai'];
						
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
					if(isset($_GET['dari'])){
						$dari = $_GET['dari'];
						$sampai = $_GET['sampai'];
						
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
					if(isset($_GET['dari'])){
						$dari = $_GET['dari'];
						$sampai = $_GET['sampai'];
						
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
					if(isset($_GET['dari'])){
						$dari = $_GET['dari'];
						$sampai = $_GET['sampai'];
						
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
					if(isset($_GET['dari'])){
						$dari = $_GET['dari'];
						$sampai = $_GET['sampai'];
						
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
					if(isset($_GET['dari'])){
						$dari = $_GET['dari'];
						$sampai = $_GET['sampai'];
						
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
					if(isset($_GET['dari'])){
						$dari = $_GET['dari'];
						$sampai = $_GET['sampai'];
						
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
					if(isset($_GET['dari'])){
						$dari = $_GET['dari'];
						$sampai = $_GET['sampai'];
						
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
					if(isset($_GET['dari'])){
						$dari = $_GET['dari'];
						$sampai = $_GET['sampai'];
						
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
					if(isset($_GET['dari'])){
						$dari = $_GET['dari'];
						$sampai = $_GET['sampai'];
						
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
					if(isset($_GET['dari'])){
						$dari = $_GET['dari'];
						$sampai = $_GET['sampai'];
						
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
					if(isset($_GET['dari'])){
						$dari = $_GET['dari'];
						$sampai = $_GET['sampai'];
						
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
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.8.0/html2pdf.bundle.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script>
	<script>
	 let element = document.getElementById('element')
	 
	  html2pdf(element,{
    margin:10,
    filename:'Harga.pdf',
    image:{type:'jpeg',quality:0.98},
    html2canvas:{scale:2,logging:true,dpi:192,letterRendering:true},
    jsPDF:{unit:'mm',format:'a4',orientation:'portrait'}
 }) 
	 </script>
</body>
</html>