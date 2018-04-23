<?php
  session_start();
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="template.css">
    <style media="screen">
      ul {
        margin-bottom: 0rem !important;
      }
    </style>
  </head>
  <body>
    <header>
      <div>
        <ul>
<!-- ====================================LOGO====================================== -->
          <li style="float: left">
            <div>
              <a href="index.php" style="font-size:18px"> MTDb </a>
            </div>
          </li>
<!-- ====================================Search_Bar====================================== -->
          <li style="float: left">
            <div class="search">
              <form action="search_result.php" method="GET">
                <input type="text" name="search" placeholder="Search for a movie..." size="60%">
                <button class="btn_in_nav" type="submit" name="submit">Search</button>
              </form>
            </div>
          </li>
          <!-- ====================================REPORT====================================== -->
          <li>
            <div>
              <a href="advance.php"> ANALYSIS </a>
            </div>
          </li>
          <li>
            <div>
              <a target="_blank" href="https://docs.google.com/document/d/1-eZK_erhcaue6oozXU-6g6Zw8VP25TMTD9a_ThR6bIw/edit?usp=sharing"> REPORT </a>
            </div>
          </li>
<!-- ====================================SIGN IN/OUT====================================== -->
          <li >
            <div class="user_status">
              <?php

                if (isset($_SESSION['email'])) {
                  echo '<form class="logout_form" action="includes/logout.inc.php" method="POST">
                        <button type="submit" name="submit">LOG OUT</button>
                        </form>';
                  echo '<form class="logout_form" action="user_main.php" method="POST">
                        <button type="submit" name="submit">MY SPACE</button>
                        </form>';
                } else {
                  echo '<form class="logout_form" action="includes/login.inc.php" method="POST">
                          <input type="text" name="email" placeholder="Email">
                          <input type="password" name="pwd" placeholder="Password">
                          <button type="submit" name="submit">LOGIN</button>
                        </form>

                     <button type="button" onclick="signup()" id="signup">SIGN UP</button>

                     <script>
                        function signup() {
                            window.location.href = "signup.php";
                        }
                      </script>
                     ';
                }
               ?>
              <!-- <form action="#" method="POST">
                <button class="btn_in_nav" type="submit" name="submit">LOG OUT</button>
              </form>
              <form action="#" method="POST">
                <button class="btn_in_nav" type="submit" name="submit">MY SPACE</button>
              </form> -->
            </div>
          </li>
        </ul>
      </div>
    </header>

  </body>
</html>
