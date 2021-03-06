<?php
// This is the login page to log in users

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: profile.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT account_id, username, password FROM account WHERE username = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Store result
                $stmt->store_result();
                
                // Check if username exists, if yes then verify password
                if($stmt->num_rows == 1){                    
                    // Bind result variables
                    $stmt->bind_result($account_id, $username, $hashed_password);
                    if($stmt->fetch()){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["account_id"] = $account_id;
                            $_SESSION["username"] = $username;                            
                            $_SESSION["profile_completed"] = false;

                               //determine the type of account the currently logged in user has - business or general
                               $sql = "SELECT account_type_id FROM account WHERE account_id = $account_id";
                               $result = $mysqli->query($sql);
                               if ($result->num_rows > 0) {
                                   $row = $result->fetch_assoc();
                                   $_SESSION["account_type"] = $row["account_type_id"];//save account type in session array
                                   
                                   if ($row["account_type_id"] == 1) //this is a general user
                                   {
                                       $sql = "SELECT first_name FROM general_user_information WHERE account_id =$account_id"; //attempt to get qrCodeId if profile exists
                                       $result = $mysqli->query($sql);
   
                                       if ($result->num_rows > 0) { //if 1 record comes back, user profile exists 
                                           $row = $result->fetch_assoc();   
                                           
                                           // user profile was previously created so proceed to home page
                                           $_SESSION["profile_completed"] = true;//keep track whether a profile has been created
                                           header("location: search.php");
                                       } else { //user profile has not yet been created so redirect to new user page
                                           header("location: user-form.php");
                                       }
                                   } elseif ($row["account_type_id"] == 2) //this is a business user
                                   {
                                       $sql = "SELECT business_name FROM business_information WHERE account_id =$account_id";
                                       $businessIDQuery = $mysqli->query("SELECT business_id FROM business_information WHERE account_id = $account_id");
                                       $businessID = mysqli_fetch_assoc($businessIDQuery)["business_id"];
                                       $result = $mysqli->query($sql);
   
                                       if ($result->num_rows > 0) {
                                           // user profile was previously created so proceed to home page                                       
                                           $_SESSION["profile_completed"] = true;//keep track whether a profile has been created
                                           $_SESSION["business_id"] = $businessID; //store business_id since account is a business
                                           header("location: profile.php");
                                       } else { //user profile has not yet been created so redirect to new business page
                                           header("location: business-form.php");
                                       }
                                   }
                               }
                        }else{
                            // Display an error message if password is not valid
                           $password_err = "The password you entered was not valid.";
                        }
                    }

                    

                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        $stmt->close();
    }
    
    // Close connection
    $mysqli->close();
}
?>
 
 <!-- Begins the html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Small Business Hub</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;1,400&family=Roboto&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="images/favicon.ico">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>

<div class=" selection:text-white justify-center">
  <div class="min-h-screen min-w-screen bg-blue-900 flex justify-center items-center">
    <div class="p-8 flex-1"> 
      <div class="w-1/2 bg-white p-10 rounded-3xl mx-auto overflow-hidden shadow-xl grid grid-cols-1 lg:grid-cols-2 gap-4">
        <!-- GIF Image -->
      <div class="">
        <div class="grid-item col-span-1">
            <div id="logo">
                <img src="images/logo.png" class="justify-self-auto" width="150px">
            </div>
        </div>
        <div class="grid-item col-span-1">

            <div id="login-gif">
                <img src= "images/login.gif"  width="350px"height= "300px">
            </div>
         </div>
    </div>
    <!-- Form -->
        <div class="grid-item px-10 pt-4 pb-8 bg-white rounded-tr-4xl">
         <h2 class="text-2xl font-semibold text-gray-900">Welcome Back!</h2>
         <p>Please enter your credentials to login.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                    <label class="font-bold">Username</label>
                    <input type="text" name="username" class="form-control peer h-10 w-full border-b-2 border-gray-300 text-gray-900 placeholder-transparent focus:outline-none focus:border-blue-600" value="<?php echo $username; ?>">
                    <span class="help-block text-red-500"><?php echo $username_err; ?></span>
                </div>    
                <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                    <label class="font-bold">Password</label>
                    <input type="password" name="password" class="form-control peer h-10 w-full border-b-2 border-gray-300 text-gray-900 placeholder-transparent focus:outline-none focus:border-blue-600">
                    <span class="help-block text-red-500"><?php echo $password_err; ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary mt-20 px-4 py-2 rounded bg-blue-500 hover:bg-blue-400 text-white font-semibold text-center block w-full focus:outline-none focus:ring focus:ring-offset-2 focus:ring-blue-500 focus:ring-opacity-80 cursor-pointer" value="Login">
                </div>
                <p class="">Don't have an account? <a href="register.php" class="text-blue-600 hover:underline focus:outline-none focus:ring-2 focus:ring-blue-500">Sign up now</a>.</p>
            </form>
        </div>
        
</div>
</div>
</div>      

</div>  

</body>
</html>