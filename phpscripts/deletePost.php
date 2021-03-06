
<?php
// This php script deletes a post
chdir("..");
session_start();

echo getcwd() . "\n";
require_once "./models/saves-model.php";
require_once "./models/posts-model.php";
require_once "./models/tags-model.php";
require_once "./config.php";

use App\Models\Posts;
use App\Models\Saves;
use App\Models\Tags;

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login.php");
    exit;
}
if(!isset($_SESSION["business_id"])){
    header("location: ../profile.php");
    exit;
}

if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['post_id']))
{
    delete($_POST['post_id'], $mysqli);
}

function delete($post_id, $mysqli){
    echo "TEST";
    $posts = new Posts();
    $save = new Saves();
    $tags = new Tags();
    // Deletes the saves
    $save->deletePostsDeleteSaves($post_id, $mysqli);
    // Deletes the tags
    $tags->deletePostsDeleteTags($post_id, $mysqli);
    // Deletes the post
    $posts->delete($post_id, $mysqli);
    
    
    // Redirect
    header("location: ../profile.php");
    exit;
}

?>