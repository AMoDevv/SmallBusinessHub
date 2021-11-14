<?php
session_start();

// Include config file
require_once "../config.php";

  
    $accountID = $_SESSION['account_id'];
    $business_name = $_POST['business_name'];
    $address_street = $_POST['address'];
    $address_number = $_POST['address_number'];
    $district = $_POST['district'];
    $city = $_POST['city'];
    $phone_number = $_POST['phone_number'];
    $facebook = $_POST['facebook'];
    $instagram = $_POST['instagram'];
    $twitter = $_POST['twitter'];
    $website = $_POST['website'];
    $email = $_POST['email'];
    $description = $_POST['description'];

    $sql = "UPDATE business_information
        SET
        business_name = '$business_name',
        address_street = '$address_street',
        address_district = '$district',
        address_city = '$city',
        address_number = '$address_number',
        phone_number = '$phone_number',
        facebook_url = '$facebook',
        instagram_url = '$instagram',
        twitter_url = '$twitter',
        website_url = '$website',
        email = '$email',
        description = '$description'

    WHERE account_id = $accountID";

if (mysqli_query($mysqli, $sql)) {
    echo($mysqli->insert_id);
    
  
    echo nl2br("\nbusiness information table successfully updated");
    // header("location: ../profile.php");
  } else {
    echo nl2br("\nERROR: Failed to execute $sql. " . mysqli_error($mysqli));
  }

?>