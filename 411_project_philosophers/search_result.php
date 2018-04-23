<?php include_once "header.php"; ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Search Result</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="search_result.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
      .checked {
          color: orange;
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
        font-size: 18px;
      }

      .rate {
        margin-left: 5px;
        font-size: 18px;
      }


      .hui {
        position: relative;
        margin-bottom: 0px;
        left: 10px;
        bottom: 10px;
        font-size: 20px;
        width: 8em;
        height: 1.2em;
        text-align: center;
        visibility:hidden;
        cursor: pointer;
      }

      #explore {
        color: white;
      }

      .search_result:hover #explore, .search_result, .hui{
        visibility:visible;
        cursor: pointer;
      }

      .search_result:hover .hui {
        background-color: grey;
      }

      #explore_genre {
        color: #007bff;
      }

      .search_result {
        display: inline-flex;
        flex-wrap: wrap;
      }

      .else1 {
        padding-left: 10px;
      }
    </style>
  </head>

  <!-- ========================================GENRE SELECTION======================================== -->

        <div class="major">
          <div class="typebutton">
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

          <form id="genre_submit" method="post">
            <input type='hidden' id= 'genre' name="name"/>
          </form>

          <script>
            function show_genre(genre) {
               document.getElementById('genre').value = genre;
               document.getElementById("genre_submit").submit();
             }
          </script>

         <?php
            if (isset($_POST['name'])) {
              $GLOBALS['set'] = true;

              include_once 'includes/dbh.inc.php';

              $name = $_POST['name'];

              $sql = "SELECT * FROM movie WHERE genres LIKE '%$name%';";

              $result = mysqli_query($conn, $sql);

              if (!$result) {
                echo mysqli_error($conn);
                exit();
              }

              //Assume there exists movies for each genre.
              if (mysqli_num_rows($result) > 0){
                $GLOBALS['result'] = $result;
              } else {
                echo 'NO RECORD FOUND!';
              }
            }
          ?>

<!-- ========================================PHP/SQL MANIPULATION======================================== -->
    <body>
      <?php
      include_once 'includes/dbh.inc.php';

      $movie_search = $_GET['search'];
      $_SESSION['search'] = $movie_search;

      if ($movie_search == NULL && $GLOBALS['set'] == NULL) {
        echo 'Please choose a movie genre or search for a movie...';
        exit();
      }

      if (!$GLOBALS['set']) {
        $sql = "SELECT * FROM movie WHERE title LIKE '%".$movie_search."%';";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
          echo mysqli_error($conn);
        }

        if (mysqli_num_rows($result) > 0){
          $GLOBALS['result'] = $result;
        } else {
          echo 'No results found for '.$movie_search.'.';
          exit();
        }
      }
      ?>

<!-- ========================================SEARCH RESULT======================================== -->
        <div class="resulttext">
          <h2><?php
            if (!$GLOBALS['set']) {
              echo '<p class="czh">Search result for  ';
              echo "".$_GET['search']." :";
              echo '</p>';
              // echo "Search result for ".$_GET['search']." :";
            } else {
              echo '<div class="search_result" id="report">';
              echo '<div class="else">';
              echo '<p class="czh">Search for genre:   </p>';
              echo '</div>';
              echo '<div class="else1">';
              echo '<p class="czh" id="explore_genre" onclick="whatever()">';
              echo " ".$_POST['name']."";
              echo '</p>';
              echo '</div>';
              echo '<div class="hui">';
              echo '<p id="explore">Explore more...';
              echo '</p>';
              echo '</div>';
              echo '</div>';
              $genre_js = $_POST['name'];
            }
           ?>
          </h2>
        </div>

        <form id="gotoAdvance" action="advance.php" method="post">
          <input type='hidden' id= 'advance' name="genre"/>
        </form>

        <script type="text/javascript">
          var temp = getElementById("report");
          function whatever() {
            document.getElementById("advance").value = "<?php echo $genre_js; ?>";
            document.getElementById("gotoAdvance").submit();
          }
        </script>

        <div class="search_result_margin">
          <?php
              while ($row = mysqli_fetch_assoc($GLOBALS['result'])){
                $poster = "https://image.tmdb.org/t/p/w500".$row["poster"];
                echo '<div class="items">';
                echo '<a href="movie_main.php?search='.$row['title'].'">';
                echo '<img src='.$poster.'  class="movie_image">';
                echo '</a>';
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

                echo '<div class="meta_abstract">'.$genres.'</div>
                      </div>
                    </div>';
              }
          ?>
        </div>
      </div>




    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>

</html>
