<div class="topnav">
	<div class="container-fluid">
		<nav class="navbar navbar-dark navbar-expand-lg topnav-menu">

			<div class="collapse navbar-collapse" id="topnav-menu-content">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="../../module=dashboard">
							<i class="uil-dashboard me-1"></i>Dashboard
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../harga/module=harga">
							<i class="uil-chart-growth me-1"></i>Harga Bahan Pokok
						</a>
					</li>
					<?php if($_SESSION['login_saharga']){
							$id=$_SESSION['login_saharga'];
							$sql ="SELECT * FROM administrator WHERE level='$id'";
								$query = mysqli_query($koneksidb,$sql);
								$results = mysqli_fetch_array($query);
								if($results['level']!=="Bidek"  && $results['level']!=="Ekbang"){?>
					<li class="nav-item">
						<a class="nav-link" href="../het/module=het">
							<i class="uil-window-restore me-1"></i>Harga Eceran Tertinggi (HET)
						</a>
					</li>
					<?php }}?>
				</ul>
			</div>
		</nav>
	</div>
</div>