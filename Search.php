<?php

include("functions/functions.php");
  if(isset($_POST["delete"]) == true){

    $in_order_code = htmlspecialchars($_POST["delete"]);

    $purchase = new Purchase();
    $purchase->load($in_order_code);
    $purchase->delete();
  }

 
 // to do a seach by date
  if(isset($_POST["date"]) == true){
    $all = new Purchases();
    $purchases = $all->search($_SESSION["customersID"], $_POST["date"]);
?>
<table class="purch">
      <tr>
        <th>Product Code</th>
        <th>First name</th>
        <th>Last name</th>
        <th>City</th>
        <th>Comments</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Subtotal</th>
        <th>Taxes</th>
        <th>Grand Total</th>
        <th>Action</th>
      </tr>
     

    <?php foreach ($purchases as $purchase_code => $purchase){?>    <!-- loops through customers -->
      <tr>
          <td>
            <?php echo $purchase["prod_code"];?>
          </td>
          <td>
            <?php echo $purchase["firstname"];?>
          </td>
          <td>
            <?php echo $purchase["lastname"];?>
          </td>
          <td>
            <?php echo $purchase["city"];?>
          </td>
          <td>
            <?php echo $purchase["comments"];?>
          </td>
          <td>
            <?php echo $purchase["price"];?>
          </td>
          <td>
            <?php echo $purchase["quantity"];?>
          </td>

          <td>
            <?php echo $purchase["subtotal_price"];?>
          </td>
          <td>
            <?php echo $purchase["taxes"];?>
          </td>
          <td>
            <?php echo $purchase["total_price"];?>
          </td>
        <td>
          <input type="submit" name="delete" value="Delete" onclick="delete_purchase('<?php echo $purchase['purchase_code'] ?>')"> </td>
        </td>
      </tr>
    <?php } ?>
    </table>
<?php }?>

?>