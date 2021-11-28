<?php
//Initalize session
session_start();
// Include the database configuration file  
require_once 'config.php';
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
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

  <link rel="stylesheet" href="./css/edit-general-user.css">
</head>

<body class="bg-pink-200">
  <!--Query Database and get user information to display in the fields.
        For the photo, display the photo in a nice size and add a button to change profile photo.
        Rest of data can just be filled out in fields ready to be edited.
    -->


  <?php
  $var = new GeneralUser();
  $generalUserInfo = $var->read($_SESSION["account_id"], $mysqli);
  echo "<div class='content'>
        
        <div class='container'>
        <form class='mb-5' method='post' id='editProfileForm' enctype='multipart/form-data' name='editProfileForm' action='phpscripts/editGeneralProfile.php'>
          <div class='row justify-content-center'>
            <div class='col-md-10'>
              
    
              <div class='row justify-content-center bg-white rounded-3xl p-5'>
                <div class='col-md-6'>
                  
                  <center><h3 class='heading mb-4'>Edit Profile</h3></center>
                  
                  <p><img src='./images/undraw-contact.svg' alt='Image' class='img-fluid'></p>
                
    
    
                </div>
                <div class='col-md-6'>
                  
                  
                    <div class='row mt-3'>
                      <div class='col-md-12 form-group'>
                        <strong><label for='first_name'>First Name</label></strong>
                        <input type=text' class='form-control' name='first_name' id='first_name' value='$generalUserInfo->first_name' required>
                        <span class='error' style='display:none' id='first_name_error'><p >Please enter your first name, cannot be blank</p></span>
                      </div>
                    </div>
                    <div class='row mt-3'>
                      <div class='col-md-12 form-group'>
                      <strong><label for='last_name'>Last Name</label></strong>
                        <input type='text' class='form-control' name='last_name' id='last_name' value='$generalUserInfo->last_name' required>
                        <span class='error' style='display:none' id='last_name_error'><p >Please enter your last name, cannot be blank</p></span>
                      </div>
                    </div>
                    <div class='row mt-3'>
                      <div class='col-md-12 form-group'>
                      <strong><label for='email'>Email</label></strong>
                        <input type='text' class='form-control' name='email' id='email' value='$generalUserInfo->email' required>
                        <span class='error' style='display:none' id='email_error'><p >Please enter a valid email address</p></span>
                      </div>
                    </div>
                    <div class='row mt-3'>
                      <div class='col-md-12 form-group'>
                      <strong><label for='gender'>Gender</label></strong>
                      <div class='form-check'>
                        <input class='form-check-input' type='radio' value ='male' name='gender' id='male' checked>
                          <label class='form-check-label' for='male'>
                            Male
                        </label>
                      </div>
                    <div class='form-check'>
                        <input class='form-check-input' type='radio' value ='female' name='gender' id='female'>
                        <label class='form-check-label' for='female'>
                            Female
                          </label>
                            </div>
                            <div class='form-check'>
                            <input class='form-check-input' type='radio' value ='other 'name='gender' id='other'>
                              <label class='form-check-label' for='other'>
                                Other
                            </label>
                          </div>
                        <span class='error' style='display:none' id='gender_error'><p >Please enter your gender, cannot be blank</p></span>
                      </div>
                    </div>
                     
                    <div class='row mt-3'>
                    <input type='button' value='Save' class=' mt-20 px-4 py-2 rounded bg-pink-500 hover:bg-pink-400 text-white font-semibold text-center block w-full focus:outline-none focus:ring focus:ring-offset-2 focus:ring-pink-500 focus:ring-opacity-80 cursor-pointer' id='editProfileBtn' name='editProfileBtn'>
                      
                    </div>
                    <a class='' href='search.php'>Cancel</a>
                  </form>
    
              </div>
            </div>
          </div>
        </div>
    
      </div>";
  ?>
  <script src="js/edit-general-user.js"></script>
</body>


</html>