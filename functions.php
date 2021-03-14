<?php

define("_CSS", "css/style.css");
define("_IMG","img/");
define("_AD_IMG1", _IMG."samsung_t7.jpg" );
define("_AD_IMG2", _IMG."seagate-barracuda-fast.jpg" );
define("_AD_IMG3", _IMG."seagate-firecuda-gaming.png" );
define("_AD_IMG4", _IMG."WD_Black_P50.png" );
define("_AD_IMG5", _IMG."rog-strix-arion.jpg" );
define("max_prod_code_length", 12);
define("min_prod_code_length", 2);
define("max_product_price", 10000);
define("min_product_price", 0);
define("max_name_length", 20);
define("min_name_length", 1);
define("max_city_length", 8);
define("min_city_length", 1);
define("max_order_quantity", 99);
define("min_order_quantity", 1);
define("max_comments_length", 200);
define("orders","buy.txt");
define('_LOGFILEPATH', "debug/");
define("_LOG_FILE", _LOGFILEPATH."logs.txt");

function generateHeader ($title){
        ?>
            <!DOCTYPE html>
        <html>
            <head>
                 <link rel="stylesheet" type="text/css" href="<?php echo _CSS;?>">
                 <link rel="stylesheet"
                       href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
                       integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
                       crossorigin="anonymous">
                 <title><?php echo $title;  ?></title>
            
          <nav class="navbar navbar-expand-lg navbar-light bg-dark">
              <img src="img/logo.png" alt="Comp MTL Logo" style="width:50px;height:50px">
              <a class="navbar-brand text-danger" href="index.php">Comp MTL</a>
           <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
           </button>

           <div class="collapse navbar-collapse" id="navbarSupportedContent">
             <ul class="navbar-nav mr-auto">
               <li class="nav-item active">
                   <a class="nav-link text-danger" href="index.php">Home <span class="sr-only" >(current)</span></a>
               </li>
               <li class="nav-item">
                   <a class="nav-link text-danger" href="buy.php">Buy</a>
               </li>
               <li class="nav-item">
                   <a class="nav-link text-danger " href="order.php" tabindex="-1" aria-disabled="false">Order</a>
               </li>
               <li>
                    <a class="nav-link  text-danger" href="contact.php" tabindex="-1" aria-disabled="false">Contact</a>
               </li>
             </ul>
               <p style="color:#86f0a1; margin-bottom: 0;">This website is powered by <img src="img/php.png" alt="Powered by PHP" style="width:50px;height:50px">
               &emsp;
             <form class="form-inline my-2 my-lg-0">
               <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
               <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
             </form>
           </div>
         </nav>
       

        </head>
        

        <?php
    }
    
function generateBody() {
        ?>
        
        <body>
<style>
body {
  background-image: url(img/earth.jpg);
  background-position: 50% 50%;
  background-repeat: repeat;
}
</style>    
        </body>
            </html>
        <?php
}    

function displayAds()
    {
        $adsImages = array(_AD_IMG1,_AD_IMG2,_AD_IMG3,_AD_IMG4,_AD_IMG5);
        
        shuffle($adsImages);
        
        $SSD_Names = array("Samsung T7","Seagate BarraCuda Fast","Seagate Firecuda Gaming","WD Black P50","ROG STRIX ARION");
        //change the order of the image
        shuffle($SSD_Names);
        for($position = 0 ; $position < count($adsImages) ; $position ++)
        {
          
          if($position == 4)
          {
              echo '<a href="https://www.newegg.ca"><img class="AdImg-big" src="'.$adsImages[$position].'"></a>';
          }
        else
        {
         
              echo '<a href="https://www.newegg.ca"><img class="AdImg" src="'.$adsImages[$position].'"></a>';
        }
          
            
        }
        
        
       
         echo '<br>';
       
         ?>
        <div style='text-align: center;color: whitesmoke'><?php echo $adsImages[4] ?></div> 
         <?php
              
    }
    
