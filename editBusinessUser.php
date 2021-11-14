<?php
//Initalize session
session_start();
// Include the database configuration file  
require_once 'config.php';
require_once "./models/business-model.php";

use App\Models\BusinessInformation;
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
    <title>Edit Business</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/favicon.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
</head>

<body>
    <!--Query Database and get business information to display in the fields.
        For the photo, display the photo in a nice size and add a button to change business profile photo.
        Rest of data can just be filled out in fields ready to be edited.
    -->

    <?php
        $var = new BusinessInformation();
        $businessInformation = $var->read($_SESSION["account_id"], $mysqli);
        echo "<div class='content'>
    
        <div class='container'>
        <form class='mb-5' method='post' id='editProfileForm' enctype='multipart/form-data' name='editProfileForm' action='phpscripts/editBusinessProfile.php'>
          <div class='row justify-content-center'>
            <div class='col-md-10'>
              
            
              <div class='row justify-content-center'>
                <div class='col-md-6'>
                  
                  <center><h3 class='heading mb-4'>Edit Profile</h3></center>
                  
                  <p><img src='./images/undraw-contact.svg' alt='Image' class='img-fluid'></p>
                </div>
                <div class='col-md-6'>
                  
                  
                    <div class='row mt-1'>
                      <div class='col-md-12 form-group'>
                        <strong><label for='business_name'>Business Name</label></strong>
                        <input type=text' class='form-control' name='business_name' id='business_name' value='$businessInformation->business_name' required>
                        <span class='error' style='display:none' id='business_name_error'><p >Please enter a business name, cannot be blank</p></span>
                      </div>
                    </div>
                    <div class='row mt-1'>
                      <div class='col-md-12 form-group'>
                      <strong><label for='address'>Address</label></strong>
                        <input type='text' class='form-control' name='address' id='address' value='$businessInformation->address_street' required>
                        <span class='error' style='display:none' id='address_error'><p >Please enter your business' address, cannot be blank</p></span>
                      </div>
                    </div>
                    <div class='row mt-1'>
                      <div class='col-md-12 form-group'>
                      <strong><label for='address_number'>Address Number</label></strong>
                        <input type='text' class='form-control' name='address_number' id='address_number' value='$businessInformation->address_number' required>
                        <span class='error' style='display:none' id='address_number_error'><p >Please enter your business address' number, cannot be blank</p></span>
                      </div>
                    </div>
                    <div class='row mt-1'>
                      <div class='col-md-12 form-group'>
                      <strong><label for='district'>District</label></strong>
                        <input type='text' class='form-control' name='district' id='district' value='$businessInformation->address_district' required>
                        <span class='error' style='display:none' id='district_error'><p >Please enter the district your business is in, cannot be blank.</p></span>
                      </div>
                    </div>
                    <div class='row mt-1'>
                      <div class='col-md-12 form-group'>
                      <strong><label for='city'>Town/City</label></strong>
                        <input type='text' class='form-control' name='city' id='city' value='$businessInformation->address_city' required>
                        <span class='error' style='display:none' id='city_error'><p >Please enter the city your business is in, cannot be blank.</p></span>
                      </div>
                    </div>
                    <div class='row mt-1'>
                      <div class='col-md-12 form-group'>
                      <strong><label for='city'>Phone Number</label></strong>
                        <input type='text' class='form-control' name='phone_number' id='phone_number' value='$businessInformation->phone_number' required>
                        <span class='error' style='display:none' id='phone_number_error'><p >Please enter the phone number for your business, cannot be blank.</p></span>
                      </div>
                    </div>
                    <div class='row mt-1'>
                      <div class='col-md-12 form-group'>
                      <strong><label for='facebook'>Facebook</label></strong>
                        <input type='text' class='form-control' name='facebook' id='facebook' value='$businessInformation->facebook_url'>
                      </div>
                    </div>
                    <div class='row mt-1'>
                      <div class='col-md-12 form-group'>
                      <strong><label for='instagram'>Instagram</label></strong>
                        <input type='text' class='form-control' name='instagram' id='instagram' value='$businessInformation->instagram_url'>
                      </div>
                    </div>
                    <div class='row mt-1'>
                      <div class='col-md-12 form-group'>
                      <strong><label for='twitter'>Twitter</label></strong>
                        <input type='text' class='form-control' name='twitter' id='twitter' value='$businessInformation->twitter_url'>
                      </div>
                    </div>
                    <div class='row mt-1'>
                      <div class='col-md-12 form-group'>
                      <strong><label for='website'>Website</label></strong>
                        <input type='text' class='form-control' name='website' id='website' value='$businessInformation->website_url'>
                      </div>
                    </div>
                    <div class='row mt-1'>
                      <div class='col-md-12 form-group'>
                      <strong><label for='email'>Email</label></strong>
                        <input type='email' class='form-control' name='email' id='email' value='$businessInformation->email' required>
                        <span class='error' style='display:none' id='email_error'><p >Please enter a valid email for your business, cannot be blank.</p></span>
                      </div>
                    </div>
                    <div class='row mt-1'>
                      <div class='col-md-12 form-group'>
                      <strong><label for='description'>Business Description</label></strong>
                        <input type='text' class='form-control' name='description' id='description' value='$businessInformation->description' required>
                      </div>
                    </div>
                     
                    <div class='row mt-1'>
                    <input type='button' value='Save' class='btn btn-primary' id='editProfileBtn' name='editProfileBtn'>
                      
                    </div>
                  </form>
    
              </div>
            </div>
          </div>
        </div>
    
      </div>";
      ?>
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

<script src="js/edit-business.js"></script>

</html>