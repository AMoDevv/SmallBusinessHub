<?php
//Initalize session

use App\Models\BusinessInformation;
use App\Models\Category;
use App\Models\Tags;

session_start();
// Include the database configuration file  
require_once './config.php';
require_once "./models/tags-model.php";
require_once "./models/category-model.php";
require_once "./models/result.php";
require_once "./models/business-model.php";

// Check if the user is logged in, if not then blueirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Initialize Search Term
$search_term = "";

if (isset($_GET["q"])){
    $search_term = $_GET["q"];
}
$search_term = strtolower($search_term);

// Initialize Business Categories
$filtered_cats = array();
if(isset($_GET['cat'])) {
    $filtered_cats = $_GET['cat'];
}

$business_filter = false;
$tags_filter = false;
$categories_filter = false;
$no_filter = false;

// Filters
if(!(isset($_GET['business']) || isset($_GET['tags']) || isset($_GET['categories']))) {
    $no_filter = true;
} else {
    if(isset($_GET['business'])){
        $business_filter = true;
    }
    if (isset($_GET['tags'])) {
        $tags_filter = true;
    } 
}



// Ratios
$out = array();
$tag_rat = 0.0;
$cat_rat = 0.0;
$bus_rat = 0.0;

if( $no_filter || $tags_filter ){
    // TAGS
    $tag_search = new Tags();
    $tag_result = $tag_search->getUniqueTags($mysqli);
    // Sort by tag match
    foreach ($tag_result as $tag) {
        // output data of each row
        $tag_name = strtolower($tag->tag);
        $rat = 1 - levenshtein($tag_name, $search_term) / max(strlen($search_term), strlen($tag_name));
        if($rat >= $tag_rat ) {
            array_push($out, new Result($tag->tag, $rat, "Tag", $tag->tag, $tag->photo));
        }
    }
}
    

if( $no_filter || $business_filter ){
    // Business
    $business_search = new BusinessInformation();
    $business_result = $business_search->getBusinessNames($mysqli, $filtered_cats);
    // Sort by tag match
    foreach ($business_result as $business) {
        // output data of each row
        
        $tag = strtolower($business->business_name);
        $rat = 1 - levenshtein($tag, $search_term) / max(strlen($search_term), strlen($tag));
        if($rat >= $bus_rat) {
            array_push($out, new Result($business->business_name, $rat, "Business", $business->business_id, $business->image));
        }
    }
}

// Sort results
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
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.2.4/dist/cdn.min.js"></script>
</head>

<body>
    <!-- Navigation -->
<nav class="bg-gray-900 shadow-2xl"> 
  <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
    <div class="relative flex items-center justify-between h-16">
      <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
        <a class="flex-shrink-0 flex items-center" href="search.php">          
          <img class="hidden lg:block h-8 w-auto" src="images/Home.png" alt="home">
            </a>
        <div class="hidden sm:block sm:ml-6">
          <div class="flex space-x-4 ">
          <form id='search' action="search.php" method="GET">
                        <?php echo  '<input name="q" type="text" class=" h-8 w-96 pr-8 pl-5 rounded z-0 focus:shadow focus:outline-none" placeholder="Search for a business..." value="'.$search_term.'">' ?>
                        <button type="submit"class=" p-1 rounded bg-yellow-400 hover:bg-yellow-200 text-black font-semibold focus:outline-none focus:ring focus:ring-offset-2 border-2 border-gray-900 focus:ring-gray-900 focus:ring-opacity-80 cursor-pointer" >Search</button>
                    </form>
            <!-- <input type="text" class="h-8 w-96 pr-8 pl-5 rounded z-0 focus:shadow focus:outline-none" placeholder="Search for a business...">         
              <div class="absolute top-4 right-3"> <i class="fa fa-search text-gray-400 z-20 hover:text-gray-500"></i> 
              </div> -->
          </div>
        </div>
      </div>
      <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">

        <div class="ml-3 relative">
          <div x-data="{ open: false }" @mouseleave="open = false" class="relative">
            <a type="button" @mouseover="open = true" class="bg-gray-800 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
              <span class="sr-only">Open user menu</span>
              <!-- User image needed-->
              <?php
                    //need to get the current user's ID from Session array
                    $id = $_SESSION["account_id"];

                    $accountType = $_SESSION["account_type"];

                    if ($accountType == 1) {
                        $sql = "SELECT image FROM general_user_information WHERE account_id = $id";
                        $result = $mysqli->query($sql);
                        $row = $result->fetch_assoc();
                        echo'<img class="rounded-full h-8 w-8" src="data:image/jpg;base64,' . base64_encode($row['image']) . '" />';
                    }
                        ?>
              
                </a>

                <div x-show="open"
            x-transition:enter.duration.100ms
            x-transition:leave.duration.1000ms
            class="absolute right-0 w-48 py-2 mt-2 bg-white bg-gray-100 rounded-md shadow-xl">
                <div
                    class="block px-4 py-2 text-sm text-gray-300 font-bold text-gray-700">
                  <?php  $id = $_SESSION["account_id"];

                            $accountType = $_SESSION["account_type"];

                            if ($accountType == 1) {
                                $sql = "SELECT first_name, last_name FROM general_user_information WHERE account_id = $id";
                                $result = $mysqli->query($sql);
                                if ($result->num_rows == 1) {
                                    $row = $result->fetch_assoc();
                                    echo $row['first_name'];
                                    echo '&nbsp;';
                                    echo $row['last_name'];
                                } else {
                                    echo "error";
                                }
                            }
                                ?>
                </div>
                <a href="editgeneraluser.php"
                    class="block px-4 py-2 text-sm text-gray-300 text-gray-700 hover:bg-gray-400 hover:text-white">
                    Edit profile
                </a>
                <a href="reset-password.php"
                    class="block px-4 py-2 text-sm text-gray-300 text-gray-700 hover:bg-gray-400 hover:text-white">
                    Reset Password
                </a>
                <a href="logout.php"
                    class="block px-4 py-2 text-sm text-gray-300 text-gray-700 hover:bg-gray-400 hover:text-white">
                    Logout
                </a>
            </div>
            
        </div>
        
        </div>

      </div>
    </div>
  </div> 
