<?php     session_start(); 

for($i=0;$i<5;$i++){
    
echo uniqid();
echo "<br>";

}
$sql="SELECT restaurant_id FROM user WHERE id=".$_SESSION["id"];
    $result= mysqli_query($conn,$sql);
    $key_id= mysqli_fetch_array($result);
    echo

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
    <H2>You have successfully Ordered</H2>
    <div class="table">
        <table>
            <thead>
            <tr>
                <td>Name</td>
                <td>Address</td>
                <td>Item Ordered</td>
                <td>Total Price</td>
            </tr>
            </thead>
            <tr>
                <td><?php echo $_SESSION["name"];?></td>
                <td><?php echo $_SESSION["address"];?></td>
                <td><?php echo $_SESSION["item_name"];?></td>
                <td><?php echo $_SESSION["price"];?></td>
            </tr>
        </table>
    </div>
</div>
<script src="main.js"></script>
</body>
</html>