<?php
require 'auth.php';
// require 'session_login.php';
 $notices = $obj_admin->display_notices();
//  $sessoion = $obj_admin->session_student();
if(isset($_POST['upload-note'])){
    $post = $obj_admin->upload_note($_POST, $_FILES['note_file']);
    
}
if(isset($_POST['download'])){
    $download = $obj_admin->download_notes($_POST);
}
if(isset($_POST['open'])){
    $download = $obj_admin->open_notes($_POST);
}

$notes = $obj_admin->display_notes();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes</title>
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
                        <li><a href="#" class="active"><i class="fa-solid fa-book-open"></i><span class="title">Notes</span></a></li>
                        <li><a href="notices.php"><i class="fa-solid fa-bullhorn"></i><span class="title">Notices</span></a></li>
                        <li><a href="feedback.php"><i class="fa-solid fa-comment"></i><span class="title">Feedback</span></a></li>
                        <li><a href="logout.php" onClick="return confirm('Are you sure you want to log out?')""><i class="fa-solid fa-arrow-right-from-bracket"></i><span class="title">Log Out</span>
              
                        </a></li>
                    </div>
                </div>
            </div>
        </div>

        <div class="body-section">
            <div class="title">
                <h3>NOTES</h3>
               
            </div>

            <div class="contents">
                <?php
                if($_SESSION['user_permission']==1){ ?>


                <div class="post-assignment">
                    <form class="teachers-form" method="post" enctype="multipart/form-data">
                        <!-- <p class="title">Upload Note</p> -->

                        <label>Note Title</label>
                        <input type="text" name="note_title">


                        <label>File</label>
                        <input type="file" name="note_file">

                        <input type="submit" name="upload-note" value="Upload">
                    </form>
                    <div class="un-msg"><?php echo $post; ?> </div>
                    <div class="su_message"><?php echo $su_message; ?> </div>
                </div>
                 <?php } ?>



                <div class="topic-container">Recently Uploaded</div>
                <?php foreach($notes as $note){ ?>
                <div class="notes-section">
                    <div class="flex-title note-title"><span><?php echo $note['note_title']; ?></span> 
                        <span class="date">
                        <?php
                            
                        $time = $obj_admin->time_ago($note['note_date']);
                        
                        echo $time;
                        
                        ?>
                        <span class="more"><i class="fa-solid fa-ellipsis-vertical"></i></span>    </span> </div>
                    <div class="notice-author">Uploaded by <?php echo $note['note_author']; ?> 
                       .</div>
                    <div class="notes-buttons">
                    <form method="post">
                        <input type="hidden" name="id" value="<?php echo $note['note_id']; ?>">
                      <div class="flex-buttons">  
                     <input type="submit" name="open" value="Open">
                     
                     <input type="submit" name="download" value="Download">
                    </div>
                </form>

                </div>

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