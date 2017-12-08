<?php
if(!isset($_SESSION['user_id']) && !isset($_SESSION['team_id'])){
header('Location: login.php');
}
?>
<head>
    <style>
        .fw {
            cursor: pointer;
            margin: 10px;
        }
        .trash {
            color: red;
        }
    </style>
</head>
<div class="tile-bg" ng-controller="linkRepository" ng-init="displayData()">
    <form name="link_form2">
        <div class="col-sm-4">
            <label>Link</label><span class="asterisk">*</span>
            <input type="text" ng-model="link" style="background: #f1f1f1!important"  class="w3-input w3-border-0">
            <input type="submit" class="w3-button"  style="background: #f1f1f1!important; margin-top: 10px" ng-disabled="link_form2.$invalid" ng-click="insertLink()" value="{{btnName}}" />
        </div>
        <div class="col-sm-4">
            <label>Note</label><span class="asterisk">*</span>
            <input type="text" ng-model="note" style="background: #f1f1f1!important" class="w3-input w3-border-0">
        </div>
    </form>
    <table style="width: 100%; margin: 15px; padding-top: 40px">
        <tr style="border-bottom: 2px solid black">
            <th style="width: 20%">Member</th>
            <th style="width: 35%">Link</th>
            <th style="width: 35%">Notes</th>
            <th style="width: 10%"></th>
        </tr>
        <tr style="border-bottom: 1px solid black" ng-repeat="x in links | filter: '.'">
            <td style="text-transform: capitalize">{{x.user}}</td>
            <td ng-bind-html="x.url"></td>
            <td>{{x.note}}</td>
            <td>
                <i ng-click="updateData(x.record_id, x.link, x.note)" class="fa fa-pencil-square-o fw"></i>
                <i ng-click="deleteData(x.record_id)" class="fa fa-trash fw trash"></i>
            </td>
        </tr>
    </table>
</div>


