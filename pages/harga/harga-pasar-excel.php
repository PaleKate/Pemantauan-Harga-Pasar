<?php
session_start();
error_reporting(0);
include('../includes/config.php');
include('../includes/format_rupiah.php');
include('../includes/library.php');

header("Content-Type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=HARGA KOMODITAS PER PASAR.xls");
?>	
<p align="center" style="font-weight:bold; font-size:16pt;">PANTAUAN HARGA BAHAN POKOK</P>
<p align="center" style="font-weight:bold; font-size:16pt;">PER PASAR</P>
<p align="center" style="font-weight:bold; font-size:16pt;">KABUPATEN TASIKMALAYA</P>
	<table border="1">
		<thead>
			<tr>
				<?php 
					if(!isset($_GET['tgl'])){
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
					if(isset($_GET['tgl'])){
						$tgl = $_GET['tgl'];
						
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
					if(isset($_GET['tgl'])){
						$tgl = $_GET['tgl'];
						
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
					if(isset($_GET['tgl'])){
						$tgl = $_GET['tgl'];
						
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
					if(isset($_GET['tgl'])){
						$tgl = $_GET['tgl'];
						
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
					if(isset($_GET['tgl'])){
						$tgl = $_GET['tgl'];
						
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
					if(isset($_GET['tgl'])){
						$tgl = $_GET['tgl'];
						
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
					if(isset($_GET['tgl'])){
						$tgl = $_GET['tgl'];
						
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
					if(isset($_GET['tgl'])){
						$tgl = $_GET['tgl'];
						
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
					if(isset($_GET['tgl'])){
						$tgl = $_GET['tgl'];
						
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
					if(isset($_GET['tgl'])){
						$tgl = $_GET['tgl'];
						
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
					if(isset($_GET['tgl'])){
						$tgl = $_GET['tgl'];
						
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
					if(isset($_GET['tgl'])){
						$tgl = $_GET['tgl'];
						
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
					if(isset($_GET['tgl'])){
						$tgl = $_GET['tgl'];
						
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
					if(isset($_GET['tgl'])){
						$tgl = $_GET['tgl'];
						
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
					if(isset($_GET['tgl'])){
						$tgl = $_GET['tgl'];
						
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
					if(isset($_GET['tgl'])){
						$tgl = $_GET['tgl'];
						
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
					if(isset($_GET['tgl'])){
						$tgl = $_GET['tgl'];
						
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
					if(isset($_GET['tgl'])){
						$tgl = $_GET['tgl'];
						
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
					if(isset($_GET['tgl'])){
						$tgl = $_GET['tgl'];
						
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
					if(isset($_GET['tgl'])){
						$tgl = $_GET['tgl'];
						
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
					if(isset($_GET['tgl'])){
						$tgl = $_GET['tgl'];
						
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
					if(isset($_GET['tgl'])){
						$tgl = $_GET['tgl'];
						
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
					if(isset($_GET['tgl'])){
						$tgl = $_GET['tgl'];
						
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
					if(isset($_GET['tgl'])){
						$tgl = $_GET['tgl'];
						
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
					if(isset($_GET['tgl'])){
						$tgl = $_GET['tgl'];
						
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
					if(isset($_GET['tgl'])){
						$tgl = $_GET['tgl'];
						
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
					if(isset($_GET['tgl'])){
						$tgl = $_GET['tgl'];
						
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
					if(isset($_GET['tgl'])){
						$tgl = $_GET['tgl'];
						
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
					if(isset($_GET['tgl'])){
						$tgl = $_GET['tgl'];
						
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
					if(isset($_GET['tgl'])){
						$tgl = $_GET['tgl'];
						
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
					if(isset($_GET['tgl'])){
						$tgl = $_GET['tgl'];
						
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
					if(isset($_GET['tgl'])){
						$tgl = $_GET['tgl'];
						
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
					if(isset($_GET['tgl'])){
						$tgl = $_GET['tgl'];
						
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
					if(isset($_GET['tgl'])){
						$tgl = $_GET['tgl'];
						
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
					if(isset($_GET['tgl'])){
						$tgl = $_GET['tgl'];
						
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
					if(isset($_GET['tgl'])){
						$tgl = $_GET['tgl'];
						
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