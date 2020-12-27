<?php
    include '../include/header.php';

    $query= $conn->prepare("SELECT * FROM social_media");
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
								<a href="#">Ayarlar</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="#">Sosyal Medya Ayarları</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<form action="../include/database-operations.php" method="post">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Sosyal Medya Ayarları</div>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-md-6 ml-auto mr-auto">
												<div class="form-group">
													<i class="icon-social-facebook mr-2"></i>
													<label >Facebook Kullanıcı Adı</label>
													<div class="input-group mb-3">
														<div class="input-group-prepend">
															<span class="input-group-text" id="basic-addon3">https://facebook.com/</span>
														</div>
														<input type="text" class="form-control" name="facebook" aria-describedby="basic-addon3" value="<?= $getQuery['social_face']?>">
													</div>
												</div>
												<div class="form-group">
													<i class="icon-social-twitter mr-2"></i>
													<label >Twitter Kullanıcı Adı</label>
													<div class="input-group mb-3">
														<div class="input-group-prepend">
															<span class="input-group-text" id="basic-addon3">https://twitter.com/</span>
														</div>
														<input type="text" class="form-control" name="twitter" aria-describedby="basic-addon3" value="<?= $getQuery['social_twitter']?>">
													</div>
												</div>
												<div class="form-group">
													<i class="icon-social-linkedin mr-2"></i>
													<label >Linkedin Kullanıcı Adı</label>
													<div class="input-group mb-3">
														<div class="input-group-prepend">
															<span class="input-group-text" id="basic-addon3">https://linkedin.com/in/</span>
														</div>
														<input type="text" class="form-control" name="linkedin" aria-describedby="basic-addon3" value="<?= $getQuery['social_linkedin']?>">
													</div>
												</div>	
												<div class="form-group">
													<i class="icon-social-instagram mr-2"></i>
													<label >İnstagram Kullanıcı Adı</label>
													<div class="input-group mb-3">
														<div class="input-group-prepend">
															<span class="input-group-text" id="basic-addon3">https://www.instagram.com/</span>
														</div>
														<input type="text" class="form-control" name="instagram" aria-describedby="basic-addon3" value="<?= $getQuery['social_instagram']?>">
													</div>
												</div>
												<div class="form-group">
													<i class="fab fa-google-plus-g mr-2"></i>
													<label >Google Plus Kullanıcı Adı</label>
													<div class="input-group mb-3">
														<div class="input-group-prepend">
															<span class="input-group-text" id="basic-addon3">https://googleplus.com/</span>
														</div>
														<input type="text" class="form-control" name="gplus" aria-describedby="basic-addon3" value="<?= $getQuery['social_gplus']?>">
													</div>
												</div>
												<div class="form-group">
													<i class="icon-social-youtube mr-2"></i>
													<label >Youtube Kullanıcı Adı</label>
													<div class="input-group mb-3">
														<div class="input-group-prepend">
															<span class="input-group-text" id="basic-addon3">https://youtube.com/in/</span>
														</div>
														<input type="text" class="form-control" name="youtube" aria-describedby="basic-addon3" value="<?= $getQuery['social_youtube']?>">
													</div>
												</div>	
												<div class="form-group">
													<i class="icon-social-github mr-2"></i>
													<label >Github Kullanıcı Adı</label>
													<div class="input-group mb-3">
														<div class="input-group-prepend">
															<span class="input-group-text" id="basic-addon3">https://github.com/</span>
														</div>
														<input type="text" class="form-control" name="github" aria-describedby="basic-addon3" value="<?= $getQuery['social_github']?>">
													</div>
												</div>	
												<div class="form-group">
													<i class="icon-social-pinterest mr-2"></i>
													<label >Pinterest Kullanıcı Adı</label>
													<div class="input-group mb-3">
														<div class="input-group-prepend">
															<span class="input-group-text" id="basic-addon3">https://www.pinterest.com/</span>
														</div>
														<input type="text" class="form-control" name="pinterest" aria-describedby="basic-addon3" value="<?= $getQuery['social_pinterest']?>">
													</div>
												</div>		
											</div>
										</div>
									</div>
									<div class="card-action ">
										<div class="col-md-2 ml-auto mr-auto">
											<button type="submit" name="socailmediasave" class="btn btn-icon btn-round btn-success mx-2">
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