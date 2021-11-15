<?php
//Initalize session


session_start();
// Include the database configuration file  
require_once 'config.php';
require_once "navigation.php";
require_once "./models/business-model.php";
require_once "./models/posts-model.php";
require_once "./models/saves-model.php";
require_once "./phpscripts/getPost.php";

use App\Models\BusinessInformation;
use App\Models\Posts;
use App\Models\Saves;

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
//need to get the current user's ID from Session array
$id = $_SESSION["account_id"];

$accountType = $_SESSION["account_type"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CodePen - Instagram Profile Layout with CSS Grid &amp; Flexbox</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/profile.css">

</head>
<style>
.post-images{
    height: 480px;
    width:98%;
}
.post-divs{
    padding: 10px;
    border: 1px solid;
    border-radius: 10px;
}
</style>

<body>
    <!-- partial:index.partial.html -->
    <header>

        <div class="c">
            <!-- End of profile section -->

            <!-- Start of posts grid section -->
            <div class="container">
            <div class="row">
            <?php
                    //need to get the current user's ID from Session array
                    
                    $get_id = (int)$_GET["id"];

                    $posts = new Posts();
                    $post = $posts->read($get_id, $mysqli);
                    $businesses = new BusinessInformation();
                    
                    echo "<div id='post_$get_id' style='width:60%;'>";

                    echo get_post($get_id, $mysqli);

                    echo "</div><div id='business' style='width:40%; float: left;'>";

                    // business_name,
                    // address_street,
                    // address_district,
                    // address_city,
                    // address_number,
                    // phone_number,
                    // facebook_url,
                    // instagram_url,
                    // twitter_url,
                    // website_url,
                    // email,
                    // description,
                    // subscription_id

                    $business = $businesses->readByPostID($get_id, $mysqli);
                    echo "<h1>$business->business_name</h1>";
                    echo '<img src="data:image/jpg;base64,' . base64_encode($business->image) . '" /><hr>';

                    echo "</div>";

            ?>
            </div>
            </div>   
            <!-- End of posts grid section -->
        </div>
        <!-- End of container -->

    </header>



    <!-- Nav Menu -->
    <div class='nav-menu hide' style="display:none;">
        <div class='container'>
            <ul>
                <li>
                    <a href="reset-password.php">
                        <span style="color:black; ">Reset Password</span>
                    </a>
                </li>
                <li>
                    <a href="logout.php">
                        <span style="color:black;">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="./js/like_post.js"></script>
</body>


</html>
