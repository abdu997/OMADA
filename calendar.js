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
                    error: function(event) {
                      alert('There was an error while fetching your team\'s events.');
                      alert(event.error());
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