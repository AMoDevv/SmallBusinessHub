<?php
//Initalize session



session_start();
// Include the database configuration file  
require_once 'config.php';
require_once "navigation.php";
require_once "./models/posts-model.php";

use App\Models\Posts;

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
} else if ($ans == 2) {
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
    <link rel="stylesheet" href="./css/profile.css">

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

<body>
    <!-- partial:index.partial.html -->
    <header>

        <div class="c">

            <div class="my-profile">

                <div class="my-profile-image">
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
                            echo '<img src="data:image/jpg;base64,' . base64_encode($row['image']) . '"  />';
                        } else {
                            echo "error";
                        }
                    }

                    ?>



                </div>

                <div class="my-profile-user-settings">

                    <h1 class="my-profile-user-name"><b><?php echo htmlspecialchars($_SESSION["username"]); ?></b></h1>

                    <button class="btn1 my-profile-edit-btn">Edit Profile</button>

                    <button class="btn1 my-profile-settings-btn" aria-label="my-profile settings"><i class="fas fa-cog" aria-hidden="true"></i></button>

                </div>

                <div class="my-profile-bio">

                    <p><span class="my-profile-real-name">
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
                    </p>

                </div>

            </div>
            <!-- End of profile section -->

            <!-- Start of posts grid section -->
            <div class="container">
            <div class="row">
            <?php
                    //need to get the current user's ID from Session array
                    $id = $_SESSION["account_id"];

                    $accountType = $_SESSION["account_type"];
                    
                    //IF USER IS GENERAL USER
                    if ($accountType == 1) {


                    } 
                    
                    //IF USER IS BUSINESS USER
                    else if ($accountType == 2) {
                        $businessID = $_SESSION["business_id"];
                        $var = new Posts();
                        $posts = $var->postsForBusiness($businessID, $mysqli);
                        
                        foreach($posts as $post){
                            $image = "data:image/jpg;base64,".base64_encode($post->photo);
                            echo "<div class='col-4 post-divs'>
                                    <img src='$image' class='post-images'>
                                    <br>
                                    <p>$post->description</p>
                                    </div>";
                        }
                    }

            ?>
            </div>
            </div>   
            <!-- End of posts grid section -->
        </div>
        <!-- End of container -->

    </header>



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
    <script src="js/profile.js"></script>
</body>


</html>