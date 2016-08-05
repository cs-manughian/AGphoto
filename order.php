#!/usr/local/php5/bin/php-cgi

  <?php
    //---------------------------------------//
    // Libs
    //require_once 'swiftmailer-5.x/lib/swift_required.php';

    // Define vars

    // Inputs
    $name      = $email = $phone = $category = $confirmation = "";
    $shootDate = $quantity = $size = $requests = $order = "";

    // Error messages
    $nameErr      = $emailErr = $phoneErr = $categoryErr = "";
    $shootDateErr = $quantityErr = $sizeErr = $requestsErr = "";

    //---------------------------------------//
    // If they submitted the form
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validate the data
        // Initialize vars
        $name      = $_POST["name"];
        $email     = $_POST["email"];
        $phone     = $_POST["phone"];
        $category  = $_POST["category"];
        $shootDate = $_POST["shootDate"];
        $quantity  = $_POST["quantity"];
        $size      = $_POST["size"];
        $requests  = $_POST["requests"];
        
        // Process data
        // Check name is valid
        if (empty($name)) {
            $nameErr = "* Name is required";
        } else {
            // Name must contain only letters and whitespace
            if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
                $nameErr = "* Only letters and white space are allowed";
            }
        }
        
        // Check email is valid
        if (empty($email)) {
            $emailErr = "* Email is required";
        } else {
            // If e-mail address isn't a valid format
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "* Invalid email format";
            }
        }
        
        // Check phone number is valid
        if (empty($phone)) {
            $phoneErr = "* Phone number is required";
        } else {
            // If the phone isn't in the format (nnn) nnn-nnnn
            if (!preg_match("/^\(\d{3}\)\s\d{3}-\d{4}$/", $phone)) {
                $phoneErr = "* Phone number must be in the format (nnn) nnn-nnnn";
            }
        }
        
        // Check category is valid
        if (empty($category)) {
            $categoryErr = "* Category is required";
        }

            // Requests must contain only letters and whitespace
            if (!preg_match("/^[a-zA-Z ]*$/", $requests)) {
                $requestsErr = "* Only letters and white space are allowed";
            }
        

        // Check shoot date is valid
        if (empty($shootDate)) {
            $shootDate = "* Shoot date is required";
        } else {
            // If the date isn't inputted in the format mm/dd/yyyy
	     // (NOTE: The posted date is in the format yyyy-mm-dd,
	     // so we use the regex for yyyy-mm-dd)
            if (!preg_match("/^(20)[1-9][0-9]-(0[1-9]|1[0-2])-(0[1-9]|1\d|2\d|3[01])$/", $shootDate)) {
                $shootDateErr = "* Shoot date must be in the format mm/dd/yyyy";
            }
        }
        
        // if post and no error, show confirmation and email
        if ( empty($nameErr) &&
	      empty($emailErr) &&
	      empty($phoneErr) &&
	      empty($categoryErr) &&
	      empty($shootDateErr) &&
	      empty($quantityErr) &&
	      empty($sizeErr) &&
	      empty($requestsErr)) {

             $confirmation = "Thank you for your request! We will contact you as soon as possible.";

	   /*
            // Email information to client
	    $message = "";
	     foreach ($_POST as $key => $value)
               $message .= "Field ".htmlspecialchars($key)." is ".htmlspecialchars($value)."\n";

	     // In case any of our lines are larger than 70 characters, we should use wordwrap()
            $message = wordwrap($message, 70, "\r\n");

            // Create the mail transport configuration
            $transport = Swift_MailTransport::newInstance();

            // Create the message
            $emailMsg = Swift_Message::newInstance();
            $emailMsg->setTo(array(
  		"cs.manughian@gmail.com" => "Aurelio De Rosa"
            ));
            $emailMsg->setFrom("example@example.com", "Your photo site");
            $emailMsg->setSubject("Photo order");
            $emailMsg->setBody($message);

            // Send the email
            $mailer = Swift_Mailer::newInstance($transport);
            $mailer->send($emailMsg);
            */
        }

    } // end if submission

    // else just load the page

    //---------------------------------------//
    ?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <title>AG PHOTO</title>
      <link rel="stylesheet" type="text/css" href="css/style.css">
   </head>
   <body>
      <?php include 'templates/header.php'; ?>
      <main id="orderPage">
      <h1>REQUEST A SHOOT</h1>
 
      <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
         <hr>
         <i>Enter Your Information</i>
         <div class="group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder="your name"  maxlength="50" required>
            <span class="error"><?php echo $nameErr;?></span>
	     <br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="email@site.com" maxlength="100" required>
            <span class="error"><?php echo $emailErr;?></span>
	     <br>
            <label for="phone">Phone:</label>
            <input type="tel" id="phone" name="phone" pattern="\(\d{3}\)\s\d{3}-\d{4}" placeholder="(nnn) nnn-nnnn" maxlength="25" required> 
            <span class="error"><?php echo $phoneErr;?></span>
         </div>
         <hr>
         <i>Select Shoot Details</i>
         <div class="group">
            Select a category 
	     <span class="error"><?php echo $categoryErr;?></span>
            <br>
            <?php
               $categories = array("wedding", "engagement", "portraits", "party"); 
               foreach($categories as $category) {
                 echo '<input id="'.$category.'" type="radio" name="category" value="'.$category.'" required><label for="'.$category.'">'.$category.'</label>';
               }
               ?>	 
         </div>
         <div class="group">
            <label for="shootDate">Date of shoot (mm/dd/yyyy)</label>
	     <span class="error"><?php echo $shootDateErr;?></span>
            <br>
            <input id="shootDate" type="date" name="shootDate" min="<?php echo date('Y-m-d'); ?>" required>
         </div>
         <hr>
         <i>Select Print Options</i>
         <div class="group">
            <label for="quantity">Number of prints</label>
            <select id="quantity" name="quantity" required>
               <option value="">Select</option>
               <?php for ($i = 1; $i <= 30; $i++) { 
                  echo '<option>'.$i.'</option>';
                  } 
                  ?>
            </select>
	     <span class="error"><?php echo $quantityErr;?></span>
            <br>
            <label for="size">Print size (inches)</label>
            <select id="size" name="size" required>
               <option value="">Select</option>
               <option>4x6</option>
               <option>8x10</option>
               <option>8x12</option>
               <option>11x14</option>
               <option>12x12</option>
            </select>
	     <span class="error"><?php echo $sizeErr;?></span>
         </div>
         <div class="group">
            <label for="requests">Special requests</label>
            <span class="error"><?php echo $requestsErr;?></span>
            <br><br>
            <textarea id="requests" name="requests" rows="4" cols="50" maxlength="250">
            </textarea>
         </div>
         <input type="submit" value="Submit">
      </form>
      <?php echo $confirmation; ?>
      </main>
      <?php include 'templates/footer.php'; ?>
   </body>
</html>