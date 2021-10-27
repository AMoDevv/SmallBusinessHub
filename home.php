<?php
//Initalize session
session_start();
// Include the database configuration file  
require_once 'config.php';
//require_once "navigation.php";

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
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
</head>

<body class="bg-white">
<nav class="bg-gradient-to-r from-green-400 to-blue-500 "> 
  <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
    <div class="relative flex items-center justify-between h-16">
      <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
        <div class="flex-shrink-0 flex items-center">          
          <img class="hidden lg:block h-8 w-auto" src="images/Home.png" alt="home">
        </div>
        <div class="hidden sm:block sm:ml-6">
          <div class="flex space-x-4 ">
            <input type="text" class="h-8 w-96 pr-8 pl-5 rounded z-0 focus:shadow focus:outline-none" placeholder="Search for a business...">         
              <div class="absolute top-4 right-3"> <i class="fa fa-search text-gray-400 z-20 hover:text-gray-500"></i> 
              </div>
          </div>
        </div>
      </div>
      <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">

        <div class="ml-3 relative">
          <div>
            <button type="button" class="bg-gray-800 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
              <span class="sr-only">Open user menu</span>
              <!-- User image needed-->
              <img class="h-8 w-8 rounded-full" src="" alt="">
            </button>
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

<footer class="p-10 bg-gradient-to-r from-green-400 to-blue-500 ">
  <p> Footer</p>
      </footer> 
</body>

</html>