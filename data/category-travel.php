<?php 
	include '../include/header.php';
	// database conn
    $query = $conn->prepare("SELECT * FROM travel LEFT JOIN author ON author.author_id = travel.author_id");
    $query->execute();


?>
            <div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Seyehat Gezi</h4>
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
								<a href="category-travel.php">Kategoriler</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="travel.php">Seyehat Gezi</a>
							</li>
						</ul>
					</div>
					<?php if($_GET['status'] == "yes"){ ?>
						<div class="alert alert-success mt-2" role="alert">
							İşlem Başarılı
						</div>
                    <?php} elseif($_GET['status'] == "no"){ ?>
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
                                            <a class="btn btn-primary btn-round ml-auto" href="travel.php" type="submit" name="travel-add" >
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
                                                        <th>İçerik</th>
                                                        <th>Yayınlanma Tarihi</th>
                                                        <th style="width: 10%">İşlemler</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php while($getTravel = $query->fetch(PDO::FETCH_ASSOC)) { ?>
                                                        <input type="hidden" name="auhtor_id" value="<?= $getTravel['author_id'] ?>">
                                                        <input type="hidden" name="travel_id" value="<?= $getTravel['travel_id'] ?>">

                                                        <tr>
                                                            <td>
                                                                <img class="avatar avatar-xl" src="../assets/img/travel/<?= $getTravel['travel_bgimage'] ?>" alt="<?= $getTravel['travel_bgimage'] ?>">

                                                            </td>
                                                            <td><?= $getTravel['author_name_surname'] ?></td>
                                                            <td><?= $getTravel['travel_title'] ?></td>
                                                            <td><?= $getTravel['travel_subject'] ?></td>
                                                            <td><?= $getTravel['travel_content'] ?></td>
                                                            <td><?= $getTravel['travel_datetime'] ?></td>
                                                            <td>
                                                                <div class="form-button-action">
                                                                    <a type="submit" data-toggle="tooltip" href="travel-display.php?id=<?= $getTravel['travel_id']?>" class="btn btn-link btn-success btn-lg" data-original-title="Görüntüle">
                                                                        <i class="far fa-eye"></i>
                                                                    </a>
                                                                    <a type="button" data-toggle="tooltip" href="travel-edit.php?id=<?= $getTravel['travel_id']?>" class="btn btn-link btn-primary btn-lg" data-original-title="Düzenle">
                                                                        <i class="fa fa-edit"></i>
                                                                    </a>
                                                                    <form action="../include/database-operations.php" method="post" >
                                                                        <input type="hidden" name="bg_name" value="<?= $getTravel['agenda_bgimage']?>">
                                                                        <input type="hidden" name="id" value="<?= $getTravel['travel_id']?>">
                                                                        <button type="submit" name="travelremove" data-toggle="tooltip" class="btn btn-link btn-danger" data-original-title="Kaldır">
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