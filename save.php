<?php
    //Create MySQL connection
    require 'config.php';
    $db_server = mysqli_connect($dbhost, $dbusername, $dbpass);
    if (!$db_server) die("Unable to connect to MySQL: " . mysqli_connect_error());

    //Select database
    mysqli_select_db($db_server,$dbname)
        or die("Unable to select database: " . mysqli_connect_error());

    // //Create a table
    // $create_table_query = "CREATE TABLE IF NOT EXISTS comments_table (
    //     name VARCHAR(32) NOT NULL,
    //     email_id VARCHAR(32) NOT NULL,
    //     message VARCHAR(255) NOT NULL,
    //     )";
    //     $result = mysqli_query($db_server,$create_table_query);
    //     if (!$result) die ("Database access failed: " . mysqli_connect_error());

    $name = mysql_entities_fix_string($db_server,$_POST['nameInput']);
    $email = mysql_entities_fix_string($db_server,$_POST['emailInput']);
    $message = mysql_entities_fix_string($db_server,$_POST['exampleMessage']);

    // Preventing SQL injecting and XSS

    function mysql_entities_fix_string($connection,$string){
        return htmlentities(mysql_fix_string($connection,$string));
    }
        
    function mysql_fix_string($connection,$string){
        if (get_magic_quotes_gpc()) $string = stripslashes($string);
            return mysqli_real_escape_string($connection,$string);
    }

    //Insert query statement
    $insert_query = "INSERT INTO comments_table VALUES('$name','$email','$message')";

    //Execute insert statemment
    $result = mysqli_query($db_server,$insert_query);
        if (!$result) die ("Database access failed: " . mysqli_connect_error());

    //Close database
    //mysqli_close($db_server);
    
    //Shows confirmaation
    echo <<<_END
    <form action = "index.php">
        <label>Comments successfully inserted.</label><br>
        <input class="button-primary" type="submit" value="Back" name="back" >
    </form>
    _END;
?>