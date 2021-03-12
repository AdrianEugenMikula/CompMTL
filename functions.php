<?php
define("_CSS", "css/style.css");
function generateHeader ($title){
 ?>
      <!DOCTYPE html>
        <html>
            <head>
                 <link rel="stylesheet" type="text/css" href="<?php echo _CSS;?>">
            </head>
        <body>

        <ul>
          <li><a href="#home">Home</a></li>
          <li><a href="#news">Buy</a></li>
          <li><a href="#contact">Order</a></li>
          <li style="float:right"><a class="active" href="#about">About</a></li>
        </ul>

        </body>
        </html>

<?php

}


?>