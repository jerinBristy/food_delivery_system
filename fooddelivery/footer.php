<?php
require_once('config/config.php');
require_once('config/db.php');
// -----for login-------------
if(isset($_POST['loginsubmit'])){
    $password=  mysqli_real_escape_string($conn,$_POST['password']);
    $email=  mysqli_real_escape_string($conn,$_POST['email']);
    $query ="SELECT * FROM user 
            WHERE email = '$email' ";
    $result= mysqli_query($conn,$query);
    $keys= mysqli_fetch_assoc($result);
    //var_dump($keys);
    if($keys['email']==$email && $keys['password']==$password )
    {
        session_start();
        $_SESSION["name"] = $keys['name'];
        $_SESSION["id"] = $keys['id'];
        $_SESSION["address"]=$keys['address'];
        $_SESSION["type"]=$keys['usertype'];
        $_SESSION["number"]=$keys['number'];
        header('Location: index.php');

    }
}
 
// ---------insert into db for signup 
if(isset($_POST['submit'])){
    $username=  mysqli_real_escape_string($conn,$_POST['username']);
    $password=  mysqli_real_escape_string($conn,$_POST['password']);
    $email=  mysqli_real_escape_string($conn,$_POST['email']); 
    $number=  mysqli_real_escape_string($conn,$_POST['number']);
    $address=  mysqli_real_escape_string($conn,$_POST['address']);
    $type= mysqli_real_escape_string($conn,$_POST['type']);
    $query = "INSERT INTO user(name,password,email,number,address,usertype) 
    VALUES('$username', '$password','$email','$number','$address','$type')";
    // ------------------for staying loggedin-----------------------------
    $query2 ="SELECT * FROM user WHERE email = '$email' ";
    $result= mysqli_query($conn,$query2);
    $keys= mysqli_fetch_assoc($result);
    if(mysqli_query($conn, $query)){
        
        $_SESSION["name"] = $username;
        $_SESSION["id"] = $keys['id'];
        $_SESSION["address"]=$keys['address'];
        $_SESSION["type"]=$keys['usertype'];
        $_SESSION["number"]=$keys['number'];

        header('Location: index.php');
        echo $_SESSION["id"];
    }
    else {
     echo 'ERROR: '. mysqli_error($conn);
    }    
}
?>
<!-- -------login popup ------------->
    <div class="popup">
        <span class="close" onclick="closewindow(1)">&times;</span>
        <form action="<?php $_SERVER['PHP_SELF'];?>" class="loginform" method="POST">
            <h2>Login</h2>
            <input type="text" name="email" placeholder="Your email"><br>
            <input type="password" name="password" placeholder="password"><br>
            <input type="submit" value="Login Now" name="loginsubmit">
            <p>New here?Its ok. <a onclick="closewindow(1),signup_popup()" >Create an account</a></p>

        </form>
    </div>
    <!-- ----------signup popup------------ -->
    <div class="signup">
        <span class="close" onclick="closewindow(0)">&times;</span>
        <form action="<?php $_SERVER['PHP_SELF'];?>" class="signupform" method="POST">
            <h2>Signup</h2>
            <input type="text" name="username" placeholder="User Name"><br>
            <input type="password" name="password" placeholder="password"><br>
            <input type="text" name="email" placeholder="Email"><br>
            <input type="text" name="number" placeholder="Contact Number"><br>
            <input type="text" name="address" placeholder="address"><br>
            <input type="hidden" name="type" value="customer">
            <input type="submit" name="submit" value="Signup" >
        </form>
    </div>
    
    <script src="main.js"></script>
</body>
</html>