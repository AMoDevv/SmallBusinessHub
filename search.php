<?php
//Initalize session

use App\Models\BusinessInformation;
use App\Models\Category;
use App\Models\Tags;

session_start();
// Include the database configuration file  
require_once './config.php';
require_once "./navigation.php";

require_once "./models/tags-model.php";
require_once "./models/category-model.php";
require_once "./models/result.php";
require_once "./models/business-model.php";

// // Check if the user is logged in, if not then redirect him to login page
// if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
//     header("location: login.php");
//     exit;
// }

$search_term = $_GET["q"];
// if( no $search ){
//     // Redirect
// }
$out = array();
$tag_rat = 0.7;
$cat_rat = 0.7;
$bus_rat = 0.7;

// TAGS
$tag_search = new Tags();
$tag_result = $tag_search->getUniqueTags($mysqli);
// Sort by tag match
foreach ($tag_result as $tag_name) {
    // output data of each row
    $tag = strtolower($tag_name);
    $rat = 1 - levenshtein($tag, $search_term) / max(strlen($search_term), strlen($tag));
    if($rat > $tag_rat) {
        array_push($out, new Result($tag_name, $rat, "Tag"));
    }
}


// Categories
$cat_search = new Category();
$cat_result = $cat_search->getUniqueCategory($mysqli);
// Sort by tag match
foreach ($cat_result as $cat_name) {
    // output data of each row
    $tag = strtolower($cat_name);
    $rat = 1 - levenshtein($tag, $search_term) / max(strlen($search_term), strlen($tag));
    if($rat > $cat_rat) {
        array_push($out, new Result($cat_name, $rat, "Category"));
    }
}


// Business
$business_search = new BusinessInformation();
$business_result = $business_search->getBusinessNames($mysqli);
// Sort by tag match
foreach ($business_result as $business) {
    // output data of each row

    $tag = strtolower($business->business_name);
    $rat = 1 - levenshtein($tag, $search_term) / max(strlen($search_term), strlen($tag));
    if($rat > $bus_rat) {
        array_push($out, new Result($business->business_name, $rat, "Business"));
    }
}

usort($out, function ($a,$b) {
    return $a->getVal()<$b->getVal();
});



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

        <div style="width: 100%; padding: 40px;">
            <h1>Results</h1>
            <div style='width: 100%;'>
            <?php
                foreach($out as $output){
                    echo "
                    <div style='width: 33%; float: left;'>
                    <h1>$output->name</h1>
                    <p>This is a $output->type</p>
                    </div>
                    ";
                }
            ?>
            </div>
        </div>

    </div>
    
</body>

</html>