<?php
include '../include/header.php';

// database connection
$literature = $conn->prepare("SELECT * FROM literature INNER JOIN author ON author.author_id = literature.author_id WHERE literature_id=:id AND author.author_category=:category ");
$author = $conn->prepare("SELECT * FROM author WHERE author_category=:category");

$literature->execute(array(
    'id' => $_GET['id'],
    'category' => 'Edebiyat'
));
$author->execute([
    'category' => 'Edebiyat'
]);

$getLiterature = $literature->fetch(PDO::FETCH_ASSOC);
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
                    <a href="category-literature.php">Kategoriler</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="literature.php">Edebiyat</a>
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
                                        <img class="avatar avatar-xxl" src="../assets/img/literature/<?= $getLiterature['literature_bgimage'] ?>" alt="<?= $getLiterature['literature_bgimage'] ?>" srcset="">
                                        <input type="hidden" name="literature_img" value="<?= $getLiterature['literature_bgimage'] ?>">
                                    </div>
                                    <hr style="background-color: white;">
                                    <div class="form-group">
                                        <input type="file" name="literatureimages" class="form-control-file" id="exampleFormControlFile1">
                                    </div>
                                    <div class="form-group">
                                        <label>Başlık</label>
                                        <input style="color: white;" type="text" class="form-control" name="literaturetitle" id="literaturetitle" value="<?= $getLiterature['literature_title'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Konu</label>
                                        <textarea class="form-control" name="literaturesubject" rows="5">
                                            <?= $getLiterature['literature_subject'] ?>
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>İçerik</label>
                                        <textarea style="color: white;" class="form-control ckeditor" name="literaturecontent" id="literaturecontent">
                                            <?= $getLiterature['literature_content'] ?>
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Anahtar Kelirmeler</label>
                                        <input style="color: white;" type="text" class="form-control" name="literaturekeywords" id="literaturekeywords" maxlength="160"
                                               value="<?= $getLiterature['literature_keywords'] ?>">
                                        <small id="keywordsHelp" class="form-text text-muted">Anahtar kelimeleri , ile
                                            ayırınız. En fazla 160 karakter olacak şekilde giriniz.</small>
                                    </div>
                                    <div class="form-group">
                                        <label>Yazar Seçiniz</label>
                                        <select class="form-control form-control-lg" id="largeSelect" name="author_id">
                                            <?php foreach ($getAuthor as $row ):  ?>
                                                <option <?= $row['author_id'] == $getLiterature['author_id'] ? 'selected' : NULL ?> value="<?= $row['author_id'] ?>">
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
                                <input type="hidden" name="literature_id" value="<?= $getLiterature['literature_id'] ?>">
                                <button type="submit" name="literatureedit" class="btn btn-icon btn-round btn-success mx-2">
                                    <i class="fa fa-check"></i>
                                </button>
                                <button type="submit" name="literaturecancel"
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