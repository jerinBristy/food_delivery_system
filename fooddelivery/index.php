<?php
require_once('config/config.php');
require_once('config/db.php');

// --------showing restaurants------------

$query='SELECT * FROM restaurant ORDER BY id DESC';
$result= mysqli_query($conn,$query);
$keys= mysqli_fetch_all($result,MYSQLI_ASSOC);



require_once('header.php');
// -------for restaurant admin---------
if(isset($_SESSION['id'])){
    $id=$_SESSION["id"];
    $queryuser= "SELECT * FROM user 
    WHERE id = '$id' ";
    $resultuser= mysqli_query($conn,$queryuser);
    $keysuser= mysqli_fetch_all($resultuser,MYSQLI_ASSOC);
    foreach ($keysuser as $key) :
        if(isset($key["restaurant_id"])){
            $_SESSION["orders"]="Orders";  //order3  
            $restaurant_id=$key["restaurant_id"];
            $query="SELECT * FROM restaurant 
            WHERE id = '$restaurant_id'"; 
            $result= mysqli_query($conn,$query);
            $keys= mysqli_fetch_all($result,MYSQLI_ASSOC); 
        }
        else{
            $_SESSION["orders"]=""; 
    
        }
       
     endforeach; 
     
}



?>

    <div class="showcase">
        <form class="search">
            <input type="text" name="" placeholder="Select your location">
            <input type="button" value="Search" >
        </form>
    </div>
    <div class="restaurants">
    
        <ul>
            <?php foreach ($keys as $key) : ?>
                <li>
                    <a href="foodmenu.php?id=<?php echo $key['id'];?>"><img src=<?php echo $key['image']; ?>></a>
                    <div class="description">
                    <h4><?php echo $key['restaurant_name']; ?></h4>
                    <P><?php echo $key['address']; ?></P>
                    </div>

                </li>
            <?php endforeach; ?> 
        </ul>
    </div>
</div>
    
<?php

require_once('footer.php');?>