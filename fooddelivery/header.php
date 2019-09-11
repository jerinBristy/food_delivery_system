<?php 
    session_start(); 
    if(isset($_GET['logout'])){
        session_destroy();
        header ('Location: index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Acme' rel='stylesheet'>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

    <title>foodie</title>
</head>
<body>
    <div class="container">
        <div class="navbar">
        
            <ul>
                <h2 class="logo"><a href="index.php">foodie <i class="fas fa-truck-moving"></i></a></h2>
                
                <li><a href="#offers">Offers</a></li>

                <?php if(!isset($_SESSION["name"])): ?>
                    <div>
                        <li><a class="login" onclick="login_popup()">Login</a></li>
                    </div>
                <?php endif; ?>
                
                <?php if(isset($_SESSION["name"])): ?>
                    <div class="hellouser" ><p>Hello <?php echo $_SESSION["name"];?> </p></div>
                    <div>
                        <a href="<?php $_SERVER['PHP_SELF'];?>?logout=true">Logout</a>
                    </div>
                <?php endif; ?>

                <?php if(isset($_SESSION["name"])): ?>
                    <?php if(isset($_SESSION["orders"])): ?>
                    <div>
                        <li><a class="login" href="order.php">Orders</a></li>
                    </div>
                <?php endif; ?>
                <?php endif; ?>
                
            </ul>
            
        </div>