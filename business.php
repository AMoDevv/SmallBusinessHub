<?php
//Initalize session
session_start();

// Include the database configuration file  
require_once 'config.php';
require_once "navigation.php";
require_once "./models/posts-model.php";
require_once "./models/saves-model.php";
require_once "./models/business-model.php";
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

if (!isset($_GET["q"])) {
    header("location: search.php");
    exit;
}

$businesses = new BusinessInformation();

$business = $businesses->read((int)$_GET["q"], $mysqli);

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

            <div class="my-profile">

                <div class="my-profile-image">
                    <?php

                    echo '<img src="data:image/jpg;base64,' . base64_encode($business->image) . '" />';

                    ?>
                </div>

                <div class="my-profile-bio">
                    <p>
                        <span class="my-profile-real-name">
                            <?php echo $business->business_name;?>
                        </span>
                        <br>
                        <?php echo $business->description;?>
                    </p>

                </div>

            </div>
            <!-- End of profile section -->

            <!-- Start of posts grid section -->
            <div class="container">
            <div class="row">
            <?php
                $var = new Posts();
                
                $posts = $var->postsForBusiness($business->business_id, $mysqli);
                
                foreach($posts as $post){
                    echo "<div id='post_$post->post_id'  class='col-4 post-divs'> ";

                    echo get_post($post->post_id, $mysqli);

                    echo "</div>";
                }

            ?>
            </div>
            </div>   
            <!-- End of posts grid section -->
        </div>
        <!-- End of container -->

    </header>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="./js/like_post.js"></script>
</body>


</html>
