<?php
require_once('config/config.php');
require_once('config/db.php');
require_once('header.php');
$login="";   //for please log in message
$item_price=0.00;
$item_name="";
$_SESSION['uniq']=" ";


if(!isset($_SESSION['id'])){
    $_SESSION["price"]=0;
}
else{
    $_SESSION["price"]=$_SESSION["price"];
}

$delivery_fee=0.00;
$charge=$item_price*(2/100);
$vat=$item_price*(5/100);
$total=$item_price+$charge+$vat+$delivery_fee;

//----------------for fooditems table---------------------
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    if(!isset($_GET['catagory'])){
        $query_fooditems = 'SELECT * FROM fooditems WHERE restaurant_id = '.$id;
        $result= mysqli_query($conn,$query_fooditems);
    }
    //-------------for restaurant table--------------------------------
    $query_restaurant= 'SELECT * FROM restaurant WHERE id =' .$id;
    $result_restaurant= mysqli_query($conn,$query_restaurant);
    $keys_restaurant= mysqli_fetch_all($result_restaurant,MYSQLI_ASSOC);

    //----------------for catagory table-------------------------------
    $query_catagory= 'SELECT * FROM catagory WHERE restaurant_id =' .$id;
    $result_catagory= mysqli_query($conn,$query_catagory);
    $keys_catagory= mysqli_fetch_all($result_catagory,MYSQLI_ASSOC);
}
if (isset($_GET['catagory'])) {
    $catagory=mysqli_real_escape_string($conn, $_GET['catagory']);
    $query= 'SELECT * from fooditems WHERE catagory_id= '.$catagory;
    $result=mysqli_query($conn,$query);
}
$keys_fooditems= mysqli_fetch_all($result,MYSQLI_ASSOC);
// ------add in cart ----------------
if(isset($_POST['add'])){
    if(isset($_SESSION['id'])){
        $login="";
        $delivery_fee=100;

        $userid= $_SESSION['id'];
        $qty=  mysqli_real_escape_string($conn,$_POST['qty']);
        $fooditem_id=  mysqli_real_escape_string($conn,$_POST['fooditem_id']);
        $restaurant_id=  mysqli_real_escape_string($conn,$_POST['restaurant_id']);
        $query = "INSERT INTO cart (quantity,user_id,restaurant_id,food_id) 
        VALUES ($qty, $userid,$restaurant_id,$fooditem_id);";
        if(mysqli_query($conn, $query)){
            //------------ show in cart
            $sql = 'SELECT * FROM fooditems WHERE id = '.$fooditem_id;
            $result_cart= mysqli_query($conn,$sql);
            $keys_cart= mysqli_fetch_all($result_cart,MYSQLI_ASSOC);
            foreach ($keys_cart as $key_cart) : 
               $item_price= $key_cart['price']*$qty;
               $item_name=$key_cart['name'];
            endforeach;
            $charge=$_SESSION["price"]*(2/100);
            $vat=$_SESSION["price"]*(5/100);
            $_SESSION["price"]=$_SESSION["price"]+$item_price;  //price


            // header('Location: foodmenu.php?id='.$restaurant_id);

        }
        else {
            echo 'ERROR: '. mysqli_error($conn);
        }  
    }
    else{
        $login="Please log in!";
    }
}
// -------for cart table---------
if(isset($_SESSION['id'])){
    $cart='SELECT * FROM cart WHERE order_status = "incomplete" AND user_id='.$_SESSION["id"];
    $result_cartstatus= mysqli_query($conn,$cart);
    $keys_cartstatus= mysqli_fetch_all($result_cartstatus,MYSQLI_ASSOC);

}
else {
    // $_SESSION["price"]=0;

}

// -------for checkout-------------
if(isset($_POST['checkout'])){
    $uniq=uniqid();
    $_SESSION['uniq']=$uniq;
    // $_SESSION["total"]=$_SESSION["price"];
    $_SESSION["price"]=0;
    $id= $_SESSION['id'];
    $sql4="UPDATE cart SET order_status='complete', unique_id='$uniq' WHERE order_status = 'incomplete' AND user_id = $id";
    if(mysqli_query($conn, $sql4)){
        header('Location: index.php');
    } else {
        echo 'ERROR: '. mysqli_error($conn);
    }
}






?>
<div class="menu_showcase">
    <?php foreach ($keys_restaurant as $key_restaurant) : ?>
        <img src=<?php echo $key_restaurant['image']; ?>>
        <div class="transparent">
            <h2><?php echo $key_restaurant['restaurant_name']; ?> - <?php echo $key_restaurant['description']; ?></h2>
        </div>
    <?php endforeach; ?>
</div>
<div class="menu_container">

    <div class="catagory">
            <h2>Catagory</h2>
            <ul>
                <?php foreach ($keys_catagory as $key_catagory) : ?>
                    <li><a href="foodmenu.php?catagory=<?php echo $key_catagory['id'];?>&id=<?php  echo $id; ?>"><?php echo $key_catagory['catagory'];?></a></li>
                <?php endforeach; ?>
            </ul>
    </div>
    <div class="menu">
        <?php foreach ($keys_fooditems as $key_fooditems) : ?>
        
            <div class="food_title">
                <h2><?php echo $key_fooditems['name']; ?></h2>
                <p><?php echo $key_fooditems['description']; ?></p>

            </div>
            <div class="food_details">
                <?php
                    $name = $key_fooditems['name'];
                    $price = $key_fooditems['price'];
                    
                ?>
                <div><h2><?php echo $name; ?></h2></div>
                <div><p><?php echo  $price; ?>.00 tk</p></div>
                <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
                    <div><input type="number" name="qty" value = 1></div>
                    <input type="hidden" name="fooditem_id" value="<?php echo  $key_fooditems['id'];?>">
                    <input type="hidden" name="restaurant_id" value="<?php echo $_GET['id'];?>">
                    <div><input type="submit" value="Add" name="add"></div>
                </form>
                <p><?php echo $login; ?></p>
            </div>
        
        <?php endforeach; ?>
    </div>
    <div class="cart">
        <h2><i class="fas fa-shopping-cart 2x"></i> Your order</h2>
        <div class="price">
            <?php
            if(isset($_SESSION['id'])):

                foreach ($keys_cartstatus as $key) : ?>
                    <?php $sql= 'SELECT * FROM fooditems WHERE id = '.$key["food_id"];
                    $result= mysqli_query($conn,$sql);
                    $items= mysqli_fetch_all($result,MYSQLI_ASSOC);  
                    ?>
                    <?php foreach ($items as $item) : ?>
                        <div class="foodprice"><p><?php echo $item["name"];?>: 
                        <?php echo $item["price"];?>* <?php echo $key["quantity"];?> = 
                        <?php echo $item["price"]*$key["quantity"];?></p></div>
                    <?php endforeach; ?> 
                <?php endforeach; endif; ?> 

                <div class="charge"><p>Restaurant srv.chg: <?php echo $charge;?></p></div>
                <div class="vat"><p>VAT: <?php echo $vat; ?></p></div>
                <div class="delivery"><p>Delivery Fee: <?php echo $delivery_fee; ?></p></div>
        </div>
        <?php if(isset($_SESSION['id'])):?>
            <div class="total"><p>Total <?php echo $_SESSION["price"]+$delivery_fee; ?></p></div>
        <?php endif; ?> 
        <form action=""<?php $_SERVER['PHP_SELF'];?> method="post">
            <input type="submit" value="Checkout" class="cart_btn" name="checkout" method="post">
        </form>

    </div>
</div>

<?php require_once('footer.php');?>