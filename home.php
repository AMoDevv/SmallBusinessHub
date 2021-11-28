<?php
//Initalize session
session_start();
use App\Models\BusinessInformation;
use App\Models\Category;
use App\Models\Tags;

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

// // $search_term = $_GET["q"];
// $search_term = strtolower("fish");
// // if( no $search ){
// //     // Redirect
// // }
// $out = array();
// $tag_rat = 0.7;
// $cat_rat = 0.7;
// $bus_rat = 0.7;

// // TAGS
// $tag_search = new Tags();
// $tag_result = $tag_search->getUniqueTags($mysqli);
// // Sort by tag match
// foreach ($tag_result as $tag) {
//     // output data of each row
//     $tag_name = strtolower($tag->tag);
//     $rat = 1 - levenshtein($tag_name, $search_term) / max(strlen($search_term), strlen($tag_name));
//     if($rat > $tag_rat) {
//         array_push($out, new Result($tag->tag, $rat, "Tag", $tag->tag, $tag->photo));
//     }
// }


// // Categories
// $cat_search = new Category();
// $cat_result = $cat_search->getUniqueCategory($mysqli);
// // Sort by tag match
// foreach ($cat_result as $cat) {
//     // output data of each row
//     $tag = strtolower($cat);
//     $rat = 1 - levenshtein($tag, $search_term) / max(strlen($search_term), strlen($tag));
//     if($rat > $cat_rat) {
//         array_push($out, new Result($cat->name, $rat, "Category", $cat->id, $cat->photo));
//     }
// }


// // Business
// $business_search = new BusinessInformation();
// $business_result = $business_search->getBusinessNames($mysqli);
// // Sort by tag match
// foreach ($business_result as $business) {
//     // output data of each row

//     $tag = strtolower($business->business_name);
//     $rat = 1 - levenshtein($tag, $search_term) / max(strlen($search_term), strlen($tag));
//     if($rat > $bus_rat) {
//         array_push($out, new Result($business->business_name, $rat, "Business", $business->business_id, $business->image));
//     }
// }

// usort($out, function ($a,$b) {
//     return $a->getVal()<$b->getVal();
// });
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

