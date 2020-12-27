<?php 

	include '../include/header.php'; 

	// database conn
	$query = $conn->prepare("SELECT * FROM author WHERE author_id=:id");
	$query->execute(array(
		'id'=>$_GET['id']
	));
	$getQuery = $query->fetch(PDO::FETCH_ASSOC);
?>
    <!-- Forms-->

			<div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Kullanıcılar</h4>
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
								<a href="author.php">Kullanıcılar</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="author-add.php">Yazar Ekle</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<form action="../include/database-operations.php" method="post">
								<div class="card">
									<div class="card-header">
										<div class="card-title">TD©</div>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-md-8 ml-auto mr-auto">
												<form action="" method="" enctype="multipart/form-data">
													<div class="form-group">
														<img class="avatar avatar-xxl" src="../assets/img/author/<?= $getQuery['author_image']?>" alt="<?= $getQuery['author_image']?>">
													</div>
													<hr>
													<div class="form-group">
														<label >Ad Soyad</label>
														<input style="color: black;" type="text" class="form-control" name="nameSurname" id="nameSurname" placeholder="Adını Soyadı" value="<?= $getQuery['author_name_surname'] ?>" readonly >
														<small id="site_title2" class="form-text text-muted">Asla Boş Bırakmayınız!</small>
													</div>							
													<div class="form-group">
														<label >Yetki</label>
														<input  style="color: black;" type="text" class="form-control" name="authority" id="authority" placeholder="Yetki Sayısı" value="<?= $getQuery['author_authority'] ?>" readonly >
														<small id="authorityHelp" class="form-text text-muted">Admin: 1 <br>Yazar: 2 <br>Moderatör: 3 <br>Üye: 4 <br> şeklinde numaralarını yazınız!</small>
													</div>							
													<div class="form-group">
														<label >Kategori</label>
														<input  style="color: black;" type="text" class="form-control" name="category" id="category" placeholder="Kategori Adı" value="<?= $getQuery['author_category'] ?>" readonly >
														<small id="categoryHelp" class="form-text text-muted">Teknoloji<br>Yaşam Sağlık<br>Gündem<br>Edebiyat<br>şeklinde numaralarını yazınız!</small>
													</div>							
													<div class="form-group">
														<label >Telefon Numarası</label>
														<input  style="color: black;" type="text" class="form-control" name="phone" id="phone" placeholder="Telefon Numarasını" value="<?= $getQuery['author_phone'] ?>" readonly >
													</div>							
													<div class="form-group">
														<label >Email Adresi</label>
														<input  style="color: black;" type="email" class="form-control" name="email" id="email" placeholder="Email Adresi" value="<?= $getQuery['author_mail'] ?>" readonly >
													</div>
												</form>
											</div>
										</div>
									</div>
									<div class="card-action ">
										<div class="col-md-1 ml-auto mr-auto">
											<a href="author.php" type="submit" name="authorcancel" class="btn btn-icon btn-round btn-success mx-2">
												<i class="fas fa-arrow-left"></i>
											</a>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>	
<?php include '../include/footer.php'; ?>