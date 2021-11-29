<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Personalize Your Profile</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="images/favicon-profile.ico" />
  <!-- Font Awesome Link -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
  <!--Bootstrap-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>

  <!--Google Font-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;1,400&family=Roboto&display=swap" rel="stylesheet">
  <!--Custom CSS-->
  <link rel="stylesheet" href="css/form-style.css">
</head>

<body class="">
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <form id="signup" class="form" action="business-save.php" method="post" enctype="multipart/form-data">
        <!-- Progress Bar -->
        <ul id="progressbar">
          <li class="active">Business Details</li>
          <li>Category</li>
          <li>Profile Setup</li>
        </ul>

        <!-- Field Sets -->
        <fieldset>
          <h2 class="fs-title">Personal Details</h2>
          <h3 class="fs-subtitle">Tell us something more about your business</h3>

          <div class="form-field">
            <label for="name" class="l">Business Name:</label>
            <input type="text" name="business_name" id="business_name" autocomplete="off" placeholder="Enter Name of Business">
            <small></small>
          </div>

          <div class="form-field">
            <label for="Email" class="l">Email:</label>
            <input type="text" name="email" id="email" autocomplete="off" placeholder="Enter your email">
            <small></small>
          </div>

          <div class="form-field">
            <label for="phone" class="l">Phone Number:</label>
            <input type="text" name="phone" id="phone_number" autocomplete="off" placeholder="Enter your phone number">
            <small></small>
          </div>

          <div class="form-field">
            <br>
            <label class="l" style="color: #db2777;">
              <u>Address Details</u>
            </label> <br> <br>
            <label for="address_street" class="l">Address Street:</label>
            <input type="addressStreet" id="address_street" name="address_street" placeholder="Street Name">
            <small></small>
          </div>

          <div class="form-field">
            <label for="address_number" class="l">Address Number:</label>
            <input type="adddressNumber" id="address_number" name="address_number" placeholder="Street Number">
            <small></small>
          </div>

          <div class="form-field">
            <label for="address_city" class="l">Address City:</label>
            <input type="addressCity" id="address_city" name="address_city" placeholder="City">
            <small></small>
          </div>

          <div class="form-field">
            <label for="district" class="l">Address District:</label>
            <select name="address_district" id="address_district">
              <option value=""></option>
              <option value="Corozal">Corozal</option>
              <option value="Orange Walk">Orange Walk</option>
              <option value="Cayo">Cayo</option>
              <option value="Belize">Belize</option>
              <option value="Stann Creek">Stann Creek</option>
              <option value="Toledo">Toledo</option>
            </select>
            <small></small>
          </div>

          <div class="form-field">
            <br>
            <label class="l" style="color: #db2777;">
              <u>Social Media Links</u>
            </label> <br> <br>
            <label for="twitter" class="l">Twitter URL:</label>
            <input type="text" name="twitter" id="twitter" autocomplete="off" placeholder="Enter your Twitter url">
            <small></small>
          </div>

          <div class="form-field">
            <label for="facebook" class="l">Facebook URL:</label>
            <input type="text" name="facebook" id="facebook" autocomplete="off" placeholder="Enter your Facebook url">
            <small></small>
          </div>

          <div class="form-field">
            <label for="instagram" class="l">Instagram URL:</label>
            <input type="text" name="instagram" id="instagram" autocomplete="off" placeholder="Enter your Instagram url">
            <small></small>
          </div>

          <div class="form-field">
            <label for="website" class="l">Personal Website URL:</label>
            <input type="text" name="website" id="website" autocomplete="off" placeholder="Enter your personal website url">
            <small></small>
          </div>

          <input type="button" name="next" class="next action-button" value="Next" />
        </fieldset>

        <fieldset>
          <h2 class="fs-title">Category</h2>
          <h3 class="fs-subtitle">Tell us the type of business you own</h3>
          <small id="err" style="color:red;"></small>
          <div class="container">

            <div class="row">

              <label class="lb">
                <input type="checkbox" name="category[]" id="health" value='1' />
                <div class="icon-box">
                  <i class="fa fa-heart" aria-hidden="true"></i>
                  <span>Health</span>
                </div>
              </label>

              <label class="lb">
                <input type="checkbox" name="category[]" id="entertainment" value='2' />
                <div class="icon-box">
                  <i class="fa fa-music" aria-hidden="true"></i>
                  <span>Entertainment</span>
                </div>
              </label>
            </div>

            <div class="row">
              <label class="lb">
                <input type="checkbox" name="category[]" id="clothing" value='3' />
                <div class="icon-box">
                  <i class="fas fa-tshirt" aria-hidden="true"></i>
                  <span> Clothing </span>
                </div>
              </label>

              <label class="lb">
                <input type="checkbox" name="category[]" id="crafts" value='4' />

                <div class="icon-box">
                  <i class="fa fa-book" aria-hidden="true"></i>
                  <span>Crafts</span>
                </div>
              </label>
            </div>

            <div class="row">
              <label class="lb">
                <input type="checkbox" name="category[]" id="hobbies" value='5' />
                <div class="icon-box">
                  <i class="fa fa-dribbble" aria-hidden="true"></i>
                  <span>Hobbies</span>
                </div>
              </label>

              <label class="lb">
                <input type="checkbox" name="category[]" id="electronics" value='6' />

                <div class="icon-box">
                  <i class="fa fa-desktop" aria-hidden="true"></i>
                  <span>Electronics</span>
                </div>
              </label>


            </div>
          </div>

          <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
          <input type="button" name="next" class="next action-button" value="Next" />
        </fieldset>


        <fieldset>
          <h2 class="fs-title">Profile Setup</h2>

          <div class="form-field">
            <h3 class="fs-subtitle">Write Your Business Bio</h3>
            <textarea type="text" rows="4" cols="50" name="bio" id="bio" autocomplete="off"> </textarea>
            <br><small></small>
          </div>
          <div class="p">
            <h3 class="fs-subtitle">Choose Your Business Profile Picture</h3>
            <div class="wrapper">
              <div class="image">
                <img src="" alt="" onerror="this.style.display='none'">
              </div>
              <div class="content">
                <div class="icon">
                  <i class="fas fa-cloud-upload-alt"></i>
                </div>
                <div class="text">
                  No file chosen, yet!
                </div>
              </div>
              <div id="cancel-btn">
                <i class="fas fa-times"></i>
              </div>
              <div class="file-name">
                File name here
              </div>
            </div>

            <br>
            <input id="default-btn" type='file' name='image' accept="image/png, image/gif, image/jpeg" style="width:200px">
            <br><small id="error1" style="color:red;"></small>
          </div>
          <script>
            const wrapper = document.querySelector(".wrapper");
            const fileName = document.querySelector(".file-name");
            const defaultBtn = document.querySelector("#default-btn");
            const customBtn = document.querySelector("#custom-btn");
            const cancelBtn = document.querySelector("#cancel-btn i");
            const img = document.querySelector("img");
            let regExp = /[0-9a-zA-Z\^\&\'\@\{\}\[\]\,\$\=\!\-\#\(\)\.\%\+\~\_ ]+$/;

            function defaultBtnActive() {
              defaultBtn.click();
            }
            defaultBtn.addEventListener("change", function() {
              const file = this.files[0];
              if (file) {
                const reader = new FileReader();
                reader.onload = function() {
                  const result = reader.result;
                  img.src = result;
                  img.style.display = "block";
                  wrapper.classList.add("active");
                }
                cancelBtn.addEventListener("click", function() {
                  img.src = "";
                  wrapper.classList.remove("active");
                })
                reader.readAsDataURL(file);
              }
              if (this.value) {
                let valueStore = this.value.match(regExp);
                fileName.textContent = valueStore;
              }
            });
          </script>
          <br>
          <input type="button" name="previous" class="previous action-button-previous" value="Previous" />

          <input type="submit" value="Save" class="action-button">
          <br><span id="error2" style="color:red; font-size:16px;"></span>
          
          <!--<input type="submit" name="submit" class="submit action-button" value="Save"/>-->
        </fieldset>
      </form>
    </div>
  </div>

  <!--Script-->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>
  <script src="js/form-script.js"></script>
  <script src="js/business_validation.js"></script>

</body>

</html>