<body class="bg-white">
<nav class="bg-gradient-to-r from-red-200 to-red-300 shadow-2xl"> 
  <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
    <div class="relative flex items-center justify-between h-16">
      <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
        <a class="flex-shrink-0 flex items-center" href="home.php">          
          <img class="hidden lg:block h-8 w-auto" src="images/Home.png" alt="home">
            </a>
        <div class="hidden sm:block sm:ml-6">
          <div class="flex space-x-4 ">
          <form id='search' action="search.php" method="GET">
                        <?php echo  '<input name="q" type="text" class=" h-8 w-96 pr-8 pl-5 rounded z-0 focus:shadow focus:outline-none" placeholder="Search for a business..." >' ?>
                        <button type="submit"class="" >Search</button>
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
                        echo'<img class="rounded-full h-10 w-10" src="data:image/jpg;base64,' . base64_encode($row['image']) . '" />';
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


   <div class="grid grid-cols-2 gap-5 px-8">
     <div> 
     <h2 class="text-2xl font-extrabold tracking-tight text-gray-900 py-6">Small Business Hub</h2>
     <div class="group relative shadow-2xl">
     <div class=" p-3 flex-1 w-full min-h-80 aspect-w-1 aspect-h-1 rounded-md overflow-hidden lg:h-80 lg:aspect-none">
      </div>
     <div>
      </div>
      
      
      </div>
      </div>


     <div>
      <h2 class="text-2xl font-extrabold tracking-tight text-gray-900 py-6">Spotlight</h2>
      <div class="grid grid-cols-2 group relative shadow-2xl">
      
        <div class="p-3">
            <div class="flex-1 w-full min-h-80 bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none">
              <img src="images/deliverit.png" alt="pic" class="w-full h-full object-center object-cover lg:w-full lg:h-full">
            </div>
          </div>
            <div>
              <p>info</p>
            </div>
        
        </div>
      </div>
    </div>  

  <div class="bg-white">
  <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
    <h2 class="text-2xl font-extrabold tracking-tight text-gray-900">Recommended for you</h2>

    <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
      <div class="group relative shadow-2xl  p-3">
        <div class="w-full min-h-80 bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none">
          <img src="images/deliverit.png" alt="pic" class="w-full h-full object-center object-cover lg:w-full lg:h-full">
        </div>
        <div class="mt-4 flex justify-between">
          <div>
            <h3 class="text-sm text-gray-700">
              <a href="#">
                <span aria-hidden="true" class="absolute inset-0"></span>
                Deliver IT
              </a>
            </h3>
            <p class="mt-1 text-sm text-gray-500">San ignacio, Cayo</p>
          </div>
          <p class="text-sm font-medium text-gray-900">606-1234</p>
        </div>
      </div>

      <div class="group relative shadow-2xl  p-3">
        <div class="w-full min-h-80 bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none">
          <img src="images/deliverit.png" alt="pic" class="w-full h-full object-center object-cover lg:w-full lg:h-full">
        </div>
        <div class="mt-4 flex justify-between">
          <div>
            <h3 class="text-sm text-gray-700">
              <a href="#">
                <span aria-hidden="true" class="absolute inset-0"></span>
                Deliver IT
              </a>
            </h3>
            <p class="mt-1 text-sm text-gray-500">San ignacio, Cayo</p>
          </div>
          <p class="text-sm font-medium text-gray-900">606-1234</p>
        </div>
      </div>

      <div class="group relative shadow-2xl  p-3">
        <div class="w-full min-h-80 bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none">
          <img src="images/deliverit.png" alt="pic" class="w-full h-full object-center object-cover lg:w-full lg:h-full">
        </div>
        <div class="mt-4 flex justify-between">
          <div>
            <h3 class="text-sm text-gray-700">
              <a href="#">
                <span aria-hidden="true" class="absolute inset-0"></span>
                Deliver IT
              </a>
            </h3>
            <p class="mt-1 text-sm text-gray-500">San ignacio, Cayo</p>
          </div>
          <p class="text-sm font-medium text-gray-900">606-1234</p>
        </div>
      </div>

      <div class="group relative shadow-2xl  p-3">
        <div class="w-full min-h-80 bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none">
          <img src="images/deliverit.png" alt="pic" class="w-full h-full object-center object-cover lg:w-full lg:h-full">
        </div>
        <div class="mt-4 flex justify-between">
          <div>
            <h3 class="text-sm text-gray-700">
              <a href="#">
                <span aria-hidden="true" class="absolute inset-0"></span>
                Deliver IT
              </a>
            </h3>
            <p class="mt-1 text-sm text-gray-500">San ignacio, Cayo</p>
          </div>
          <p class="text-sm font-medium text-gray-900">606-1234</p>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- =============Trending================ -->
<?php

if ($result = $mysqli -> query("
SELECT p.post_id
FROM 
    (
        SELECT post_id, COUNT(*) as c
        FROM saves
        WHERE DATEDIFF(CURRENT_TIMESTAMP, DateCreated) < 7
        GROUP BY post_id
        ORDER BY c DESC
    )
as p
LIMIT 4; ")) 
{
  echo "Returned rows are: " . $result -> num_rows;
  // Free result set 
}

?>

<!-- ==========Top food=============== -->
  
<div style="width: 100%; padding: 40px;">
            <h1>Results</h1>
            <div style='width: 100%;'>
            <?php
                foreach($out as $output){
                    $image = "data:image/jpg;base64,".base64_encode($output->photo);
                    echo "
                    <div style='width: 33%; float: left;'>
                    <h1>$output->name</h1>
                    <img src='$image' class='post-images'>
                    <p>This is a $output->type</p>
                    <a href='/SmallBusinessHub/$output->type/$output->id'>'/SmallBusinessHub/$output->type/$output->id'</a>
                    </div>
                    ";
                }
            ?>
            </div>
  </div>


<footer class="p-10 bg-gradient-to-r from-green-400 to-blue-500 ">
  <p> Footer</p>
      </footer> 
</body>

</html>