    <nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar" ng-controller="SessionController">
        <br>
        <div class="w3-container w3-row" ng-repeat="x in profile">
            <div class="w3-col s4">
                <img src="{{x.user_image}}" class="w3-circle w3-margin-right" style="width:55px; height: 55px;">
            </div>
            <div class="w3-col s8 w3-bar">
                <h4 style="text-transform: capitalize;">Welcome, <strong>{{x.user_fname}}</strong></h4>
            </div>
        </div>
        <hr>
        <div class="w3-bar-block">
            <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>&nbsp; Close Menu</a>
            <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-user fa-fw"></i>&nbsp; Personal Dashboard</a>
            <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-cog fa-fw"></i>&nbsp; Account Settings</a>
            <a onclick="document.getElementById('team_create').style.display='block'" class="w3-bar-item w3-button w3-padding"><i class="fa fa-plus fa-fw"></i>&nbsp; Create Team</a>
            <a href="php/logout.php" class="w3-bar-item w3-button w3-padding logout"><i class="fa fa-sign-out fa-fw"></i>&nbsp; Log Out</a>
            <hr>
            <div ng-repeat="x in user_teams" style="text-transform: capitalize; color: white;">
                <a href="index.php?teamname={{x.team_name}}'" class="w3-bar-item w3-button w3-padding"><i class="fa fa-users fa-fw"></i>&nbsp; {{x.team_name}}</a>
<!--                onclick="window.location.href='index.php?teamname={{x.team_name}}'" -->
            </div>
            <br>
            <br>
        </div>
    </nav>
        <!--modal-->
        <div id="team_create" class="w3-modal">
            <div class="w3-modal-content w3-animate-top w3-card-4" style="padding: 25px; background: #f1f1f1!important; width: 30%;">
                <span onclick="document.getElementById('team_create').style.display='none'" class="w3-button w3-display-topright" style="font-size: 20px">&times;</span>
                <div class="w3-container">
                    <h4>Create a Team</h4>
                    <form>
                        <label>Team Name<span class="asterisk">*</span>
                        </label>
                        <input class="w3-input w3-border-0" type="text" required>
                        <label>Member #1</label>
                        <input class="w3-input w3-border-0" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" placeholder="e-mail" required>
                        <label>Member #2</label>
                        <input class="w3-input w3-border-0" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" placeholder="e-mail" required>
                        <label>Member #3</label>
                        <input class="w3-input w3-border-0" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" placeholder="e-mail" required>
                        <label>Member #4</label>
                        <input class="w3-input w3-border-0" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" placeholder="e-mail" required>
                        <input class="w3-button" type="submit" value="Create" style="background: white; margin-top: 10px">
                        <p><small>NOTE: You will be the Admin for the team. You can set up a team without members, and add members later.</small>
                        </p>
                    </form>
                </div>
            </div>
        </div>