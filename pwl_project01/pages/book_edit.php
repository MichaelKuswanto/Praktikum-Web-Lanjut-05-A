<?php
$editedIsbn = filter_input(INPUT_GET, 'bis');
if (isset($editedIsbn)) {
    $book = fetchOneBook($editedIsbn);
}

$updatePressed = filter_input(INPUT_POST, 'btnUpdate');
if (isset($updatePressed)){
    $title = filter_input(INPUT_POST, "txttitle");
    $author = filter_input(INPUT_POST, "txtauthor");
    $publisher = filter_input(INPUT_POST, "txtpublisher");
    $year = filter_input(INPUT_POST, "txtyear");
    $des = filter_input(INPUT_POST, "txtdes");
    $genre = filter_input(INPUT_POST, "txtgenre");
    $result = updateBookToDb($book['isbn'], $title, $author, $publisher, $year, $des, $genre);
    if ($result) {
        header('location:index.php?menu=book');
        echo '<div>Data successfully updated</div>';
    } else {
        echo '<div>Failed to update data</div>';
    }
}

$uploadPressed = filter_input(INPUT_POST,'btnUpload');
if (isset($uploadPressed)) {
    $fileName = filter_input(INPUT_POST,'txtFileName');
    $targetDirectory = 'uploads/';
    $fileExtension = pathinfo($_FILES['txtFile']['name'], PATHINFO_EXTENSION);
    $fileUploadPath = $targetDirectory . $fileName . '.' . $fileExtension;
    if ($_FILES['txtFile']['size'] > 1024 * 2048) {
        echo '<div>Uploaded file exceed 2MB</div>';
    } else {
        move_uploaded_file($_FILES['txtFile']['tmp_name'], $fileUploadPath);
    }
    $result = updateBookCover($book['isbn'], $fileUploadPath);
    if($result){
        header('location:index.php?menu=book_update&bis='.$fileName);
    } else{
        echo '<div>Failed to update cover</div>';
    }
}
?>

<div class="d-flex justify-content-center">
    <div class="w-50 p-3 bg-light">
        <form method="post">
            <div class="row">
                <label for="txtisbn" class="col-form-label">Book ISBN</label>
                <div class="col-sm-10">
                    <input type="text" maxlength="45" placeholder="Book ISBN"  id="txtisbn" class="form-control" readonly value="<?php echo $book['isbn']?>">
                </div>
            </div>
            <div class="row">
                <label for="txttitle" class="col-form-label">Book Title</label>
                <div class="col-sm-10">
                    <input type="text" maxlength="45" placeholder="Book Title" required autofocus name="txttitle" id="txttitle" class="form-control" value="<?php echo $book['title']?>">
                </div>
            </div>
            <div class="row">
                <label for="txtauthor" class="col-form-label">Book Author</label>
                <div class="col-sm-10">
                    <input type="text" maxlength="45" placeholder="Book Author" required autofocus name="txtauthor" id="txtauthor" class="form-control" value="<?php echo $book['author']?>">
                </div>
            </div>
            <div class="row">
                <label for="txtpublisher" class="col-form-label">Book Publisher</label>
                <div class="col-sm-10">
                    <input type="text" maxlength="45" placeholder="Book Publisher" required autofocus name="txtpublisher" id="txtpublisher" class="form-control" value="<?php echo $book['publisher']?>">
                </div>
            </div>
            <div class="row">
                <label for="txtyear" class="col-form-label">Book Publish Year</label>
                <div class="col-sm-10">
                    <input type="text" maxlength="45" placeholder="Book Publish Year" required autofocus name="txtyear" id="txtyear" class="form-control" value="<?php echo $book['publish_year']?>">
                </div>
            </div>
            <div class="row">
                <label for="txtdes" class="col-form-label">Book Description</label>
                <div class="col-sm-10">
                    <input type="text" maxlength="45" placeholder="Book Description" required autofocus name="txtdes" id="txtdes" class="form-control" value="<?php echo $book['short_description']?>">
                </div>
            </div>
            <div class="row">
                <label for="txtgenre">Book Genre</label>
                <div class="col-sm-10">
                    <select class="from-control" name="txtgenre" id="txtgenre">
                        <option>--Select your Genre--</option>
                        <?php
                        $result = fetchGenreFromDb();
                        foreach ($result as $genre) {
                            echo '<option value="'. $genre['id'] .'">'. $genre['name']. '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div>
                <input type="submit" value="Update Data" name="btnUpdate" class="btn btn-primary">
            </div>
        </form>
        <h1>Current Cover</h1>
        <div>
            <?php
            if ($book['cover'] == null) {
                $book['cover'] = 'uploads/logo_maranatha.png';
            }
            echo  '<img width="210" height="300"  src="' . $book['cover'] . '">' ;
            ?>
        </div>
        <form method="post" enctype="multipart/form-data">
            <fieldset>
                <legend>Upload Image</legend>
                <div class="row">
                    <label for="txtFileName" class="col-form-label">File Name</label>
                    <div class="col-sm-10">
                        <input type="text" maxlength="45"  id="txtFileName" name="txtFileName" class="form-control" readonly value="<?php echo $book['isbn']?>">
                    </div>
                    <label for="txtFile" class="col-form-label">Upload Cover</label>
                    <div>
                        <input type="file" name="txtFile" accept="image/*">
                    </div>
                    <div>
                        <input type="submit" name="btnUpload" value="Upload File to Server">
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