function generateBody_WHITEBACKGROUND() {
    ?>
        
        <body>
<style>
body {
  background-image: url(img/white.png);
  background-position: 100% 100%;
  background-repeat: repeat;
}
</style>   
<table>   
    <?php
        $file = fopen("./buy.txt", "r") or die("Unable to open file!");
        while (!feof($file)){   
            $data = fgets($file); 
            list($ProdId, $FirstName, $LastName, $City, $Comments, $Price, $Quantity, $SubTotal, $Taxes, $GrandTotal) = explode("|", $data);
    ?> 
    <tr>
        <td><?=$ProdId ?></td>
        <td><?=$FirstName ?></td>
        <td><?=$LastName ?></td>
        <td><?=$City ?></td>
        <td><?=$Comments ?></td>
        <td><?=$Price ?></td>
        <td><?=$Quantity ?></td>
        <td><?=$SubTotal ?></td>
        <td><?=$Taxes ?></td>
        <td><?=$GrandTotal ?></td>
        ...
    </tr>
    <?php
        }
        fclose();
   ?>
</table>
<!--iterate and change the color-->
<?php foreach ($customer_data as $customer => $data){?>
	<tr>
		<?php foreach ($data as $key => $value){?>
			<?php
			$color = "color : black";
				if(isset($_GET['command']) && $_GET['command'] == 'color'){
					if($key == "subtotal"){
						if($value < 100.00){
							$color = "color:red";
						}elseif ($value>=100.00 && $value <= 999.99) {
							$color = "color:orange";
						}else{
							$color = "color:green";
						}
					}
				}
				if($key == "subtotal" || $key == "taxes" || $key == "grand_total" || $key == "price") {
					$value = "$".$value;
				}
			?>
			<td style="<?=$color?>">
				<?php echo $value?>
			</td>
		<?php } ?>
	</tr>
<?php } ?>

        </body>
            </html>
        <?php
}      

function generateFooter() {
        ?>  
        <link rel="stylesheet" type="text/css" href="<?php echo _CSS;?>">
        <style>
      .img-container {
        text-align: center;
        display: block;
        margin-top: 100%;
      }
        </style>
       <span class="img-container"> <!-- Inline parent element -->
           <img src="img/coding.png" alt="<3">
       </span>
            
            <div class="footer">
                
                <?php 
            $copyYear = 2021; 
            $currentYear = date('Y'); 
            echo $copyYear . (($copyYear != $currentYear) ? '-' . $currentYear : '');
            ?> Adrian Eugen Mikula 1231843, CompMTL ©

        <?php
    }


            //To display error on the forms
    function buy($errors)
    {
         ?>
        
        <?php echo"<pre>" .  print_r($errors['success'], true) . "</pre>";?>
        <div class="forms">
        <link rel="stylesheet" type="text/css" href="<?php echo _CSS;?>">
        <form method="post" action="buy.php">
        <p><span class="error">* required field</span></p>
        <p style="color:white">Product Id: <input type="text" name="ProdId" > </p>
        <span class="error">* <?php display_error($errors['ProdId'] ); ?></span> <br><br>
        <p style="color:white">First Name: <input type="text" name="FirstName"> </p>
         <span class="error">*<?php display_error($errors['FirstName']);?></span> <br><br>
         <p style="color:white">Last Name: <input type="text" name="LastName"> </p>
        <span class="error">*<?php display_error($errors['LastName']);?></span> <br><br>
        <p style="color:white">City: <input type="text" name="City"> </p>
        <span class="error">*<?php display_error($errors['City']);?></span><br><br>
        <p style="color:white">Comments: <textarea name="Comments"></textarea> </p>
        <span class="error"><?php display_error($errors['Comments']);?></span><br><br>
        <p style="color:white">Price: <input type="number" name="price"> </p>
        <span class="error">*<?php display_error($errors['Price']);?></span><br><br>
        <p style="color:white">Quantity: <input type="number" name="quantity"> </p>
        <span class="error">*<?php display_error($errors['Quantity']);?></span><br><br>
        <input type="submit" name="submit" value="Submit">
        <br>
        <br>
        <br>
	
        </form>
        </div>

        
        <?php
    }
        
        
    
    //to show the error
    function display_error($error)
    {
        if($error != ''){
            echo'<span class="error">' . $error . ' </span>';
        }
    }

    //function to get the text file
    function get_data_txt(){
      if (file_exists ('./buy.txt"') ) {
        $data=fopen("./buy.txt", "r") or die("Unable to open file!");
      return $data;
      }else{
        return "Unable to open file!";
      }
    }

 // open the text file
 function open_file()
 {
  $return = json_decode(file_get_contents(purchases), true);
  //if empty return the array otherwise return the text file if true
  if(empty($return)){
    return array();
  }else{
    return $return;
  }
}

