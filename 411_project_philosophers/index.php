<?php
    include_once 'header.php';
  ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>MovieTellerDb</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
    <style>
      .showtime {
        margin: auto;
        margin-top: 10px;
      }
      .carousel-inner {
        background-color: #222222;
      }

      .whatthefuck {
        margin: auto;
      }

      .whatthefuck img{
        display: block;
        margin-left: auto;
        margin-right: auto;
      }

      body {
          background-color: #212529;
      }

      .category {
          border: none;
          margin-top: 5px;
      }


    </style>
  </head>
  <body>

    <!-- ========================================Genre======================================== -->
    <div>
      <div class="category">
        <button type="button" class="btn btn-outline-info" onclick="show_genre('Action')">Action</button>
        <button type="button" class="btn btn-outline-info" onclick="show_genre('Adventure')">Adventure</button>
        <button type="button" class="btn btn-outline-info" onclick="show_genre('Animation')">Animation</button>
        <button type="button" class="btn btn-outline-info" onclick="show_genre('Comedy')">Comedy</button>
        <button type="button" class="btn btn-outline-info" onclick="show_genre('Crime')">Crime</button>
        <button type="button" class="btn btn-outline-info" onclick="show_genre('Documentary')">Documentary</button>
        <button type="button" class="btn btn-outline-info" onclick="show_genre('Drama')">Drama</button>
        <button type="button" class="btn btn-outline-info" onclick="show_genre('Family')">Family</button>
        <button type="button" class="btn btn-outline-info" onclick="show_genre('Fantasy')">Fantasy</button>
        <button type="button" class="btn btn-outline-info" onclick="show_genre('History')">History</button>
        <button type="button" class="btn btn-outline-info" onclick="show_genre('Horror')">Horror</button>
        <button type="button" class="btn btn-outline-info" onclick="show_genre('Music')">Music</button>
        <button type="button" class="btn btn-outline-info" onclick="show_genre('Mystery')">Mystery</button>
        <button type="button" class="btn btn-outline-info" onclick="show_genre('Romance')">Romance</button>
        <button type="button" class="btn btn-outline-info" onclick="show_genre('Science Fiction')">Science Fiction</button>
        <button type="button" class="btn btn-outline-info" onclick="show_genre('TV Movie')">TV Movie</button>
        <button type="button" class="btn btn-outline-info" onclick="show_genre('Thriller')">Thriller</button>
        <button type="button" class="btn btn-outline-info" onclick="show_genre('War')">War</button>
        <button type="button" class="btn btn-outline-info" onclick="show_genre('Western')">Western</button>
      </div>
    </div>

    <form id="genre_submit" method="post" action="search_result.php">
      <input type='hidden' id= 'genre' name="name"/>
    </form>

    <script>
      function show_genre(genre) {
         document.getElementById('genre').value = genre;
         document.getElementById("genre_submit").submit();
       }
    </script>

    <!-- ========================================Featured List======================================== -->
    <?php
      include_once 'includes/dbh.inc.php';

      $sql = "SELECT * FROM movie WHERE release_date > 20100101 AND popularity > 40 ORDER BY vote_average DESC LIMIT 5;";
      $result = mysqli_query($conn, $sql);

      if (!$result) {
        echo mysqli_error($conn);
      }

      if(mysqli_num_rows($result) > 0){
        $GLOBALS['result'] = $result;

      } else {
        //TODO: handling error message here!
        echo 'NULL';
        exit();
      }
    ?>

    <div class="major" id="Mark">
      <div class="showtime">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <!-- <div class="whatthefuck">
                <img src="https://img.moegirl.org/common/9/99/38900829.jpg" width="585" length="873" align="middle">
              </div> -->

              <?php
                while ($row = mysqli_fetch_assoc($GLOBALS['result'])) {
                  if ($row["poster"] == 'None') {
                    continue;
                    echo '<span style="color:#AFA;text-align:center;">'.$row["poster"].'</span>';
                  }
                  $poster = "https://image.tmdb.org/t/p/w500".$row["poster"];
                  echo '<div class="whatthefuck">';
                  echo '<a href="movie_main.php?search='.$row['title'].'">';
                  echo '<img src='.$poster.' width="585" height="873" align="middle">';
                  echo '</a>';
                  echo '</div>';
                  echo '<div class="carousel-caption d-none d-md-block">';
                  echo '<h5>'.$row['title'].'</h5>';
                  echo '<p>'.$row['overview'].'</p>';
                  echo '</div>';
                  break;
                }
               ?>

              <!-- <div class="carousel-caption d-none d-md-block">
                <h5>Main Page!</h5>
                <p>Call me Mark, I tried my best to build this. Hope you guys can do the remaing part. Thank you!</p>
              </div> -->
            </div>
            <?php
              while ($row = mysqli_fetch_assoc($GLOBALS['result'])) {
                if ($row["poster"] == 'None') {
                  continue;
                  echo '<span style="color:#AFA;text-align:center;">'.$row["poster"].'</span>';
                }
                $poster = "https://image.tmdb.org/t/p/w500".$row["poster"];
                echo '<div class="carousel-item">';
                echo '<div class="whatthefuck">';
                echo '<a href="movie_main.php?search='.$row['title'].'">';
                echo '<img src='.$poster.' width="585" height="873" align="middle">';
                echo '</a>';
                echo '</div>';
                echo '<div class="carousel-caption d-none d-md-block">';
                echo '<h5>'.$row['title'].'</h5>';
                echo '<p>'.$row['overview'].'</p>';
                echo '</div>';
                echo '</div>';
              }
             ?>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <?php
        include_once 'footer.php';
      ?>
  </body>
</html>
