<?php
$deleteCommand = filter_input(INPUT_GET, 'cmd');
if (isset($deleteCommand) && $deleteCommand == 'del') {
    $genreId = filter_input(INPUT_GET, 'gid');
    $result = deleteGenreToDb($genreId);
    if ($result) {
        echo '<div>Data successfully removed</div>';
    } else {
        echo '<div>Failed to remove data</div>';
    }
}

$submitPressed = filter_input(INPUT_POST,"btnSave");
if (isset($submitPressed)) {
    $name = filter_input(INPUT_POST, "txtName");
    if (trim($name) == '') {
        echo "<div>Please provide with a valid name</div>";
    } else {
        $result = addNewGenre($name);
        if ($result) {
            echo '<div>Data successfully added</div>';
        } else {
            echo '<div>Failed to add data</div>';
        }
    }
}
?>

<div class="d-flex justify-content-center">
    <div class="w-50 p-3 bg-light">
        <form method="post">
            <label for="txtName">Genre Name</label>
            <input type="text" maxlength="45" placeholder="Genre name" required autofocus name="txtName" id="txtName">
            <input type="submit" value="Save Data" name="btnSave">
        </form>
    </div>
</div>

<!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">-->
<div class="d-flex justify-content-center">
    <div class="w-50 p-3 bg-light">
        <table class="table table-striped justify-content-center">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $result = fetchGenreFromDb();
            foreach ($result as $genre) {
                echo '<tr>';
                echo '<td>' . $genre['id']. '</td>' ;
                echo '<td>' . $genre['name']. '</td>' ;
                echo '<td>
                <button onclick="editGenre(' . $genre['id'] . ')" class="btn btn-warning">Edit Data</button>
                <button onclick="deleteGenre(' . $genre['id'] . ')" class="btn btn-danger">Delete Data</button>
                </td>' ;
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<script src="js/genre_index.js"></script>
