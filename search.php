<?php
//Initalize session

use App\Models\Category;
use App\Models\Tags;

session_start();
// Include the database configuration file  
require_once './config.php';
require_once "./navigation.php";

require_once "./models/tags-model.php";
require_once "./models/category-model.php";
require_once "./models/result.php";

// // Check if the user is logged in, if not then redirect him to login page
// if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
//     header("location: login.php");
//     exit;
// }

$search_term = $_GET["q"];
// if(){
//     // Redirect
// }

// TAGS
$tag_search = new Tags();
$tag_result = $tag_search->getUniqueTags($mysqli);
// Sort by tag match
$tag_out = array();
foreach ($tag_result as $tag_name) {
    // output data of each row
    $tag = strtolower($tag_name);
    $rat = 1 - levenshtein($tag, $search_term) / max(strlen($search_term), strlen($tag));
    if($rat > 0.7) {
        array_push($tag_out, new Result($tag_name, $rat));
    }
}

usort($tag_out, function ($a,$b) {
    return $a->getVal()<$b->getVal();
});

foreach($tag_out as $lis) {
    echo $lis->getName(). $lis->getVal(). "<br>";
}
// Show only top 4





// Categories
$cat_search = new Category();
$cat_result = $cat_search->getUniqueCategory($mysqli);
// Sort by tag match
$cat_out = array();
foreach ($cat_result as $cat_name) {
    // output data of each row
    $tag = strtolower($cat_name);
    $rat = 1 - levenshtein($tag, $search_term) / max(strlen($search_term), strlen($tag));
    if($rat > 0.7) {
        array_push($cat_out, new Result($cat_name, $rat));
    }
}

usort($cat_out, function ($a,$b) {
    return $a->getVal()<$b->getVal();
});

foreach($cat_out as $lis) {
    echo $lis->getName(). $lis->getVal(). "<br>";
}


$name_search;
$category_search;


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <style type="text/css">
        body {
            font: 14px sans-serif;
            text-align: center;
        }
    </style>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/favicon.ico" />
</head>

<body>
    <div class="page-header">
        <h1>Search Page</h1>



    </div>
    
</body>

</html>