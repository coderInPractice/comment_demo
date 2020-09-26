<?php
//Initial page connection to the database
require 'config.php';
$db_server = mysqli_connect($dbhost, $dbusername, $dbpass);
    if (!$db_server) die("Unable to connect to MySQL: " . mysqli_connect_error());

mysqli_select_db($db_server,$dbname)
    or die("Unable to select database: " . mysqli_connect_error());

$select_query = "SELECT * FROM comments_table ORDER BY name DESC";

$result = mysqli_query($db_server,$select_query);
    if (!$result) die ("Database access failed: " . mysqli_connect_error());
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta charset="utf-8">
  <title>Demo - Comment</title>
  <meta name="description" content="">
  <meta name="author" content="Manish Verma">

  <!-- Mobile Specific Metas
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- FONT
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

  <!-- CSS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">

  <!-- Favicon
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="icon" type="image/png" href="images/favicon.png">

  <style>

      #content{
          font-size: 20px;
      }

  </style>


</head>
<body>
    <div class="container">
        <div class="row">
            <div class="twelve columns">
                <h1>Lorem Ipsum</h1>
            </div>
        </div>
        <div class="row">
            <div class="twelve columns">
                <p id="content">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                    when an unknown printer took a galley of type and scrambled it to make a type specimen 
                    book. It has survived not only five centuries, but also the leap into electronic typesetting, 
                    remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset 
                    sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like 
                    Aldus PageMaker including versions of Lorem Ipsum.

                </p>
            </div>
        </div>
        <hr>

        <div class="row">
            <div class="twelve columns">
                <h4>Comments:</h4>
                <form action="save.php" method="POST">
                    <div class="row">
                      <div class="six columns">
                        <label for="exampleEmailInput">Your name</label>
                        <input class="u-full-width" type="text" name="nameInput" required>
                      </div>

                      <div class="six columns">
                        <label for="exampleRecipientInput">Your email</label>
                        <input class="u-full-width" type="email" placeholder="test@mailbox.com" name="emailInput" required>
                      </div>
                    </div>

                    <label for="exampleMessage">Message</label>
                    <textarea class="u-full-width" placeholder="Write here …" name="exampleMessage" maxlength="250" required></textarea>

                    <input class="button-primary" type="submit" value="Submit" name="submit">
                  </form>
            </div>
            <div class="row">
                <div class="twelve columns">
                    <p class = "six columns"><strong>Recent Comments:</strong><br><br>
                    <?php
                    // Iterating through all the data
                        while($res = mysqli_fetch_array($result)){
                            echo '<strong>'.$res['name'].'</strong>'.'<br>';
                            echo $res['email'].'<br>';
                            echo $res['message'].'<br>'.'<br>';
                        }
                    ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