</nav>
<!--grid-->
<div class="grid grid-cols-6 md:grid-cols-12 grid-flow-col gap-4">

<!--col 1-->
<div class="col-span-2">
    <div class="">
        <div class="flex flex-col items-left p-10 ">
            <div class="flex flex-col">
                <h1 class="font-bold items-left"> Filters</h1>
                            <?php 
                                if( $business_filter ) {
                                    echo "
                                    <label class='inline-flex items-center mt-3'>
                                    <input form='search' type='checkbox' type='checkbox' name='business' value='true' class='form-checkbox h-5 w-5 text-gray-600' checked >
                                    <span class='ml-2 text-gray-700'>Business</span>
                                    </label>
                                    ";
                                } else {
                                    echo " 
                                    <label class='inline-flex items-center mt-3'>
                                    <input form='search' type='checkbox' type='checkbox' name='business' value='false' class='form-checkbox h-5 w-5 text-gray-600' >
                                    <span class='ml-2 text-gray-700'>Business</span>
                                    </label>";
                                }
                            
                                if( $tags_filter ) {
                                    echo "
                                    <label class='inline-flex items-center mt-3'>
                                    <input form='search' type='checkbox' type='checkbox' name='tags' value='true' class='form-checkbox h-5 w-5 text-gray-600' checked >
                                    <span class='ml-2 text-gray-700'>tags</span>
                                    </label>";
                                } else {
                                    echo "
                                    <label class='inline-flex items-center mt-3'>
                                    <input form='search' type='checkbox' type='checkbox' name='tags' value='false' class='form-checkbox h-5 w-5 text-gray-600' >
                                    <span class='ml-2 text-gray-700'>tags</span>
                                    </label>";
                                }       
                                
                                echo "<label class='inline-flex items-center mt-3'>";
                                echo "<select form='search' name='cat[]' id='cat' multiple class='' style='height:150px;overflow: inherit;'>";
                                echo "<option class='inline-flex items-center mt-3' value='1' ". (in_array('1', $filtered_cats) ? "selected" : "") ." >Health</option>";
                                echo "<option value='2' ". (in_array('2', $filtered_cats) ? "selected" : "") ." >Entertainment</option>";
                                echo "<option value='3' ". (in_array('3', $filtered_cats) ? "selected" : "") ." >Clothing</option>";
                                echo "<option value='4' ". (in_array('4', $filtered_cats) ? "selected" : "") ." >Crafts</option>";
                                echo "<option value='5' ". (in_array('5', $filtered_cats) ? "selected" : "") ." >Hobbies</option>";
                                echo "<option value='6' ". (in_array('6', $filtered_cats) ? "selected" : "") ." >Electronics</option>";
                                echo "</select>
                                </label>
                                ";
                                
                            ?>
            </div>
        </div>                        

    </div>
</div>
<!--col2-->

    <div class="page-header col-span-11 pr-20 text-center">
        
                    <div class='grid lg:grid-cols-5 md:grid-cols-3 md:grid-cols-1 gap-4'>
                     <?php
                        foreach($out as $output){

                            $image = "data:image/jpg;base64,".base64_encode($output->photo);
                            echo "   
                            <div class='shadow-xl p-3 cols-span-1'>
                            <a href='./$output->type.php?q=$output->id'>
                              <div class='gap-y-10 gap-x-6 rounded-md overflow-hidden h-4/5 group-hover:opacity-75'>
                                <img src='$image' alt='pic' class='object-contain w-full h-full object-center lg:w-full lg:h-full'>
                              </div>
                              <div class='mt-4 flex justify-between'>
                                <div>
                                  <h3 class=' text-gray-700'>
                                      <h1 class='font-bold' >$output->name</h1>                                    
                                  </h3>
                                  
                                </div>
                                </a>
                            </div>                       
                            </div>
                            ";
                        }
                    ?>
                    </div>    
    </div>
</div>

</body>

</html>