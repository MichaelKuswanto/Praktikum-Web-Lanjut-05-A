<?php
$deleteCommand = filter_input(INPUT_GET, 'cmd');
if (isset($deleteCommand) && $deleteCommand == 'del') {
    $bookIsbn = filter_input(INPUT_GET, 'bis');
    $result = deleteBookToDb($bookIsbn);
    if ($result) {
        echo '<div>Data successfully removed</div>';
    } else {
        echo '<div>Failed to remove data</div>';
    }
}

$submitPressed = filter_input(INPUT_POST,"btnSave");
if (isset($submitPressed)) {
    $isbn = filter_input(INPUT_POST, "txtisbn");
    $title = filter_input(INPUT_POST, "txttitle");
    $author = filter_input(INPUT_POST, "txtauthor");
    $publisher = filter_input(INPUT_POST, "txtpublisher");
    $year = filter_input(INPUT_POST, "txtyear");
    $des = filter_input(INPUT_POST, "txtdes");
    $genre = filter_input(INPUT_POST, "txtgenre");
    $result = addNewBook($isbn, $title, $author, $publisher, $year, $des, $genre);
    if ($result) {
        echo '<div>Data successfully added</div>';
    } else {
        echo '<div>Failed to add data</div>';
    }
}
?>

<!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">-->

<div class="row d-flex justify-content-center">
    <div class="w-100 p-3 bg-light">
        <form method="post">
            <div class="row d-flex justify-content-center">
                <div class="col-sm-3">
                    <label for="txtisbn">ISBN</label>
                </div>
                <div class="col-sm-7">
                    <input type="text" maxlength="45" placeholder="ISBN" required autofocus name="txtisbn" id="txtisbn">
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-sm-3">
                    <label for="txttitle">Title</label>
                </div>
                <div class="col-sm-7">
                    <input type="text" maxlength="45" placeholder="Title" required autofocus name="txttitle" id="txttitle">
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-sm-3">
                    <label for="txtauthor">Author</label>
                </div>
                <div class="col-sm-7">
                    <input type="text" maxlength="45" placeholder="Author" required autofocus name="txtauthor" id="txtauthor">
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-sm-3">
                    <label for="txtpublisher">Publisher</label>
                </div>
                <div class="col-sm-7">
                    <input type="text" maxlength="45" placeholder="Publisher" required autofocus name="txtpublisher" id="txtpublisher">
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-sm-3">
                    <label for="txtyear">Year</label>
                </div>
                <div class="col-sm-7">
                    <input type="text" maxlength="45" placeholder="Publish Year" required autofocus name="txtyear" id="txtyear">
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-sm-3">
                    <label for="txtdes">Short Description</label>
                </div>
                <div class="col-sm-7">
                    <textarea maxlength="45" placeholder="Short Description" required autofocus name="txtdes" id="txtdes"></textarea>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-sm-3">
                    <label for="txtgenre">Genre</label>
                </div>
                <div class="col-sm-7">
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
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-sm-3">
                    <input type="submit" value="Save Data" name="btnSave">
                </div>
                <div class="col-sm-7">

                </div>
            </div>
        </form>
    </div>
</div>



<div class="row d-flex justify-content-center">
    <div class="w-100 p-3 bg-light">
        <table class="table table-striped justify-content-center">
            <thead>
            <tr>
                <th scope="col">Cover</th>
                <th scope="col">ISBN</th>
                <th scope="col">Title</th>
                <th scope="col">Author</th>
                <th scope="col">Publisher</th>
                <th scope="col">Publish Year</th>
                <th scope="col">Short Description</th>
                <th scope="col">Genre</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $result = fetchBookFromDb();
            foreach ($result as $book) {
                if ($book['cover'] == NULL) {
                    $book['cover'] = 'uploads/logo_maranatha.png';
                }
                echo '<tr>';
                echo '<td>' . '<img width="105" height="150"  src="' . $book['cover'] . '">'. '</td>' ;
                echo '<td>' . $book['isbn']. '</td>' ;
                echo '<td>' . $book['title']. '</td>' ;
                echo '<td>' . $book['author']. '</td>' ;
                echo '<td>' . $book['publisher']. '</td>' ;
                echo '<td>' . $book['publish_year']. '</td>' ;
                echo '<td>' . $book['short_description']. '</td>' ;
                echo '<td>' . $book['genre_name']. '</td>' ;
                echo '<td>
                <button onclick="editCover(\'' . $book['isbn'] . '\')" class="btn btn-info">Edit Cover</button>
                <button onclick="editBook(\'' . $book['isbn'] . '\')" class="btn btn-warning">Edit Data</button>
                <button onclick="deleteBook(\'' . $book['isbn'] . '\')" class="btn btn-danger">Delete Data</button>
                </td>' ;
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<script src="js/book_index.js"></script>