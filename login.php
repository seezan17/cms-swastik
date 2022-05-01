<?php
require 'auth.php';

// auth check


if(isset($_POST['submit-login'])){

 $info = $obj_admin->validate_user($_POST);

}
echo $_COOKIE['su_message'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogIn</title>
    <link rel="stylesheet" href="../style/style-public.css">
    <link rel="stylesheet" href="../style/style-public-form.css">


</head>

<body>
    <div class="bg-img"></div>

    <div class="container">
        <div class="fixed">
            <div class="header">

                <div class="logo-section">
                    <img src="../img/swastik-logo-red.png">
                </div>

                <div class="menu-section">
                    <a href="../index.html" id="about-us">About Us</a>
                    <a href="contact.html" id="contact">Contact</a>
                    <a href="#" class="active" id="login">Log In</a>
                    <a href="register.php" id="register">Register</a>
                </div>
            </div>
        </div>
        <div class="body">

            <div class="content">


        <div class="form">
            <div class="topic">
                <h3>Log In</h3>
            </div>
            <form method="post">
                <label for="email" >Email</label>
                <input type="email" name="email" >
                <label for="password" >Password</label>
                <input type="password" name="password">
                <?php if(isset($info)){ ?>
                        <a class="un-msg"><?php echo $info; ?></a>
                       
			  <?php } ?>
                <input type="submit" name="submit-login" value="Log In">
                <?php echo $_SESSION['name']; ?>
               
               
    
    
                <div class="form-bottom">
                    <span class="form-bottom left"><a href="#">Forgot Password?</a></span>
                    <span class="form-bottom right"><a href="register.php" id="register" >New Here?</a></span>
                </div>
            </form>
        </div>





            </div>

        </div>


    </div>



</body>

</html>