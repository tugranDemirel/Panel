<?php 
	include '../include/header.php'; 

	// database connection
	$query = $conn->prepare("SELECT * FROM messages WHERE message_id=:id");
	$query->execute(array(
		'id'=>$_GET['id']
	));
	$getMessages = $query->fetch(PDO::FETCH_ASSOC);
?>
    <!-- Forms-->

			<div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Mesajlar</h4>
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
								<a href="messages.php">Mesajlar</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<form action="../include/database-operations.php" method="POST">
								<div class="card">
									<div class="card-header">
										<div class="card-title">TD©</div>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-md-8 ml-auto mr-auto">
												<form action="../include/database-operations.php" method="POST" enctype="multipart/form-data" role="form">
													<div class="form-group">
														<label >Mail Gönderen Ad Soyad </label>
														<input style="color: black;" type="text" class="form-control" name="nameSurname" value="<?= $getMessages['message_sender'] ?> " readonly>
													</div>							
													<div class="form-group">
														<label >Gönderen Email</label>
														<input style="color: black;" type="email" class="form-control" name="mail" value="<?= $getMessages['message_mail'] ?>" readonly>
													</div>							
													<div class="form-group">
														<label >Gönderen Mail Konu</label>
														<input style="color: black;" type="text" class="form-control" name="subject" value="<?= $getMessages['message_subject']?> " readonly>
													</div>  
                                                    <div class="form-group">
                                                        <label >Gönderen Mail İçerik</label>
                                                        <textarea style="color: black;" class="form-control " rows="5" readonly>
                                                            <?= $getMessages['message_content']?>
                                                        </textarea>
                                                    </div>
                                                    <hr style="background-color: white;">
                                                    <div class="form-group">
                                                        <label >Yanıtınız</label>
                                                        <textarea style="color: white;" class="form-control ckeditor" name="content" id="content" rows="5">
                                                        </textarea>
                                                    </div>
												</form>
											</div>
										</div>
									</div>
									<div class="card-action ">
										<div class="col-md-2 ml-auto mr-auto">
                                            <input type="hidden" name="message_id" value="<?= $getMessages['message_id']?>">
											<button type="submit" name="messagereply" class="btn btn-icon btn-round btn-success mx-2">
												<i class="fa fa-check"></i>
											</button>
											<button type="submit" name="messagecancel" class="btn btn-icon btn-round btn-danger mx-2">
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