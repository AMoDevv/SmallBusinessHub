
<?php
// This script returns the html to print out a post
// It is used in business, tag, and category pages

use App\Models\Posts;
use App\Models\Saves;

if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['post_id']))
{
    chdir("..");
    require_once "./models/saves-model.php";
    require_once "./models/posts-model.php";
    require_once "./config.php";
    
    session_start();
    get_post($_POST['post_id'], $mysqli);
}

function get_post($post_id, $mysqli){
    $posts = new Posts();
    $post = $posts-> read($post_id, $mysqli);
    $saves = new Saves();

    $image = "data:image/jpg;base64,".base64_encode($post->getPhoto());
    echo "<div class='grid grid-rows-6 p-4 mb-24'>
            <div class='group relative row-span-4 justify-items-center'>  
                <img src='$image' class='modal-open group-hover:opacity-75 inline h-48 object-contain object-center' data-id='$post_id'>
            </div>
            <br>
            <div class='row-span-1'>
            <p>".$post->getDescription()."</p>
            </div>
            <br>
            <div>
            ";
    
    
    

    echo $saves->get_likes($post_id, $mysqli);
    echo "<button class='text-pink-500 background-transparent font-bold uppercase outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150' type='button'>
<i class='fas fa-heart'></i>
</button>Likes</div> </div>";

    
}

?>
