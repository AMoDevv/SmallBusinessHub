
<?php


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
    echo "<div class='grid grid-rows-6 p-4 mb-48'>
            <div class='group relative row-span-4 justify-items-center'>  
                <img src='$image' class='modal-open group-hover:opacity-75 inline h-48 object-contain object-center' data-id='$post_id'>
            </div>
            <br>
            <div class='row-span-1'>
            <p>".$post->getDescription()."</p>
            </div>
            <br>
            ";
    
    
    if($saves->save_exists($post_id, $_SESSION["account_id"], $mysqli)) {
        echo "<div class='row-span-1'> <button class='like_button px-4 py-2 rounded bg-blue-500 hover:bg-blue-400 text-white font-semibold text-center block w-full focus:outline-none focus:ring focus:ring-offset-2 focus:ring-blue-500 focus:ring-opacity-80 cursor-pointer' value='$post_id' value-liked='true'>Unlike</button>";
    } else {
        echo "<div class='row-span-1'> <button class='like_button px-4 py-2 rounded bg-blue-500 hover:bg-blue-400 text-white font-semibold text-center block w-full focus:outline-none focus:ring focus:ring-offset-2 focus:ring-blue-500 focus:ring-opacity-80 cursor-pointer' value='$post_id' value-liked='false'>Like</button>";
    }

    echo $saves->get_likes($post_id, $mysqli);
    echo "Likes </div></div>";

    
}

?>
