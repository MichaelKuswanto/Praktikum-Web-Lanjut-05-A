<?php
$editedId = filter_input(INPUT_GET, 'gid');
if (isset($editedId)) {
    $genre = fetchOneGenre($editedId);
}

$updatePressed = filter_input(INPUT_POST, 'btnUpdate');
if (isset($updatePressed)){
    $name = filter_input(INPUT_POST, "txtName");
    if (trim($name) == '') {
        echo "<div>Please provide with a valid name</div>";
    } else {
        $result = updateGenreToDb($genre['id'], $name);
        if ($result) {
            header('location:index.php?menu=genre');
            echo '<div>Data successfully updated</div>';
        } else {
            echo '<div>Failed to update data</div>';
        }
    }
}
?>

<div class="d-flex justify-content-center">
    <div class="w-50 p-3 bg-light">
        <form method="post">
            <div class="row">
                <label for="txtID" class="col-form-label">Genre ID</label>
                <div class="col-sm-10">
                    <input type="text" maxlength="45" placeholder="Genre ID"  id="txtID" class="form-control" readonly value="<?php echo $genre['id']?>">
                </div>
            </div>
            <div class="row">
                <label for="txtName" class="col-form-label">Genre Name</label>
                <div class="col-sm-10">
                    <input type="text" maxlength="45" placeholder="Genre name" required autofocus name="txtName" id="txtName" class="form-control" value="<?php echo $genre['name']?>">
                </div>
            </div>
            <div>
                <input type="submit" value="Update Data" name="btnUpdate" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>
