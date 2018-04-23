<?php
    include_once 'dbh.inc.php';
    session_start();

    if (isset($_POST['title'])) {

      $ID = $_GET['ID'];
      $title = $_POST['title'];
      $content = mysqli_real_escape_string($conn, $_POST['content']);
      $rate = $_POST['rate'];

      $sql = "UPDATE movie_review SET content = '$content' WHERE ID = '$ID';";
      $result = mysqli_query($conn, $sql);

      if (!$result) {
        echo mysqli_error($conn);
      }

      $sql = "UPDATE movie_review SET title = '$title' WHERE ID = '$ID';";
      $result = mysqli_query($conn, $sql);

      if (!$result) {
        echo mysqli_error($conn);
      }

      $sql = "UPDATE movie_review SET rate = $rate WHERE ID = '$ID';";
      $result = mysqli_query($conn, $sql);

      if (!$result) {
        echo mysqli_error($conn);
      }

      header("Location: ../review.php?ID=$ID");
      exit();
    } else {
      echo 'not set!';
    }
