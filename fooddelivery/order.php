<?php     session_start(); 
    require_once('config/config.php');
    require_once('config/db.php');
    // echo $_SESSION['uniq'];
    // echo $_SESSION['name'];
    
    $uniq=$_SESSION['uniq'];
    $sql="SELECT restaurant_id FROM user WHERE id=".$_SESSION["id"];
    $result= mysqli_query($conn,$sql);
    $key_id= mysqli_fetch_assoc($result);
    // echo $_SESSION['id'];
    // var_dump($key_id);
    // die();

    $sql='SELECT * FROM cart WHERE order_status ='."complete".' AND restaurant_id='.$key_id["restaurant_id"];
    $result= mysqli_query($conn,$sql);
    $keys= mysqli_fetch_all($result,MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Orders</title>
</head>
<body>
<div class="order">
    <H2>Orders</H2>
    <div class="table">
        <table>
            <thead>
            <tr>
                <td>Customer Name</td>
                <td>Customer Address</td>
                <td>Item Ordered</td>
                <td>Total Price</td>
            </tr>
            </thead>
            <tr>
                
                <?php foreach ($keys as $key) : ?>

                    <?php $query='SELECT * FROM user WHERE id='.$key["user_id"];
                            $result2= mysqli_query($conn,$query);
                            $users= mysqli_fetch_all($result2,MYSQLI_ASSOC);
                            foreach ($users as $user) :?>

                               <td><?php echo $user["name"];?></td>
                               <td><?php echo $user["address"];?></td> 
 
                               <?php endforeach; ?>

                    
                <?php endforeach; ?>

                <?php foreach ($keys as $key) : ?>
<td>
                <?php $query='SELECT * FROM fooditems WHERE id='.$key["food_id"];
                            $result2= mysqli_query($conn,$query);
                            $users= mysqli_fetch_all($result2,MYSQLI_ASSOC);
                            foreach ($users as $user) :?>

                               <?php echo $user["name"];?>
 
                               <?php endforeach; ?>

                    
                <?php endforeach; ?>
                </td>
                <td><?php echo $_SESSION["item_name"];?></td>
                <td><?php echo $_SESSION["price"];?></td>
            </tr>
        </table>
    </div>
</div>
<script src="main.js"></script>
</body>
</html>