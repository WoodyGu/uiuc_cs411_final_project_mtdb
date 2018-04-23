<?php

  include_once 'dbh.inc.php';
  session_start();
  $email = $_SESSION['email'];
  $sql = "SELECT ID FROM user WHERE email='$email';";

  $result = mysqli_query($conn, $sql);
  $result_check = mysqli_num_rows($result);

  if ($result_check < 1) {
    echo "WTF, NOT LOGGED IN???";
    exit();
  }

  $row = mysqli_fetch_assoc($result);
  $userID = $row['ID'];

  if(isset($_POST['submitImg'])){
    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTempName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];
    //only allow .jpeg or .png
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if(in_array($fileActualExt, $allowed)){
      if($fileError == 0){
        if($fileSize < 500000){
          //save to file manager
          $newFileName = $userID.".".$fileActualExt;
          $fileDest = $uploadfile = $_SERVER['DOCUMENT_ROOT']."/Images/".$newFileName;
          if(!move_uploaded_file($fileTempName, $fileDest)){
            echo "WTF! Upload error!!";
            exit();
          }
          $sqlPic = "UPDATE user SET picture = '$newFileName' WHERE ID = '$userID';";
          if (!mysqli_query($conn, $sqlPic)) {
            printf("WTF!!! Errormessage: %s\n", mysqli_error($conn));
            exit();
          }
        }
        else{
          echo "WTF! the file is too large!";
          exit();
        }
      }
      else{
        echo "WTF, some error occur when uploading!";
        exit();
      }
    }
    else{
      echo "WTF you are uploading!!";
      exit();
    }
  }
  header("Location: ../user_main.php?upload=success");
  exit();
 ?>
