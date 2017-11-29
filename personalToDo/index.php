<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<script src="../js/angular.min.js"></script>
<script src="personalTodo.js"></script>
    
<style>
    .trash {
        color: red;
        margin: 10px;
        cursor: pointer;
    }
    .check {
        color: green;
        opacity: 0.3;
        margin: 10px;
        font-size: 20px; 
        cursor: pointer;
    }
    .check:hover {
        opacity: 0.5;
    }
    .checked {
        opacity: 0.8;
    }
    .checked:hover {
        opacity: 1;
    }
</style>

<div ng-controller="taskController" ng-app="personalToDo"> 
    <form name="taskForm">
        <input type="text" ng-model="taskInput" placeholder="Add New Item" autocomplete="off" autofocus required />
        <button type="submit" ng-click="createTask(); taskInput = null" ng-disabled="taskForm.$invalid">
            <i class="fa fa-plus"></i>&nbsp;Add Task
        </button>
    </form>
    <input type="text" ng-model="filterItem"placeholder="Filter Tasks" />
    <br>
    <table>
        <tr ng-repeat="x in items | filter : filterItem">
            <td><i class="fa fa-check fw check" ng-class="{checked: x.progress == 'complete'}" ng-click="changeProgress(x.task_id)"></i></td>
            <td style="min-width: 100px">{{x.task}}</td>
            <td><i class="fa fa-trash trash" ng-click="deleteTask(x.task_id)"></i></td>
        </tr>
    </table>
</div>