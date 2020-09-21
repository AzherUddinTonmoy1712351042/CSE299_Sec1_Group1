<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
   $filepath = realpath(dirname(__FILE__));
   include_once ($filepath.'/../classes/Customer.php');  
?>

<?php // We have to edit those besis of their catId so we have to hold that.
    if(!isset($_GET['custId']) ||$_GET ['custId']==NULL ){ //if dont get any id then it will send to catlist.php 
        echo "<script>window.location='inbox.php';</script>";
    }else{
        $id=$_GET ['custId'];
    }
          

          if ($_SERVER['REQUEST_METHOD']== 'POST'){
          echo "<script>window.location='inbox.php';</script>";
  }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Customer Details</h2>
               <div class="block copyblock"> 
               
                <?php
                   $cus= new Customer();
                   $getCust=$cus->getCustomerData($id);
                   if($getCust){
                    While($result=$getCust->fetch_assoc()){

                
                ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                           <td>Name</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['name'];//it will show the catname in box?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                           <td>Address</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['address'];//it will show the catname in box?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                           <td>City</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['city'];//it will show the catname in box?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                           <td>Zipcode</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['zip'];//it will show the catname in box?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                           <td>Phone</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['phone'];//it will show the catname in box?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                           <td>Email</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['email'];//it will show the catname in box?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Ok" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php } } ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>