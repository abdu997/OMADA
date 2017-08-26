<?php
// include '/php/calendar/editEventInfo.php';
session_start();

if(!isset($_SESSION[ 'name'])){
  header( 'Location: calendar2.php');
}

$team_id = $_SESSION['team_id'];
$user_id = $_SESSION['user_id'];

?>

<!DOCTYPE html>
<html lang="en">

<div w3-include-html="head.html"></div>

<body>
  <div id="wrapper">
    <div>
      <?php include "nav_bar.php"; ?>
    </div>

    <div id="page-wrapper">

      <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
          <div class="col-lg-12">
            <h1 class="page-header">
              Drag and Drop Calendar (jQuery)
              <small>Subheading</small>
            </h1>
          </div>
        </div>
        <div class="row">
          <div id="calendar" class="col-lg-8" width="100%"></div>
        </div>

        <!-- /.row -->

        		<!-- Modal -->
        		<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        		  <div class="modal-dialog" role="document">
        			<div class="modal-content">
        			<form id="add_form" class="form-horizontal" method="POST" onSubmit="php/calendar/addEvent.php">

        			  <div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
        				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
                              <input type="date" class="form-control" id="end_date" name="end_date" >
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
      							<label class="text-danger"><input type="checkbox"  name="delete"  id="delete"> Delete event</label>
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
      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="js/jquery.js"></script>
  <script src="js/w3data.js"></script>
  <script>
      w3IncludeHTML();
  </script>

  <!-- Bootstrap Core JavaScript -->
  <script src="js/bootstrap.min.js"></script>
  <script src='lib/moment.min.js'></script>
  <!-- <script src='lib/jquery.min.js'></script> -->
  <script src='lib/fullcalendar.min.js'></script>
  <!-- <script src='lib/jquery-ui.min.js'></script> -->

  <script>
	  $(document).ready(function() {
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay,listMonth'
            },
            navLinks: true, // can click day/week names to navigate views
            businessHours: true, // display business hours
            eventLimit: true,
            editable: true,
            selectable: true,
            selectHelper: true,
            eventSources: [
                {
                    url: 'php/calendar/getEvents.php',
                    type: 'GET',
                    data: {
                        type: 'user_in_team'
                    },
                    error: function() {
                      alert('There was an error while fetching your team\'s events.')
                    }
                },
                {
                  url: 'php/calendar/getEvents.php',
                  type: 'GET',
                  data: {
                      type: 'team'
                  },
                  error: function() {
                    alert('There was an error while fetching your personal events.')
                  }
                }
            ],
            select: function(start, end) {
                $('#ModalAdd #start_date').val(moment(start).format('YYYY-MM-DD'));
                $('#ModalAdd #start_time').val(moment(start).format('HH:mm'));
        				$('#ModalAdd #end_date').val(moment(end).format('YYYY-MM-DD'));
                $('#ModalAdd #end_time').val(moment(end).format('HH:mm'));
        				$('#ModalAdd').modal('show');
            },
            eventRender: function(event, element) {
        				element.bind('dblclick', function() {
          					$('#ModalEdit #id').val(event.id);
                    $('#ModalEdit #event_title').val(event.title);
                    $('#ModalEdit #event_url').val(event.event_url);
                    $('#ModalEdit #all_day').prop("checked", event.all_day);
                    $('#ModalEdit #delete').prop("checked", false);
                    $('#ModalEdit #start_date').val(event.start_date);
                    $('#ModalEdit #start_time').val(event.start_time);
                    $('#ModalEdit #end_date').val(event.end_date);
                    $('#ModalEdit #end_time').val(event.end_time);
                    $('#ModalEdit #colour').val(event.backgroundColor);
          					$('#ModalEdit').modal('show');
        				});
    			},
          eventDrop: function(event, delta, revertFunc) {
              edit(event);
          },
          eventResize: function(event, dayDelta, minuteDelta, revertFunc){
              edit(event);
          }
        });

        function edit(event){
            start_date = event.start.format('YYYY-MM-DD');
            start_time = event.start.format('HH:mm:ss');
            if (event.end){
                end_date = event.end.format('YYYY-MM-DD');
                end_time = event.end.format('HH:mm:ss');
                all_day = event.all_day;
            } else {
              end_date = start_date;
              end_time = NULL;
              all_day = true;
            }
            id = event.id;

            $.ajax({
              type: "POST",
              url: "php/calendar/editEventDate.php",
              data: {
                  id: id,
                  start_date: start_date,
                  start_time: start_time,
                  end_date: end_date,
                  end_time: end_time,
                  all_day: all_day,
              },
              success: function(event){
                $('#calendar').fullCalendar( 'refetchEvents');
              }
            })
        }

        $("#add_form").submit(function(e){
          e.preventDefault();

          if($("#ModalAdd #all_day").is(':checked')){
              var all_day = true;
          } else {
              var all_day = false;
          }
          $.ajax({
            type:"POST",
            url: "php/calendar/addEvent.php",
            data:{
              event_title: $('#ModalAdd #event_title').val(),
              start_date: $('#ModalAdd #start_date').val(),
              start_time: $('#ModalAdd #start_time').val(),
              end_date: $('#ModalAdd #end_date').val(),
              end_time: $('#ModalAdd #end_time').val(),
              colour: $('#ModalAdd #colour').val(),
              event_url: $('#ModalAdd #event_url').val(),
              all_day: all_day,
              team_id: $('#ModalAdd #team_id').val(),
              user_id: $('#ModalAdd #user_id').val()
            },
            success: function(event){
              // alert(event);
              $('#calendar').fullCalendar( 'refetchEvents');
              $('#ModalAdd').modal('hide');
            }
          })
        })

        $("#edit_form").submit(function(e){
          e.preventDefault();
          if($("#ModalEdit #all_day").is(':checked')){
              var all_day = true;
          } else {
              var all_day = false;
          }
          if($("#ModalEdit #delete").is(':checked')){
              var is_delete = true;
          } else {
              var is_delete = false;
          }
          $.ajax({
            type:"POST",
            url: "php/calendar/editEventInfo.php",
            data:{
              event_title: $('#ModalEdit #event_title').val(),
              start_date: $('#ModalEdit #start_date').val(),
              start_time: $('#ModalEdit #start_time').val(),
              end_date: $('#ModalEdit #end_date').val(),
              end_time: $('#ModalEdit #end_time').val(),
              colour: $('#ModalEdit #colour').val(),
              event_url: $('#ModalEdit #event_url').val(),
              all_day: all_day,
              id: $('#ModalEdit #id').val(),
              delete: is_delete
            },
            success: function(event){
              $('#calendar').fullCalendar( 'refetchEvents');
              $('#ModalEdit').modal('hide');
            }
          })
        })

	});
</script>

</body>
</html>
