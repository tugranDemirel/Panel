<?php 
	include '../include/header.php'; 

	$query = $conn->prepare("SELECT * FROM settings");
	$query->execute();
	$getQuery = $query->fetch(PDO::FETCH_ASSOC);

?>
    <!-- Forms-->

			<div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Ayarlar</h4>
						<ul class="breadcrumbs">
							<li class="nav-home">
								<a href="index.php">
									<i class="icon-home"></i>
								</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="#">Ayarlar</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="#">Site Ayarları</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<form action="../include/database-operations.php" method="POST" enctype="multipart/form-data" >
								<div class="card">
									<div class="card-header">
										<div class="card-title">Site Ayarları</div>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-md-8 ml-auto mr-auto">
												<div class="form-group">
													<label >Logo</label>
													<img class="avatar avatar-xxl" src="../assets/img/logo<?= $getQuery['setting_logo']?>" alt="" srcset="">
												</div>
												<hr style="background: white;">
												<div class="form-group">
													<input type="file" name="logo" class="form-control-file"  >
												</div>
												<div class="form-group">
													<label >Site Başlık</label>
													<input type="text" class="form-control" name="title" placeholder="Site Başlığı" value="<?= $getQuery['setting_title']?>">
													<small id="site_title2" class="form-text text-muted">Asla Boş Bırakmayınız!</small>
												</div>							
												<div class="form-group">
													<label >Site Anahtar Kelimeleri</label>
													<input type="text" class="form-control" name="keywords" placeholder="Site Keywords" value="<?= $getQuery['setting_keywords']?>">
													<small id="site_keywords2" class="form-text text-muted">Anahtar kelimeleri , ile ayırınız. En fazla 260 karakter olabilir.</small>
												</div>							
												<div class="form-group">
													<label >Site Yazarı</label>
													<input type="text" class="form-control" name="author" placeholder="Site Yazarı" value="<?= $getQuery['setting_author']?>">
												</div>
												<div class="form-group">
													<label >Site Açıklaması</label>
													<textarea class="form-control" name="description" rows="5" value="<?= $getQuery['setting_description']?>">
													</textarea>
													<small id="site_keywords2" class="form-text text-muted">En fazla 160 karakter olabilir.</small>
												</div>							
												<div class="form-group">
													<label >Site Adresi</label>
													<input type="text" class="form-control" name="url" placeholder="Site Adresi" value="<?= $getQuery['site_url']?>">
												</div>
											</div>
										</div>
									</div>
									<div class="card-action ">
										<div class="col-md-2 ml-auto mr-auto">
											<button type="submit" name="settingssave" class="btn btn-icon btn-round btn-success mx-2">
												<i class="fa fa-check"></i>
											</button>
											<button type="submit" name="authorcancel" class="btn btn-icon btn-round btn-danger mx-2">
												<i class="far fa-window-close"></i>
											</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>	
<?php include '../include/footer.php'; ?>