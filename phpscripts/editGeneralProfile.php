<?php
session_start();

// Include config file
require_once "../config.php";

    $accountID = $_SESSION['account_id'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];

    $sql = "UPDATE general_user_information
        SET first_name = '$firstName',
        last_name = '$lastName',
        email = '$email',
        gender = '$gender'

    WHERE account_id = $accountID";

if (mysqli_query($mysqli, $sql)) {
    echo($mysqli->insert_id);
    
  
    echo nl2br("\ngeneral user information table successfully updated");
    header("location: ../search.php");
  } else {
    echo nl2br("\nERROR: Failed to execute $sql. " . mysqli_error($mysqli));
  }
?>