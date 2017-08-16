<?php
  session_start();
  include "../connection.php";

  $user_id = $_SESSION['user_id'];
  $team_id = $_SESSION['team_id'];

  if (isset($_POST) && isset($_POST['db_id'])){
    $id = $_POST['db_id'];
    if (isset($_POST['delete']) && $_POST['delete'] == 1){
      $sql = "DELETE FROM `test`.`map` WHERE `id`='$id'";
      $result = mysqli_query($conn, $sql);
      if ($result){
        echo 'deleted';
      } else {
        echo 'sql error';
      }
    } else {
      if (isset($_POST['name']) && (trim($_POST['name']) !== "")){
        $name = '\'' . addslashes(urldecode($_POST['name'])) . '\'';
      } else {
        $name = 'NULL';
      }
      if (isset($_POST['address']) && (trim($_POST['address']) !== "")){
        $address = '\'' . addslashes(urldecode($_POST['address'])) . '\'';
      } else {
        $address = 'NULL';
      }
      if (isset($_POST['phone']) && (trim($_POST['phone']) !== "")){
        $phone = '\'' . addslashes(urldecode($_POST['phone'])) . '\'';
      } else {
        $phone = 'NULL';
      }
      if (isset($_POST['website']) && (trim($_POST['website']) !== "")){
        $website = '\'' . addslashes(urldecode($_POST['website'])) . '\'';
      } else {
        $website = 'NULL';
      }
      if (isset($_POST['description']) && (trim($_POST['description']) !== "")){
        $description = '\'' . addslashes(urldecode($_POST['description'])) . '\'';
      } else {
        $description = 'NULL';
      }
      if (isset($_POST['colour']) && (trim($_POST['colour']) !== "")){
        $colour = '\'' . addslashes(urldecode($_POST['colour'])) . '\'';
      } else {
        $colour = 'NULL';
      }
      if (isset($_POST['lat']) && (trim($_POST['lat']) !== "")){
        $lat = '\'' . addslashes(urldecode($_POST['lat'])) . '\'';
      } else {
        $lat = 'NULL';
      }
      if (isset($_POST['lng']) && (trim($_POST['lng']) !== "")){
        $lng = '\'' . addslashes(urldecode($_POST['lng'])) . '\'';
      } else {
        $lng = 'NULL';
      }

      if ($lat !== NULL && $lng !== NULL && $colour !== NULL){
        // $sql = ("INSERT INTO `test`.`map` (team_id, user_id, name, address, phone, "
        //   . "website, description, colour, lat, lng) VALUES ($team, $user, $name, "
        //   . "$address, $phone, $website, $description, $colour, $lat, $lng)");
        $sql = ("UPDATE `test`.`map` SET `name`=$name, `address`=$address, "
            . "`phone`=$phone, `website`=$website, `description`=$description, "
            . "`colour`=$colour, `lat`=$lat, `lng`=$lng WHERE `id`=$id");
        $result = mysqli_query($conn, $sql);
        if ($result){
          echo 'saved';
        } else {
          echo 'sql error';
        }

      } else {
        echo 'parameter error';
      }

    }
  }

?>
