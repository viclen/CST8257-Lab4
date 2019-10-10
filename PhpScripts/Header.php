<?php
    if(!isset($_SESSION) || empty($_SESSION)){
        session_start();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="Contents/css/bootstrap.css">
    <link rel="stylesheet" href="Contents/AlgCss/Site.css">
</head>
<body>
    <nav class="navbar-inverse">
        <div class="navbar-header">
            <a class="navbar-brand" style="padding: 10px;">
                <img style="height: 100%;" src="Contents/img/AC.png">
            </a>
        </div>
        <div class="container-fluid">
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li <?=(strpos($_SERVER["REQUEST_URI"],"Index.php") || substr($_SERVER["REQUEST_URI"], -1, 1)=="/") ? 'class="active"' : ''?>><a href="Index.php">Home</a></li>
                    <li <?=strpos($_SERVER["REQUEST_URI"],"Disclaimer.php") ? 'class="active"' : ''?>><a href="Disclaimer.php">Terms and Conditions</a></li>
                    <li <?=strpos($_SERVER["REQUEST_URI"],"CustomerInfo.php") ? 'class="active"' : ''?>><a href="CustomerInfo.php">Customer Information</a></li>
                    <li <?=strpos($_SERVER["REQUEST_URI"],"DepositCalculator.php") ? 'class="active"' : ''?>><a href="DepositCalculator.php">Calculator</a></li>
                    <li <?=strpos($_SERVER["REQUEST_URI"],"Complete.php") ? 'class="active"' : ''?>><a href="Complete.php">Complete</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
