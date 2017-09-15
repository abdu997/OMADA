<?php
//session_start();

//if(!isset($_SESSION[ 'name'])){header( 'Location: calendar2.php');}

//$team_id = '1';
//$user_id = '1';

?>
<!-- Fullcalendar CSS -->
<link href='lib/fullcalendar.min.css' rel='stylesheet'>
<link href='lib/fullcalendar.print.min.css' rel='stylesheet' media='print'>
<link rel="stylesheet" href="css/bootstrap.min.css">

<!--Scripts-->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>

<script src='lib/moment.min.js'></script>
<script src='lib/fullcalendar.min.js'></script>
<script src="lib/ajaxCalendar.js"></script>

<!-- Calendar -->
<div id="calendar" width="100%"></div>

<!-- Modal -->
<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="add_form" class="form-horizontal" method="POST" onSubmit="php/calendar/addEvent.php">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Add Event</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Event Title<span>*</span>
                        </label>
                        <input type="text" class="form-control" id="event_title" name="event_title" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Start Date<span>*</span>
                                </label>
                                <input type="date" class="form-control" id="start_date" name="start_date" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Start Time
                                </label>
                                <input type="time" class="form-control" id="start_time" name="start_time">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>End Date<span>*</span>
                                </label>
                                <input type="date" class="form-control" id="end_date" name="end_date" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>End Time
                                </label>
                                <input type="time" class="form-control" id="end_time" name="end_time">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Colour<span>*</span>
                                </label>
                                <select class="form-control" id="colour" name="colour" required>
                                    <option selected="true" id="colour-0" value="red">Red</option>
                                    <option id="colour-1" value="blue">Blue</option>
                                    <option id="colour-2" value="yellow">Yellow</option>
                                    <option id="colour-3" value="green">Green</option>
                                    <option id="colour-4" value="purple">Purple</option>
                                    <option id="colour-5" value="orange">Orange</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Event URL</label>
                                <input class="form-control" id="event_url" name="event_url">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>All Day</label>
                        <div class="checkbox-group">
                            <div class="checkbox">
                                <label>
                                    <input id="all_day" name="all_day" type="checkbox">Yes</label>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="team_id" class="form-control" id="team_id" value="<?php echo $_SESSION['team_id'];?>">
                    <input type="hidden" name="user_id" class="form-control" id="user_id" value="">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-horizontal" id="edit_form" method="POST" onSubmit="php/calendar/editEventInfo.php">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Edit Event</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Event Title<span>*</span>
                        </label>
                        <input type="text" class="form-control" id="event_title" name="event_title" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Start Date<span>*</span>
                                </label>
                                <input type="date" class="form-control" id="start_date" name="start_date" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Start Time
                                </label>
                                <input type="time" class="form-control" id="start_time" name="start_time">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>End Date
                                </label>
                                <input type="date" class="form-control" id="end_date" name="end_date">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>End Time
                                </label>
                                <input type="time" class="form-control" id="end_time" name="end_time">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Colour<span>*</span>
                                </label>
                                <select class="form-control" id="colour" name="colour" required>
                                    <option selected="true" id="colour-0" value="red">Red</option>
                                    <option id="colour-1" value="blue">Blue</option>
                                    <option id="colour-2" value="yellow">Yellow</option>
                                    <option id="colour-3" value="green">Green</option>
                                    <option id="colour-4" value="purple">Purple</option>
                                    <option id="colour-5" value="orange">Orange</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Event URL</label>
                                <input class="form-control" id="event_url" name="event_url">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>All Day</label>
                        <div class="checkbox-group">
                            <div class="checkbox">
                                <label>
                                    <input id="all_day" name="all_day" type="checkbox">Yes</label>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                <label class="text-danger">
                                    <input type="checkbox" name="delete" id="delete"> Delete event</label>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="id" class="form-control" id="id">


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>