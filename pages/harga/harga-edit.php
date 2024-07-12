<div class="modal fade" id="modal-lg-edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-full-width modal-dialog-scrollable">
		<div class="modal-content">
				<?php 
					if(isset($_POST['cari2'])){
						$pasar = $_SESSION['login_saharga'];
						$tgl = $_POST['tgl'];
						
						$sql = "SELECT * FROM harga WHERE tgl='$tgl' AND pasar='$pasar'";
							$query = mysqli_query($koneksidb,$sql);
							$result = mysqli_fetch_array($query);
				?>
			<div class="modal-header">
				<h4 class="modal-title" id="myLargeModalLabel">Form Update Data Bahan Pokok Pasar <?php echo $result['pasar'];?></h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" method="POST" action="harga-editact.php">
					<div class="row g-2">
						<div class="mb-3 col-md-12">
							<label class="form-label">Tanggal</label>
								<input type="hidden" class="form-control" name="id" value="<?php echo htmlentities($result['id_bahan']);?>" readonly>
								<input type="text" class="form-control" value="<?php echo Indonesia2Tgl($tgl);?>" readonly>
						</div>
						<div class="mb-3 col-md-3">
							<label class="form-label">Beras Premium (Kg)</label>
								<div class="input-group flex-nowrap">
									<span class="input-group-text" id="basic-addon1">Rp</span>
									<input type="number" class="form-control" name="beras_p" min=0 value="<?php echo htmlentities($result['beras_p']);?>">
								</div>
						</div>
						<div class="mb-3 col-md-3">
							<label class="form-label">Beras Medium (Kg)</label>
								<div class="input-group flex-nowrap">
									<span class="input-group-text" id="basic-addon1">Rp</span>
									<input type="number" class="form-control" name="beras_m" min=0 value="<?php echo htmlentities($result['beras_m']);?>">
								</div>
						</div>
						<div class="mb-3 col-md-3">
							<label class="form-label">Gula Pasir (Kg)</label>
								<div class="input-group flex-nowrap">
									<span class="input-group-text" id="basic-addon1">Rp</span>
									<input type="number" class="form-control" name="gula" min=0 value="<?php echo htmlentities($result['gula']);?>">
								</div>
						</div>
						<div class="mb-3 col-md-3">
							<label class="form-label">Minyak Bimoli (Liter)</label>
								<div class="input-group flex-nowrap">
									<span class="input-group-text" id="basic-addon1">Rp</span>
									<input type="number" class="form-control" name="bimoli" min=0 value="<?php echo htmlentities($result['bimoli']);?>">
								</div>
						</div>
						<div class="mb-3 col-md-3">
							<label class="form-label">Minyak Goreng Curah (Liter)</label>
								<div class="input-group flex-nowrap">
									<span class="input-group-text" id="basic-addon1">Rp</span>
									<input type="number" class="form-control" name="minyak_c" min=0 value="<?php echo htmlentities($result['minyak_c']);?>">
								</div>
						</div>
						<div class="mb-3 col-md-3">
							<label class="form-label">Minyak Goreng Kemasan (Liter)</label>
								<div class="input-group flex-nowrap">
									<span class="input-group-text" id="basic-addon1">Rp</span>
									<input type="number" class="form-control" name="minyak_k" min=0 value="<?php echo htmlentities($result['minyak_k']);?>">
								</div>
						</div>
						<div class="mb-3 col-md-3">
							<label class="form-label">Daging Sapi (Kg)</label>
								<div class="input-group flex-nowrap">
									<span class="input-group-text" id="basic-addon1">Rp</span>
									<input type="number" class="form-control" name="sapi" min=0 value="<?php echo htmlentities($result['sapi']);?>">
								</div>
						</div>
						<div class="mb-3 col-md-3">
							<label class="form-label">Daging Ayam Broiler (Kg)</label>
								<div class="input-group flex-nowrap">
									<span class="input-group-text" id="basic-addon1">Rp</span>
									<input type="number" class="form-control" name="ayam_b" min=0 value="<?php echo htmlentities($result['ayam_b']);?>">
								</div>
						</div>
						<div class="mb-3 col-md-3">
							<label class="form-label">Daging Ayam Kampung (Kg)</label>
								<div class="input-group flex-nowrap">
									<span class="input-group-text" id="basic-addon1">Rp</span>
									<input type="number" class="form-control" name="ayam_k" min=0 value="<?php echo htmlentities($result['ayam_k']);?>">
								</div>
						</div>
						<div class="mb-3 col-md-3">
							<label class="form-label">Harga Telur Ayam Ras (Kg)</label>
								<div class="input-group flex-nowrap">
									<span class="input-group-text" id="basic-addon1">Rp</span>
									<input type="number" class="form-control" name="telur" min=0 value="<?php echo htmlentities($result['telur']);?>">
								</div>
						</div>
						<div class="mb-3 col-md-3">
							<label class="form-label">Susu Kental Manis Merk Bendera (Kaleng)</label>
								<div class="input-group flex-nowrap">
									<span class="input-group-text" id="basic-addon1">Rp</span>
									<input type="number" class="form-control" name="susu_b" min=0 value="<?php echo htmlentities($result['susu_b']);?>">
								</div>
						</div>
						<div class="mb-3 col-md-3">
							<label class="form-label">Susu Kental Manis Merk Indomilk (Kaleng)</label>
								<div class="input-group flex-nowrap">
									<span class="input-group-text" id="basic-addon1">Rp</span>
									<input type="number" class="form-control" name="susu_i" min=0 value="<?php echo htmlentities($result['susu_i']);?>">
								</div>
						</div>
						<div class="mb-3 col-md-3">
							<label class="form-label">Susu Bubuk Dancow (200 Gr)</label>
								<div class="input-group flex-nowrap">
									<span class="input-group-text" id="basic-addon1">Rp</span>
									<input type="number" class="form-control" name="susu_d" min=0 value="<?php echo htmlentities($result['susu_d']);?>">
								</div>
						</div>
						<div class="mb-3 col-md-3">
							<label class="form-label">Jagung Pipilan (Kg)</label>
								<div class="input-group flex-nowrap">
									<span class="input-group-text" id="basic-addon1">Rp</span>
									<input type="number" class="form-control" name="jagung_p" min=0 value="<?php echo htmlentities($result['jagung_p']);?>">
								</div>
						</div>
						<div class="mb-3 col-md-3">
							<label class="form-label">Jagung Tingkat Peternak (Kg)</label>
								<div class="input-group flex-nowrap">
									<span class="input-group-text" id="basic-addon1">Rp</span>
									<input type="number" class="form-control" name="jagung_t" min=0 value="<?php echo htmlentities($result['jagung_t']);?>">
								</div>
						</div>
						<div class="mb-3 col-md-3">
							<label class="form-label">Garam Beryodium (250 Gr)</label>
								<div class="input-group flex-nowrap">
									<span class="input-group-text" id="basic-addon1">Rp</span>
									<input type="number" class="form-control" name="garam" min=0 value="<?php echo htmlentities($result['garam']);?>">
								</div>
						</div>
						<div class="mb-3 col-md-3">
							<label class="form-label">Tepung Terigu Cap Segitiga Biru (Kg)</label>
								<div class="input-group flex-nowrap">
									<span class="input-group-text" id="basic-addon1">Rp</span>
									<input type="number" class="form-control" name="tepung" min=0 value="<?php echo htmlentities($result['tepung']);?>">
								</div>
						</div>
						<div class="mb-3 col-md-3">
							<label class="form-label">Kacang Kedelai Lokal (Kg)</label>
								<div class="input-group flex-nowrap">
									<span class="input-group-text" id="basic-addon1">Rp</span>
									<input type="number" class="form-control" name="kacang_k" min=0 value="<?php echo htmlentities($result['kacang_k']);?>">
								</div>
						</div>
						<div class="mb-3 col-md-3">
							<label class="form-label">Kacang Hijau (Kg)</label>
								<div class="input-group flex-nowrap">
									<span class="input-group-text" id="basic-addon1">Rp</span>
									<input type="number" class="form-control" name="kacang_h" min=0 value="<?php echo htmlentities($result['kacang_h']);?>">
								</div>
						</div>
						<div class="mb-3 col-md-3">
							<label class="form-label">Kacang Tanah (Kg)</label>
								<div class="input-group flex-nowrap">
									<span class="input-group-text" id="basic-addon1">Rp</span>
									<input type="number" class="form-control" name="kacang_t" min=0 value="<?php echo htmlentities($result['kacang_t']);?>">
								</div>
						</div>
						<div class="mb-3 col-md-3">
							<label class="form-label">Blue Band Margarin (Kg)</label>
								<div class="input-group flex-nowrap">
									<span class="input-group-text" id="basic-addon1">Rp</span>
									<input type="number" class="form-control" name="blueband" min=0 value="<?php echo htmlentities($result['blueband']);?>">
								</div>
						</div>
						<div class="mb-3 col-md-3">
							<label class="form-label">Indomie Rasa Ayam Bawang (Dus)</label>
								<div class="input-group flex-nowrap">
									<span class="input-group-text" id="basic-addon1">Rp</span>
									<input type="number" class="form-control" name="mie" min=0 value="<?php echo htmlentities($result['mie']);?>">
								</div>
						</div>
						<div class="mb-3 col-md-3">
							<label class="form-label">Cabe Merah Biasa (Kg)</label>
								<div class="input-group flex-nowrap">
									<span class="input-group-text" id="basic-addon1">Rp</span>
									<input type="number" class="form-control" name="cabe_mb" min=0 value="<?php echo htmlentities($result['cabe_mb']);?>">
								</div>
						</div>
						<div class="mb-3 col-md-3">
							<label class="form-label">Cabe Hijau Biasa (Kg)</label>
								<div class="input-group flex-nowrap">
									<span class="input-group-text" id="basic-addon1">Rp</span>
									<input type="number" class="form-control" name="cabe_hb" min=0 value="<?php echo htmlentities($result['cabe_hb']);?>">
								</div>
						</div>
						<div class="mb-3 col-md-3">
							<label class="form-label">Cabe Rawit Hijau (Kg)</label>
								<div class="input-group flex-nowrap">
									<span class="input-group-text" id="basic-addon1">Rp</span>
									<input type="number" class="form-control" name="cabe_rh" min=0 value="<?php echo htmlentities($result['cabe_rh']);?>">
								</div>
						</div>
						<div class="mb-3 col-md-3">
							<label class="form-label">Cabe Rawit Merah (Kg)</label>
								<div class="input-group flex-nowrap">
									<span class="input-group-text" id="basic-addon1">Rp</span>
									<input type="number" class="form-control" name="cabe_rm" min=0 value="<?php echo htmlentities($result['cabe_rm']);?>">
								</div>
						</div>
						<div class="mb-3 col-md-3">
							<label class="form-label">Wortel (Kg)</label>
								<div class="input-group flex-nowrap">
									<span class="input-group-text" id="basic-addon1">Rp</span>
									<input type="number" class="form-control" name="wortel" min=0 value="<?php echo htmlentities($result['wortel']);?>">
								</div>
						</div>
						<div class="mb-3 col-md-3">
							<label class="form-label">Kol (Kg)</label>
								<div class="input-group flex-nowrap">
									<span class="input-group-text" id="basic-addon1">Rp</span>
									<input type="number" class="form-control" name="kol" min=0 value="<?php echo htmlentities($result['kol']);?>">
								</div>
						</div>
						<div class="mb-3 col-md-3">
							<label class="form-label">Buncis (Kg)</label>
								<div class="input-group flex-nowrap">
									<span class="input-group-text" id="basic-addon1">Rp</span>
									<input type="number" class="form-control" name="buncis" min=0 value="<?php echo htmlentities($result['buncis']);?>">
								</div>
						</div>
						<div class="mb-3 col-md-3">
							<label class="form-label">Bawang Merah (Kg)</label>
								<div class="input-group flex-nowrap">
									<span class="input-group-text" id="basic-addon1">Rp</span>
									<input type="number" class="form-control" name="bawang_m" min=0 value="<?php echo htmlentities($result['bawang_m']);?>">
								</div>
						</div>
						<div class="mb-3 col-md-3">
							<label class="form-label">Bawang Putih Impor (Kg)</label>
								<div class="input-group flex-nowrap">
									<span class="input-group-text" id="basic-addon1">Rp</span>
									<input type="number" class="form-control" name="bawang_p" min=0 value="<?php echo htmlentities($result['bawang_p']);?>">
								</div>
						</div>
						<div class="mb-3 col-md-3">
							<label class="form-label">Ikan Asin Teri (Kg)</label>
								<div class="input-group flex-nowrap">
									<span class="input-group-text" id="basic-addon1">Rp</span>
									<input type="number" class="form-control" name="ikan" min=0 value="<?php echo htmlentities($result['ikan_asin']);?>">
								</div>
						</div>
						<div class="mb-3 col-md-3">
							<label class="form-label">Kentang (Kg)</label>
								<div class="input-group flex-nowrap">
									<span class="input-group-text" id="basic-addon1">Rp</span>
									<input type="number" class="form-control" name="kentang" min=0 value="<?php echo htmlentities($result['kentang']);?>">
								</div>
						</div>
						<div class="mb-3 col-md-3">
							<label class="form-label">Gula Merah Kelapa (Kg)</label>
								<div class="input-group flex-nowrap">
									<span class="input-group-text" id="basic-addon1">Rp</span>
									<input type="number" class="form-control" name="gula_merah" min=0 value="<?php echo htmlentities($result['gula_merah']);?>">
								</div>
						</div>
						<div class="mb-3 col-md-3">
							<label class="form-label">Kelapa (Butir)</label>
								<div class="input-group flex-nowrap">
									<span class="input-group-text" id="basic-addon1">Rp</span>
									<input type="number" class="form-control" name="kelapa" min=0 value="<?php echo htmlentities($result['kelapa']);?>">
								</div>
						</div>
						<div class="mb-3 col-md-3">
							<label class="form-label">Gas Elpiji 3 Kg (Tabung)</label>
								<div class="input-group flex-nowrap">
									<span class="input-group-text" id="basic-addon1">Rp</span>
									<input type="number" class="form-control" name="gas" min=0 value="<?php echo htmlentities($result['gas']);?>">
								</div>
						</div>
					</div>
							<?php }?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
				<button type="submit" class="btn btn-info" name="submit">Update</button>
			</div>
			</form>
			
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->