
<html>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jqc-1.12.4/dt-1.10.13/r-2.1.1/datatables.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css" />
    <head>
        <div w3-include-html="head.html"></div>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">

        <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
        <style>
            /* Always set the map height explicitly to define the size of the div
             * element that contains the map. */
            #map {
              height: 100%;
            }
            /* Optional: Makes the sample page fill the window. */
            html, body {
              height: 88%;
              width: 100%;
              margin: 0;
              padding: 0;
            }
            #description {
              font-family: Roboto;
              font-size: 15px;
              font-weight: 300;
            }

            #infowindow-content .title {
              font-weight: bold;
            }

            #infowindow-content {
              display: none;
            }

            #map #infowindow-content {
              display: inline;
            }

            .pac-card {
              margin: 10px 10px 0 0;
              border-radius: 2px 0 0 2px;
              box-sizing: border-box;
              -moz-box-sizing: border-box;
              outline: none;
              box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
              background-color: #fff;
              font-family: Roboto;
            }

            #pac-container {
              padding-bottom: 12px;
              margin-right: 12px;
            }

            .pac-controls {
              display: inline-block;
              padding: 5px 11px;
            }

            .pac-controls label {
              font-family: Roboto;
              font-size: 13px;
              font-weight: 300;
            }

            #pac-input {
              background-color: #fff;
              font-family: Roboto;
              font-size: 15px;
              font-weight: 300;
              margin-left: 12px;
              margin-top: 12px;
              padding: 0 11px 0 13px;
              text-overflow: ellipsis;
              width: 400px;
            }

            #pac-input:focus {
              border-color: #4d90fe;
            }

            #title {
              color: #fff;
              background-color: #4d90fe;
              font-size: 25px;
              font-weight: 500;
              padding: 6px 12px;
            }
            #target {
              width: 345px;
            }

            .datatable td {
              overflow: hidden;
              /*text-overflow: ellipsis;*/
              /*white-space: pre-line;*/
              /*word-break: normal;*/
            }

            .dtr-details {
              color: black;
            }

            .dtr-data {
              /*overflow: hidden;*/
              /*text-overflow: ellipsis;*/
              white-space: normal;
              word-break: break-word;
            }

        </style>
    </head>
    <body>
        <div id="wrapper">
          <div><?php include "nav_bar.php"; ?></div>

          <div id="page-wrapper">

            <div class="container-fluid">

              <!-- Page Heading -->
              <div class="row">
                <div class="col-lg-12">
                  <h1 class="page-header">
                    Dynamic Map
                    <small>DoubleClick or Search To Add!</small>
                  </h1>
                </div>
              </div>

              <div class="row">
                <input id="pac-input" class="controls" type="text" placeholder="Search Box">
                <div id="map"></div>
              </div>
              <div class="row">
                  <div class="col-lg-12" id='table_container' style="margin-top:20px;width:50%">
                  </div>
              </div>
            </div>
          </div>
        </div>

        <script>
            String.prototype.format = function(placeholders) {
              var s = this;
              for(var propertyName in placeholders) {
                  var re = new RegExp('{' + propertyName + '}', 'gm');
                  if (placeholders[propertyName]){
                    s = s.replace(re, placeholders[propertyName]);
                  } else {
                    s = s.replace(re, '');
                  }
              }
              return s;
            };

            var save_format = ("<table>"
              +"<tr><td>Name:</td> <td><input type=\"text\" id=\"sn-name\" value=\"{name}\"/> </td> </tr>"
              +"<tr><td>Address:</td> <td><input type=\"text\" id=\"sn-address\" value=\"{address}\"/> </td> </tr>"
              +"<tr><td>Phone #:</td> <td><input type=\"text\" id=\"sn-phone\" value=\"{phone}\"/> </td> </tr>"
              +"<tr><td>Website:</td> <td><input type=\"text\" id=\"sn-website\" value=\"{website}\"/> </td> </tr>"
              +"<tr><td>Description:</td> <td><input type=\"text\" id=\"sn-description\" value=\"{description}\"/> </td> </tr>"
              +"<tr><td>Colour:</td> <td><select id=\"sn-colour\">"
              +"<option selected=\"true\" value=\"Red\">Red</option>"
              +"<option value=\"Blue\">Blue</option>"
              +"<option value=\"Green\">Green</option>"
              +"<option value=\"Orange\">Orange</option>"
              +"<option value=\"Pink\">Pink</option>"
              +"<option value=\"Purple\">Purple</option>"
              +"<option value=\"Yellow\">Yellow</option></td></tr>"
              +"<tr><td></td><td><input type=\"button\" value=\"Save\" style=\"color:white;background-color:green\""
              +"onclick=\"saveData({marker_id},\'{marker_type}\')\"/></td></tr>"
              +"</table>");

            var save_click_format = ("<table>"
              +"<tr><td>Name:</td> <td><input type=\"text\" id=\"sn-name\" value=\"\"/> </td> </tr>"
              +"<tr><td>Address:</td> <td><input type=\"text\" id=\"sn-address\" value=\"\"/> </td> </tr>"
              +"<tr><td>Phone #:</td> <td><input type=\"text\" id=\"sn-phone\" value=\"\"/> </td> </tr>"
              +"<tr><td>Website:</td> <td><input type=\"text\" id=\"sn-website\" value=\"\"/> </td> </tr>"
              +"<tr><td>Description:</td> <td><input type=\"text\" id=\"sn-description\" value=\"\"/> </td> </tr>"
              +"<tr><td>Colour:</td> <td><select id=\"sn-colour\">"
              +"<option selected=\"true\" value=\"Red\">Red</option>"
              +"<option value=\"Blue\">Blue</option>"
              +"<option value=\"Green\">Green</option>"
              +"<option value=\"Orange\">Orange</option>"
              +"<option value=\"Pink\">Pink</option>"
              +"<option value=\"Purple\">Purple</option>"
              +"<option value=\"Yellow\">Yellow</option>"
              +"</td></tr></table>"
              +"<input type=\"button\" value=\"Save\" style=\"color:white;background-color:green;float:left\" onclick=\"saveData({marker_id},\'{marker_type}\')\"/>"
              +"<input type=\"button\" value=\"Delete\" style=\"color:white;background-color:red;float:right\" onclick=\"removeTempMarker({marker_id},\'{marker_type}\')\"/>");

            var show_format = ("<table>"
              +"<tr><td><p><strong>Name:</strong></p></td><td><p id='s-name'>{name}</p></td></tr>"
              +"<tr><td><p><strong>Address:</strong></p></td><td><p id='s-address'>{address}</p></td></tr>"
              +"<tr><td><p><strong>Phone #:</strong></p></td><td><p id='s-phone'>{phone}</p></td></tr>"
              +"<tr><td><p><strong>Website:</strong></p></td><td><a href='{site_prefix}{website}' target='_blank'><p id='s-website'>{website}</p></a></td></tr>"
              +"<tr><td><p><strong>Description:</strong></p></td><td><p id='s-description'>{description}</p></td></tr>"
              +"<tr><td><p><strong>Colour:</strong></p></td><td><p id='s-colour'>{colour}</p></td></tr>"
              +"</table>"
              +"<input type='button' value='Edit' style=\"float:left;background-color:green;color:white\" onclick=\"editData({marker_id},\'{marker_type}\')\"'/>"
              +"<input type='button' value='Delete' style=\"float:right;background-color:red;color:white\" onclick=\"deleteWarning({marker_id},\'{marker_type}\')\">");

            var delete_warning_format = ("Are you sure you want to <strong>PERMANENTLY DELETE</strong> {name}?<br><br>"
              +"<input type='button' value='Cancel' style=\"float:left\" onclick=\"showData({marker_id},\'{marker_type}\')\"'/>"
              +"<input type='button' value='DELETE' style=\"color:white;background-color:red;float:right\" onclick=\"deleteData({marker_id},\'{marker_type}\')\"'/>");
