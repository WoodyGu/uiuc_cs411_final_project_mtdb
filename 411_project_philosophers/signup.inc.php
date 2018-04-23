<?php

    if (!isset($_POST['submit'])) {
      header("Location: ../signup.php?signup=error");
      exit();
    }

    include_once 'dbh.inc.php';

    $username = $_POST['username'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $pwd_conf = $_POST['pwd_conf'];


    // foreach ($_POST['type'] as $type) {
    //   echo $type;
    // }
    //More error handlings include: length of username/password, if email has already registered
    if (empty($username) || empty($email) || empty($pwd) || empty($pwd_conf)) {
      header("Location: ../signup.php?signup=empty");
      exit();
    } else if ($pwd != $pwd_conf) {
      header("Location: ../signup.php?signup=pwd_not_match&username=$username&email=$email");
      exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      header("Location: ../signup.php?signup=invalid_email&username=$username");
      exit();
    }

    $movieTpyeStr = "";
    if(!empty($_POST["type"])){
      foreach ($_POST["type"] as $movieType) {
        if($movieTpyeStr == ""){
          $movieTpyeStr = $movieType;
        }
        else{
          $movieTpyeStr = $movieTpyeStr.",".$movieType;
        }
      }
    }
    // echo $movieTpyeStr;
    $sql = "INSERT INTO user (email, username, password, movie_type) VALUES ('$email', '$username', '$pwd', '$movieTpyeStr');";
    if (!mysqli_query($conn, $sql)) {
      printf("WTF!!! Errormessage: %s\n", mysqli_error($conn));
    }

    header("Location: ../index.php?signup=success");
