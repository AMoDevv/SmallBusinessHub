<?php
//Initalize session
session_start();
// Include the database configuration file  
require_once 'config.php';
require_once "navigation.php";

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/favicon.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/add-post.css">
</head>

<body>
    <form action="phpscripts/uploadPost.php" method="post" enctype="multipart/form-data">
        <div class="form-group post-body">
            <center><h2>Create a new post</h2></center>
            <br>
            <label for="description">What's on your mind</label>
            <textarea class="form-control" id="description" name="description" rows="10" cols="50" required></textarea>
        <br>
            <div class="upload-wrapper">
            <span class="file-name" id="fileName">Choose a file...</span>
            <label for="file-upload">Browse<input type="file" id="file-upload" name="uploadedFile" required onchange='updateFileName(this)'></label>
                </div>
        <br>
        <label for="tags">Tags eg. #cooking #food #seafood #gourmet</label>
        <textarea class="form-control" id="tags" name="tags" rows="1" cols="50" required></textarea>
        <center><input type="submit" name="uploadBtn" value="Upload" /></center>
        <br>
        </div>
    </form>
</body>
<script>
    const fileName = document.querySelector("#fileName");
    function updateFileName(object){
        console.log('file changed');
        var file = object.files[0];
        var name = file.name;
        console.log(name);
        fileName.textContent = name;
    }
</script>

</html>