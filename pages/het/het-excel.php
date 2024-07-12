<?php
session_start();
error_reporting(0);
include('../includes/config.php');
include('../includes/format_rupiah.php');
include('../includes/library.php');

header("Content-Type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=HARGA HET PER KOMODITAS.xls");
?>	
<p align="center" style="font-weight:bold; font-size:16pt;">PANTAUAN HARGA ECERAN TERTINGGI (HET)</P>
<p align="center" style="font-weight:bold; font-size:16pt;">PER-KOMODITAS</P>
<p align="center" style="font-weight:bold; font-size:16pt;">KABUPATEN TASIKMALAYA</P>
	<table border="1">
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
				<td class="text-center"><?php echo htmlentities(number_format($result['beras_p']));?></td>
			</tr>
			<tr>
				<td align="center"><?php echo $nomor++;?></td>
				<td>Beras Medium</td>
				<td class="text-center">Kg</td>
				<td class="text-center"><?php echo htmlentities(number_format($result['beras_m']));?></td>
			</tr>
			<tr>
				<td align="center"><?php echo $nomor++;?></td>
				<td>Gula Pasir Dalam Negeri</td>
				<td class="text-center">Kg</td>
				<td class="text-center"><?php echo htmlentities(number_format($result['gula']));?></td>
			</tr>
			<tr>
				<td align="center"><?php echo $nomor++;?></td>
				<td>Minyak Goreng Bimoli Kemasan</td>
				<td class="text-center">Liter</td>
				<td class="text-center"><?php echo htmlentities(number_format($result['bimoli']));?></td>
			</tr>
			<tr>
				<td align="center"><?php echo $nomor++;?></td>
				<td>Minyak Goreng Curah</td>
				<td class="text-center">Liter</td>
				<td class="text-center"><?php echo htmlentities(number_format($result['minyak_c']));?></td>
			</tr>
			<tr>
				<td align="center"><?php echo $nomor++;?></td>
				<td>Minyak Goreng Kemasan Sederhana</td>
				<td class="text-center">Liter</td>
				<td class="text-center"><?php echo htmlentities(number_format($result['minyak_k']));?></td>
			</tr>
			<tr>
				<td align="center"><?php echo $nomor++;?></td>
				<td>Daging Sapi</td>
				<td class="text-center">Kg</td>
				<td class="text-center"><?php echo htmlentities(number_format($result['sapi']));?></td>
			</tr>
			<tr>
				<td align="center"><?php echo $nomor++;?></td>
				<td>Daging Ayam Broiler</td>
				<td class="text-center">Kg</td>
				<td class="text-center"><?php echo htmlentities(number_format($result['ayam_b']));?></td>
			</tr>
			<tr>
				<td align="center"><?php echo $nomor++;?></td>
				<td>Daging Ayam Kampung</td>
				<td class="text-center">Kg</td>
				<td class="text-center"><?php echo htmlentities(number_format($result['ayam_k']));?></td>
			</tr>
			<tr>
				<td align="center"><?php echo $nomor++;?></td>
				<td>Telur Ayam Ras</td>
				<td class="text-center">Kg</td>
				<td class="text-center"><?php echo htmlentities(number_format($result['telur']));?></td>
			</tr>
			<tr>
				<td align="center"><?php echo $nomor++;?></td>
				<td>Susu Kental Manis Merk Bendera</td>
				<td class="text-center">Kaleng</td>
				<td class="text-center"><?php echo htmlentities(number_format($result['susu_b']));?></td>
			</tr>
			<tr>
				<td align="center"><?php echo $nomor++;?></td>
				<td>Susu Kental Manis Merk Indomilk</td>
				<td class="text-center">Kaleng</td>
				<td class="text-center"><?php echo htmlentities(number_format($result['susu_i']));?></td>
			</tr>
			<tr>
				<td align="center"><?php echo $nomor++;?></td>
				<td>Susu Bubuk Dancow</td>
				<td class="text-center">200 Gr</td>
				<td class="text-center"><?php echo htmlentities(number_format($result['susu_d']));?></td>
			</tr>
			<tr>
				<td align="center"><?php echo $nomor++;?></td>
				<td>Jagung Pipilan</td>
				<td class="text-center">Kg</td>
				<td class="text-center"><?php echo htmlentities(number_format($result['jagung_p']));?></td>
			</tr>
			<tr>
				<td align="center"><?php echo $nomor++;?></td>
				<td>Jagung Tingkat Peternak</td>
				<td class="text-center">Kg</td>
				<td class="text-center"><?php echo htmlentities(number_format($result['jagung_t']));?></td>
			</tr>
			<tr>
				<td align="center"><?php echo $nomor++;?></td>
				<td>Garam Beryodium</td>
				<td class="text-center">250 Gr</td>
				<td class="text-center"><?php echo htmlentities(number_format($result['garam']));?></td>
			</tr>
			<tr>
				<td align="center"><?php echo $nomor++;?></td>
				<td>Tepung Terigu Cap Segitiga Biru</td>
				<td class="text-center">Kg</td>
				<td class="text-center"><?php echo htmlentities(number_format($result['tepung']));?></td>
			</tr>
			<tr>
				<td align="center"><?php echo $nomor++;?></td>
				<td>Kacang Kedelai Lokal</td>
				<td class="text-center">Kg</td>
				<td class="text-center"><?php echo htmlentities(number_format($result['kacang_k']));?></td>
			</tr>
			<tr>
				<td align="center"><?php echo $nomor++;?></td>
				<td>Kacang Hijau</td>
				<td class="text-center">Kg</td>
				<td class="text-center"><?php echo htmlentities(number_format($result['kacang_h']));?></td>
			</tr>
			<tr>
				<td align="center"><?php echo $nomor++;?></td>
				<td>Kacang Tanah</td>
				<td class="text-center">Kg</td>
				<td class="text-center"><?php echo htmlentities(number_format($result['kacang_t']));?></td>
			</tr>
			<tr>
				<td align="center"><?php echo $nomor++;?></td>
				<td>Blue Band Margarin</td>
				<td class="text-center">Kg</td>
				<td class="text-center"><?php echo htmlentities(number_format($result['blueband']));?></td>
			</tr>
			<tr>
				<td align="center"><?php echo $nomor++;?></td>
				<td>Indomie Rasa Ayam Bawang</td>
				<td class="text-center">Dus</td>
				<td class="text-center"><?php echo htmlentities(number_format($result['mie']));?></td>
			</tr>
			<tr>
				<td align="center"><?php echo $nomor++;?></td>
				<td>Cabe Merah Biasa</td>
				<td class="text-center">Kg</td>
				<td class="text-center"><?php echo htmlentities(number_format($result['cabe_mb']));?></td>
			</tr>
			<tr>
				<td align="center"><?php echo $nomor++;?></td>
				<td>Cabe Hijau Biasa</td>
				<td class="text-center">Kg</td>
				<td class="text-center"><?php echo htmlentities(number_format($result['cabe_hb']));?></td>
			</tr>
			<tr>
				<td align="center"><?php echo $nomor++;?></td>
				<td>Cabe Rawit Merah</td>
				<td class="text-center">Kg</td>
				<td class="text-center"><?php echo htmlentities(number_format($result['cabe_rm']));?></td>
			</tr>
			<tr>
				<td align="center"><?php echo $nomor++;?></td>
				<td>Cabe Rawit Hijau</td>
				<td class="text-center">Kg</td>
				<td class="text-center"><?php echo htmlentities(number_format($result['cabe_rh']));?></td>
			</tr>
			<tr>
				<td align="center"><?php echo $nomor++;?></td>
				<td>Wortel</td>
				<td class="text-center">Kg</td>
				<td class="text-center"><?php echo htmlentities(number_format($result['wortel']));?></td>
			</tr>
			<tr>
				<td align="center"><?php echo $nomor++;?></td>
				<td>Kol</td>
				<td class="text-center">Kg</td>
				<td class="text-center"><?php echo htmlentities(number_format($result['kol']));?></td>
			</tr>
			<tr>
				<td align="center"><?php echo $nomor++;?></td>
				<td>Buncis</td>
				<td class="text-center">Kg</td>
				<td class="text-center"><?php echo htmlentities(number_format($result['buncis']));?></td>
			</tr>
			<tr>
				<td align="center"><?php echo $nomor++;?></td>
				<td>Bawang Merah</td>
				<td class="text-center">Kg</td>
				<td class="text-center"><?php echo htmlentities(number_format($result['bawang_m']));?></td>
			</tr>
			<tr>
				<td align="center"><?php echo $nomor++;?></td>
				<td>Bawang Putih Impor</td>
				<td class="text-center">Kg</td>
				<td class="text-center"><?php echo htmlentities(number_format($result['bawang_p']));?></td>
			</tr>
			<tr>
				<td align="center"><?php echo $nomor++;?></td>
				<td>Ikan Asin Teri</td>
				<td class="text-center">Kg</td>
				<td class="text-center"><?php echo htmlentities(number_format($result['ikan_asin']));?></td>
			</tr>
			<tr>
				<td align="center"><?php echo $nomor++;?></td>
				<td>Kentang</td>
				<td class="text-center">Kg</td>
				<td class="text-center"><?php echo htmlentities(number_format($result['kentang']));?></td>
			</tr>
			<tr>
				<td align="center"><?php echo $nomor++;?></td>
				<td>Gula Merah Kelapa</td>
				<td class="text-center">Kg</td>
				<td class="text-center"><?php echo htmlentities(number_format($result['gula_merah']));?></td>
			</tr>
			<tr>
				<td align="center"><?php echo $nomor++;?></td>
				<td>Kelapa</td>
				<td class="text-center">Butir</td>
				<td class="text-center"><?php echo htmlentities(number_format($result['kelapa']));?></td>
			</tr>
			<tr>
				<td align="center"><?php echo $nomor++;?></td>
				<td>Gas Elpiji 3 Kg</td>
				<td class="text-center">Tabung</td>
				<td class="text-center"><?php echo htmlentities(number_format($result['gas']));?></td>
			</tr>
		</tbody>
	</table>  