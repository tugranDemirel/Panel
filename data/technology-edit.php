<?php
include '../include/header.php';

// database connection
$technology = $conn->prepare("SELECT * FROM technology INNER JOIN author ON author.author_id = technology.author_id WHERE technology_id=:id AND author.author_category=:category ");
$author = $conn->prepare("SELECT * FROM author WHERE author_category=:category");

$technology->execute(array(
    'id' => $_GET['id'],
    'category' => 'Teknoloji'
));
$author->execute([
    'category' => 'Teknoloji'
]);

$getTechnology = $technology->fetch(PDO::FETCH_ASSOC);
$getAuthor = $author->fetchAll(PDO::FETCH_ASSOC);

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
                    <a href="category-technology.php">Kategoriler</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="technology.php">Teknoloji</a>
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
                                        <img class="avatar avatar-xxl" src="../assets/img/technology/<?= $getTechnology['technology_bgimage'] ?>" alt="<?= $getTechnology['technology_bgimage'] ?>" srcset="">
                                        <input type="hidden" name="technology_img" value="<?= $getTechnology['technology_bgimage'] ?>">
                                    </div>
                                    <hr style="background-color: white;">
                                    <div class="form-group">
                                        <input type="file" name="technologyimages" class="form-control-file" id="exampleFormControlFile1">
                                    </div>
                                    <div class="form-group">
                                        <label>Başlık</label>
                                        <input style="color: white;" type="text" class="form-control" name="technologytitle" id="technologytitle" value="<?= $getTechnology['technology_title'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Konu</label>
                                        <textarea class="form-control" name="technologysubject" rows="5">
                                            <?= $getTechnology['technology_subject'] ?>
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>İçerik</label>
                                        <textarea style="color: white;" class="form-control ckeditor" name="technologycontent" id="technologycontent">
                                            <?= $getTechnology['technology_content'] ?>
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Anahtar Kelirmeler</label>
                                        <input style="color: white;" type="text" class="form-control" name="technologykeywords" id="technologykeywords" maxlength="160"
                                               value="<?= $getTechnology['technology_keywords'] ?>">
                                        <small id="keywordsHelp" class="form-text text-muted">Anahtar kelimeleri , ile
                                            ayırınız. En fazla 160 karakter olacak şekilde giriniz.</small>
                                    </div>
                                    <div class="form-group">
                                        <label>Yazar Seçiniz</label>
                                        <select class="form-control form-control-lg" id="largeSelect" name="author_id">
                                            <?php foreach ($getAuthor as $row ):  ?>
                                                <option <?= $row['author_id'] == $getTechnology['author_id'] ? 'selected' : NULL ?> value="<?= $row['author_id'] ?>">
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
                                <input type="hidden" name="technology_id" value="<?= $getTechnology['technology_id'] ?>">
                                <button type="submit" name="technologyedit" class="btn btn-icon btn-round btn-success mx-2">
                                    <i class="fa fa-check"></i>
                                </button>
                                <button type="submit" name="technologycancel"
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