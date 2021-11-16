<?php
session_start();

// Include config file
require_once "../config.php";

$message = '';
  if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK)
  {
    // get details of the uploaded file
    $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
    $fileName = $_FILES['uploadedFile']['name'];
    $fileSize = $_FILES['uploadedFile']['size'];
    $fileType = $_FILES['uploadedFile']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    // sanitize file-name
    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

    // check if file has one of the following extensions
    $allowedfileExtensions = array('jpg', 'jpeg', 'png');

    if (in_array($fileExtension, $allowedfileExtensions))
    {
      $businessID = $_SESSION["business_id"];
      $image = addslashes(file_get_contents($_FILES['uploadedFile']['tmp_name']));
      $description = str_replace("'", "'",$_POST['description']);
      $sql = "INSERT INTO posts(
        business_id,
        photo,
        description,
        saves,
        boost
    )
    VALUES(
        $businessID,
        '$image',
        '$description',
        '0',
        '0'
    )";

if (mysqli_query($mysqli, $sql)) {
  echo($mysqli->insert_id);
  $postID = $mysqli->insert_id;
  $rawTagsString = $_POST['tags'];
  $rawTagsString = str_replace('#', '',$rawTagsString);
  $tagsArray = explode(' ', $rawTagsString);
  
  foreach ($tagsArray as $tag){
    $sql = "INSERT INTO tags(
      tag,
      post_id
    )
    VALUES(
      '$tag',
      $postID
    )";

    if(mysqli_query($mysqli, $sql)){
      echo nl2br("\ntag added successfully to tags table.");
    }
    else{
      echo nl2br("\nERROR: Failed to execute $sql. " . mysqli_error($mysqli));
    }
  }

  echo nl2br("\nPost added successfully to posts table.");
  // header("location: ../profile.php");
} else {
  echo nl2br("\nERROR: Failed to execute $sql. " . mysqli_error($mysqli));
}
      
    }
    else
    {
      $message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
    }
  }
  else
  {
    $message = 'There is some error in the file upload. Please check the following error.<br>';
    $message .= 'Error:' . $_FILES['uploadedFile']['error'];
    echo $message;
  }

$_SESSION['message'] = $message;
// header("Location: add.php");
?>