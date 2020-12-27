<?php 
	include '../include/header.php'; 
	
	// database conn
	$query = $conn->prepare("SELECT * FROM messages");
	$query->execute();

?>
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
							<div class="card">
								<div class="card-body">
									<div class="table-responsive">
										<table id="add-row" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>Gönderen Adı-Soyadı</th>
													<th>Email Adres</th>
													<th>Konu</th>
													<th>Cevaplama </th>
													<th>DurumuTarih</th>
													<th style="width: 10%">İşlemler</th>
												</tr>
											</thead>
											<tbody>
												<?php while($getMessages = $query->fetch(PDO::FETCH_ASSOC)){?>
													<tr>
														<td><?= $getMessages['message_sender'] ?></td>
														<td><?= $getMessages['message_mail'] ?></td>
														<td><?= $getMessages['message_subject'] ?></td>
														<td><?= $getMessages['message_status'] ?></td>
														<td><?= $getMessages['message_date'] ?></td>
														<td>
															<div class="form-button-action">
																<a type="submit" data-toggle="tooltip" href="reply-message.php?id=<?= $getMessages['message_id']?>" class="btn btn-link btn-success btn-lg" data-original-title="Yanıtla">
                                                                    <i class="fas fa-reply"></i>
																</a>
																<form action="../include/database-operations.php" method="post">
																	<input type="hidden" name="id" value="<?= $getMessages['message_id']?>">
																	<button type="submit" name="removemessage" data-toggle="tooltip" class="btn btn-link btn-danger" data-original-title="Sil">
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