<?php include '../include/header.php'; ?>
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
							<div class="card">
								<div class="card-header">
									<div class="card-title">TD©</div>
								</div>
								<form action="../include/database-operations.php" method="POST" enctype="multipart/form-data" role="form">
									<div class="card-body">
										<div class="row">
											<div class="col-md-8 ml-auto mr-auto">
													<div class="form-group">
														<label >Fotoğraf</label>
														<input type="file" name="images"class="form-control-file" id="exampleFormControlFile1">
														<input type="hidden" name="id">
													</div>
													<div class="form-group">
														<label >Ad Soyad</label>
														<input type="text" class="form-control" name="nameSurname" id="nameSurname" placeholder="Adını Soyadı">
														<small id="nameSurnameHelp" class="form-text text-muted">Asla Boş Bırakmayınız!</small>
													</div>							
													<div class="form-group">
														<label >Yetki</label>
														<input type="text" class="form-control" name="authority" id="authority" placeholder="Yetki Sayısı">
														<small id="authorityHelp" class="form-text text-muted">Admin: 1 <br>Yazar: 2 <br>Moderatör: 3 <br>Üye: 4 <br> şeklinde numaralarını yazınız!</small>
													</div>							
													<div class="form-group">
														<label >Kategori</label>
														<input type="text" class="form-control" name="category" id="category" placeholder="Kategori Adı">
														<small id="categoryHelp" class="form-text text-muted">Teknoloji<br>Yaşam Sağlık<br>Gündem<br>Edebiyat<br>Seyehat Gezi<br>şeklinde isimlerini yazınız!</small>
													</div>							
													<div class="form-group">
														<label >Telefon Numarası</label>
														<input type="text" class="form-control phone" name="phone" id="phone" placeholder="Telefon Numarasını" maxlength="11" minlength="10">
													</div>							
													<div class="form-group">
														<label >Email Adresi</label>
														<input type="email" class="form-control" name="email" id="email" placeholder="Email Adresi">
													</div>
											</div>
										</div>
									</div>
									<div class="card-action ">
										<div class="col-md-2 ml-auto mr-auto">
											<button type="submit" name="authorsave" class="btn btn-icon btn-round btn-success mx-2">
												<i class="fa fa-check"></i>
											</button>
											<button type="submit" name="authorcancel" class="btn btn-icon btn-round btn-danger mx-2">
												<i class="far fa-window-close"></i>
											</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>	
<?php include '../include/footer.php'; ?>