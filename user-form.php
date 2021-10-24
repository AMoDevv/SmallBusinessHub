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

<body>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <form id="signup" class="form" action="user-save.php" method="post" enctype="multipart/form-data">
                <!-- Progress Bar -->
                <ul id="progressbar">
                    <li class="active">Personal Details</li>
                    <li>Interests</li>
                    <li>Profile Setup</li>
                </ul>

                <!-- Field Sets -->
                <fieldset>
                    <h2 class="fs-title">Personal Details</h2>
                    <h3 class="fs-subtitle">Tell us something more about you</h3>

                    <div class="form-field">
                        <label for="firstName" class="l">First Name:</label>
                        <input type="text" name="first_name" id="first_name" autocomplete="off" placeholder="Enter First Name">
                        <small></small>
                    </div>

                    <div class="form-field">
                        <label for="lastName" class="l">Last Name:</label>
                        <input type="text" name="last_name" id="last_name" autocomplete="off" placeholder="Enter Last Name">
                        <small></small>
                    </div> <br>

                    <!--<span class="gender-label">Gender:</span> <br>
                    <div class="form-gender-field">
                        <label class="radio-inline">
                            <input type="radio" id="male" name="gender" value="male">Male
                        </label>
                        <label class="radio-inline">
                            <input type="radio" id="female" name="gender" value="female">Female
                        </label>
                        <label class="radio-inline">
                            <input type="radio" id="other" name="gender" value="other">Other
                        </label>
                        <small></small>
                        <br>
                    </div>-->

                    <span class="gender-label">Gender:</span>
                    <div class="form-gender-field">
                        <label for="male">Male</label>
                        <input type="radio" id="male" name="gender" value="male">

                        <label for="female">Female</label>
                        <input type="radio" id="female" name="gender" value="female">

                        <label for="other">Other</label>
                        <input type="radio" id="other" name="gender" value="other">
                        </br>
                        <small></small>
                    </div>

                    <div class="form-field">
                        <label for="Email" class="l">Email:</label>
                        <input type="text" name="email" id="email" autocomplete="off" placeholder="Enter your email">
                        <small></small>
                    </div>

                    <div class="form-field">
                        <label for="birthday" class="l">Birthday:</label>
                        <input type="date" id="dateOfBirth" name="dateOfBirth" autocomplete="off" placeholder="Select your date of birth">
                        <br><small></small>
                    </div>

                    <!--<div class="form-field">
                    <input type="submit" value="Sign Up" class="btn">
                </div>-->

                    <input type="button" name="next" class="next action-button" value="Next" />
                </fieldset>

                <fieldset>
                    <h2 class="fs-title">Interests</h2>
                    <h3 class="fs-subtitle">Tell us what you're into</h3>
                    <small id="err" style="color:red;"></small>
                    <div class="container">

                        <div class="row">

                            <label class="lb">
                                <input type="checkbox" name="interest[]" id="health" value='1' />
                                <div class="icon-box">
                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                    <span>Health</span>
                                </div>
                            </label>

                            <label class="lb">
                                <input type="checkbox" name="interest[]" id="entertainment" value='2'/>
                                <div class="icon-box">
                                    <i class="fa fa-music" aria-hidden="true"></i>
                                    <span>Entertainment</span>
                                </div>
                            </label>
                        </div>

                        <div class="row">
                            <label class="lb">
                                <input type="checkbox" name="interest[]" id="clothing" value='3'/>
                                <div class="icon-box">
                                    <i class="fas fa-tshirt" aria-hidden="true"></i>
                                    <span> Clothing </span>
                                </div>
                            </label>

                            <label class="lb">
                                <input type="checkbox" name="interest[]" id="crafts" value='4'/>

                                <div class="icon-box">
                                    <i class="fa fa-book" aria-hidden="true"></i>
                                    <span>Crafts</span>
                                </div>
                            </label>
                        </div>

                        <div class="row">
                            <label class="lb">
                                <input type="checkbox" name="interest[]" id="hobbies" value='5' />
                                <div class="icon-box">
                                    <i class="fa fa-dribbble" aria-hidden="true"></i>
                                    <span>Hobbies</span>
                                </div>
                            </label>

                            <label class="lb">
                                <input type="checkbox" name="interest[]" id="electronics" value='6' />

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
                    <h3 class="fs-subtitle">Choose a Profile Picture</h3>
                    <small id="error1" style="color:red;"></small>
                    <div class="p">
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
    <script src="js/user_validation.js"></script>

</body>

</html>