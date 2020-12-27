<?php 
	include '../include/header.php';

	$query = $conn->prepare("SELECT * FROM contact");
	$query->execute();
	$getQuery = $query->fetch(PDO::FETCH_ASSOC);
?>
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
								<a href="">Ayarlar</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="">İletişim Ayarları</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<form action="../include/database-operations.php" method="post">
								<div class="card">
									<div class="card-header">
										<div class="card-title">İletişim Ayarları</div>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-md-8 ml-auto mr-auto">				
													<div class="form-group">
														<i class="fas fa-at mr-2"></i>
														<label >Email Adres</label>
														<input type="email" class="form-control" name="email" required placeholder="Email Giriniz" value="<?=$getQuery['contact_email']?>">
														<small id="emailHelp2" class="form-text text-muted">Asla boş bırakmayınız!</small>
													</div>
													<div class="form-group">
														<i class="icon-phone mr-2"></i>
														<label >Telefon Numarası</label>
														<input type="text" class="form-control phone" name="phone"  required placeholder="Telefon Numarası Giriniz" value="<?=$getQuery['contact_phone']?>">
														<small id="phoneHelp" class="form-text text-muted">Asla boş bırakmayınız!</small>
													</div>
													<div class="form-group">
														<i class="icon-phone mr-2"></i>
														<label >2. Telefon Numarası</label>
														<input type="text" class="form-control phone" name="phone2" placeholder="Telefon Numarası Giriniz" value="<?=$getQuery['contact_phone2']?>">
														<small id="phoneHelp2" class="form-text text-muted">İsteğe Bağlı!</small>
													</div>    
													<div class="form-group">
														<i class="fas fa-fax mr-2"></i>
														<label >Fax Numarası</label>
														<input type="text" class="form-control" name="fax" placeholder="Fax Numarası Giriniz" value="<?=$getQuery['contact_fax']?>">    
													</div>  
													<div class="form-group">
														<i class="fas fa-address-card mr-2"></i>
														<label >Adres</label>
														<input type="text" class="form-control" name="adress" placeholder="Adres Giriniz" value="<?=$getQuery['contact_adress']?>">    
													</div>
												</div>
											</div>
										</div>
									<div class="card-action ">
										<div class="col-md-2 ml-auto mr-auto">
											<button type="submit" name="contactsave" class="btn btn-icon btn-round btn-success mx-2">
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