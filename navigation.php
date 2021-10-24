<?php
require_once "config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Small Business Hub</title>
    <link rel="stylesheet" href="css/navigation.css">
    <link rel="icon" href="images/favicon.ico" />

</head>

<body>
    <div class="middle">
        <div class="nav">
            <!--Privileges-->
            <?php
            if ($_SESSION['account_type'] == 2) //business user
                echo
            '<div class="button-wrap">
                <button onclick="location.href = \'add.php\';" class="btn add">
                <svg  class="svg-icon"  xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                </button>
            </div>';
            elseif ($_SESSION['account_type'] == 1) //general user
                echo 
                '<div class="button-wrap">
                <button onclick="location.href = \'home.php\';" class="btn active feed">
                    <svg class="svg-icon" viewBox="0 0 20 20">
                        <path d="M18.121,9.88l-7.832-7.836c-0.155-0.158-0.428-0.155-0.584,0L1.842,9.913c-0.262,0.263-0.073,0.705,0.292,0.705h2.069v7.042c0,0.227,0.187,0.414,0.414,0.414h3.725c0.228,0,0.414-0.188,0.414-0.414v-3.313h2.483v3.313c0,0.227,0.187,0.414,0.413,0.414h3.726c0.229,0,0.414-0.188,0.414-0.414v-7.042h2.068h0.004C18.331,10.617,18.389,10.146,18.121,9.88 M14.963,17.245h-2.896v-3.313c0-0.229-0.186-0.415-0.414-0.415H8.342c-0.228,0-0.414,0.187-0.414,0.415v3.313H5.032v-6.628h9.931V17.245z M3.133,9.79l6.864-6.868l6.867,6.868H3.133z"></path>
                    </svg>
                </button>
            </div>
            <div class="button-wrap">
                <button onclick="location.href = \'search.php\';" class="btn stats">
                    <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" aria-describedby="desc" role="img" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <path data-name="layer2" fill="none" stroke="#202020" stroke-miterlimit="10" stroke-width="2" d="M39.049 39.049L56 56" stroke-linejoin="round" stroke-linecap="round"></path>
                        <circle data-name="layer1" cx="27" cy="27" r="17" fill="none" stroke="#202020" stroke-miterlimit="10" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"></circle>
                    </svg>
                </button>
            </div>';
            ?>
            <div class="button-wrap">
                <button onclick="location.href = 'profile.php';" class="btn profile">
                    <svg class="svg-icon" viewBox="0 0 20 20">
                        <path fill="none" d="M14.023,12.154c1.514-1.192,2.488-3.038,2.488-5.114c0-3.597-2.914-6.512-6.512-6.512
                        c-3.597,0-6.512,2.916-6.512,6.512c0,2.076,0.975,3.922,2.489,5.114c-2.714,1.385-4.625,4.117-4.836,7.318h1.186
                        c0.229-2.998,2.177-5.512,4.86-6.566c0.853,0.41,1.804,0.646,2.813,0.646c1.01,0,1.961-0.236,2.812-0.646
                        c2.684,1.055,4.633,3.568,4.859,6.566h1.188C18.648,16.271,16.736,13.539,14.023,12.154z M10,12.367
                        c-2.943,0-5.328-2.385-5.328-5.327c0-2.943,2.385-5.328,5.328-5.328c2.943,0,5.328,2.385,5.328,5.328
                        C15.328,9.982,12.943,12.367,10,12.367z"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <script src="js/navigation.js"></script>

</body>

</html>