//save the text file
function save_to_file($data)
{
  $old_data = open_file();
  $new_data = array_merge($old_data, array($data));

  if(file_put_contents(purchases, json_encode($new_data, true)))
  {
    return "Data Saved successfully";
  }
  else
  {
    return "Error While Saving File :(";
  }
}

//
//// function to manageError 
//function manageError($errorCode, $errorMessage, $errorFile, $errorLine, $errorContext)
//{
//    // for debugging
//    /*echo "An error occured <br>";
//    echo "Error code: " . $errorCode;
//    echo "<br>" . "Error message: " . $errorMessage;
//    echo "<br>" . "File name: " . $errorFile;
//    echo "<br>" . "Line: " . $errorLine;
//    echo "<br>" . "Error context: " . $errorContext . "<br>";*/
//    /*
//    $currentDate = new DateTime("now");
//    
//    file_put_contents(_LOG_FILE, "An error occured at " . $currentDate->format("Y M d") . "\r\n", FILE_APPEND);
//    file_put_contents(_LOG_FILE, "Error code: " . $errorCode . "\r\n", FILE_APPEND);
//    file_put_contents(_LOG_FILE, "Error message: " . $errorMessage . "\r\n", FILE_APPEND);
//    file_put_contents(_LOG_FILE, "File name: " . $errorFile . "\r\n", FILE_APPEND);
//    file_put_contents(_LOG_FILE, "Line: " . $errorLine . "\r\n\r\n", FILE_APPEND);*/
//    
//    $arrayErrors = array($errorCode, $errorMessage, $errorFile, $errorLine);
//    
//    file_put_contents(_LOG_FILE, json_encode($arrayErrors), FILE_APPEND);
//   
//    
//    //die("An error occured.");
//}

//manage the exception
//function manageException($exception)
//{
//    /*echo "exception <br>";
//    echo "Error code: " . $exception->getCode();
//    echo "<br>" . "Error message: " . $exception->getMessage();
//    echo "<br>" . "File name: " . $exception->getFile();
//    echo "<br>" . "Line: " . $exception->getLine();*/
//    
//    $currentDate = new DateTime("now");
//    date_default_timezone_set("America/New_York");
//   // $browser = get_browser(null, true);
//    //Get the browser version
//
//    file_put_contents(_LOG_FILE, "An exception occured at " . $currentDate->format("Y M d") . date("h:i:sa"). "\r\n", FILE_APPEND);
//    file_put_contents(_LOG_FILE, "Exception code: " . $exception->getCode() . "\r\n", FILE_APPEND);
//    file_put_contents(_LOG_FILE, "Exception message: " . $exception->getMessage() . "\r\n", FILE_APPEND);
//    file_put_contents(_LOG_FILE, "File name: " . $exception->getFile() . "\r\n", FILE_APPEND);
//    file_put_contents(_LOG_FILE, "Line: " . $exception->getLine() . "\r\n\r\n", FILE_APPEND);
//    file_put_contents(_LOG_FILE, "browser version:" . $exception->get_browser() . "\r\n\r\n", FILE_APPEND);
//    
//    die("PHP engine stopped.");
//}

// set_error_handler("manageError");

// set_exception_handler("manageException");


