<?php
//Initalize session



session_start();
// Include the database configuration file  
require_once 'config.php';
require_once "./models/posts-model.php";
require_once "./models/saves-model.php";
require_once "./phpscripts/getPost.php";

use App\Models\Posts;
use App\Models\Saves;

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
//need to get the current user's ID from Session array
$id = $_SESSION["account_id"];

$accountType = $_SESSION["account_type"];

if ($accountType == 1) {
    $sql = "SELECT image FROM general_user_information WHERE account_id = $id";
} else if ($accountType == 2) {
    $sql = "SELECT image FROM business_information WHERE account_id = $id";
}
$result = $mysqli->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    // echo '<img src="data:image/jpg;base64,' . base64_encode($row['image']) . '"  />';
} else {
    //echo "error";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CodePen - Instagram Profile Layout with CSS Grid &amp; Flexbox</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

  <style>
    .modal {
      transition: opacity 0.25s ease;
    }
    body.modal-active {
      overflow-x: hidden;
      overflow-y: visible !important;
    }
  </style>
</head>
<style>
.post-images{
    height: 480px;
    width:98%;
}
.post-divs{
    padding: 10px;
    border: 1px solid;
    border-radius: 10px;
}
</style>

<body class=" flex justify-center">


    <!-- partial:index.partial.html -->
<header>
<nav class=""> 
                <div x-show="open"
            x-transition:enter.duration.100ms
            x-transition:leave.duration.1000ms
            class="absolute right-0 w-48 mt-2 mr-2 bg-white bg-gray-100 rounded-md shadow-xl">
                <a href="editBusinessuser.php"
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
</nav>
<div class="c">
    <div class="flex justify-center bg-blue-700 items-center h-auto w-auto">
        
                    <div class="bg-blue-700 text-white flex justify-center p-16 px-80 grid grid-rows-1">
                        <div class="h-40 w-40 container mx-auto">
                            <?php
                            //need to get the current user's ID from Session array
                            $id = $_SESSION["account_id"];

                            $accountType = $_SESSION["account_type"];

                            if ($accountType == 1) {
                                $sql = "SELECT image FROM general_user_information WHERE account_id = $id";
                                $result = $mysqli->query($sql);

                                if ($result->num_rows == 1) {
                                    $row = $result->fetch_assoc();
                                    echo '<img src="data:image/jpg;base64,' . base64_encode($row['image']) . '" />';
                                } else {
                                    echo "error";
                                }
                            } else if ($accountType == 2) {
                                $sql = "SELECT image FROM business_information WHERE account_id = $id";
                                $result = $mysqli->query($sql);

                                if ($result->num_rows == 1) {
                                    $row = $result->fetch_assoc();
                                    echo '<img class="w-auto h-auto" src="data:image/jpg;base64,' . base64_encode($row['image']) . '"  />';
                                } else {
                                    echo "error";
                                }
                            }

                            ?>
                        </div>
                        <div><h1 class="text-4xl p-8"><b><?php echo htmlspecialchars($_SESSION["username"]); ?></b></h1></div>
                        <div class="my-profile-bio">

                                <p><span class="text-xl p-8">
                                        <?php

                                        //need to get the current user's ID from Session array
                                        $id = $_SESSION["account_id"];

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
                                        } else if ($accountType == 2) {
                                            $sql = "SELECT business_name FROM business_information WHERE account_id = $id";
                                            $result = $mysqli->query($sql);
                                            if ($result->num_rows == 1) {
                                                $row = $result->fetch_assoc();
                                                echo $row['business_name'];
                                            } else {
                                                echo "error";
                                            }
                                        }



                                        ?>
                                    </span>
                                    <br>
                                    <span class="text-xl p-8">
                                    <?php

                                    //need to get the current user's ID from Session array
                                    $id = $_SESSION["account_id"];

                                    $accountType = $_SESSION["account_type"];

                                    if ($accountType == 1) {
                                        echo '';
                                    } else if ($accountType == 2) {
                                        $sql = "SELECT description FROM business_information WHERE account_id = $id";
                                        $result = $mysqli->query($sql);
                                        if ($result->num_rows == 1) {
                                            $row = $result->fetch_assoc();
                                            echo $row['description'];
                                        } else {
                                            echo "error";
                                        }
                                    }



                                    ?>
                                    </span>
                                </p>

                        </div>
                    </div> 
                    
    </div>
            <!-- End of profile section -->

            <!-- Start of posts grid section -->
            <!-- <div class="container"> -->
                <div class="grid grid-cols-5 gap-4 pt-12 px-60 bg-gray-100">
                    <?php
                            //need to get the current user's ID from Session array
                            $id = $_SESSION["account_id"];

                            $accountType = $_SESSION["account_type"];
                            
                            //IF USER IS GENERAL USER
                            if ($accountType == 1) {
                                echo "<script type='text/javascript'>
                                    document.getElementById('editProfileBtn').classList.add('generalUserEditBtn');
                                </script>";

                            } 
                            
                            //IF USER IS BUSINESS USER
                            else if ($accountType == 2) {
                                echo "<script type='text/javascript'>
                                    document.getElementById('editProfileBtn').classList.add('businessUserEditBtn');
                                </script>";
                                $businessID = $_SESSION["business_id"];
                                $var = new Posts();
                                $posts = $var->postsForBusiness($businessID, $mysqli);
                                $saves = new Saves();
                                
                                foreach($posts as $post){
                                    echo "<div class='group relative'> <div id='post_$post->post_id'  class='object-contain w-full h-full object-center bg-white aspect-w-1 aspect-h-1 rounded-md overflow-hidden lg:h-80 lg:aspect-none'> ";

                                    echo get_post($post->post_id, $mysqli);

                                    echo "</div> </div>";
                                }
                            }

                    ?>
                 </div>   
            <!-- End of posts grid section -->
