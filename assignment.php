<?php
require 'auth.php';


 if(isset($_POST['post_assi'])){
    $post = $obj_admin->post_assi($_POST, $_FILES['assi_file']);
}

$assignments = $obj_admin->display_assi();


if(isset($_POST['download'])){
    $download = $obj_admin->download_assi($_POST);
}
if(isset($_POST['open'])){
    $open = $obj_admin->open_assi($_POST);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignments</title>
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
                <li><a href="assignment.php" class="active"><i class="fa-solid fa-clipboard-list"></i><span
                            class="title">Assignment</span></a></li>
                <li><a href="notes.php"><i class="fa-solid fa-book-open"></i><span class="title">Notes</span></a></li>
                <li><a href="notices.php"><i class="fa-solid fa-bullhorn"></i><span class="title">Notices</span></a></li>
                <li><a href="feedback.php"><i class="fa-solid fa-comment"></i><span class="title">Feedback</span></a></li>
                <li><a href="logout.php" onClick="return confirm('Are you sure you want to log out?')""><i class="fa-solid fa-arrow-right-from-bracket"></i><span class="title">Log Out</span> </a></li>
      
                    </div>
                </div>
            </div>
        </div>

        <div class="body-section">
            <div class="title">
                <h3>ASSIGNMENTS</h3>              
            </div>

            <div class="contents">

            <?php
                if($_SESSION['user_permission']==1){ ?>


                <div class="post-assignment">
                    <form class="teachers-form" method="post" enctype="multipart/form-data">
                        <!-- <p class="title">Post Assignment</p> -->

                        <label>Assignment Title</label>
                        <input type="text" name="assi_title">

                        <label>Description</label>
                        <textarea class="teachers-textarea" name="assi_desc"></textarea>

                        <label>Due Date</label>
                        <input type="text" name="assi_due_date">

                        <label>File(If any)</label>
                        <input type="file" name="assi_file">

                        <input type="submit" name="post_assi" value="Post">
                    </form>
                    <div class="message"> <?php echo $post; ?> </div>
                </div>
                 <?php } ?>
                

                
                <div class="topic-container">Most Recent</div>
                <?php foreach($assignments as $assi){ ?>
                <div class="assignment-section">
                    <div class="flex-title assignment-title"><span><?php echo $assi['assi_title']; ?></span> 
                        <span class="date">
                        <?php
                            
                        $time = $obj_admin->time_ago($assi['assi_date']);
                        
                        echo $time;
                        
                        ?>  <span class="more"><i class="fa-solid fa-ellipsis-vertical"></i></span>    </span> </div>
                    <div class="assignment-desc"><?php echo $assi['assi_desc']; ?></div>
                    <div class="assignment-author">Posted By  <?php echo $assi['assi_author']; ?> </div>
                    
                    <?php if($assi['assi_file']!=NULL){ ?>
                    <form method="post">
                    <input type="hidden" name="id" value="<?php echo $assi['assi_id']; ?>">
                      <div class="flex-buttons">  
                     <input type="submit" name="open" value="Open">
                     
                     <input type="submit" name="download" value="Download">
                    </div>
                </form>
                <?php } ?>
                       
                        <div class="submission-date">Due Date: <b><?php echo $assi['assi_due_date']; ?></b></div>
                    

                </div>
                <?php } ?>

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