<?php
session_start();

// Include config file
require_once "config.php";


// Escape user inputs for security
$business_name = mysqli_real_escape_string($mysqli, $_REQUEST['business_name']);
$address_street = mysqli_real_escape_string($mysqli, $_REQUEST['address_street']);
$address_number = mysqli_real_escape_string($mysqli, $_REQUEST['address_number']);
$address_city = mysqli_real_escape_string($mysqli, $_REQUEST['address_city']);
$address_district = mysqli_real_escape_string($mysqli, $_REQUEST['address_district']);
$categories = $_POST['category'];
$phone_number = mysqli_real_escape_string($mysqli, $_REQUEST['phone_number']);
$email = mysqli_real_escape_string($mysqli, $_REQUEST['email']);
$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
$subscription = 1;
$description = mysqli_real_escape_string($mysqli, $_REQUEST['bio']);
$facebook = mysqli_real_escape_string($mysqli, $_REQUEST['facebook']);
$instagram = mysqli_real_escape_string($mysqli, $_REQUEST['instagram']);
$twitter = mysqli_real_escape_string($mysqli, $_REQUEST['twitter']);
$website = mysqli_real_escape_string($mysqli, $_REQUEST['website']);



//need to get the current user's ID from Session array
$id = $_SESSION["account_id"];


// attempt insert query execution
$sql = "INSERT INTO business_information(
    image,
    business_name,
    address_street,
    address_district,
    address_city,
    address_number,
    phone_number,
    facebook_url,
    instagram_url,
    twitter_url,
    website_url,
    email,
    description,
    subscription_id,
    account_id
)
VALUES(
    '$image',
    '$business_name',
    '$address_street',
    '$address_district',
    '$address_city',
    '$address_number',
    '$phone_number',
    '$facebook',
    '$instagram',
    '$twitter',
    '$website',
    '$email',
    '$description',
    '$subscription',
    '$id'
)";

if (mysqli_query($mysqli, $sql)) {
    echo nl2br("\nRecords added successfully to business_information table.");
    foreach ($categories as $category) {
        echo $category . "<br />";
    }
    $_SESSION["profile_completed"] = true; //update the session array's profile_completed bool to true to indicate profile creation    
} else {
    echo nl2br("\nERROR: Failed to execute $sql. " . mysqli_error($mysqli));
}

$gId = " SELECT business_id FROM business_information WHERE account_id = $id";
$result = $mysqli->query($gId);
$row = $result->fetch_assoc();
$ans = $row['business_id'];
foreach ($categories as $category) {
    $sql1 = "INSERT INTO business_category(
        business_id,
        category_id
    )
    VALUES(
        '$ans',
        '$category'
        
    )";

   if (mysqli_query($mysqli, $sql1)) {
        echo nl2br("\nRecords added successfully to business_category table.");
               
        $_SESSION["business_id"] = $gId; //store business_id since account is a business
        header("location: profile.php");
   } else {
        echo $ans;
        echo nl2br("\nERROR: Failed to execute $sql. " . mysqli_error($mysqli));
    }
}


// close connection
mysqli_close($mysqli);
