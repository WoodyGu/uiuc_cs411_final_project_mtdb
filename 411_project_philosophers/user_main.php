<?php
  include_once 'header.php';
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>user_main</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="user_main_style.css">
    <link rel="stylesheet" href="search_result.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
      .checked {
          color: orange;
      }
      .major {
        margin: auto;
        margin-top: 60px;
        width: 80%;
        min-height: 700px;
        max-height: 1200px;
        background-color: white;
        overflow-y: scroll;
      }

      div.Reviews {
        border: none;
        margin-left: 20px;
        margin-right: 20px;
        border-top: 1px solid #e5e5e5;
        padding-top: 3px;
      }

      .pro_img {
        margin-left: 10px;
        margin-top: 20px;
      }

      .item2 {
        margin-top: 20px;
      }

      .item3 {
        margin-top: 30px;
      }

      .editpart {
        margin-top: 105px;
      }

      .stars {
        position: relative;
        display: flex;
        flex-wrap: wrap;
        margin-top: 5px;
      }

      .stars_rate {
        display: flex;
        flex-wrap: wrap;
      }

      .fa {
        margin-left: 1px;
      }

      .rate {
        margin-left: 2px;
        margin-top: 1px;
      }

      .stars_review {
        margin-top: 5px;
        margin-left: 6px;
      }

      .stars_review .fa {
        font-size: 19px;
        margin-left: 2px;
      }

      .stars_review, .review_title {
        position: relative;
        display: flex;
        flex-wrap: wrap;
      }


    </style>
  </head>

  <!-- ========================================USER INFO======================================== -->

  <body>
    <div class="major">
      <div class="user_information">
        <?php
          include_once "includes/dbh.inc.php";
          if (isset($_GET['user_ID'])) {
            $GLOBALS['ID'] = $_GET['user_ID'];
          } else {
            $GLOBALS['ID'] = $_SESSION['ID'];
          }

          $sql = "SELECT * FROM user WHERE ID = ".$GLOBALS['ID'].";";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_assoc($result);

          $imageName = $row['picture'];
          $GLOBALS['username'] = $row['username'];

          echo '<div class="item1">';
              echo '<img src="http://movietellerdb.web.engr.illinois.edu/Images/'.$imageName.'" width="150" height="200" class="pro_img">';
          echo "</div>";
         ?>

         <!-- <form action="includes/editProfile.inc.php" method="POST" class="signup-form"> -->

        <div class="item2">
          <p class="username"><?php echo $GLOBALS['username']; ?></p>
          <p class="intro"><?php
              include_once 'includes/dbh.inc.php';
              $sql = "SELECT * FROM user WHERE ID=".$GLOBALS['ID'].";";
              $result = mysqli_query($conn, $sql);

              if (mysqli_num_rows($result) >= 1) {
                $result = mysqli_fetch_assoc($result);
                echo $result['bio'];
                $GLOBALS['weight'] = $result['weight'];
              } else {
                echo 'NULL';
              }
               ?></p>
        </div>

        <div class="item3">
          <div class="followpart">
            <?php
                if (isset($_POST['follow'])) {
                  $sql = "INSERT INTO follow VALUES (".$_GET["user_ID"].", ".$_SESSION["ID"].");";
                  include_once 'includes/dbh.inc.php';

                  $result = mysqli_query($conn, $sql);
                  // unset($_POST['follow']);
                  if (!$result) {
                    echo mysqli_error($conn);
                    exit();
                  }

                } else if (isset($_POST['unfollow'])) {
                  $sql = "DELETE FROM follow WHERE followed_ID=".$_GET["user_ID"]." AND following_ID=".$_SESSION["ID"].";";
                  include_once 'includes/dbh.inc.php';

                  $result = mysqli_query($conn, $sql);
                  // unset($_POST['unfollow']);
                  if (!$result) {
                    echo mysqli_error($conn);
                    exit();
                  }
                }
             ?>
            <?php
                $sql_following = "SELECT * FROM follow WHERE following_ID = ".$GLOBALS['ID'].";";
                $sql_followed = "SELECT * FROM follow WHERE followed_ID = ".$GLOBALS['ID'].";";
                include_once 'includes/dbh.inc.php';

                $result_following = mysqli_query($conn, $sql_following);
                $result_followed = mysqli_query($conn, $sql_followed);
                $following = mysqli_num_rows($result_following);
                $followed = mysqli_num_rows($result_followed);

                echo '<h5>Following: '.$following.'</h5>';
                echo '<h5>Followed: '.$followed.'</h5>';
             ?>
          </div>
          <div class="editpart">
            <?php
              if (!isset($GLOBALS['ID']) || $GLOBALS['ID'] == $_SESSION['ID']) {
                echo '<a href="editprofile.php" class="edit">Edit Profile</a>';
              } else {
                include_once 'dbh.inc.php';
                $sql = "SELECT * FROM follow WHERE followed_ID = '".$GLOBALS['ID']."' AND following_ID = '".$_SESSION['ID']."';";
                $result = mysqli_query($conn, $sql);

                if (!$result) {
                  echo mysqli_error($conn);
                  exit();
                }

                if (mysqli_num_rows($result) == 0){ //not followed
                  echo '<form method="post">
                    <button action="user_main.php?user_ID='.$GLOBALS['ID'].'" type="submit" name="follow" >Follow</button>
                  </form>';
                } else { // followed
                  echo '<form method="post">
                    <button action="user_main.php?user_ID='.$GLOBALS['ID'].'" type="submit" name="unfollow" >Unfollow</button>
                  </form>';
                }
              }
             ?>
          </div>
        </div>
      </div>

      <!-- ========================================MOMENTS======================================== -->
      <!-- BE CAREFUL ABOUT CONFUSING NAMING! -->
      <form method="POST" class="selection">
        <button type="submit" name="reviews" class="btn btn-lg">Moments</button>
        <button type="submit" name="moments" class="btn btn-lg">Reviews</button>
        <button type="submit" name="list" class="btn btn-lg">Favorite List</button>
        <button type="submit" name="recommend" class="btn btn-lg">Recommended Movies</button>
      </form>

      <div class="Reviews">
        <?php
            if (isset($_POST["moments"])) {//REVIEWS
              $ID = $GLOBALS['ID'];
              $sqlList = "SELECT movie_review.movie_ID as movie_ID, movie_review.ID as ID, movie.title as m_title, movie_review.title as mr_title, date, rate, content FROM movie_review, user, movie WHERE movie_review.user_ID = user.ID AND $ID = movie_review.user_ID AND movie_review.movie_ID = movie.ID;";

              $result = mysqli_query($conn, $sqlList);

              if (!$result) {
                echo mysqli_error($conn);
              }

              if(mysqli_num_rows($result) > 0){
                  while($row = mysqli_fetch_assoc($result)){
                    $movie_ID = $row['movie_ID'];
                    $review_ID = $row['ID'];

                    // echo '<div class="review_piece">';

                    echo '<div class="review_piece">

                    <div class="review_title">
                    <h4><a href="review.php?ID='.$review_ID.'&user_ID='.$ID.'" a>'.$row['mr_title'].'</a></h4>';

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

                    echo '<p>Commented <b>'.$row['m_title'].'</b> on '.$row['date'].'</p>
                    <p>'.$row['content'].'</p>
                    </div>';
                  }
                } else {
                  echo "You haven't written any reviews! Write a review now ;)";
                }//LIST
            } else if (isset($_POST["list"])) {
                $sql = "SELECT * FROM movie, favorite WHERE movie_ID=movie.ID AND user_ID = ".$GLOBALS['ID'].";";

                $result = mysqli_query($conn, $sql);

                if (!$result) {
                  echo mysqli_error($conn);
                }
                if(mysqli_num_rows($result) > 0){
                  while ($row = mysqli_fetch_assoc($result)){
                    $poster = "https://image.tmdb.org/t/p/w500".$row["poster"];
                    echo '<div class="items">';
                    echo '<img src='.$poster.'  class="movie_image">';
                    echo '<div class="detail">';
                    echo '<div class="title">
                            <a href="movie_main.php?search='.$row['title'].'">'.$row['title'].'</a>

                            ('.$row['release_date'].')  </div>';
                    echo '<div class="meta_abstract">'.$row['rate'].'</div>';

                    echo '<div class="stars_rate">';
                    echo '<div class="stars">';
                    echo '<span class="fa fa-star checked"></span>';
                    if ($row['vote_average'] < 1) {
                      echo '<span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>';
                    } else if ($row['vote_average'] >= 1 && $row['vote_average'] < 2) {
                      echo '<span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>';
                    } else if ($row['vote_average'] >= 2 && $row['vote_average'] < 3) {
                      echo '<span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>';
                    } else if ($row['vote_average'] >= 3 && $row['vote_average'] < 4) {
                      echo '<span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>';
                    } else {
                      echo '<span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>';
                    }
                    echo '</div>';
                    echo '<div class="rate">';
                    echo '<span class="checked"> '.$row['vote_average'].'</span>';
                    echo '</div>';
                    echo '</div>';


                    $genres = $row['genres'];
                    // echo '<div class="genre">'.$genres.'<div>';

                    echo '<div class="meta_abstract">'.$genres.'</div>
                          </div>
                        </div>';
                  }
                } else {
                  echo "You don't have any collections ;)";
                }
            } else if (isset($_POST["recommend"])) {
              $output = shell_exec('/home/movietellerdb/miniconda3/bin/python recommend.py  "'.$GLOBALS['weight'].'"');

              $output = explode(",",$output);

              $sql = "SELECT * FROM movie WHERE ID IN (".implode(',',$output).");";

              $result = mysqli_query($conn, $sql);

              if (!$result) {
                echo mysqli_error($conn);
              }

              // $row = mysqli_fetch_assoc($result);
              // print($row["title"]);
              if(mysqli_num_rows($result) > 0){
                while ($row = mysqli_fetch_assoc($result)){
                  $poster = "https://image.tmdb.org/t/p/w500".$row["poster"];
                  echo '<div class="items">';
                  echo '<img src='.$poster.'  class="movie_image">';
                  echo '<div class="detail">';
                  echo '<div class="title">
                          <a href="movie_main.php?search='.$row['title'].'">'.$row['title'].'</a>

                          ('.$row['release_date'].')  </div>';
                  echo '<div class="meta_abstract">'.$row['rate'].'</div>';

                  echo '<div class="stars_rate">';
                  echo '<div class="stars">';
                  echo '<span class="fa fa-star checked"></span>';
                  if ($row['vote_average'] < 1) {
                    echo '<span class="fa fa-star"></span>
                          <span class="fa fa-star"></span>
                          <span class="fa fa-star"></span>
                          <span class="fa fa-star"></span>';
                  } else if ($row['vote_average'] >= 1 && $row['vote_average'] < 2) {
                    echo '<span class="fa fa-star checked"></span>
                          <span class="fa fa-star"></span>
                          <span class="fa fa-star"></span>
                          <span class="fa fa-star"></span>';
                  } else if ($row['vote_average'] >= 2 && $row['vote_average'] < 3) {
                    echo '<span class="fa fa-star checked"></span>
                          <span class="fa fa-star checked"></span>
                          <span class="fa fa-star"></span>
                          <span class="fa fa-star"></span>';
                  } else if ($row['vote_average'] >= 3 && $row['vote_average'] < 4) {
                    echo '<span class="fa fa-star checked"></span>
                          <span class="fa fa-star checked"></span>
                          <span class="fa fa-star checked"></span>
                          <span class="fa fa-star"></span>';
                  } else {
                    echo '<span class="fa fa-star checked"></span>
                          <span class="fa fa-star checked"></span>
                          <span class="fa fa-star checked"></span>
                          <span class="fa fa-star checked"></span>';
                  }
                  echo '</div>';
                  echo '<div class="rate">';
                  echo '<span class="checked"> '.$row['vote_average'].'</span>';
                  echo '</div>';
                  echo '</div>';


                  $genres = $row['genres'];
                  // echo '<div class="genre">'.$genres.'<div>';

                  echo '<div class="meta_abstract">'.$genres.'</div>
                        </div>
                      </div>';
                }
              } else {
                echo "You don't have any collections ;)";
              }


            } else { //MOMENTS
              $subquery = "SELECT followed_ID FROM follow WHERE following_ID =".$GLOBALS['ID']." ;";

              $sql = "SELECT movie_review.user_ID as uid, movie_review.ID as ID, movie_review.title as rt, date, movie_review.rate as rate, movie_review.content as content, username FROM movie_review, follow, user WHERE user.ID=movie_review.user_ID AND movie_review.user_ID=followed_ID AND movie_review.user_ID IN (SELECT followed_ID FROM follow WHERE following_ID = ".$GLOBALS['ID'].") ORDER BY date DESC;";

              $result = mysqli_query($conn, $sql);

              if (!$result) {
                echo mysqli_error($conn);
              }

              if(mysqli_num_rows($result) > 0){
                  while($row = mysqli_fetch_assoc($result)){
                    // echo '<div class="review_piece">
                    // <h4><a href="review.php?ID='.$row['ID'].'&user_ID='.$row['uid'].'" >'.$row['rt'].'</a> '.$row['rate'].'</h4>

                    echo '<div class="review_piece">

                    <div class="review_title">
                    <h4><a href="review.php?ID='.$row['ID'].'&user_ID='.$row['uid'].'" >'.$row['rt'].'</a></h4>';

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

                    echo '<p>'.$row['username'].' Commented on '.$row['date'].'</p>
                    <p>'.$row['content'].'</p>
                    </div>';
                  }
                } else {
                  echo "You aren't following anyone. Start following now ;)";
                }
            }
         ?>
      </div>
    </div>


    <!-- ========================================JAVASCRIPT======================================== -->

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
