<?php
if (!isset($_SESSION)) session_start();
require_once('conn.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="User Registration and Login System Example for Web Technologies">
    <meta name="author" content="Eva Sørum Poulsen | BTECH">
    <link rel="icon" href="favicon.ico">

    <title>User Registration and Login System Example for Web Technologies</title>

    <!-- Bootstrap core CSS -->
    <link href="styles/bootstrap.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="styles/style.css" rel="stylesheet" type="text/css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Quicksand|Ubuntu|Ubuntu+Condensed" rel="stylesheet">
    <script src="js/bootstrap.bundle.js" type="text/javascript"></script>
</head>

<body>
<nav class="navbar navbar-expand-sm fixed-top navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Web<span class="orange">Technologies</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
              </li>
              </li>
                  <li class="nav-item">
                    <a class="nav-link" href="registration.php">Register</a>
                  </li>
              
              <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
              </li>
            </ul>
          </div>
    </div>
</nav>
