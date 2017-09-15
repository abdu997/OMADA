<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<script src="../js/angular.min.js"></script>
<script src="personalTodo.js"></script>
    
<style>
    .items-list-cb:checked ~ .items-list-desc {
            color: #34bf6e;
            text-decoration: line-through;
        }
</style>

<div ng-controller="taskController" ng-app="personalToDo"> 
    <form name="taskForm">
        <input type="text" ng-model="itemInput" placeholder="Add New Item" autocomplete="off" autofocus required />
        <button type="submit" ng-click="addItem(itemInput); itemInput = null" ng-disabled="taskForm.$invalid">
            <i class="fa fa-plus"></i>&nbsp;Add Item
        </button>
    </form>
    <input type="text" ng-model="filterItem"placeholder="Filter Items" />
    <br>
        <label ng-repeat="item in items | filter : filterItem">
            <input type="checkbox" value="{{item.STATUS}}" ng-checked="item.STATUS==2" ng-click="changeStatus(item.TASK_ID,item.STATUS,item.ITEM)" class="items-list-cb">
            <span></span>
            <span class="items-list-desc" ng-class="{strike:item.STATUS==2}">{{item.ITEM}} <span>[{{item.CREATED_AT | date:"MMM d"}}]</span></span>
            <a ng-click="deleteItem(item.TASK_ID)"><i class="fa fa-minus-circle"></i></a>
            <br>
        </label>
</div>
