<?php 
	include '../include/header.php'; 

	// database connection
	$auhtor = $conn->prepare("SELECT * FROM author WHERE author_category=:agenda");
	$agenda = $conn->prepare("SELECT * FROM agenda");
     
	$agenda->execute();
	$auhtor->execute(array(
        'agenda'=>'Gündem'
    ));

    $getAgenda = $agenda->fetch(PDO::FETCH_ASSOC);
?>
    <!-- Forms-->

			<div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Kategoriler</h4>
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
								<a href="category-agenda.php">Kategoriler</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href=agenda.php>Gündem</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<form action="../include/database-operations.php" method="POST" enctype='multipart/form-data' >
								<div class="card">
									<div class="card-header">
										<div class="card-title">TD©</div>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-md-8 ml-auto mr-auto">	

													<div class="form-group">
                                                        <label >Foroğraf</label>
                                                        <input type="file" name="images" class="form-control-file" id="exampleFormControlFile1">
													</div>					
													<div class="form-group">
														<label >Başlık</label>
														<input style="color: white;" type="text" class="form-control" name="title" id="agendatitle">
													</div>							
													<div class="form-group">
														<label >Konu</label>
                                                        <textarea class="form-control" name="subject" rows="5">
                                                        </textarea>
													</div>  
                                                    <div class="form-group">
                                                        <label >İçerik</label>
                                                        <textarea style="color: white;" class="form-control ckeditor" name="content" id="agendacontent">
                                                        </textarea>
                                                    </div>							
													<div class="form-group">
														<label >Anahtar Kelirmeler</label>
														<input style="color: white;" type="text" class="form-control" name="keywords" id="keywords" maxlength="160">
														<small id="keywordsHelp" class="form-text text-muted">Anahtar kelimeleri , ile ayırınız. En fazla 160 karakter olacak şekilde giriniz.</small>
													</div>
                                                    <div class="form-group">
                                                        <label >Yazar Seçiniz</label>
                                                        <select class="form-control form-control-lg" id="largeSelect" name="author_id">
                                                            <?php while( $getAuthor = $auhtor->fetch(PDO::FETCH_ASSOC)) {?>
                                                                <option value="<?=$getAuthor['author_id']?>">
                                                                    <?=$getAuthor['author_name_surname']?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>	
											</div>
										</div>
									</div>
									<div class="card-action ">
										<div class="col-md-2 ml-auto mr-auto">
											<button type="submit" name="agendasave" class="btn btn-icon btn-round btn-success mx-2" data-original-title="Kaydet">
												<i class="fa fa-check"></i>
											</button>
											<button type="submit" name="authorcancel" class="btn btn-icon btn-round btn-danger mx-2" data-original-title="İptal">
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