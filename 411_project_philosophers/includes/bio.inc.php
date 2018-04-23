<?php
include_once 'includes/dbh.inc.php';
$email = $_SESSION['email'];
$sql = "SELECT * FROM user WHERE email='$email';";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) >= 1) {
  echo mysqli_fetch_assoc($result)['bio'];
} else {
  echo 'NULL';
}
