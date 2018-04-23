<?php include_once "header.php"; ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Movie</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="movie_main_style.css">
    <style>
      body {
        background-color: #333;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: 50% 35%;
      }

      .checked {
          color: orange;
          font-size: 28px;
      }

      .button-like {
        border: 2px solid #8a8a8a;
        background-color: transparent;
        text-decoration: none;
        padding: 0.2rem;
        position: relative;
        vertical-align: middle;
        text-align: center;
        display: inline-block;
        border-radius: 3rem;
        color: #8a8a8a;
        font-size: 22px;
        transition: all ease 0.4s;
        margin-top: 2px;
      }

      .button-like span {
        margin-left: 0.5rem;
      }

      .button-like .fa,
      .button-like span {
        transition: all ease 0.4s;
      }

      .button-like:focus {
        background-color: transparent;
      }

      .button-like:focus .fa,
      .button-like:focus span {
        color: #8a8a8a;
      }

      .button-like:hover {
        border-color: #cc4b37;
        background-color: transparent;
      }

      .button-like:hover .fa,
      .button-like:hover span {
        color: #cc4b37;
      }

      .liked {
        background-color: #cc4b37;
        border-color: #cc4b37;
      }

      .liked .fa,
      .liked span {
        color: #fefefe;
      }

      .liked:focus {
        background-color: #cc4b37;
      }

      .liked:focus .fa,
      .liked:focus span {
        color: #fefefe;
      }

      .liked:hover {
        background-color: #cc4b37;
        border-color: #cc4b37;
      }

      .liked:hover .fa,
      .liked:hover span {
        color: #fefefe;
      }

      .top_major {
        width: 80%;
      }

      .fa {
        font-size: 28px;
        margin-left: 2px;
      }

      .stars {
        position: relative;
        display: flex;
        flex-wrap: wrap;
        margin-left: 5px;
        margin-right: 5px;
        padding-top: 15px;
      }

      .movie_header {
        display: inline-block;
      }

      .term1 {
        display: flex;
        flex-wrap: wrap;
      }

      .fa-heart {
        font-size: 22px;
      }

      div.Reviews {
        border: none;
        margin-left: 20px;
        margin-right: 20px;
        border-top: 1px solid #e5e5e5;
        padding-top: 3px;
      }

      .introduction {
        border-color: #e5e5e5;
      }

      .movie_title {
        padding: 0px;
      }

      .stars_review, .review_title {
        position: relative;
        display: flex;
        flex-wrap: wrap;
      }

      .stars_review {
        margin-top: 6px;
        margin-left: 6px;
      }

      .stars_review .fa {
        font-size: 16px;
      }


    </style>

    <script>
      // $(document).foundation();
      $(function() {
        $('.button-like')
          .bind('click', function(event) {

            if ($(".button-like").hasClass("liked")) {
              $('input[name="favorite"]').val(0);
              $(".button-like").removeClass("liked");
            } else {
              $('input[name="favorite"]').val(1);
              $(".button-like").addClass("liked");
            }

            $("#favorite").submit();
            // window.alert("submitted");
          })
      });
    </script>

  </head>

  <!-- ========================================PHP/SQL MANIPULATION======================================== -->

  <body>
    <?php
    include_once 'includes/dbh.inc.php';

    $movie_search = $_GET['search'];
    $_SESSION['search'] = $movie_search;

    $sql = "SELECT * FROM movie WHERE title LIKE '%".$movie_search."%';";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) >= 1) {
      $GLOBALS['result'] = mysqli_fetch_assoc($result);
      $_SESSION['result'] = $GLOBALS['result'];
    }
    ?>

    <!-- ========================================MOVIE INFO======================================== -->
    <div class="top_major">
      <div class="major">
        <div class="movie_title">
          <!-- <div class="term1"> -->

            <div class="movie_header">
              <?php
                  echo '<p>';
                  echo $GLOBALS['result']['title'];
                  echo '</p>';

              ?>
            </div>

            <div class="stars">
              <?php
                  echo '
                  <span class="fa fa-star checked"></span>
                  ';
                  if ($GLOBALS['result']['vote_average'] < 1) {
                    echo '
                      <span class="fa fa-star"></span>
                      <span class="fa fa-star"></span>
                      <span class="fa fa-star"></span>
                      <span class="fa fa-star"></span>
                      ';
                  } else if ($GLOBALS['result']['vote_average'] >= 1 && $GLOBALS['result']['vote_average'] < 2) {
                    echo '<span class="fa fa-star checked"></span>
                          <span class="fa fa-star"></span>
                          <span class="fa fa-star"></span>
                          <span class="fa fa-star"></span>';
                  } else if ($GLOBALS['result']['vote_average'] >= 2 && $GLOBALS['result']['vote_average'] < 3) {
                    echo '
                      <span class="fa fa-star checked"></span>
                      <span class="fa fa-star checked"></span>
                      <span class="fa fa-star"></span>
                      <span class="fa fa-star"></span>
                          ';
                  } else if ($GLOBALS['result']['vote_average'] >= 3 && $GLOBALS['result']['vote_average'] < 4) {
                    echo '
                      <span class="fa fa-star checked"></span>
                      <span class="fa fa-star checked"></span>
                      <span class="fa fa-star checked"></span>
                      <span class="fa fa-star"></span>
                          ';
                  } else {
                    echo '
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                          ';

                  }
                  echo '</div>';
                  echo '<div class="ratings">';
                  echo '<span class="checked"> '.' '.$GLOBALS['result']['vote_average'].'</span>';
                  echo '</div>';
                ?>


          <!-- </div> -->

          <form id="favorite" method="post">
            <input type='hidden' name="favorite" />
          </form>

          <?php
            include_once 'includes/dbh.inc.php';
            if (isset($_SESSION['ID'])) {
                $sql = "SELECT * FROM favorite WHERE user_ID =".$_SESSION['ID']." AND movie_ID=".$GLOBALS["result"]["ID"]." ;";
                $result2 = mysqli_query($conn, $sql);

                if (!$result2) {
                  echo "error1 ".mysqli_error($conn);
                }

                if (mysqli_num_rows($result2) > 0){
                  $GLOBALS['button'] = "button button-like liked";
                } else {
                  $GLOBALS['button'] = "button button-like";
                }

                if (isset($_POST['favorite'])) {

                  if ($_POST['favorite'] == 1) {
                    include_once 'dbh.inc.php';

                    //UPDATE WEIGHTS
                    $sql3 = "SELECT weight FROM user WHERE ID='".$_SESSION['ID']."';";
                    $row = mysqli_fetch_assoc(mysqli_query($conn, $sql3));

                    $output = shell_exec('/home/movietellerdb/miniconda3/bin/python update_weight.py  "'.$row['weight'].'" " '.$GLOBALS['result']['genres'].'"');
                    $output = mysqli_real_escape_string($conn, $output);
                    $sql2 = "UPDATE user SET weight='".$output."' WHERE  ID='".$_SESSION['ID']."';";
                    mysqli_query($conn, $sql2);

                    //INSERT TO FAVORITE LIST
                    $sql = "INSERT INTO favorite VALUES ('".$GLOBALS["result"]["ID"]."', '".$_SESSION["ID"]."');";
                    $GLOBALS['button'] = "button button-like liked";
                  } else {
                    $sql = "DELETE FROM favorite WHERE movie_ID=".$GLOBALS["result"]["ID"]." AND user_ID=".$_SESSION["ID"].";";
                    $GLOBALS['button'] = "button button-like";
                  }

                  if (!mysqli_query($conn, $sql)) {
                    echo mysqli_error($conn);
                  }
                }
            } else {
                $GLOBALS['button'] = "button button-like";
            }



           ?>

           <!-- LIKE BUTTON -->
             <div class="term2">
               <?php
                   echo '<button class="'.$GLOBALS['button'].'">';
                ?>
                 <i class="fa fa-heart"></i>
                 <span>Like</span>
               </button>
             </div>



        </div>

        <div class="subject">

          <?php
            $poster = "https://image.tmdb.org/t/p/w500".$GLOBALS["result"]["poster"];
            echo '<img src='.$poster.' class="movie_image" id="image_movie">';
           ?>

          <script type="text/javascript">
            var source = document.getElementById("image_movie").src;
            document.body.style.backgroundImage = "url('" + source + "')";
          </script>

          <div id="info">
            <span class="meta_abstract">
              <span class="pl">Language:</span>
              <span class="attrs">
                <?php
                  echo $GLOBALS['result']['language'];
                ?>
              </span>
            </span>

            <span class="meta_abstract">
              <span class="pl">Popularity:</span>
              <span class="attrs">
                <?php
                  echo $GLOBALS['result']['popularity'];
                ?>
              </span>
            </span>

            <span class="meta_abstract">
              <span class="pl">Production Country:</span>
              <span class="attrs">
                <?php
                  echo $GLOBALS['result']['production_country'];
                ?>
              </span>
            </span>

            <span class="meta_abstract">
              <span class="pl">Duration:</span>
              <?php
                echo $GLOBALS['result']['runtime'];
              ?>
              <span class="attrs"></span>
            </span>

            <span class="meta_abstract">
              <span class="pl">Average Vote:</span>
              <span class="attrs">
                <?php
                  echo $GLOBALS['result']['vote_average'];
                ?>
              </span>
            </span>

            <span class="meta_abstract">
              <span class="pl">Genres:</span>
              <span class="attrs">
                <?php
                  echo $GLOBALS['result']['genres'];
                ?>
              </span>
            </span>

            <span class="meta_abstract">
              <span class="pl">Overview:</span>
            </span>

            <p class="introduction">
              <?php
                echo $GLOBALS['result']['overview'];
              ?>
            </p>
          </div>
        </div>

