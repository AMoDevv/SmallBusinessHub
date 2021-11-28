<?php
//Initalize session


session_start();
// Include the database configuration file  
require_once 'config.php';
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
            <div class="bg-gray-200 grid grid-cols-3 mt-20 place-content-center p-10 rounded-lg ">
            <?php
                    //need to get the current user's ID from Session array
                    
                    $get_id = (int)$_GET["id"];

                    $posts = new Posts();
                    $post = $posts->read($get_id, $mysqli);
                    $businesses = new BusinessInformation();

                    echo "<div id='business' class='col-span-1'style='width:20% ; '>";

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
                    echo '<img src="data:image/jpg;base64,' . base64_encode($business->image) . '" /><hr>';
                    echo "<a href='business.php?q=$business->business_id'><h1 class='text-4xl'>$business->business_name</h1></a>";

                    echo "</div>";
                    echo "<div id='post_$get_id' class='col-span-2 text-2xl'>";

                    echo get_post($get_id, $mysqli);

                    echo "</div>";

            ?>
            </div>
            </div>   
            <!-- End of posts grid section -->
        </div>
        <!-- End of container -->

    </header>



    <!-- Nav Menu -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="./js/like_post.js"></script>
</body>


</html>
