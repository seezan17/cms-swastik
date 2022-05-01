<?php
require 'auth.php';

 $notices = $obj_admin->display_notices();

if(isset($_POST['post-notice'])){
    $post = $obj_admin->post_notice($_POST);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    <link rel="stylesheet" href="../style/style-d.css">
    <script src="https://kit.fontawesome.com/ccd7dcf437.js" crossorigin="anonymous"></script>

</head>

<body>
    <div class="container">
        <div class="fixed-nav">
            <div class="left-div">
                <div class="fixed-logo">
                    <div class="logo-section"><img src="../img/swastik-logo-red.png"></div>
                </div>
                <div class="fixed-menu">
                    <div class="menu-section">
                        <li><a href="home.php"><i class="fa-solid fa-house"></i><span
                                    class="title">Home</span></a></li>
                        <li><a href="assignment.php"><i class="fa-solid fa-clipboard-list"></i><span
                                    class="title">Assignment</span></a></li>
                        <li><a href="notes.php"><i class="fa-solid fa-book-open"></i><span class="title">Notes</span></a></li>
                        <li><a href="notices.php"><i class="fa-solid fa-bullhorn"></i><span class="title">Notices</span></a></li>
                        <li><a href="#" class="active"><i class="fa-solid fa-comment"></i><span class="title">Feedback</span></a></li>
                        <li><a href="logout.php" onClick="return confirm('Are you sure you want to log out?')""><i class="fa-solid fa-arrow-right-from-bracket"></i><span class="title">Log Out</span>
              
                        </a></li>
                    </div>
                </div>
            </div>
        </div>

        <div class="body-section">
            <div class="title">
                <h3>FEEDBACK</h3>
               
            </div>

            <div class="contents">


                
                <div class="feedback-section">
                    <div class="feedback-head">
                        <p>Lets Make the college better, together.</p>
                        
                    </div>
                    <div class="feedback-content">
                        <form method="post">
                        <label for="name">About You</label>
                        <textarea class="about-you" name="about-you" placeholder="You can leave this field blank" ></textarea>

                        <label for="feedback">Feedback</label>
                        <textarea name="feedback"></textarea>

                        <input type="submit" name="submit" value="Submit">
                    </form>

                    </div>

                </div>
            </div>

        </div>

        <div class="right-div">
            <div class="title"><h3>Recommended External resources:</h3></div>
            <div class="resource-content">
                <ul>
                    <li><a href="https://drive.google.com/drive/folders/1q2sOBNU4lPBkwtF1Msl6uCACBV5TUGWD?fbclid=IwAR0P2UGTopfuXW5TFaJ8-QSPLegL4JDsiokl1HNDTrf0DU8Qom4mLUJ8hE4">🔰Cybersecurity Collection</a></li>
                    <li><a href="#">🔰Advanced React and Redux</a></li>
                    <li><a href="#">🔰Web Developer Nanodegree</a></li>
                    <li><a href="#">🔰HTML5 and CSS3</a></li>
                    <li><a href="#">🔰Photoshop CC</a></li>
                    <li><a href="#">🔰Python & Ethical Hacking</a></li>
                </ul>
            </div>
        </div>



    </div>

</body>

</html>