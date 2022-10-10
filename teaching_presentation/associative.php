<html>
   <body>
    <!-- These are two examples of creating an ASSOCIATIVE array -->
      
      <?php
         /* First method to associate create array. */
         echo "<h2>This is a ASSOCIATIVE array created by using the array() method.</h2>";
         $salaries = array("mohammad" => 2000, "qadir" => 1000, "zara" => 500);
         
         echo "Salary of mohammad is ". $salaries['mohammad'] . "<br />";
         echo "Salary of qadir is ".  $salaries['qadir']. "<br />";
         echo "Salary of zara is ".  $salaries['zara']. "<br />";

         echo "<br />";
         
         /* Second method to create array. */
         echo "<h2>This is a ASSOCIATIVE array created by entering in each value in directly into the array individually.</h2>";
         $salaries['mohammad'] = "high";
         $salaries['qadir'] = "medium";
         $salaries['zara'] = "low";
         
         echo "Salary of mohammad is ". $salaries['mohammad'] . "<br />";
         echo "Salary of qadir is ".  $salaries['qadir']. "<br />";
         echo "Salary of zara is ".  $salaries['zara']. "<br />";
      ?>
   
   </body>
</html>