<?php include_once "header.php"; ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>review</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style/review.css">
    <link rel="stylesheet" href="style/review_viewer.css">
  </head>

  <body>

    <?php
        include_once 'includes/dbh.inc.php';

        $GLOBALS['ID'] = $_GET['ID'];
        $GLOBALS['user_ID'] = $_GET['user_ID'];

        $sql = "SELECT title, date, content, username FROM movie_review, user WHERE user.ID = movie_review.user_ID AND movie_review.ID = ".$GLOBALS['ID'].";";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
          echo mysqli_error($conn);
        }

        $GLOBALS['row'] = mysqli_fetch_assoc($result);
     ?>

<!-- =================================CONTENT=========================================== -->
    <main class="main_viewer">
      <div class="review_viewer_title viewer-wrap">
        <?php
            echo "<h2>".$GLOBALS['row']['title']."</h2>";
         ?>
      </div>

      <div class="review_user_info viewer-wrap">
        <!-- <img class="profile_img" src="Images/christina-truong.png"> -->
        <span id="user_name"> <?php echo $GLOBALS['row']['username']; ?> </span>
        <span id="date"> <?php echo $GLOBALS['row']['date']; ?> </span>
      </div>

      <div class="review_viewer_content viewer-wrap">
        <p id="content"><?php echo $GLOBALS['row']['content'] ?></p>
      </div>

      <div class="viewer-wrap">
        <?php
            if (!isset($GLOBALS['user_ID']) || $GLOBALS['user_ID'] == $_SESSION['ID']) {
              echo '<form action="includes/delete.inc.php?ID='.$GLOBALS['ID'].'" method=POST>
                      <button type="submit" name="submit" class="review_viewer_control btn btn-link">DELETE</button>
                    </form>';
              echo '<form action="review_editor.php?ID='.$GLOBALS['ID'].'" method=POST>
                      <button type="submit" name="submit" class="review_viewer_control btn btn-link">EDIT</button>
                    </form>';
            }

         ?>
      </div>
    </main>

    <!-- ========================================JAVASCRIPT======================================== -->

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