</div>
        <!-- End of container -->
</header>
  
  <!--Modal-->
  <div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
    <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
    
    <div class="modal-container bg-white w-11/12  mx-auto rounded shadow-lg z-50 overflow-y-auto">
      
      <div class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
        <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
          <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
        </svg>
        <span class="text-sm">(Esc)</span>
      </div>

      <!-- Add margin if you want to see some of the overlay behind the modal-->
      <div class="modal-content py-4 text-left px-6">
        <div class="modal-change"></div>
    </div>
  </div>

  
  <script>
    var openmodal = document.querySelectorAll('.modal-open')
    
    for (var i = 0; i < openmodal.length; i++) {
        openmodal[i].addEventListener('click', function(event){
            event.preventDefault()
            post_id = $(event.target).attr("data-id")
            $.ajax({
            type: "GET",
            url: "./view.php",
            data: {
            id: post_id
            },
        }).done(function (msg) {
            console.log(msg);
            $(".modal-change").html(msg)
            toggleModal(false);
        });
        })
    }
    
    const overlay = document.querySelector('.modal-overlay')
    overlay.addEventListener('click', toggleModal)
    
    var closemodal = document.querySelectorAll('.modal-close')
    for (var i = 0; i < closemodal.length; i++) {
      closemodal[i].addEventListener('click', toggleModal)
    }
    
    document.onkeydown = function(evt) {
      evt = evt || window.event
      var isEscape = false
      if ("key" in evt) {
    	isEscape = (evt.key === "Escape" || evt.key === "Esc")
      } else {
    	isEscape = (evt.keyCode === 27)
      }
      if (isEscape && document.body.classList.contains('modal-active')) {
    	toggleModal()
      }
    };
    
    
    function toggleModal (close = true) {
        console.log(close)
        if(close) {
            
            $(".modal-change").html("")
        }
      const body = document.querySelector('body')
      const modal = document.querySelector('.modal')
      modal.classList.toggle('opacity-0')
      modal.classList.toggle('pointer-events-none')
      body.classList.toggle('modal-active')
    }
    
     
  </script>


    <!-- Nav Menu -->
    <div class='nav-menu hide' style="display:none;">
        <div class='container'>
            <ul>
                <li>
                    <a href="reset-password.php">
                        <span style="color:black; ">Reset Password</span>
                    </a>
                </li>
                <li>
                    <a href="logout.php">
                        <span style="color:black;">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="./js/profile.js"></script>
</body>


</html>
