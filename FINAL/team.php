<?php
session_start();
include "php/connect.php";
if(!isset($_SESSION['name'])){
header('Location: login.php');
}
?>
<html>
<head>
    <title>OmadaHQ</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--UI FrameWorks-->
    <link rel="stylesheet" href="css/w3.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!--Fonts-->
    <link rel="stylesheet" href="css/raleway.css">

    <!--Icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/ionicons-2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    
    <!--Custom Stylesheet-->
    <link rel="stylesheet" href="css/style.css">
    
    <!--Angular Scripts-->
    <script src="js/angular.min.js"></script>
    <script src="js/omadaApp.js"></script>
    
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
</head>

<!-- Top container -->
<div class="w3-bar w3-top w3-black w3-large" style="z-index:4; position: fixed">
    <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey w3-right" onclick="w3_open();"><i class="fa fa-bars"></i> &nbsp;Menu</button>
    <span class="w3-bar-item">OmadaHQ</span>
</div>

<body class="w3-light-grey" style="margin-top: 43px" ng-app="omadaApp">
    <!-- Sidebar/menu -->
    <? include 'nav-sidebar.php';?>

    <!-- Overlay effect when opening sidebar on small screens -->
    <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

    <div class="w3-main" style="margin-left:300px;">
        <header class="w3-container">
            <h3 style="padding-top: 25px; padding-bottom: 25px;"><b><i class="fa fa-dashboard"></i> Team Name Dashboard</b></h3>
        </header>


        <div class="w3-container">
            <div class="row">
                <div class="col-md-8 left" style="padding-right: 0px">
                    <div class="tile-bg">
                        <h3><i class="fa fa-comments fa-fw icon"></i>Chat</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    
    <!--Javascript-->
    <script for="sidebar">
        var mySidebar = document.getElementById("mySidebar");
        var overlayBg = document.getElementById("myOverlay");
        function w3_open() {
            if (mySidebar.style.display === 'block') {
                mySidebar.style.display = 'none';
                overlayBg.style.display = "none";
            } else {
                mySidebar.style.display = 'block';
                overlayBg.style.display = "block";
            }
        }
        function w3_close() {
            mySidebar.style.display = "none";
            overlayBg.style.display = "none";
        }
    </script>
    <script for="modal">
        var modal = document.getElementById('team_create');
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

</body>

</html> 
