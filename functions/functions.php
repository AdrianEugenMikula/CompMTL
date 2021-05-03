<?php
session_start();
define("_CSS", "css/style.css");
define("_IMG","img/");
define("_AD_IMG1", _IMG."samsung_t7.jpg" );
define("_AD_IMG2", _IMG."seagate-barracuda-fast.jpg" );
define("_AD_IMG3", _IMG."seagate-firecuda-gaming.png" );
define("_AD_IMG4", _IMG."WD_Black_P50.png" );
define("_AD_IMG5", _IMG."rog-strix-arion.jpg" );
define("max_productID_length", 12);
define("min_productID_length", 2);
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
define("MAX_PROD_CODE_LENGTH", 12);
define("MIN_PROD_CODE_LENGTH", 2);
define("MAX_PRODUCT_PRICE", 10000);
define("MIN_PRODUCT_PRICE", 0);
define("MAX_NAME_LENGTH", 20); 
define("MIN_NAME_LENGTH", 1);
define("MAX_CITY_LENGTH", 20);
define("MIN_CITY_LENGTH", 1);
define("MAX_ADDRESS_LENGTH", 20);
define("MIN_PROVINCE_LENGTH", 1);
define("MAX_PROVINCE_LENGTH", 20);
define("MIN_postalcode_LENGTH", 7);
define("MAX_postalcode_LENGTH", 7);
define("MIN_USERNAME_LENGTH", 4);
define("MAX_USERNAME_LENGTH", 12);
define("MIN_pwd_LENGTH", 8);
define("MAX_pwd_LENGTH", 255);
define("MIN_ORDER_QUANTITY", 1);
define("MAX_ORDER_QUANTITY", 99);
define("MIN_COMMENTS_LENGTH", 0);
define("MAX_COMMENTS_LENGTH", 200);
define("MIN_PROD_NAME_LENGTH", 0); 
define("MIN_PROD_DESC_LENGTH", 0);  
define("MAX_PROD_NAME_LENGTH", 200);
define("MAX_PROD_DESC_LENGTH", 200); 
define("TAX_RATE", 12.05); 
define("purchases","purchases.txt");


require_once("database.php");
require_once("validate.php");

require_once("collections.php");

require_once("customer.php");
require_once("product.php");
require_once("Purchase.php");

require_once("customers.php");
require_once("products.php");
require_once("Purchases.php");


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
              
               <button class="btn btn-outline-success my-2 my-sm-0" type="submit">LogIn</button>
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
<style>
body {
  background-image: url(img/white.png);
  background-position: 100% 100%;
  background-repeat: repeat;
}
</style> 
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

function register($errors){
      if(logged_in() == true){
        header("location: index.php");
      }
      ?>
      <form method="post" action="">
        <p><span class="error">* required field</span></p>
        
        First Name: <input type="text" name="firstname" > 
        <span class="error">* <?php display_error($errors['firstname'] ); ?></span> <br><br>

        Last Name: <input type="text" name="lastname" > 
        <span class="error">* <?php display_error($errors['lastname'] ); ?></span> <br><br>

        Address: <input type="text" name="address" > 
        <span class="error">* <?php display_error($errors['address'] ); ?></span> <br><br>

        City: <input type="text" name="city" > 
        <span class="error">* <?php display_error($errors['city'] ); ?></span> <br><br>

        Province: <input type="text" name="province" > 
        <span class="error">* <?php display_error($errors['province'] ); ?></span> <br><br>

        Postal Code: <input type="text" name="postalcode" > 
        <span class="error">* <?php display_error($errors['postalcode'] ); ?></span> <br><br>

        Username: <input type="text" name="username" > 
        <span class="error">* <?php display_error($errors['username'] ); ?></span> <br><br>


        pwd: <input type="pwd" name="pwd"> 
        <span class="error">* <?php display_error($errors['pwd'] ); ?></span> <br><br>


        <input type="submit" name="submit" value= "Submit">
        <br>
        <br>
        <br>
        <p>Already have an account? <a href="login.php">Login</a></p>
        </form>
    <?php }


function login($errors){
  if(logged_in() == true){
    header("location: index.php");
  }
?>
  <form method="post" action="">
   <br><br>
  <p><span class="error">* required field</span></p>
  Username: <input type="text" name="username" > 
  <span class="error">* <?php display_error($errors['username'] ); ?></span> <br><br>
  pwd: <input type="pwd" name="pwd"> 
  <span class="error">* <?php display_error($errors['pwd'] ); ?></span> <br><br>
  <input type="submit" name="submit" value="Submit">
  <br>
  <br>
  <br>
  <p>Don't have an account? <a href="register.php">Create one</a></p>
  </form>
<?php }


function logged_in(){
  if(isset($_SESSION["logged_in"]) == true)
    return true;
  return false;
}

