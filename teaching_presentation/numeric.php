<html>
   <body>
   <!-- These are two examples of creating a NUMERIC ARRAY -->

      <?php
         /* First method to create array. */
        echo "<h2>This is a NUMERIC array created by using the array() method.</h2>";
         $numbers = array( 1, 2, 3, 4, 5);
         
         foreach( $numbers as $value ) {
            echo "Value is $value <br />";
         }

        echo "<br />";
         
         /* Second method to create array. */
        echo "<h2>This is a NUMERIC array created by entering in each value in directly into the array individually.</h2>";
         $numbers[0] = "one";
         $numbers[1] = "two";
         $numbers[2] = "three";
         $numbers[3] = "four";
         $numbers[4] = "five";
         
         foreach( $numbers as $value ) {
            echo "Value is $value <br />";
         }
      ?>
      
   </body>
</html>