<?php
//Initalize session
session_start();
// Include the database configuration file  
require_once 'config.php';
require_once "navigation.php";
require_once "./models/general-user-model.php";

use App\Models\GeneralUser;

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
    <title>Edit General User</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/favicon.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="./css/edit-general-user.css">
</head>

<body>
    <!--Query Database and get user information to display in the fields.
        For the photo, display the photo in a nice size and add a button to change profile photo.
        Rest of data can just be filled out in fields ready to be edited.
    -->
    

    <?php
        $var = new GeneralUser();
        $generalUserInfo = $var->read($_SESSION["account_id"], $mysqli);
        echo "<div class='content'>
    
        <div class='container'>
          <div class='row justify-content-center'>
            <div class='col-md-10'>
              
    
              <div class='row justify-content-center'>
                <div class='col-md-6'>
                  
                  <center><h3 class='heading mb-4'>Edit Profile</h3></center>
                  
                  <p><img src='./images/undraw-contact.svg' alt='Image' class='img-fluid'></p>
    
    
                </div>
                <div class='col-md-6'>
                  
                  <form class='mb-5' method='post' id='editProfileForm' name='editProfileForm' action='phpscripts/editGeneralProfile.php'>
                    <div class='row mt-3'>
                      <div class='col-md-12 form-group'>
                        <strong><label for='first_name'>First Name</label></strong>
                        <input type=text' class='form-control' name='first_name' id='first_name' value='$generalUserInfo->first_name' required>
                      </div>
                    </div>
                    <div class='row mt-3'>
                      <div class='col-md-12 form-group'>
                      <strong><label for='last_name'>Last Name</label></strong>
                        <input type='text' class='form-control' name='last_name' id='last_name' value='$generalUserInfo->last_name' required>
                      </div>
                    </div>
                    <div class='row mt-3'>
                      <div class='col-md-12 form-group'>
                      <strong><label for='email'>Email</label></strong>
                        <input type='text' class='form-control' name='email' id='email' value='$generalUserInfo->email' required>
                      </div>
                    </div>
                    <div class='row mt-3'>
                      <div class='col-md-12 form-group'>
                      <strong><label for='gender'>Gender</label></strong>
                        <input type='text' class='form-control' name='gender' id='gender' value='$generalUserInfo->gender' required>
                      </div>
                    </div>
                     
                    <div class='row mt-3'>
                    <input type='submit' value='Save' class='btn btn-primary' id='editProfileBtn' name='editProfileBtn' required>
                      
                    </div>
                  </form>
    
              </div>
            </div>
          </div>
        </div>
    
      </div>";
    ?>
</body>


</html>