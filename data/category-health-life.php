<?php 
	include '../include/header.php';
	// database conn
    $query = $conn->prepare("SELECT * FROM healt_life LEFT JOIN author ON author.author_id = healt_life.author_id");
    $query->execute();


?>
            <div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Sağlık Yaşam</h4>
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
								<a href="category-health-life.php">Kategoriler</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="healthLife.php">Sağlık Yaşam</a>
							</li>
						</ul>
					</div>
                    <?php if(isset($_GET['status']) && $_GET['status']  == "yes"){ ?>
                        <div class="alert alert-success mt-2" role="alert">
                            İşlem Başarılı
                        </div>
                        <?php } elseif(isset($_GET['status']) && $_GET['status']  == "no"){ ?>
                        <div class="alert alert-danger mt-2" role="alert">
                            İşlem Başarısız
                        </div>
                    <?php } ?>
					<div class="row">
						<div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex align-items-center">
                                            <h4 class="card-title">Yazı Ekle</h4>
                                            <a class="btn btn-primary btn-round ml-auto" href="healthLife.php" type="submit" name="healthLife-add" >
                                                <i class="fa fa-plus"></i>
                                                Yazı Ekle
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="add-row" class="display table table-striped table-hover" >
                                                <thead>
                                                    <tr>
                                                        <th>Resim</th>
                                                        <th>Yazar Adı-Soyadı</th>
                                                        <th>Başlık</th>
                                                        <th>Konusu</th>
                                                        <th>Yayınlanma Tarihi</th>
                                                        <th style="width: 10%">İşlemler</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php while($gethealthLife = $query->fetch(PDO::FETCH_ASSOC)) { ?>
                                                        <input type="hidden" name="auhtor_id" value="<?= $gethealthLife['author_id'] ?>">
                                                        <input type="hidden" name="healthLife_id" value="<?= $gethealthLife['healthLife_id'] ?>">

                                                        <tr>
                                                            <td>
                                                                <img class="avatar avatar-xl" src="../assets/img/healthLife/<?= $gethealthLife['healthLife_bgimage'] ?>" alt="<?= $gethealthLife['healthLife_bgimage'] ?>">

                                                            </td>
                                                            <td><?= $gethealthLife['author_name_surname'] ?></td>
                                                            <td><?= $gethealthLife['healthLife_title'] ?></td>
                                                            <td><?= $gethealthLife['healthLife_subject'] ?></td>
                                                            <td><?= $gethealthLife['healthLife_datetime'] ?></td>
                                                            <td>
                                                                <div class="form-button-action">
                                                                    <a type="submit" data-toggle="tooltip" href="healthLife-display.php?id=<?= $gethealthLife['healthLife_id']?>" class="btn btn-link btn-success btn-lg" data-original-title="Görüntüle">
                                                                        <i class="far fa-eye"></i>
                                                                    </a>
                                                                    <a type="button" data-toggle="tooltip" href="healthLife-edit.php?id=<?= $gethealthLife['healthLife_id']?>" class="btn btn-link btn-primary btn-lg" data-original-title="Düzenle">
                                                                        <i class="fa fa-edit"></i>
                                                                    </a>
                                                                    <form action="../include/database-operations.php" method="post" >
                                                                        <input type="hidden" name="bg_name" value="<?= $gethealthLife['healthLife_bgimage']?>">
                                                                        <input type="hidden" name="id" value="<?= $gethealthLife['healthLife_id']?>">
                                                                        <button type="submit" name="healthLiferemove" data-toggle="tooltip" class="btn btn-link btn-danger" data-original-title="Kaldır">
                                                                            <i class="fa fa-times"></i>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php }?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
						</div>
					</div>
				</div>
			</div>
<?php include '../include/footer.php'; ?>