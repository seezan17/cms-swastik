<?php
require 'auth.php';

// auth check


if(isset($_POST['submit-register'])){
 $info = $obj_admin->add_new_user($_POST);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
                    <a href="login.php" id="login">Log In</a>
                    <a href="#" class="active" id="register">Register</a>
                </div>

            </div>
        </div>
        <div class="body">

            <div class="content">


                <div class="form form-register">
                    <h3 class="topic">Sign Up</h3>
                    <form method="post">

                        <!-- <div class="radio">
                            <div class="student">
                                <input type="radio" name="who" value="0">
                                <label for="who">Student</label>
                            </div>

                            <div class="teacher">
                                <input type="radio" name="who" value="1">
                                <label for="who">Teacher</label>
                            </div>
                        </div> -->
                        <label for="">Who?</label>
                        <select name="who">
                            <option value="1">Teacher</option>
                            <option value="0">Student</option>
                        </select>



                        <label for="fullname">Full Name</label>
                        <input type="text" name="fullname">


                        <label for="email">Email</label>
                        <input type="email" name="email">

                        <label for="password">Password</label>
                        <input type="password" name="password1">

                        <label for="password">Confirm Password</label>
                        <input type="password" name="password2">

                        <?php if(isset($info)){ ?>
                        <a class="msg un-msg"><?php echo $info; ?></a>
			  <?php } ?>

                        <input type="submit" name="submit-register" value="Sign Up">

                    </form>
                    

                    <div class="form-bottom">
                        <span class=" center"><a href="login.php" id="login-btm">Already Have an account?</a></span>
                        

                    </div>
                </div>




            </div>

        </div>


    </div>



</body>

</html>