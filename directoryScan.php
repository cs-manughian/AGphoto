#!/usr/local/php5/bin/php-cgi

<?php
    
    // --------------------------------------------------------------------
    // directoryScan.php -- detects images uploaded into images folder
    // 
    // Created: 4/24/16 Sarah Shibley
    //
	//		- First drop and recreate the Pictures table.
    //		- Any images uploaded into the sub-directories of the "images"
    //			folder will be detected and automatically inserted into the
    //			database "Pictures" table.
    //		- files that are already inside the database (i.e., same path)
    //			will not be re-inserted
    //		- when a sub-directory is added to the images folder, also add
    //			the directory name to the $directories array below
    // --------------------------------------------------------------------
    
    $directories = array(
        "Wedding",
        "Portrait",
        "Engagement",
		"Home"
    );
    
    $dir = 'img/';
    
    $insertCount = 0;
    
    define('DBHOST', '***');
    define('DBNAME', '***');
    define('DBUSER', '***');
    define('DBPASS', '***');
    $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
    $error      = mysqli_connect_error();
    if ($error != null) {
        $output = "<p> unable to connect to the database<p>" . $error;
        exit($output);
    }
    
	$presql = 'DROP TABLE Pictures;';
	$presqlResult = mysqli_query($connection, $presql);
	$presql = 'CREATE TABLE Pictures(
				pictureLink varchar(30)PRIMARY KEY NOT NULL,
				altText varchar(30),
				orientation varchar(15),
				galleryType varchar(50) NOT NULL
				);';
	$presqlResult = mysqli_query($connection, $presql);

    foreach ($directories as $subDir) {
        $files = scandir($dir . $subDir);
		foreach ($files as $fileName) {
			if ($fileName != "." && $fileName != "..") {
				$filePath = $dir . $subDir . '/' . $fileName;
				$info     = getimagesize($filePath);
				if ($info[0] == 0 || $info[1] == 0 || (($info[2] !== 1) && ($info[2] !== 2) && ($info[2] !== 3))) {
					echo 'file ' . $filePath . ' is not an image';
				} else {
					if ($info[0] < $info[1]) {
						$orientation = 'vertical';
					} else {
						$orientation = 'horizontal';
					}
					$sql    = 'SELECT * FROM Pictures WHERE pictureLink = "' . $filePath . '";';
					$result = mysqli_query($connection, $sql);
					
					if (mysqli_num_rows($result) == 0) {
						$sql    = 'INSERT INTO Pictures VALUES ("' . $filePath . '", "' . $fileName . '", "' . $orientation . '", "' . $subDir . '")';
						$result = mysqli_query($connection, $sql);
						$insertCount++;               
					}
				}
			}
		}   
    }
    echo 'Successfully inserted ' . $insertCount . ' pictures';
?>