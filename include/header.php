<?php
    error_reporting(0);
    require 'database-operations.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Tuğran Demirel | TD</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="../assets/img/icon.ico" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="../assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['../assets/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/atlantis.min.css">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="../assets/css/demo.css">
	<!-- CKEditor -->
	<script src="../assets/ckeditor/ckeditor.js"></script>
</head>
<body data-background-color="dark">
	<div class="wrapper">
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="dark2">
				
				<a href="index.php" class="logo">
					<img src="../assets/img/logo.svg" alt="navbar brand" class="navbar-brand">
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->
			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="dark">
                    Deneme
			</nav>
			<!-- End Navbar -->
		</div>

		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2" data-background-color="dark2">
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<img src="../assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									Tuğran Demirel
									<span class="user-level">Admin</span>
									<span class="caret"></span>
								</span>
							</a>
							<div class="clearfix"></div>

							<div class="collapse in" id="collapseExample">
								<ul class="nav">
									<li>
										<a href="#profile">
											<span class="link-collapse">My Profile</span>
										</a>
									</li>
									<li>
										<a href="#edit">
											<span class="link-collapse">Edit Profile</span>
										</a>
									</li>
									<li>
										<a href="#settings">
											<span class="link-collapse">Settings</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<ul class="nav nav-primary">
						<li class="nav-item" style="cursor: pointer;">
							<a href="../data/index.php">
								<i class="fas fa-home"></i>
								<p>Anasayfa</p>
								<span ></span>
							</a>
						</li>
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Components</h4>
						</li>
                        <li class="nav-item" style="cursor: pointer;">
							<a href="messages.php">
                                <i class="fas fa-inbox"></i>
								<p>Mesaj Kutusu</p>
								<span ></span>
							</a>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="#users">
                                <i class="fas fa-users"></i>
								<p>Kullanıcılar</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="users">
								<ul class="nav nav-collapse">
									<li>
										<a href="../data/author.php">
											<span class="sub-item">Yazarlar</span>
										</a>
                                    </li>
								</ul>
							</div>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="#tables">
                                <i class="fa fa-list-alt" aria-hidden="true"></i>
								<p>Kategoriler</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="tables">
								<ul class="nav nav-collapse">
									<li>
										<a href="category-agenda.php">
											<span class="sub-item">Gündem</span>
										</a>
									</li>
									<li>
										<a href="category-technology.php">
											<span class="sub-item">Teknoloji</span>
										</a>
									</li>
									<li>
										<a href="category-literature.php">
											<span class="sub-item">Edebiyat</span>
										</a>
									</li>
									<li>
										<a href="category-travel.php">
											<span class="sub-item">Seyehat Gezi</span>
										</a>
									</li>
									<li>
										<a href="category-health-life.php">
											<span class="sub-item">Sağlık Yaşam</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="#charts">
								<i class="fas fa-cog"></i>
								<p>Ayarlar</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="charts">
								<ul class="nav nav-collapse">
									<li>
										<a href="../data/settings.php">
											<span class="sub-item">Site Ayarları</span>
										</a>
                                    </li>
                                    <li>
										<a href="../data/contact.php">
											<span class="sub-item">İletişim Ayarları</span>
										</a>
									</li>
									<li>
										<a href="../data/social-media.php">
											<span class="sub-item">Sosyal Medya Ayarları</span>
										</a>
									</li>
									<li>
										<a href="../data/mail-setting.php">
											<span class="sub-item">Mail Ayarları</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
                        <li class="nav-item" style="cursor: pointer; ">
                            <a href="messages.php">
                                <i style="color: red;" class="fas fa-sign-out-alt"></i>
                                <p style="color: red;" >Çıkış</p>
                                <span ></span>
                            </a>
                        </li>
					</ul>
				</div>
			</div>
		</div>
		<div class="main-panel">


		<!-- End Sidebar -->