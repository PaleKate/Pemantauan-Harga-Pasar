<div class="navbar-custom topnav-navbar">
	<div class="container-fluid">

		<!-- LOGO -->
		<a href="" class="topnav-logo">
			<span class="topnav-logo-lg">
				<img src="../../assets/images/logo.png" alt="" height="40">
			</span>
		</a>

		<ul class="list-unstyled topbar-menu float-end mb-0">
			
			<li class="notification-list">
				<a class="nav-link end-bar-toggle" href="javascript: void(0);">
					<i class="dripicons-gear noti-icon"></i>
				</a>
			</li>

			<li class="dropdown notification-list d-xl-none">
				<a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
					<i class="dripicons-search noti-icon"></i>
				</a>
				<div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
					<form class="p-3">
						<input type="text" class="form-control" placeholder="Search ...">
					</form>
				</div>
			</li>

			<li class="dropdown notification-list">
				<a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" id="topbar-userdrop" href="#" role="button" aria-haspopup="true" aria-expanded="false">
					<span class="account-user-avatar"> 
						<img src="../../assets/images/logo.png" alt="user-image" class="rounded-circle">
					</span>
					<?php
							$id=$_SESSION['login_saharga'];
							$sql ="SELECT * FROM administrator WHERE level='$id'";
								$query = mysqli_query($koneksidb,$sql);
								$results = mysqli_fetch_array($query);
					?>
					<span>
						<span class="account-user-name"><?php echo $results['username'];?></span>
						<span class="account-position"><?php echo $results['level'];?></span>
					</span>
				</a>
				<div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown" aria-labelledby="topbar-userdrop">
					<!-- item-->
					<div class=" dropdown-header noti-title">
						<h6 class="text-overflow m-0">Welcome !</h6>
					</div>

					<!-- item-->
					<a href="../profil/module=profil" class="dropdown-item notify-item">
						<i class="mdi mdi-account-circle me-1"></i>
						<span>Profil</span>
					</a>

					<!-- item-->
					<a href="../includes/module=logout" class="dropdown-item notify-item">
						<i class="mdi mdi-logout me-1"></i>
						<span>Logout</span>
					</a>

				</div>
			</li>

		</ul>
		<a class="navbar-toggle" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
			<div class="lines">
				<span></span>
				<span></span>
				<span></span>
			</div>
		</a>
		<div class="app-search dropdown">
			<form>
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Search..." id="top-search">
					<span class="mdi mdi-magnify search-icon"></span>
					<button class="input-group-text  btn-primary" type="submit">Search</button>
				</div>
			</form>

		</div>
	</div>
</div>