<?php
    include '../include/header.php';

    $query = $conn->prepare("SELECT * FROM mail_setting");
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
								<a href="">Mail Ayarları</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
                            <form action="../include/database-operations.php" method="post">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Mail Ayarları</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-5 ml-auto mr-auto">				
                                                    <div class="form-group">
                                                        <i class="fab fa-ioxhost mr-2"></i>
                                                        <label >SMTP Host</label>
                                                        <input type="text" class="form-control" name="smtphost" required placeholder="Email Giriniz" value="<?=$getQuery['mail_host']?>">
                                                        <small id="emailHelp2" class="form-text text-muted">Gmail: smtp.gmail.com <br>Yandex: smtp.yandex.com.tr </small>
                                                    </div>
                                                    <div class="form-group">  
                                                        <i class="fas fa-at mr-2"></i>
                                                        <label >SMPT E-posta Adresi</label>
                                                        <input type="email" class="form-control" name="smtpemail" required placeholder="Gelen Mailleri Yanıtlayacak E-mail Adres" value="<?=$getQuery['mail_sender']?>">
                                                        <small id="smtpemailHelp" class="form-text text-muted">demireltugran66@gmail.com</small>
                                                    </div>
                                                    <div class="form-group">
                                                        <i class="fas fa-key mr-2"></i>
                                                        <label >Şife</label>
                                                        <input type="password" class="form-control" name="smtppassword" required placeholder="Gelen Mailleri Yanıtlayacak E-mail Şifres" value="<?=$getQuery['mail_password']?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <i class="fas fa-address-card mr-2"></i>
                                                        <label >Yanıt Mail Adresi</label>
                                                        <input type="email" class="form-control" name="smtpreply" required placeholder="Kullanıcının Yanıtını Göndereceği Mail Adres" value="<?=$getQuery['mail_reply']?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <i class="fas fa-address-card mr-2"></i>
                                                        <label >Yanıt Mail Adresinin Ad Soyadı</label>
                                                        <input type="text" class="form-control" name="smtpnamesurname"  required placeholder="Kullanıcının Yanıtını Göndereceği Mail Adresin Ad Soyad" value="<?=$getQuery['mail_reply_name_surname']?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="card-action ">
                                        <div class="col-md-2 ml-auto mr-auto">
                                            <button type="submit" name="smtpsave" class="btn btn-icon btn-round btn-success mx-2">
                                                <i class="fa fa-check"></i>
                                            </button>
                                            <button type="submit" name="smtpcancel" class="btn btn-icon btn-round btn-danger mx-2">
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