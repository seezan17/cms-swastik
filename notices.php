<?php
require 'auth.php';

if(isset($_POST['post'])){
    $post = $obj_admin->post_notice($_POST);
}


 $notices = $obj_admin->display_notices();



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notices</title>
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
                        <li><a href="home.php" ><i class="fa-solid fa-house"></i><span
                                    class="title">Home</span></a></li>
                        <li><a href="assignment.php"><i class="fa-solid fa-clipboard-list"></i><span
                                    class="title">Assignment</span></a></li>
                        <li><a href="notes.php"><i class="fa-solid fa-book-open"></i><span class="title">Notes</span></a></li>
                        <li><a href="#" class="active"><i class="fa-solid fa-bullhorn"></i><span class="title">Notices</span></a></li>
                        <li><a href="feedback.php"><i class="fa-solid fa-comment"></i><span class="title">Feedback</span></a></li>
                        <li><a href="logout.php" onClick="return confirm('Are you sure you want to log out?')""><i class="fa-solid fa-arrow-right-from-bracket"></i><span class="title">Log Out</span>
              
                        </a></li>
                    </div>
                </div>
            </div>
        </div>

        <div class="body-section">
            <div class="title">
                <h3>HOME</h3>
               
            </div>

            <div class="contents">
                <!-- <?php
                if($_SESSION['user_permission']==1){ ?>
            <div class="post-notice">
                        <form method="post">
                        <textarea name="notice_content" class="teachers-textarea" placeholder="Post Notice"></textarea>
                        <input type="submit" name="post-notice" value="Post">
                        </form>
                        <div class="message"> <?php echo $post; ?> </div>
                    </div>
                    <?php } ?> -->


                    <?php
                    if($_SESSION['user_permission']==1){ ?>
    
    
                    <div class="notice post-assignment">
                        <form class="teachers-form" method="post" enctype="multipart/form-data">

                            <textarea name="notice_content" placeholder="Post Notice"></textarea>
                               
                            <input type="submit" name="post" value="Post">
                        </form>
                        <div class="message"><?php echo $post; ?></div>
                        
                    </div>
                     <?php } ?>
              

                 <div class="topic-container">

                    Recent Notices
                </div>
                <?php foreach ($notices as $notice) { ?>
                <div class="notice-section">
                    <div class="user">
                        <img class="user-img" src="../user-img/user-default.png">
                    </div>
                    <div class="notice-head">
                        <span class="author"><b>
                                <?php echo $notice['notice_author']; ?>
                            </b></span>
                        <span class="date">
                            <?php
                            
                            $time = $obj_admin->time_ago($notice['notice_date']);
                            
                            echo $time;
                            
                            ?>
                            <span class="more"><i class="fa-solid fa-ellipsis-vertical"></i></span>     
                        </span>
                        
                     </div>
                    <div class="notice-content">
                        <p>
                            <?php echo $notice['notice_content']; ?>
                        </p>
                    </div>


                   <div class="reply" id="id1">
                        <a href="#" id="cut-reply" onclick="document.getElementById('id1').style.display='none'"> <i
                                class="
                        fa-solid fa-xmark"></i></a>
                        <form method="post" action="../b-e/commentss.php">
                            <textarea type="text" class="reply-textarea" name="reply_content" placeholder=""></textarea>
                            <input type="submit" class="reply-submit" name="reply_submit" value="Post">
                        </form>
                    </div> 

                    <div class="interact">
                        <a class="like-icon" href="#like">
                            <?php echo $notice['likes']; ?><i class="fa-regular fa-thumbs-up"></i>
                        </a>
                        <a class="like-icon" href="#like">
                            <?php echo $notice['dislikes']; ?><i class="fa-regular fa-thumbs-down"></i>
                        </a>
                        <a class="reply-icon" href="#" id="reply-icon"
                            onclick="document.getElementById('id1').style.display='block'">
                            <?php echo $notice['comments']; ?><i class="fa-solid fa-reply"></i>
                        </a>
                    </div>

                </div>
                <?php  } ?>
               
              



                

                
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