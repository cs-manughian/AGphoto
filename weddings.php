#!/usr/local/php5/bin/php-cgi
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <title>AG PHOTO</title>
      <link rel="stylesheet" type="text/css" href="css/style.css">
		<script src="js/jquery.min.js"></script> 
      <script src="js/jquery.mosaicflow.min.js"></script>  
   </head>
   <body>
      <?php
    include 'templates/header.php';
    ?>
      <main>
      <h1>WEDDINGS</h1>
      <?php
    $servername  = "***";
    $username    = "***";
    $password    = "***";
    $dbname      = "***";
    $galleryType = "Wedding";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "SELECT pictureLink FROM Pictures WHERE galleryType='$galleryType'";
    
    
    $result = $conn->query($sql);
	?>
	 <div class="clearfix mosaicflow">
	 <?php
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo '<div class="mosaicflow__item"><img src="' . $row["pictureLink"] . '" alt="' . $row["altText"] . '"/></div>';
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    
    ?>
      </div>
    </main>
      <?php
    include 'templates/footer.php';
    ?>

   </body>
</html>