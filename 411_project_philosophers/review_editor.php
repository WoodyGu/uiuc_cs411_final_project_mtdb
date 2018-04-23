<?php include_once "header.php"; ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Edit Your Review</title>
    <style>
      .logout_form{
        display: inline-block;
      }
    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="review_editor.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
      .checked {
          color: orange;
      }
      .unstyled-button {
        border: none;
        padding: 0;
        background: none;
      }
      .rate {
        color: #696B68;
        font-size: 20px;
      }
      .start {
        margin-left: 20px;
        margin-bottom: 10px;
      }
      .term3 {
        margin-left: 80%;
      }

    </style>
  </head>
<!-- ========================================PHP/SQL MANIPULATION======================================== -->
  <?php
      include_once 'includes/dbh.inc.php';

      $GLOBALS['new'] = $_GET['new'];

      if (isset($_POST['submit']) && !$GLOBALS['new']) {
        $sql = "SELECT title, date, content FROM movie_review WHERE ID = ".$_GET['ID'].";";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
          echo mysqli_error($conn);
        }
        // if (mysqli_num_rows($result) == 0) {
        //   echo 'NO!';
        // }
        $GLOBALS['row'] = mysqli_fetch_assoc($result);
      }


   ?>

<!-- ========================================TITLE & CONTENT======================================== -->

  <body>
    <div class="major">

        <div class="start">
          <span class="rate">Give a rate:</span>



          <button class="fa fa-star unstyled-button" onclick="change_rate(1)" id="one"></button>
          <button class="fa fa-star unstyled-button" onclick="change_rate(2)" id="two"></button>
          <button class="fa fa-star unstyled-button" onclick="change_rate(3)" id="three"></button>
          <button class="fa fa-star unstyled-button" onclick="change_rate(4)" id="four"></button>
          <button class="fa fa-star unstyled-button" onclick="change_rate(5)" id="five"></button>

        </div>

        <input type='hidden' id= 'rate' value=0 />

        <script>
          function change_rate(rate){
            document.getElementById("rate").value = rate;
            document.getElementById("one").classList.add('checked');
            if (rate == 1) {
              if (document.getElementById("two").classList.contains('checked')) {
                document.getElementById("two").classList.toggle('checked');
              }
              if (document.getElementById("three").classList.contains('checked')) {
                document.getElementById("three").classList.toggle('checked');
              }
              if (document.getElementById("four").classList.contains('checked')) {
                document.getElementById("four").classList.toggle('checked');
              }
              if (document.getElementById("five").classList.contains('checked')) {
                document.getElementById("five").classList.toggle('checked');
              }
            } else if (rate == 2) {
              document.getElementById("two").classList.add('checked');
              if (document.getElementById("three").classList.contains('checked')) {
                document.getElementById("three").classList.toggle('checked');
              }
              if (document.getElementById("four").classList.contains('checked')) {
                document.getElementById("four").classList.toggle('checked');
              }
              if (document.getElementById("five").classList.contains('checked')) {
                document.getElementById("five").classList.toggle('checked');
              }
            } else if (rate == 3) {
              document.getElementById("two").classList.add('checked');
              document.getElementById("three").classList.add('checked');
              if (document.getElementById("four").classList.contains('checked')) {
                document.getElementById("four").classList.toggle('checked');
              }
              if (document.getElementById("five").classList.contains('checked')) {
                document.getElementById("five").classList.toggle('checked');
              }
            } else if (rate == 4) {
              document.getElementById("two").classList.add('checked');
              document.getElementById("three").classList.add('checked');
              document.getElementById("four").classList.add('checked');
              if (document.getElementById("five").classList.contains('checked')) {
                document.getElementById("five").classList.toggle('checked');
              }
            } else {
              document.getElementById("two").classList.add('checked');
              document.getElementById("three").classList.add('checked');
              document.getElementById("four").classList.add('checked');
              document.getElementById("five").classList.add('checked');
            }
          }
        </script>

        <div class="editor_part">
          <div class="term1">
            <?php
              if ($GLOBALS['new']) {
                echo '<textarea name="title" id="review_title" value="Untitled" placeholder="Your title here" rows="1"></textarea>';

              } else {
                echo '<textarea name="title" id="review_title" rows="1">'.$GLOBALS["row"]["title"].'</textarea>';
              }
             ?>
          </div>

          <div class="term2">
            <?php
              if ($GLOBALS['new']) {
                echo '<textarea name="content" id="content" placeholder="Share your opinion..." rows="1"></textarea>';
              } else {
                echo '<textarea name="content" id="content" rows="1">'.$GLOBALS["row"]["content"].' </textarea>';
              }
             ?>
          </div>

<!-- ========================================BUTTONS======================================== -->

          <div class="term3">
            <button type="button" class="btn btn-link" onclick="submit_review()">
              <?php
              if ($GLOBALS['new']) {
                echo 'Submit';
              } else {
                echo 'Update';
              }
              ?></button>
          </div>

          <form action= <?php
            if ($GLOBALS['new']) {
              echo 'includes/post_review.inc.php';
            } else {
              echo 'includes/edit.inc.php?ID='.$_GET['ID'];
            }
           ?> id="review_submit" method="POST">
            <input type='hidden' id= 'review_title_submit' name="title"/>
            <input type='hidden' id= 'content_submit' name="content"/>
            <input type='hidden' id= 'rate_submit' name="rate"/>
          </form>

          <script>
            function submit_review() {

              var review_title = document.getElementById('review_title').value;
              var content = document.getElementById('content').value;
              var rate = document.getElementById('rate').value;
              if (review_title == '') {
                alert("Please enter your title.");
                return;
              } else {
                document.getElementById("review_title_submit").value = review_title;
              }

              if (content.length < 100) {
                alert("Content length can't be less than 100 characters.");
                return;
              } else {
                document.getElementById("content_submit").value = content;
              }

              document.getElementById("rate_submit").value = rate;
              document.getElementById("review_submit").submit();
             }
          </script>
        </div>
      </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>

</html>
