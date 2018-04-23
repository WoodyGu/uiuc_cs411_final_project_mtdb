<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>MovieTellerDb</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <?php
      include_once "header.php";
     ?>

    <section class="main-container">
      <div class="main-wrapper">
        <!-- <h2>Edit Profile</h2> -->
        <div class="big_title">
          <h2>Edit Profile</h2>
        </div>

        <form action="includes/upload.inc.php" method="post" enctype='multipart/form-data' class="img-form">
          <input type="file" name="file">
          <button type="submit" name="submitImg">UPLOAD IMAGE</button>
        </form>
        <form action="includes/editprofile.inc.php" method="POST" class="signup-form">
          <?php
            if (isset($_SESSION['username'])) {
              echo '<input type="text" name="username" placeholder="Username" value="'.$_SESSION['username'].'">';
              echo "<br>";
            } else {
              echo '<input type="text" name="username" placeholder="Username">';
              echo "<br>";
            }
            if (isset($_SESSION['bio'])) {
              echo '<input type="text" name="bio" value="'.$_SESSION['bio'].'">';
              echo "<br>";
            } else {
              echo '<input type="text" name="bio" placeholder="Introduce yourself...">';
              echo "<br>";
            }
           ?>
           <input type="password" name="pwd" placeholder="Password">
           <br>
           <input type="password" name="pwd_conf" placeholder="Confirm Password">
           <br>


           <div class="temp">
             <h3>Please choose types of the movie that you like:</h3>
           </div>


           <div class="center choice">
             <div class="btn-group-toggle" data-toggle="buttons">
               <label class="btn btn-secondary">
                 <input type="checkbox" autocomplete="off" name="type[]" value="Action">Action
               </label>
             </div>

             <div class="btn-group-toggle" data-toggle="buttons">
               <label class="btn btn-secondary">
                 <input type="checkbox" autocomplete="off" name="type[]" value="Adventure">Adventure
               </label>
             </div>

             <div class="btn-group-toggle" data-toggle="buttons">
               <label class="btn btn-secondary">
                 <input type="checkbox" autocomplete="off" name="type[]" value="Animation">Animation
               </label>
             </div>
             <div class="btn-group-toggle" data-toggle="buttons">
               <label class="btn btn-secondary">
                 <input type="checkbox" autocomplete="off" name="type[]" value="Comedy">Comedy
               </label>
             </div>
             <div class="btn-group-toggle" data-toggle="buttons">
               <label class="btn btn-secondary">
                 <input type="checkbox" autocomplete="off" name="type[]" value="Crime">Crime
               </label>
             </div>
             <div class="btn-group-toggle" data-toggle="buttons">
               <label class="btn btn-secondary">
                 <input type="checkbox" autocomplete="off" name="type[]" value="Documentary">Documentary
               </label>
             </div>
             <div class="btn-group-toggle" data-toggle="buttons">
               <label class="btn btn-secondary">
                 <input type="checkbox" autocomplete="off" name="type[]" value="Drama">Drama
               </label>
             </div>
             <div class="btn-group-toggle" data-toggle="buttons">
               <label class="btn btn-secondary">
                 <input type="checkbox" autocomplete="off" name="type[]" value="Family">Family
               </label>
             </div>
             <div class="btn-group-toggle" data-toggle="buttons">
               <label class="btn btn-secondary">
                 <input type="checkbox" autocomplete="off" name="type[]" value="Fantasy">Fantasy
               </label>
             </div>
             <div class="btn-group-toggle" data-toggle="buttons">
               <label class="btn btn-secondary">
                 <input type="checkbox" autocomplete="off" name="type[]" value="History">History
               </label>
             </div>
             <div class="btn-group-toggle" data-toggle="buttons">
               <label class="btn btn-secondary">
                 <input type="checkbox" autocomplete="off" name="type[]" value="Horror">Horror
               </label>
             </div>
             <div class="btn-group-toggle" data-toggle="buttons">
               <label class="btn btn-secondary">
                 <input type="checkbox" autocomplete="off" name="type[]" value="Music">Music
               </label>
             </div>
             <div class="btn-group-toggle" data-toggle="buttons">
               <label class="btn btn-secondary">
                 <input type="checkbox" autocomplete="off" name="type[]" value="Mystery">Mystery
               </label>
             </div>
             <div class="btn-group-toggle" data-toggle="buttons">
               <label class="btn btn-secondary">
                 <input type="checkbox" autocomplete="off" name="type[]" value="Romance">Romance
               </label>
             </div>
             <div class="btn-group-toggle" data-toggle="buttons">
               <label class="btn btn-secondary">
                 <input type="checkbox" autocomplete="off" name="type[]" value="Science Fiction">Science Fiction
               </label>
             </div>
             <div class="btn-group-toggle" data-toggle="buttons">
               <label class="btn btn-secondary">
                 <input type="checkbox" autocomplete="off" name="type[]" value="TV Movie">TV Movie
               </label>
             </div>
             <div class="btn-group-toggle" data-toggle="buttons">
               <label class="btn btn-secondary">
                 <input type="checkbox" autocomplete="off" name="type[]" value="Thriller">Thriller
               </label>
             </div>
             <div class="btn-group-toggle" data-toggle="buttons">
               <label class="btn btn-secondary">
                 <input type="checkbox" autocomplete="off" name="type[]" value="War">War
               </label>
             </div>
             <div class="btn-group-toggle" data-toggle="buttons">
               <label class="btn btn-secondary">
                 <input type="checkbox" autocomplete="off" name="type[]" value="Western">Western
               </label>
             </div>
           </div>

          <br>

          <div class="submit_button">
            <button type="submit" name="submit">Update</button>
          </div>

        </form>

      </div>
    </section>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>


  </body>

</html>