function account($errors){
  global $customer_data;
?>
<div class="account-form">
  <form action="" method="post">
    <h2>Change Account Details</h2>
    <p><span class="error">* required field</span></p>
    Customer Code: <input type="text" placeholder="<?=$customer_data->getcustomersID()?>" value="<?=$customer_data->getcustomersID()?>" name="customersID" disabled="disabled">

    <p><span class="error">* required field</span></p>
    First Name: <input type="text" placeholder="<?=$customer_data->getfirstname()?>" value="<?=$customer_data->getfirstname()?>" name="firstname" > 
    <span class="error">* <?php display_error($errors['firstname'] ); ?></span> <br><br>

    <p><span class="error">* required field</span></p>
    Last Name: <input type="text" placeholder="<?=$customer_data->getlastname()?>" value="<?=$customer_data->getlastname()?>" name="lastname" > 
    <span class="error">* <?php display_error($errors['lastname'] ); ?></span> <br><br>

    <p><span class="error">* required field</span></p>
    Address: <input type="text" placeholder="<?=$customer_data->getAddress()?>" value="<?=$customer_data->getAddress()?>" name="address" > 
    <span class="error">* <?php display_error($errors['address'] ); ?></span> <br><br>

    <p><span class="error">* required field</span></p>
    City: <input type="text" placeholder="<?=$customer_data->getCity()?>" value="<?=$customer_data->getCity()?>" name="city" > 
    <span class="error">* <?php display_error($errors['city'] ); ?></span> <br><br>

    <p><span class="error">* required field</span></p>
    Province: <input type="text" placeholder="<?=$customer_data->getProvince()?>" value="<?=$customer_data->getProvince()?>" name="province" > 
    <span class="error">* <?php display_error($errors['province'] ); ?></span> <br><br>

    <p><span class="error">* required field</span></p>
    Postal Code: <input type="text" placeholder="<?=$customer_data->getpostalcode()?>" value="<?=$customer_data->getpostalcode()?>" name="postalcode" > 
    <span class="error">* <?php display_error($errors['postalcode'] ); ?></span> <br><br>

    <p><span class="error">* required field</span></p>
    Username: <input type="text" placeholder="<?=$customer_data->getUsername()?>" value="<?=$customer_data->getUsername()?>" name="username" > 
    <span class="error">* <?php display_error($errors['username'] ); ?></span> <br><br>

    <input type="submit" name="submit-info">
  </form>

  <form action="" method="post">
    <h2>Change pwd</h2>
    <p><span class="error">* required field</span></p>
    Old pwd: <input type="pwd" name="old_pwd" > 
    <span class="error">* <?php display_error($errors['old_pwd'] ); ?></span> <br><br>

    <p><span class="error">* required field</span></p>
    New pwd: <input type="pwd" name="new_pwd" > 
    <span class="error">* <?php display_error($errors['new_pwd'] ); ?></span> <br><br>

    <p><span class="error">* required field</span></p>
    Confirm New pwd: <input type="pwd" name="confirm_new_pwd" > 
    <span class="error">* <?php display_error($errors['confirm_new_pwd'] ); ?></span> <br><br>

    <input type="submit" name="submit-pwd">
  </form>
  <br><br><br>
</div>
<?php
}