//Function to validate the form
function validateForm()
{
  $errors = array('error_count'=>false, 'ProdId'=>'', 'FirstName'=>'', 'LastName'=>'', 'City'=>'', 'Price'=>'','Quantity'=>'', 'Comments'=>'', 'success'=>'');
 
if(isset($_POST['submit']) == true){
    $ProdId = filter_var($_POST['ProdId'] ,FILTER_SANITIZE_STRING) ;
  $FirstName =  filter_var( $_POST['FirstName'],FILTER_SANITIZE_STRING) ;
  $LastName =  filter_var( $_POST['LastName'],FILTER_SANITIZE_STRING) ;
  $Price =  filter_var( $_POST['Price'],FILTER_SANITIZE_STRING) ;
  $City =  filter_var( $_POST['City'],FILTER_SANITIZE_STRING) ;
  $Quantity = filter_var( $_POST['Quantity'],FILTER_SANITIZE_STRING) ;
  $comments =  filter_var( $_POST['Comments'],FILTER_SANITIZE_STRING) ;
        
        
     
  $regx_prod_code = "/^(?=[p])([a-zA-Z0-9])+$/";

  if(strlen($ProdId) > max_prod_code_length || strlen($ProdId) < min_prod_code_length)
        {
    $errors['prod_code'] = 'Product code should be between ' . min_prod_code_length . ' and ' . max_prod_code_length . ' characters long and must start with a q.';
    $errors['error_count'] = true;
  }
        else if(preg_match($regx_prod_code, $ProdId) == false)
        {
    $errors['prod_code'] = 'Product code should have start with small capital p.';
    $errors['error_count'] = true;
  }

  if(strlen($FirstName) > max_name_length || strlen($FirstName) < min_name_length)
        {
    $errors['fname'] = 'First Name can not be empty or be longer than ' . max_name_length . ' characters.';
    $errors['error_count'] = true;
  }
        
  if(strlen($LastName) > max_name_length || strlen($LastName) < min_name_length){
    $errors['lname'] = 'Last Name can not be empty or be longer than ' . max_name_length . ' characters.';
    $errors['error_count'] = true;
  }
  if(strlen($City) > max_city_length || strlen($City) < min_city_length)
        {
    $errors['city'] = 'City Name can not be empty or be longer than ' . max_city_length . ' characters.';
    $errors['error_count'] = true;
  }

  if(is_numeric($Price) == false)
        {
    $errors['price'] = 'Price Should only contain numbers';
    $errors['error_count'] = true;
  }
        else if($Price < min_product_price)
        {
    $errors['price'] = 'Price cannot be lower than' . min_product_price;
    $errors['error_count'] = true;
  }
        else if($Price >max_product_price)
        {
    $errors['price'] = 'Price cannot be higher than' . max_product_price;
    $errors['error_count'] = true;
  }

  if(is_float($Quantity) == true)
        {
    $errors['quantity'] = 'Quantity cannot be a decimal';
    $errors['error_count'] = true;
  }
        else if($Quantity > max_order_quantity || $Quantity < min_order_quantity)
        {
    $errors['quantity'] = 'Order quantity must be between' . min_order_quantity . 'and' . max_order_quantity;
    $errors['error_count'] = true;
  }

  if($comments > max_comments_length){
    $errors['comments'] = 'Comments cannot exceed ' . max_comment_length . ' characters';
    $errors['error_count'] = true;
  }
  
  if ($errors['error_count'] != true) {
    //save data in .txt
    

    $subtotal = $Price * $Quantity;
    $taxes = ($subtotal * 12.05)/100;
    $grand_total = round($taxes + $subtotal, 2);

    $data = array('prod_code'=> $ProdId, 'fname'=> $FirstName,'lname'=> $LastName, 'city'=> $City, 'price'=> $Price, 'quantity'=> $Quantity, 'comments'=> $comments, 'subtotal'=> $subtotal, 'taxes'=>$taxes, 'grand_total'=>$grand_total);

    $errors['success'] = save_to_file($data);
  }
}
}