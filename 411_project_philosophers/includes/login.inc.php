<?php

    session_start();

    include_once 'dbh.inc.php';

    $email = $_POST['email'];
    $pwd = $_POST['pwd'];

    if (empty($email) || empty($pwd)) {
      header("Location: ../index.php?login=empty");
      exit();
    }

    $sql = "SELECT * FROM user WHERE email='$email';";

    $result = mysqli_query($conn, $sql);
    $result_check = mysqli_num_rows($result);

    if ($result_check < 1) {
      header("Location: ../index.php?login=not_found");
      exit();
    }

    $row = mysqli_fetch_assoc($result);
    if ($row['password'] != $pwd) {
      header("Location: ../index.php?login=incorrect_pwd");
      exit();
    }

    $_SESSION['username'] = $row['username'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['ID'] = $row['ID'];

    header("Location: ../index.php?login=success");
    exit();
