<!--Michael Kuswanto - 2172037-->
<!--Rezon Handry Gunawan - 2172004-->

<?php
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
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP Programming</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row d-flex justify-content-center">
        <form method="post" enctype="multipart/form-data">
            <fieldset>
                <legend>Upload Image</legend>
                <input type="text" name="txtFileName" placeholder="Upload File Name">
                <input type="file" name="txtFile" accept="image/*">
                <div>
                    <input type="submit" name="btnUpload" value="Upload File to Server">
                </div>
            </fieldset>
        </form>
    </div>
</div>
</body>
</html>
