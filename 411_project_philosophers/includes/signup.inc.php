<?php
    session_start();
    if (!isset($_POST['submit'])) {
      header("Location: ../signup.php?signup=error");
      exit();
    }

    include_once 'dbh.inc.php';

    $username = $_POST['username'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $pwd_conf = $_POST['pwd_conf'];

    // if (empty($username) || empty($email) || empty($pwd) || empty($pwd_conf)) {
    //   header("Location: ../signup.php?signup=empty");
    //   exit();
    // } else if ($pwd != $pwd_conf) {
    //   header("Location: ../signup.php?signup=pwd_not_match&username=$username&email=$email");
    //   exit();
    // } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //   header("Location: ../signup.php?signup=invalid_email&username=$username");
    //   exit();
    // }

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

    $command = escapeshellcmd('python weight.py '.$movieTpyeStr);
    $output = shell_exec($command);
    $output = mysqli_real_escape_string($conn, $output);

    $sql = "INSERT INTO user (email, username, password, weight) VALUES ('$email', '$username', '$pwd', '$output');";
    if (!mysqli_query($conn, $sql)) {
      echo mysqli_error($conn);
    }

    $sql = "SELECT * FROM user WHERE email='$email';";
    $row = mysqli_fetch_assoc(mysqli_query($conn, $sql));

    $_SESSION['username'] = $row['username'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['ID'] = $row['ID'];

    header("Location: ../index.php?signup=success");