//function to create the page header
function createPageHeader($title)
{
?>
  <!DOCTYPE html>
  <html>
  <head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="<?php echo _CSS;?>">
  <script type="text/javascript" src="<?php echo JS_FILE?>"></script>
  <title><?php echo $title;  ?></title>
  </head>
<?php

}


          
function buy($errors){
  if(logged_in() == false){
header("location: login.php");
}
    global $product_data;
  ?>

  <?php if(isset($_GET["success"])){ echo "<h3 style='color:green!important'>product added!<h3>"; }?>
  <div class="forms">
    <link rel="stylesheet" type="text/css" href="<?php echo _CSS;?>">
    <form method="post" action="">
      <p><span class="error">* required field</span></p>
      
      Customer: <input type="text" placeholder="<?=$_SESSION["customersID"]?> - <?=$_SESSION["username"]?>" disabled="disabled"><br><br>

      Product: <select name="productID">
        <option value="none">Please choose the product</option>
        <?php 
          foreach ($product_data->data as $key => $value) {?>
            <option value="<?=$key?>"><?=$value->getproductID()?> - <?=$value->getDescription()?></option>
        <?php }?>
      </select>
      <span class="error">* <?php display_error($errors['productID'] ); ?></span> <br><br>
      

      Quantity: <input type="number" name="quantity">
      <span class="error">*<?php display_error($errors['quantity']);?></span> <br><br>


      Comments: <textarea name="comments"></textarea>
      <span class="error">*<?php display_error($errors['comments']);?></span> <br><br>

      <input type="submit" name="submit" value="Submit">
      
      <br>
  
      <a href="./PhpCheatSheet.txt">Click here to download my cheatsheet</a>
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

function purchases(){
  global $customer_purchase_data;
  if(logged_in() == false){
    header("location:" . url);
  }
  ?>
    <h2><u> Purchases</u></h2>
    <br>

    <input type="date" name="date" id="search_date">
    <input type="submit" name="submit" onclick="search_purchase();">

    <br>
    <script type="text/javascript">search_purchase();</script>
    <div id="purchase_table"></div>

<?php 
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


// function to manageError 
function manageError($errorCode, $errorMessage, $errorFile, $errorLine)
{
    // for debugging
    echo "An error occured <br>";
    echo "Error code: " . $errorCode;
    echo "<br>" . "Error message: " . $errorMessage;
    echo "<br>" . "File name: " . $errorFile;
    echo "<br>" . "Line: " . $errorLine;
    
    $currentDate = new DateTime("now");
    
    file_put_contents(_LOG_FILE, "An error occured at " . $currentDate->format("Y M d") . "\r\n", FILE_APPEND);
    file_put_contents(_LOG_FILE, "Error code: " . $errorCode . "\r\n", FILE_APPEND);
    file_put_contents(_LOG_FILE, "Error message: " . $errorMessage . "\r\n", FILE_APPEND);
    file_put_contents(_LOG_FILE, "File name: " . $errorFile . "\r\n", FILE_APPEND);
    file_put_contents(_LOG_FILE, "Line: " . $errorLine . "\r\n\r\n", FILE_APPEND);
    
    
    $arrayErrors = array($errorCode, $errorMessage, $errorFile, $errorLine);
    
    file_put_contents(_LOG_FILE, json_encode($arrayErrors), FILE_APPEND);
   
    
    die("An error occured.");
}

//manage the exception
function manageException($exception){
    echo "exception <br>";
    echo "Error code: " . $exception->getCode();
    echo "<br>" . "Error message: " . $exception->getMessage();
    echo "<br>" . "File name: " . $exception->getFile();
    echo "<br>" . "Line: " . $exception->getLine();
    
    $currentDate = new DateTime("now");
    date_default_timezone_set("America/New_York");
    $browser = get_browser(null, true);
    
//Get the browser version

    file_put_contents(_LOG_FILE, "An exception occured at " . $currentDate->format("Y M d") . date("h:i:sa"). "\r\n", FILE_APPEND);
    file_put_contents(_LOG_FILE, "Exception code: " . $exception->getCode() . "\r\n", FILE_APPEND);
    file_put_contents(_LOG_FILE, "Exception message: " . $exception->getMessage() . "\r\n", FILE_APPEND);
    file_put_contents(_LOG_FILE, "File name: " . $exception->getFile() . "\r\n", FILE_APPEND);
    file_put_contents(_LOG_FILE, "Line: " . $exception->getLine() . "\r\n\r\n", FILE_APPEND);
    //file_put_contents(_LOG_FILE, "Browser version: " . $exception->get_browser() . "\r\n\r\n", FILE_APPEND);
    
    die("PHP engine stopped.");
}

 set_error_handler("manageError");

 set_exception_handler("manageException");


//Function to validate the form
function validateForm(){
  $errors = array('error_count'=>false, 'ProdId'=>'', 'FirstName'=>'', 'lastname'=>'', 'City'=>'', 'Price'=>'','Quantity'=>'', 'Comments'=>'', 'Success'=>'');
 
if(isset($_POST['submit']) == true){
    $productID = filter_var($_POST['ProdId'] ,FILTER_SANITIZE_STRING) ;
  $FirstName =  filter_var( $_POST['FirstName'],FILTER_SANITIZE_STRING) ;
  $lastname =  filter_var( $_POST['lastname'],FILTER_SANITIZE_STRING) ;
  $Price =  filter_var( $_POST['Price'],FILTER_SANITIZE_STRING) ;
  $City =  filter_var( $_POST['City'],FILTER_SANITIZE_STRING) ;
  $Quantity = filter_var( $_POST['Quantity'],FILTER_SANITIZE_STRING) ;
  $Comments =  filter_var( $_POST['Comments'],FILTER_SANITIZE_STRING) ;
  $Success = filter_var ( $_POST['Success'],FILTER_SANITIZE_STRING) ;
        
        
     
  $regx_productID = "/^(?=[p])([a-zA-Z0-9])+$/";

  if(strlen($productID) > max_productID_length || strlen($productID) < min_productID_length)
        {
    $errors['ProdId'] = 'Product code should be between ' . min_productID_length . ' and ' . max_productID_length . ' characters long and must start with a q.';
    $errors['error_count'] = true;
  }
        else if(preg_match($regx_productID, $productID) == false)
        {
    $errors['ProdId'] = 'Product code should have start with small capital p.';
    $errors['error_count'] = true;
  }

  if(strlen($FirstName) > max_name_length || strlen($FirstName) < min_name_length)
        {
    $errors['firstname'] = 'First Name can not be empty or be longer than ' . max_name_length . ' characters.';
    $errors['error_count'] = true;
  }
        
  if(strlen($lastname) > max_name_length || strlen($lastname) < min_name_length){
    $errors['lastname'] = 'Last Name can not be empty or be longer than ' . max_name_length . ' characters.';
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
    $errors['price'] = 'Price cannot be higher than ' . max_product_price;
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

    $data = array('productID'=> $productID, 'firstname'=> $FirstName,'lastname'=> $lastname, 'city'=> $City, 'price'=> $Price, 'quantity'=> $Quantity, 'comments'=> $comments, 'subtotal'=> $subtotal, 'taxes'=>$taxes, 'grand_total'=>$grand_total);

    $errors['success'] = save_to_file($data);
  }
 }
}

?>