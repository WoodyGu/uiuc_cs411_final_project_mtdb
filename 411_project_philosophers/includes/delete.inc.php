<?php
    include_once 'dbh.inc.php';

    if (isset($_POST['submit'])) {
      $ID = $_GET['ID'];

      $sql = "DELETE FROM movie_review WHERE ID = '$ID';";
      $result = mysqli_query($conn, $sql);

      if (!$result) {
        echo mysqli_error($conn);
      }

      mysqli_fetch_assoc($result);

      header("Location: ../user_main.php?delete=success");
      exit();
    }
