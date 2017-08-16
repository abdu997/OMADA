<html>

<head>
    <title>Dashboard Draft</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--FrameWorks-->
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
    <script src="js/dash-app.js"></script>
    <script src="js/angular.min.js"></script>
</head>

<!-- Top container -->
<div class="w3-bar w3-top w3-black w3-large" style="z-index:4; position: fixed">
    <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey w3-right" onclick="w3_open();"><i class="fa fa-bars"></i> &nbsp;Menu</button>
    <span class="w3-bar-item">Dashboard</span>
</div>

<body class="w3-light-grey" style="margin-top: 43px" ng-app="DashApp" ng-controller="SessionController">
    <!-- Sidebar/menu -->
    <? include 'nav-sidebar.php';?>

    <!-- Overlay effect when opening sidebar on small screens -->
    <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

    <!-- !PAGE CONTENT! -->
    <div class="w3-main" style="margin-left:300px;">
        <!-- Header -->
        <header class="w3-container">
            <h3 style="padding-top: 25px; padding-bottom: 25px;"><b><i class="fa fa-dashboard"></i> Team Name Dashboard</b></h3>
        </header>


        <div class="w3-container">
            <div class="row">
                <div class="col-md-6 left" style="padding-right: 0px">
                    <div class="tile-bg">
                        <h3><i class="fa fa-comments fa-fw icon"></i>Chat</h3>
                        <?php include 'chat.php';?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="tile-bg">
                        <h3><i class="fa fa-list-ol fa-fw icon"></i>Personal To Do</h3>
                        <?php include 'personal-todo.php';?>
                    </div>
                    <div class="tile-bg">
                        <h3><i class="fa fa-map-marker fa-fw icon"></i>Team Map</h3>
                        <?php include 'team-map.php';?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="tile-bg">
                        <h3><i class="fa fa-calendar fa-fw icon"></i>Team Calendar</h3>
                        <?php //include 'team-calendar.php';?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="tile-bg">
                        <h3><i class="fa fa-link fa-fw icon"></i>Link Repository</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tile-bg">
                        <h3><i class="fa fa-money fa-fw icon"></i>Transaction Tracker</h3>
                        <?php //include 'trantracker.php';?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!--Javascript-->
    <script src="js/w3data.js"></script>
    <script>
      w3IncludeHTML();
    </script>
    <script for="sidebar">
        // Get the Sidebar
        var mySidebar = document.getElementById("mySidebar");

        // Get the DIV with overlay effect
        var overlayBg = document.getElementById("myOverlay");

        // Toggle between showing and hiding the sidebar, and add overlay effect
        function w3_open() {
            if (mySidebar.style.display === 'block') {
                mySidebar.style.display = 'none';
                overlayBg.style.display = "none";
            } else {
                mySidebar.style.display = 'block';
                overlayBg.style.display = "block";
            }
        }

        // Close the sidebar with the close button
        function w3_close() {
            mySidebar.style.display = "none";
            overlayBg.style.display = "none";
        }
    </script>
    <script for="modal">
        // Get the modal
        var modal = document.getElementById('team_create');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

</body>

</html> 
