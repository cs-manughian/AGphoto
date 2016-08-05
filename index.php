#!/usr/local/php5/bin/php-cgi
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <title>AG PHOTO</title>
      <link rel="stylesheet" type="text/css" href="css/style.css">
   </head>
   <body>
      <?php include 'templates/header.php'; ?>
      <main>
	    <?php
    $servername  = "***";
    $username    = "***";
    $password    = "***";
    $dbname      = "***";
    $galleryType = "Home";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "SELECT pictureLink,altText FROM Pictures WHERE galleryType='$galleryType'";
 
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo '<div><img src="' . $row["pictureLink"] . '" alt="' . $row["altText"] . '"/></div>';
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    
    ?>
      </main>
      <?php include 'templates/footer.php'; ?>
   </body>
</html>