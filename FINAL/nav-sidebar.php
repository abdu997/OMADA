<?php
$team_id = $_SESSION['team_id'];
$admin_status = $_SESSION['admin_status'];
$team_type = $_SESSION['team_type'];
?>
<div class="w3-bar w3-top w3-black w3-large" style="z-index:4; position: fixed;">
    <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey w3-right" onclick="w3_open();"><i class="fa fa-bars"></i> &nbsp;Menu</button>
    <span class="w3-bar-item">OmadaHQ<small style="font-size: 10px">BETA</small></span>
</div>
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:200px;" id="mySidebar" ng-controller="SessionController" ng-init="userTeams(); userinfo()">
    <br>
    <div class="w3-container w3-row" ng-repeat="x in user">
        <div class="w3-col s4">
            <!--                <img src="{{x.user_image}}" class="w3-circle w3-margin-right" style="width:55px; height: 55px;">-->
        </div>
        <div class="w3-col s8 w3-bar">
            <h4 style="text-transform: capitalize;">Welcome, <strong>{{x.first_name}}</strong></h4>
        </div>
    </div>
    <hr>
    <div class="w3-bar-block">
        <a class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>&nbsp; Close Menu</a>
        <div onClick="window.location.reload()" ng-click="teamSelect(x.t_id, x.admin, x.type, x.team_name)" ng-repeat="x in teams | filter : {'type':'personal'} " style="text-transform: capitalize; color: white;">
            <a ng-class="{'active': x.t_id == <?php echo $team_id;?>}" class="w3-bar-item w3-button w3-padding"><i class="fa fa-user fa-fw"></i>&nbsp; {{x.team_name}}</a>
        </div>
        <a onclick="document.getElementById('edit_user').style.display='block'" class="w3-bar-item w3-button w3-padding"><i class="fa fa-cog fa-fw"></i>&nbsp; Edit Account</a>
        <a onclick="document.getElementById('team_create').style.display='block'" class="w3-bar-item w3-button w3-padding"><i class="fa fa-plus fa-fw"></i>&nbsp; Create Team</a>
        <a href="php/logout.php" class="w3-bar-item w3-button w3-padding logout"><i class="fa fa-sign-out fa-fw"></i>&nbsp; Log Out</a>
        <hr>
        <div onClick="window.location.reload()" ng-click="teamSelect(x.t_id, x.admin, x.type, x.team_name)" ng-repeat="x in teams | filter : {'type':'team'}" style="text-transform: capitalize; color: white;">
            <a ng-class="{'active': x.t_id == <?php echo $team_id;?>}" class="w3-bar-item w3-button w3-padding"><i class="fa fa-users fa-fw"></i>&nbsp; {{x.team_name}}</a>
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
<div id="edit_user" class="w3-modal">
    <div ng-controller="SessionController" ng-init="userinfo()" class="w3-modal-content w3-animate-top w3-card-4" style="padding: 25px; background: #f1f1f1!important; width: 30%;">
        <span onclick="document.getElementById('edit_user').style.display='none'" class="w3-button w3-display-topright" style="font-size: 20px">&times;</span>
        <div class="w3-container">
            <h4>Edit Personal Profile</h4>
            <form ng-repeat="x in user" autocomplete='off'>
                <label>First Name</label><span class="asterisk">*</span>
                <input value="{{x.first_name}}" id="firstName" class="w3-input w3-border-0" type="text">
                <small ng-show="firstNameError" style="color: red;">First name cannot be empty!<br></small>
                <label>Last Name</label><span class="asterisk">*</span>
                <input value="{{x.last_name}}" id="lastName" class="w3-input w3-border-0" type="text">
                <small ng-show="lastNameError" style="color: red;">Last name cannot be empty!<br></small>
                <label>Email</label><span class="asterisk">*</span>
                <input value="{{x.email}}" id="email" class="w3-input w3-border-0" type="email">
                <small ng-show="emailError" style="color: red;">Email must be valid!<br></small>
                <input ng-click="editProfile()" class="w3-button" type="submit" value="Update" style="background: white; margin-top: 10px">
                <br>
                <h4>Password Update</h4>
                <label>Old Password</label><span class="asterisk">*</span>
                <input ng-model="oldPassword" id="oldPassword" class="w3-input w3-border-0" autocomplete="off" type="password">
                <small ng-show="oldPasswordError" style="color: red;">Old password is incorrect!<br></small>
                <label>New Password</label><span class="asterisk">*</span>
                <input ng-model="newPassword" id="newPassword" class="w3-input w3-border-0" autocomplete="off" type="password">
                <small ng-show="newPasswordError" style="color: red;">You need to follow the pattern!<br></small>
                <small>Must contain an uppercase and lowercase letter, number and min. 8 characters</small>
                <br>
                <label>Repeat New Password</label><span class="asterisk">*</span>
                <input ng-model="repeatNewPassword" id="repeatNewPassword" class="w3-input w3-border-0" autocomplete="off" type="password">
                <small ng-show="repeatNewPasswordError" style="color: red;">The passwords dont match!<br></small>
                <input ng-click="editPassword()" class="w3-button" type="submit" value="Update Password" style="background: white; margin-top: 10px">
                <small ng-show="passwordChangeSuccess" style="color: green;">Password Successfully Updated!<br></small>
            </form>
        </div>
    </div>
</div>
<div id="edit_team" class="w3-modal">
    <div ng-controller="SessionController" ng-init="teamName()" class="w3-modal-content w3-animate-top w3-card-4" style="padding: 25px; background: #f1f1f1!important; width: 30%;">
        <span onclick="document.getElementById('edit_team').style.display='none'" class="w3-button w3-display-topright" style="font-size: 20px">&times;</span>
        <div class="w3-container">
            <h4>Edit Team</h4>
            <form name="teamNameChange" ng-repeat="x in teamNames | filter : {'t_id': '<?php echo $team_id; ?>'}">
                <label>Team Name</label>
                <input id="teamName" value="{{x.team_name}}" class="w3-input w3-border-0" autocomplete="off" type="text">
                <small ng-show="nullTeamError" style="color: red">New team name cannot be empty<br></small>
                <small ng-show="teamLengthError" style="color: red">Team name cannot be larger than 20 characters<br></small>
                <small ng-show="changeTeamSuccess" style="color: green">Team name successfully changed!<br></small>
                <input ng-disabled="changeTeamName.$invalid" ng-click="changeTeamName(<?php echo $team_id;?>)" class="w3-button" style="background: white; margin-top: 4px" type="submit" value="Change">
            </form>
        </div>
    </div>
</div>
<div ng-hide="'personal' == '<?php echo $team_type;?>'" style="float: right; margin-right: 15px;" ng-controller="SessionController">
    <a href="#" data-toggle="editTeamTooltip" data-placement="bottom" title="Only team admins can edit a team"><i class="fa fa-question-circle fw" style="font-size: 17px"></i></a> &nbsp;
    <button onclick="document.getElementById('edit_team').style.display='block'" ng-disabled="'N' == '<?php echo $admin_status;?>' || 'personal' == '<?php echo $team_type;?>'" style="background: white" class="w3-button">Edit Team</button>
    <script>
    $(document).ready(function(){
        $('[data-toggle="editTeamTooltip"]').tooltip();   
    });
    </script>
</div>
<script for="modal">
var modal = document.getElementById('team_create');
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    } 
}
</script>

