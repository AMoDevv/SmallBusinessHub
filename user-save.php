<?php
session_start();

// Include config file
require_once "config.php";


// Escape user inputs for security
$first_name = mysqli_real_escape_string($mysqli, $_REQUEST['first_name']);
$last_name = mysqli_real_escape_string($mysqli, $_REQUEST['last_name']);
$gender = mysqli_real_escape_string($mysqli, $_REQUEST['gender']);
$interests = $_POST['interest'];
$dateOfBirth = mysqli_real_escape_string($mysqli, $_REQUEST['dateOfBirth']);
$email = mysqli_real_escape_string($mysqli, $_REQUEST['email']);
$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));


//need to get the current user's ID from Session array
$id = $_SESSION["account_id"];


// attempt insert query execution
$sql = "INSERT INTO general_user_information(
    image,
    first_name,
    last_name,
    date_of_birth,
    gender,
    email,
    account_id
)
VALUES(
    '$image',
    '$first_name',
    '$last_name',
    '$dateOfBirth',
    '$gender',
    '$email',
    '$id'
)";

if (mysqli_query($mysqli, $sql)) {
    echo nl2br("\nRecords added successfully to general_user_information table.");
    foreach ($interests as $interest) {
        echo $interest . "<br />";
    }
    $_SESSION["profile_completed"] = true; //update the session array's profile_completed bool to true to indicate profile creation    
} else {
    echo nl2br("\nERROR: Failed to execute $sql. " . mysqli_error($mysqli));
}

$gId = " SELECT general_user_id FROM general_user_information WHERE account_id = $id";
$result = $mysqli->query($gId);
$row = $result->fetch_assoc();
$ans = $row['general_user_id'];
foreach ($interests as $interest) {
    $sql1 = "INSERT INTO interests(
        general_user_id,
        category_id
    )
    VALUES(
        '$ans',
        '$interest'
        
    )";

    if(mysqli_query($mysqli, $sql1))
    {
        echo nl2br("\nRecords added successfully to interest table.");
         header("location: search.php");
    } else {
        echo $ans;
        echo nl2br("\nERROR: Failed to execute $sql. " . mysqli_error($mysqli));
    }
}

 
// close connection
mysqli_close($mysqli);
?>
