<?php

    if (!isset($_POST['submit'])) {
      header("Location: ../editprofile.php?edit=error");
      exit();
    }

    include_once 'dbh.inc.php';
    session_start();
    $username = $_POST['username'];
    $bio = $_POST['bio'];
    $pwd = $_POST['pwd'];
    $pwd_conf = $_POST['pwd_conf'];
    $userID = $_SESSION['ID'];

    if (empty($username) || empty($pwd) || empty($pwd_conf)) {
      header("Location: ../editprofile.php?editprofile=empty");
      exit();
    } else if ($pwd != $pwd_conf) {
      header("Location: ../editprofile.php?editprofile=pwd_not_match&username=$username&email=$email");
      exit();
    }
    $sql = "UPDATE user SET username = '$username', password = '$pwd', bio = '$bio' WHERE ID = '$userID';";
    if (!mysqli_query($conn, $sql)) {
      echo mysqli_error($conn);
    }
    $_SESSION['username'] = $username;
    $_SESSION['bio'] = $bio;

    header("Location: ../user_main.php?editprofile=success");
?>
