
<?php

chdir("..");
session_start();

echo getcwd() . "\n";
require_once "./models/saves-model.php";
require_once "./config.php";

use App\Models\Saves;

if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['post_id']))
{
    
    test($_POST['post_id'], $_POST['liked'], $mysqli);
}

function test($post_id, $liked, $mysqli){
    echo "TEST";
    $save = new Saves();
    $save->setPostID($post_id);
    $save->setUserID($_SESSION["account_id"]);
    
    return $save->create([], $mysqli);
}

?>