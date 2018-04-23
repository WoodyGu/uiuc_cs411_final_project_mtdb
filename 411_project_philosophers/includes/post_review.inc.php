<?php
    session_start();

    if (!isset($_POST['title'])) {
      exit();
    }
    include_once 'dbh.inc.php';

    $title = $_POST['title'];
    $rate = $_POST['rate'];
    $reviewText = mysqli_real_escape_string($conn, $_POST['content']);

    $reviewDate = date("Y-m-d");
    $movie_ID = $_SESSION['result']['ID'];
    $user_ID = $_SESSION['ID'];

    $sql = "INSERT INTO movie_review (title, rate, content, date, movie_ID, user_ID) VALUES ('$title', '$rate', '$reviewText', '$reviewDate', '$movie_ID', '$user_ID');";

    if (!mysqli_query($conn, $sql)) {
      echo mysqli_error($conn);
    }

    header("Location: ../movie_main.php?search=".$_SESSION['search']);
