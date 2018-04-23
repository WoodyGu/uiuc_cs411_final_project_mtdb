<?php
    include_once 'header.php';
  ?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Welcome!</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="advance.css">
  </head>
  <body>
    <div class="outer">
      <div class="all">
        <div class="slide1" id="part1">

          <div class="choices1">
            <div class="term1">
              <div class="term1_img">
                <img src="plot2.png" alt="development" height="350px" width="350px">
              </div>
              <div class="term1_button">
                <button type="button" class="btn btn-link choice1" id="temp1" value="plot">Development<br></button>
              </div>
            </div>

            <div class="term1">
              <div class="term1_img">
                <img src="pie.png" alt="development" height="350px" width="350px">
              </div>
              <div class="term1_button">
                <button type="button" class="btn btn-link choice1" id="temp2" value="pie">Comparison</button>
              </div>
            </div>

            <div class="term1">
              <div class="term1_img">
                <img src="bar.png" alt="development" height="350px" width="350px">
              </div>
              <div class="term1_button">
                <button type="button" class="btn btn-link choice1" id="temp3" value="bar">Histogram</button>
              </div>
            </div>
          </div>
        </div>




        <div class="slide2" id="part2">
          <!-- <p class='question2'>Questions here</p> -->
          <div class="choices2" style="top:135%">
            <!-- <button type="button" class="btn btn-link choice2" id="temp5" value="5">option1</button>
            <button type="button" class="btn btn-link choice2" id="temp6" value="6">option2</button>
            <button type="button" class="btn btn-link choice2" id="temp7" value="7">option3</button>
            <button type="button" class="btn btn-link choice2" id="temp8" value="8">option4</button> -->
            <div class="term2">
              <div class="term2_img">
                <img src="hashtag.png" alt="development" height="450px" width="450px" style="width: 300px; height: 300px; padding-left: 50px;>
              </div>
              <div class="term1_button">
                <button type="button" class="btn btn-link choice1" id="temp4" value="quantity">Quantity</button>
              </div>
            </div>

            <div class="term2">
              <div class="term2_img">
                <img src="dollar.png" alt="development" height="450px" width="450px" style=" width: 300px; height: 300px;>
              </div>
              <div class="term1_button">
                <button type="button" class="btn btn-link choice1" id="temp5" value="box office">Box Office</button>
              </div>
            </div>
          </div>

        </div>

        <div class="slide3" id="part3">
          <div class="choices3">
            <div class="folder">
              <button type="button" class="btn btn-link choice3" id="temp6" value="70">1970s</button>
              <button type="button" class="btn btn-link choice3" id="temp7" value="90">1990s</button>
              <button type="button" class="btn btn-link choice3" id="temp8" value="10">2010s</button>
            </div>
            <div class="folder">
              <button type="button" class="btn btn-link choice3" id="temp9" value="80">1980s</button>
              <button type="button" class="btn btn-link choice3" id="temp10" value="00">2000s</button>
              <button type="button" class="btn btn-link choice3" id="temp11" value="all">All</button>
            </div>
          </div>

        </div>

        <div class="slide4" id="part4">
          <div class="choices4" id="well">
            <button type="button" class="btn btn-link choice4" id="czh" onclick="wtf();">Show Result</button>
          </div>
        </div>

        <div class="slide5" id="part5">

        </div>

        <script>
          var temp = "<?php echo $_POST['genre']; ?>";
          function wtf() {
            $.ajax({
              method: "POST",
              url: "action.php",
              data: {type: ans1, y_value: ans2, generation: ans3, genre: temp},
              success: function(status) {
                $("#part4").html(
                  status
                );
              }
            });
          }
        </script>
      </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="advance.js">

    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  </body>
</html>