//
//            function bindInfoWindow (marker, map, infowindow, html) {
//              marker.addListener('click', function() {
//                  infowindow.setContent(html);
//                  infowindow.open(map, this);
//              });
//            }
//
//            var delete_format;
//
//            var map;
//            // var markers = [];
//            var team_markers = [];
//            var user_markers = [];
//            var click_markers = [];
//            var search_markers = [];
//            var infoWindow;
//
//            // This map adds a search box to a map, using the Google Place Autocomplete
//            // feature. People can enter geographical searches. The search box will return a
//            // pick list containing a mix of places and predicted search terms.
//
//            // This map requires the Places library. Include the libraries=places
//            // parameter when you first load the API. For example:
//            // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
//
//            function initAutocomplete() {
//              map = new google.maps.Map(document.getElementById('map'), {
//                center: {lat: 45.4236, lng: -75.7009},
//                zoom: 13,
//                mapTypeId: 'roadmap'
//              });
//              infoWindow = new google.maps.InfoWindow;
//
//              var search_count = 0;
//
//              map.setOptions({disableDoubleClickZoom: true }); // This is used to add elements
//
//              // Create the search box and link it to the UI element.
//              var input = document.getElementById('pac-input');
//              var searchBox = new google.maps.places.SearchBox(input);
//              map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
//
//              // Bias the SearchBox results towards current map's viewport.
//              map.addListener('bounds_changed', function() {
//                searchBox.setBounds(map.getBounds());
//              });
//
//
//              // Listen for the event fired when the user selects a prediction and retrieve
//              // more details for that place.
//              searchBox.addListener('places_changed', function() {
//                var places = searchBox.getPlaces();
//
//                if (places.length == 0) {
//                  return;
//                }
//
//                // Clear out the old markers.
//                search_markers.forEach(function(marker) {
//                  marker.setMap(null);
//                  marker = null;
//                });
//                search_markers.splice(0, search_markers.length);
//
//                // markers = saved_markers;
//
//                // For each place, get the icon, name and location.
//                var bounds = new google.maps.LatLngBounds();
//                var search_counter = 0;
//                places.forEach(function(place) {
//                  var overlap = false;
//                  var overlap_marker;
//                  user_markers.forEach(function(marker) {
//                    if (marker.position.lat() == place.geometry.location.lat() && marker.position.lng() == place.geometry.location.lng()){
//                      overlap = true;
//                      overlap_marker = marker;
//                    }
//                  });
//                  team_markers.forEach(function(marker){
//                    if (marker.position.lat() == place.geometry.location.lat() && marker.position.lng() == place.geometry.location.lng()){
//                      overlap = true;
//                      overlap_marker = marker;
//                    }
//                  });
//                  if (overlap) {
//                    var icon = {
//                      url: 'http://maps.google.com/mapfiles/ms/micons/POI.png', //place.icon,
//                      size: new google.maps.Size(32, 32),
//                      origin: new google.maps.Point(0, 0),
//                      anchor: new google.maps.Point(27, 58),
//                      scaledSize: new google.maps.Size(32, 32)
//                    };
//
//                    // Create a marker for each place.
//                    var marker = new google.maps.Marker({
//                      map: map,
//                      icon: icon,
//                      animation: google.maps.Animation.DROP,
//                      title: place.name,
//                      position: place.geometry.location,
//                      id: search_counter,
//                    });
//
//                    marker.addListener('click', function(){
//                      new google.maps.event.trigger(overlap_marker, 'click');
//                    });
//
//                    search_counter = search_counter + 1;
//                    search_markers.push(marker);
//                  } else {
//                    var name = place.name;
//                    var address = place.formatted_address;
//                    var phone = place.formatted_phone_number;
//                    var website = place.website;
//                    var marker_type = "search";
//                    var info_string = save_format.format({
//                      name: name,
//                      address: address,
//                      phone: phone,
//                      website: website,
//                      description: '',
//                      marker_id: search_counter.toString(),
//                      marker_type: marker_type
//                    });
//                    var infowincontent = document.createElement('div');
//                    infowincontent.innerHTML = info_string;
//
//
//                    if (!place.geometry) {
//                      console.log("Returned place contains no geometry");
//                      return;
//                    }
//                    var icon = {
//                      url: 'http://maps.google.com/mapfiles/ms/micons/blue-pushpin.png', //place.icon,
//                      size: new google.maps.Size(32, 32),
//                      origin: new google.maps.Point(0, 0),
//                      anchor: new google.maps.Point(17, 34),
//                      scaledSize: new google.maps.Size(32, 32)
//                    };
//
//                    // Create a marker for each place.
//                    var marker = new google.maps.Marker({
//                      map: map,
//                      name: name,
//                      address: address,
//                      phone: phone,
//                      website: website,
//                      description: '',
//                      icon: icon,
//                      animation: google.maps.Animation.DROP,
//                      title: place.name,
//                      position: place.geometry.location,
//                      id: search_counter,
//                    });
//
//                    search_counter = search_counter + 1;
//
//                    bindInfoWindow(marker, map, infoWindow, infowincontent);
//
//                    search_markers.push(marker);
//
//                    if (place.geometry.viewport) {
//                      // Only geocodes have viewport.
//                      bounds.union(place.geometry.viewport);
//                    } else {
//                      bounds.extend(place.geometry.location);
//                    }
//                  }
//
//                });
//                map.fitBounds(bounds);
//              });
//
//              google.maps.event.addListener(map, 'dblclick', function(event) {
//                var marker_id = click_markers.length;
//                var marker_type = "click";
//
//                var info_string = save_click_format.format({
//                  marker_id: marker_id.toString(),
//                  marker_type: marker_type
//                });
//                var infowincontent = document.createElement('div');
//                infowincontent.innerHTML = info_string;
//
//                var icon = {
//                  url: 'http://maps.google.com/mapfiles/ms/micons/red-pushpin.png', //place.icon,
//                  size: new google.maps.Size(32, 32),
//                  origin: new google.maps.Point(0, 0),
//                  anchor: new google.maps.Point(17, 34),
//                  scaledSize: new google.maps.Size(32, 32)
//                };
//
//                var marker = new google.maps.Marker({
//                  map: map,
//                  icon: icon,
//                  title: 'Drag Me!',
//                  position: event.latLng,
//                  id: marker_id,
//                  draggable: true
//                });
//
//                bindInfoWindow(marker, map, infoWindow, infowincontent);
//                infoWindow.setContent(infowincontent);
//                infoWindow.open(map, marker);
//
//
//                click_markers.push(marker);
//
//              });
//
//              refreshSavedMarkers();
//
//            };
//            function find_marker (marker_id, marker_type){
//              marker_id = parseInt(marker_id);
//              // alert('yes');
//              var marker;
//              if (marker_type == 'team'){
//                marker = team_markers[marker_id];
//              } else {
//                marker = user_markers[marker_id];
//              }
//
//              new google.maps.event.trigger(marker, 'click');
//              $('body').animate({scrollTop: "10px"});
//            }
//
//            function removeTempMarker(marker_id, marker_type){
//              var marker_list;
//              if (marker_type == 'search'){
//                marker_list = search_markers;
//              } else {
//                marker_list = click_markers;
//              }
//
//              marker_list[marker_id].setMap(null);
//              marker_list[marker_id] = null;
//
//              marker_list.splice(marker_id, 1);
//
//              var update_id;
//              for(update_id = marker_id; update_id < marker_list.length; update_id++){
//                marker = marker_list[update_id];
//                marker.id = update_id;
//
//                if (marker_type == 'search'){
//                  infowincontent = save_format.format({
//                    name: marker.name,
//                    address: marker.address,
//                    phone: marker.phone,
//                    website: marker.website,
//                    description: '',
//                    marker_id: update_id.toString(),
//                    marker_type: marker_type});
//                } else {
//                  infowincontent = save_click_format.format({
//                    marker_id: update_id.toString(),
//                    marker_type: marker_type
//                  });
//                }
//                bindInfoWindow(marker, map, infoWindow, infowincontent);
//              }
//
//              if (marker_type == 'search'){
//                search_markers = marker_list;
//              } else {
//                click_markers = marker_list;
//              }
//
//            }
//
//            function saveData(marker_id, marker_type) {
//              marker_id = parseInt(marker_id);
//              var marker;
//              var url;
//              var db_id;
//
//              switch (marker_type){
//                case 'search':
//                  marker = search_markers[marker_id];
//                  db_id = null;
//                  url = "php/map/createPOI.php";
//                  break;
//                case 'click':
//                  marker = click_markers[marker_id];
//                  db_id = null;
//                  url = "php/map/createPOI.php";
//                  break;
//                case 'team':
//                  marker = team_markers[marker_id];
//                  db_id = marker.db_id;
//                  url = "php/map/editPOI.php";
//                  break;
//                case 'user_in_team':
//                  marker = user_markers[marker_id];
//                  db_id = marker.db_id;
//                  url = "php/map/editPOI.php";
//                  break;
//              }

              var name = escape(document.getElementById('sn-name').value);
              var address = escape(document.getElementById('sn-address').value);
              var phone = escape(document.getElementById('sn-phone').value);
              var website = escape(document.getElementById('sn-website').value);
              var description = escape(document.getElementById('sn-description').value);
              var colour = document.getElementById('sn-colour').value;
              var lat = marker.position.lat().toString();
              var lng = marker.position.lng().toString();


              $.ajax({
                type: "POST",
                url: url,
                data:{
                  type: 'team',
                  name: name,
                  address: address,
                  phone: phone,
                  website: website,
                  description: description,
                  colour: colour,
                  lat: lat,
                  lng: lng,
                  db_id: db_id,
                  delete: 0
                },
                error: function(){
                  alert('cannot save');
                },
                success: function(event){
                  if (event == 'saved'){
                    if (marker_type == 'search' || marker_type == 'click'){
                      removeTempMarker(marker_id, marker_type);
                    }
                    refreshSavedMarkers();
                    if (marker_type == 'user_in_team' || marker_type == 'team'){
                      new google.maps.event.trigger(marker, 'click');
                    }

                    infoWindow.setContent('CHANGES SAVED :)');

                  } else {
                    // alert(event);
                    infoWindow.setContent('ERROR SAVING :(');
                  }
                }
              })
            };

            function editData (marker_id, marker_type){
              marker_id = parseInt(marker_id);
              var marker;
              if (marker_type == 'team'){
                marker = team_markers[marker_id];
              } else {
                marker = user_markers[marker_id];
              }

              var name = decodeURI(document.getElementById('s-name').innerHTML);
              var address = decodeURI(document.getElementById('s-address').innerHTML);
              var phone = decodeURI(document.getElementById('s-phone').innerHTML);
              var website = decodeURI(document.getElementById('s-website').innerHTML);
              var description = decodeURI(document.getElementById('s-description').innerHTML);
              var colour = document.getElementById('s-colour').innerHTML;

              var info_string = save_format.format({
                name: name,
                address: address,
                phone: phone,
                website: website,
                description: description,
                marker_id: marker_id.toString(),
                marker_type: marker_type
              });

              var infowincontent = document.createElement('div');
              infowincontent.innerHTML = info_string;

              infoWindow.setContent(infowincontent);
              document.getElementById('sn-colour').value = colour;
            };

            function deleteWarning(marker_id, marker_type){
              marker_id = parseInt(marker_id);
              var marker;
              if (marker_type == 'team'){
                marker = team_markers[marker_id];
              } else {
                marker = user_markers[marker_id];
              }
              var name = marker.title;

              var info_string = delete_warning_format.format({
                name: name,
                marker_id: marker_id.toString(),
                marker_type: marker_type
              })

              var infowincontent = document.createElement('div');
              infowincontent.innerHTML = info_string;
              infoWindow.setContent(infowincontent);
            };

            function deleteData(marker_id, marker_type){
              marker_id = parseInt(marker_id);
              var marker;
              if (marker_type == 'team'){
                marker = team_markers[marker_id];
              } else {
                marker = user_markers[marker_id];
              }
              var db_id = marker.db_id;

              $.ajax({
                type: "POST",
                url: "php/map/editPOI.php",
                data:{
                  db_id: db_id,
                  delete: 1
                },
                error: function(){
                  alert('cannot delete');
                },
                success: function(event){
                  if (event=='deleted'){
                    refreshSavedMarkers();
                  } else {
                    infoWindow.setContent('ERROR DELETING :(');
                  }
                }
              })
            };

            function showData(marker_id, marker_type){
              marker_id = parseInt(marker_id);
              var marker;
              if (marker_type == 'team'){
                marker = team_markers[marker_id];
              } else {
                marker = user_markers[marker_id];
              }
              new google.maps.event.trigger(marker, 'click');
            };

            function generateSavedMarkers(data, marker_type){
              var marker_id = 0;

              for(marker_id = 0; marker_id < data.length; marker_id++){
                var poi = data[marker_id];
                var name = poi.name;
                var address = poi.address;
                var phone = poi.phone;
                var website = poi.website;
                var site_prefix = 'http://';
                if (website && website.substring(0,7) == 'http://'){
                  website = website.substring(7);
                } else if (website && website.substring(0,8) == 'https://'){
                  website = website.substring(8);
                  site_prefix = 'https://';
                }


                var description = poi.description;
                var colour = poi.colour;
                var lat = poi.lat;
                var lng = poi.lng;
                var icon_url = poi.url;
                var db_id = poi.db_id;
                var info_string = show_format.format({
                  name: name,
                  address: address,
                  phone: phone,
                  site_prefix: site_prefix,
                  website: website,
                  description: description,
                  colour: colour,
                  marker_id: marker_id.toString(),
                  marker_type: marker_type
                });

                var infowincontent = document.createElement('div');
                infowincontent.innerHTML = info_string;

                var icon = {
                  url: icon_url,
                  size: new google.maps.Size(32, 32),
                  origin: new google.maps.Point(0, 0),
                  anchor: new google.maps.Point(17, 34),
                  scaledSize: new google.maps.Size(32, 32)
                };

                var marker = new google.maps.Marker({
                  map: map,
                  icon: icon,
                  // animation: google.maps.Animation.DROP,
                  title: name,
                  position: {
                    lat: parseFloat(lat),
                    lng: parseFloat(lng)
                  },
                  id: marker_id,
                  db_id: db_id,
                });

                bindInfoWindow(marker, map, infoWindow, infowincontent);

                if (marker_type == 'team'){
                  team_markers.push(marker);
                } else {
                  user_markers.push(marker);
                }
              }
            }

            function getSavedMarkers(marker_type){
              $.ajax({
                type: "GET",
                url: "php/map/loadPOIMarkers.php",
                data: {
                  type: marker_type,
                },
                error: function(){
                  alert('cannot load saved data for ' + marker_type);
                },
                success: function(json){
                  data = JSON.parse(json);
                  generateSavedMarkers(data, marker_type);
                }
              })
            };

            function refreshSavedMarkers(){
              // clear old markers
              team_markers.forEach(function(marker) {
                marker.setMap(null);
                marker = null;
              });
              team_markers.splice(0, team_markers.length);
              user_markers.forEach(function(marker) {
                marker.setMap(null);
                marker = null;
              });
              user_markers.splice(0, user_markers.length);

              getSavedMarkers('user_in_team');
              getSavedMarkers('team');

              load_table();
            };

            function load_table(){
              $.ajax({
                type: "GET",
                url: "php/map/loadPOITable.php",
                data: {
                  type: 'team'
                },
                success: function(html){
                  if (html == 'error with parameters' || html == 'error with sql'){
                    // alert(html);
                  } else {
                    // alert(html);
                    $("#table_container").html($(html).filter('#POITableWrap').html());
                    try {
                      var table = $("#POITable").DataTable();
                      // alert('deployed');
                    }
                    catch(err) {
                      alert (err);
                    }
                  }
                },
                error: function(html){
                  alert(html);
                }
              })
            }

          </script>
          <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRoCAjRV7mNElfaj0xkqpdiU_mzqCH09Y&libraries=places&callback=initAutocomplete"
         async defer></script>
        <script src="js/jquery.js"></script>
        <script src="js/w3data.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src='lib/moment.min.js'></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs/jqc-1.12.4/dt-1.10.13/r-2.1.1/datatables.min.js"></script>
        <script>
          w3IncludeHTML();
        </script>
    </body>
</html>
