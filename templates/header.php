<?php
   // --------------------------------------------------------------------
   // header.php -- header for AG Photography website
   // 
   // Created: 4/18/16 Sarah Shibley
   // --------------------------------------------------------------------
   
   /*Set $directory to your path to header.php */
   $directory='/~cmanugh2/AGphoto/';
   
   ?>
<header>
   Student Project -- not a commercial site.
   <a href="index.php"><img id="head_logo" src="img/logo.jpg" alt="AG Photo Logo"/></a><!--take alt text and image source from db in future-->
   <nav>
      <ul>
         <li <?php if($_SERVER['REQUEST_URI']==$directory . "portraits.php") {echo ' class="active"';}?>><a href="portraits.php">Portraits</a></li>
         <li <?php if($_SERVER['REQUEST_URI']==$directory . "weddings.php") {echo ' class="active"';}?>><a href="weddings.php">Weddings</a></li>
         <li <?php if($_SERVER['REQUEST_URI']==$directory . "engagements.php")	{echo ' class="active"';}?>><a href="engagements.php">Engagements</a></li>
         <li <?php if($_SERVER['REQUEST_URI']==$directory . "contact.php") {echo ' class="active"';}?>><a href="contact.php"> Contact</a></li>
         <li <?php if($_SERVER['REQUEST_URI']==$directory . "about.php") {echo ' class="active"';}?>><a href="about.php"> About Me</a></li>
         <li <?php if($_SERVER['REQUEST_URI']==$directory . "order.php") {echo ' class="active"';}?>><a href="order.php"> Order</a></li>
      </ul>
   </nav>
</header>