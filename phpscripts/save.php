
<?php
// This is the script used to save a like or unlike request

chdir("..");
session_start();

echo getcwd() . "\n";
require_once "./models/saves-model.php";
require_once "./config.php";

use App\Models\Saves;

if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['post_id']))
{
    
    like($_POST['post_id'], $_POST['liked'], $mysqli);
}

function like($post_id, $liked, $mysqli){
    echo "TEST";
    $save = new Saves();
    $save->setPostID($post_id);
    $save->setUserID($_SESSION["account_id"]);
    

    if($liked=='true'){
        return $save->delete($post_id, $_SESSION["account_id"], $mysqli);
    } else {
        return $save->create([], $mysqli);
    }

}

?>