<!-- ========================================ALL REVIEWS======================================== -->

        <div class="movie_title">
          <div class="temp1">
            <p>Review</p>
          </div>
          <div class="temp2">
            <?php
                echo '<form  action="review_editor.php?movie_ID='.$GLOBALS['result']['ID'].'&new=1" method="post">';
             ?>
              <button type="submit" name="submit" class="btn btn-light" id="editReview">Write Review</button>
            </form>
          </div>
        </div>

        <div class="Reviews">
              <?php
                  include_once 'includes/dbh.inc.php';

                  $sqlList = "SELECT user.ID, user.username, movie_review.title, rate, date, content FROM movie_review, user WHERE movie_ID =".$GLOBALS['result']['ID']." AND user.ID = movie_review.user_ID;";

                  $reviewList = mysqli_query($conn, $sqlList);
                  $RevLstChk = mysqli_num_rows($reviewList);

                  if (!$reviewList) {
                    echo mysqli_error($conn);
                  }

                  if($RevLstChk > 0){
                    while($row = mysqli_fetch_assoc($reviewList)){
                      echo '<div class="review_piece">

                      <div class="review_title">
                      <h4>'.$row['title'].'</h4>';

                      echo '<div class="stars_review">';
                      if ($row['rate'] == 1) {
                        echo '<span class="fa fa-star checked"></span>';
                        echo '<span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>';
                      } else if ($row['rate'] == 2) {
                        echo '<span class="fa fa-star checked"></span>';
                        echo '<span class="fa fa-star checked"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>';
                      } else if ($row['rate'] == 3) {
                        echo '<span class="fa fa-star checked"></span>';
                        echo '<span class="fa fa-star checked"></span>
                              <span class="fa fa-star checked"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>';
                      } else if ($row['rate'] == 4) {
                        echo '<span class="fa fa-star checked"></span>';
                        echo '<span class="fa fa-star checked"></span>
                              <span class="fa fa-star checked"></span>
                              <span class="fa fa-star checked"></span>
                              <span class="fa fa-star"></span>';
                      } else {
                        echo '<span class="fa fa-star checked"></span>';
                        echo '<span class="fa fa-star checked"></span>
                              <span class="fa fa-star checked"></span>
                              <span class="fa fa-star checked"></span>
                              <span class="fa fa-star checked"></span>';

                      }
                      echo '</div>';
                      echo '</div>';


                      echo '<p>Written by <a href="user_main.php?user_ID='.$row['ID'].'" >'.$row['username'].'</a> on '.$row['date'].'
                      <p>'.$row['content'].'</p>
                      </div>';
                    }
                  }
               ?>
        </div>

      </div>
    </div>



    <!-- ========================================JAVASCRIPT======================================== -->

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
