
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
    echo "<div>
            <img src='$image' class='post-images'>
            <br>
            <p>".$post->getDescription()."</p>
            <br>
            ";
    
    
    if($saves->save_exists($post_id, $_SESSION["account_id"], $mysqli)) {
        echo "<button class='like_button' value='$post_id' value-liked='true'>Unlike</button>";
    } else {
        echo "<button class='like_button' value='$post_id' value-liked='false'>Like</button>";
    }

    echo "</div>";

    
}

?>