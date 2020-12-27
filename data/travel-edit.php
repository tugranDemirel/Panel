<?php
include '../include/header.php';

// database connection
$travel = $conn->prepare("SELECT * FROM travel INNER JOIN author ON author.author_id = travel.author_id WHERE travel_id=:id AND author.author_category=:category ");
$author = $conn->prepare("SELECT * FROM author WHERE author_category=:category");

$travel->execute(array(
    'id' => $_GET['id'],
    'category' => 'Seyehat Gezi'
));
$author->execute([
    'category' => 'Seyehat Gezi'
]);

$getTravel = $travel->fetch(PDO::FETCH_ASSOC);
$getAuthor = $author->fetchAll(PDO::FETCH_ASSOC);

?>
    <!-- Forms-->

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
        <div class="row">
            <div class="col-md-12">
                <form action="../include/database-operations.php" method="POST" enctype='multipart/form-data'>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">TD©</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8 ml-auto mr-auto">
                                    <div class="form-group">
                                        <img class="avatar avatar-xxl" src="../assets/img/travel/<?= $getTravel['travel_bgimage'] ?>" alt="<?= $getTravel['travel_bgimage'] ?>" srcset="">
                                    </div>
                                    <hr style="background-color: white;">
                                    <div class="form-group">
                                        <input type="file" name="travelimages" class="form-control-file" id="exampleFormControlFile1">
                                    </div>
                                    <div class="form-group">
                                        <label>Başlık</label>
                                        <input style="color: white;" type="text" class="form-control" name="traveltitle" id="traveltitle" value="<?= $getTravel['travel_title'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Konu</label>
                                        <textarea class="form-control" name="travelsubject" rows="5">
                                            <?= $getTravel['travel_subject'] ?>
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>İçerik</label>
                                        <textarea style="color: white;" class="form-control ckeditor" name="travelcontent" id="travelcontent">
                                            <?= $getTravel['travel_content'] ?>
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Anahtar Kelirmeler</label>
                                        <input style="color: white;" type="text" class="form-control" name="travelkeywords" id="travelkeywords" maxlength="160"
                                               value="<?= $getTravel['travel_keywords'] ?>">
                                        <small id="keywordsHelp" class="form-text text-muted">Anahtar kelimeleri , ile
                                            ayırınız. En fazla 160 karakter olacak şekilde giriniz.</small>
                                    </div>
                                    <div class="form-group">
                                        <label>Yazar Seçiniz</label>
                                        <select class="form-control form-control-lg" id="largeSelect" name="author_id">
                                            <?php foreach ($getAuthor as $row ):  ?>
                                                <option <?= $row['author_id'] == $getTravel['author_id'] ? 'selected' : NULL ?> value="<?= $row['author_id'] ?>">
                                                    <?= $row['author_name_surname'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-action ">
                            <div class="col-md-2 ml-auto mr-auto">
                                <input type="hidden" name="travel_id" value="<?= $getTravel['travel_id'] ?>">
                                <button type="submit" name="traveledit" class="btn btn-icon btn-round btn-success mx-2">
                                    <i class="fa fa-check"></i>
                                </button>
                                <button type="submit" name="travelcancel"
                                        class="btn btn-icon btn-round btn-danger mx-2">
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