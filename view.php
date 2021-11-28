<?php
//Initalize session


session_start();
// Include the database configuration file  
require_once 'config.php';
require_once "./models/business-model.php";
require_once "./models/posts-model.php";
require_once "./models/saves-model.php";

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

        <div class="">
            <!-- End of profile section -->

            <!-- Start of posts grid section -->
            <div class="container">
            <div class="bg-gray-100 grid grid-cols-3 mt-20 place-content-center p-10 rounded-lg ">
            <?php
                    //need to get the current user's ID from Session array
                    
                    $get_id = (int)$_GET["id"];

                    $posts = new Posts();
                    $post = $posts->read($get_id, $mysqli);
                    $businesses = new BusinessInformation();

                    echo "<div class='p-10'> <div id='business' class='h-80 w-80 container'style='width:20% ; '>";

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
                    echo '<div class="h-40 w-40 flex justify-center items-center mr-40"><img src="data:image/jpg;base64,' . base64_encode($business->image) . '" /></div>';
                    echo "<a href='business.php?q=$business->business_id'><h1 class='text-4xl'>$business->business_name</h1></a>";

                    echo "</div>";
                    
                    echo "<div id='post_$get_id' class='col-span-2 text-2xl relative'>";
                    $image = get_post($get_id, $mysqli);

                    function get_post($post_id, $mysqli){
                        $posts = new Posts();
                        $post = $posts-> read($post_id, $mysqli);
                        $saves = new Saves();

                        echo "<div class='p-4 mb-screen'>
                        
                        </div>
                        </div>
                        <br>
                        <div class='row-span-1'>
                        <p>".$post->getDescription()."</p>
                        </div>
                        <br>
                        ";
                        
                        
                        if($saves->save_exists($post_id, $_SESSION["account_id"], $mysqli)) {
                            echo "<div class='row-span-1'> <button class='like_button px-4 py-2 rounded bg-blue-500 hover:bg-blue-400 text-white font-semibold text-center block w-full focus:outline-none focus:ring focus:ring-offset-2 focus:ring-blue-500 focus:ring-opacity-80 cursor-pointer' value='$post_id' value-liked='true'>Unlike</button><div>";
                        } else {
                            echo "<div class='row-span-1'> <button class='like_button px-4 py-2 rounded bg-blue-500 hover:bg-blue-400 text-white font-semibold text-center block w-full focus:outline-none focus:ring focus:ring-offset-2 focus:ring-blue-500 focus:ring-opacity-80 cursor-pointer' value='$post_id' value-liked='false'>Like</button><div>";
                        }
                        
                        echo $saves->get_likes($post_id, $mysqli);
                        echo "<button class='text-pink-500 background-transparent font-bold uppercase outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150' type='button'
                        >
                        <i class='fas fa-heart'></i>
                        </button>Likes</div>";
                        
                        return "data:image/jpg;base64,".base64_encode($post->getPhoto());
                        
                    }


                    echo "</div> </div>";

                    echo "<div class='group col-span-2 justify-items-center m-auto object-none h-full w-full'>  
                    <img src='$image' class='modal-open' data-id='$get_id'>
                    </div>";

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
