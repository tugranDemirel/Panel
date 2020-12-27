<?php 
	include '../include/header.php'; 
	
	// database conn
	$query = $conn->prepare("SELECT * FROM author");
	$query->execute();

?>

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
								<a href="">Yazarlar</a>
							</li>
						</ul>
					</div>
					<?php if($_GET['status'] == "yes"){ ?>
						<div class="alert alert-success mt-2" role="alert">
							İşlem Başarılı
						</div>
						<?php 
						}
						elseif($_GET['status'] == "no"){ ?>
						<div class="alert alert-danger mt-2" role="alert">
							İşlem Başarısız
						</div>
					<?php } ?>
					<div class="row">
						<div class="col-md-12">
                            <form action="../include/database-operations.php" method="post">
							    <div class="card">
								<div class="card-header">
									<div class="d-flex align-items-center">
										<h4 class="card-title">Yazar Ekle</h4>
										<a class="btn btn-primary btn-round ml-auto" href="author-add.php" type="submit" name="author-add" >
											<i class="fa fa-plus"></i>
											Yazar Ekle
                                        </a>
									</div>
								</div>
								<div class="card-body">

									<div class="table-responsive">
										<table id="add-row" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>Yazar Adı-Soyadı</th>
													<th>Yetki</th>
													<th>Kategori</th>
													<th>Mail Adresi</th>
													<th>Kayıt Tarih</th>
													<th style="width: 10%">İşlemler</th>
												</tr>
											</thead>
											<tbody>
												<?php while($getAuthor = $query->fetch(PDO::FETCH_ASSOC)){?>
													<tr>
														<td>
                                                            <?= $getAuthor['author_name_surname'] ?>
                                                            <input type="hidden" name="author_img" value="<?=$getAuthor['author_image']?>">
                                                        </td>
														<td><?= $getAuthor['author_authority'] ?></td>
														<td><?= $getAuthor['author_category'] ?></td>
														<td><?= $getAuthor['author_mail'] ?></td>
														<td><?= $getAuthor['author_datetime'] ?></td>
														<td>
															<div class="form-button-action">
																<a type="submit" data-toggle="tooltip" href="author-display.php?id=<?= $getAuthor['author_id']?>" class="btn btn-link btn-success btn-lg" data-original-title="Görüntüle">
																	<i class="far fa-eye"></i>
																</a>
																<a type="button" data-toggle="tooltip" href="author-edit.php?id=<?= $getAuthor['author_id']?>" class="btn btn-link btn-primary btn-lg" data-original-title="Düzenle">
																	<i class="fa fa-edit"></i>
																</a>
																	<input type="hidden" name="id" value="<?= $getAuthor['author_id']?>">
																	<button type="submit" name="authorremove" data-toggle="tooltip" class="btn btn-link btn-danger" data-original-title="Kaldır">
																		<i class="fa fa-times"></i>
																	</button>
															</div>
														</td>
													</tr>
												<?php }?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
                            </form>
						</div>
					</div>
				</div>
			</div>
<?php include '../include/footer.php'; ?>