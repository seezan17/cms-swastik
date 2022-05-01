<?php

class control_class
{	

/* -------------------------set_database_connection_using_PDO---------------------- */

	public function __construct()
	{ 
        $host_name='localhost';
		$user_name='root';
		$password='';
		$db_name='cms_swastik';

		try{
			$connection=new PDO("mysql:host={$host_name}; dbname={$db_name}", $user_name,  $password);
			$this->db = $connection ; // connection established
		} catch (PDOException $message ) {
			echo $message->getMessage();
		}
	}
	// -------------------------SESSION CHECK-----------------------------------------

	public function session_login(){
		session_start();

if (isset($_SESSION['student_is_logged_in']) or isset($_SESSION['teacher_is_logged_in']) ) {
}
else{
  $un_message = "<p>Please Log In first. </p>";
  header("Location: login.php");
  die;
}
	}

	// ------------------Session Student---------------------
	public function session_teacher(){
		if(isset($_SESSION['teacher_is_logged_in']) ){
		}
		else{
			$un_message = "<p>Please Log In first. </p>";
  header("Location: login.php");
  die;
		}
	}

	//-------------------Session Teacher---------------------
	public function session_student(){
		if(isset($_SESSION['student_is_logged_in'])){

		}
		else{
			$un_message = "<p>Please Log In first. </p>";
  header("Location: login.php");
  die;
		}
	}

    /* ---------------------- sanitize_input_data ----------------------------------- */
	
	public function sanitize_input_data($data) {

	
        // $data = trim($data);
        // $data = stripslashes($data);
        // $data = htmlspecialchars($data); 
		
		
	return $data;
	}

    /* ----------------------Register New user --------------------------------------- */

	public function add_new_user($data){
			
		
		$user_fullname  = $this->sanitize_input_data($data['fullname']);
		$user_email = $this->sanitize_input_data($data['email']);
		$user_permission = $this->sanitize_input_data($data['who']);
		$user_password1 = $this->sanitize_input_data(md5($data['password1']));
        $user_password2 = $this->sanitize_input_data(md5($data['password2']));
		
        
		try{
			$sqlEmail = "SELECT user_email FROM swastik_users WHERE user_email = '$user_email' ";

			$query_result_for_email = $this->db->prepare($sqlEmail);
			$query_result_for_email->execute();
			$total_email = $query_result_for_email->rowCount();
			

			if($total_email != 0){
				$un_message = "Email already taken";
            	return $un_message;

			}
			
			elseif($user_password1 != $user_password2 ){
			 $message = "Passwords don't match.";
                return $un_message;
            }
			else{
				$add_user = $this->db->prepare("INSERT INTO swastik_users (user_fullname, user_email, user_password, user_permission) VALUES (:x, :y, :z, :a) ");
				$add_user->bindparam(':x', $user_fullname);
				$add_user->bindparam(':y', $user_email);
				$add_user->bindparam(':z', $user_password1);
				$add_user->bindparam(':a', $user_permission);
				$add_user->execute();
			

				header('Location: login.php');

				
			}


		}catch (PDOException $e) {
			echo $e->getMessage();
			
		}
	}

// --------------------------Login Validation-------------------------

	public function validate_user($data) {
        
        $user_password = $this->sanitize_input_data(md5($data['password']));
		$user_email = $this->sanitize_input_data($data['email']);
		
        try
       {
          $stmt = $this->db->prepare("SELECT * FROM swastik_users WHERE user_email=:email AND user_password=:password LIMIT 1");
          $stmt->execute(array(':email'=>$user_email, ':password'=>$user_password));
          $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
          if($stmt->rowCount() > 0)
          {
          		session_start();
	            $_SESSION['user_id'] = $userRow['user_id'];
	            $_SESSION['user_fullname'] = $userRow['user_fullname'];
	            // $_SESSION['security_key'] = 'rewsgf@%^&*nmghjjkh';
	            $_SESSION['user_permission'] = $userRow['user_permission'];

				header('Location: ../f-e/home.php');
			
				
             
          }else{
			  $un_message = 'Invalid Email or Password';
              return $un_message;
			 
		  }
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }	
		
    }

	// ---------------------------Post Notices-----------------------------
	public function post_notice($data){
		$notice_content  = $this->sanitize_input_data($data['notice_content']);
		if($notice_content!=NULL){
		try{
			$upload_notice = $this->db->prepare('INSERT INTO swastik_notices(notice_content, notice_author)VALUES(:a,:b)');
			$upload_notice->bindparam(':a', $notice_content);
			$upload_notice->bindparam(':b', $_SESSION['user_fullname']);
			$upload_notice->execute();
			
			$message = "<p style='color:green;'>Posted.</p>";
			
			
		}
		catch(PDOException $exception){
			echo $exception->getMessage();
			

		}
	}
	else{
		$message = "<p style='color:red;'>Notice can not be empty.</p>";

	}
	return $message;
	}




	// -------------------------Display Notices-----------------------

	public function display_notices(){
		try {
			$sql = "SELECT * FROM swastik_notices ORDER BY notice_id DESC LIMIT 3 ";			
			$stmt = $this->db->prepare($sql);			
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$notices = $stmt->fetchAll();
			return $notices;
		  } catch (PDOException $exception) {
			echo $exception->getMessage();
		  }

		  
	}


	// ------------------------------Post Assignment--------------------------
	public function post_assi($data, $file){
		
		// $assi_for = $this->sanitize_input_data($data['assi_for']);
		$assi_title = $this->sanitize_input_data($data['assi_title']);
		$assi_desc = $this->sanitize_input_data($data['assi_desc']);
		$assi_due_date = $this->sanitize_input_data($data['assi_due_date']);
		$filename = NULL;
		if($assi_title!=NULL && $assi_desc!=NULL && $assi_due_date!=NULL ){
		if($file['name'] != NULL){

		$filename = $this->sanitize_input_data($file["name"]);
		$tempname = $file["tmp_name"];	

		

    	$folder = "../Files/Assignments/".$filename;
		$FileType = strtolower(pathinfo($folder,PATHINFO_EXTENSION));


		if (file_exists($folder)) {
			$message = "<p style='color:red;'>File Name already exists.</p>";
		  }

		  else if($FileType !=  "pdf" ) {
			$message = "<p style='color:red;'>Only PDF file is allowed.</p>";
			
		  }

		  else
    	if(!move_uploaded_file($tempname, $folder)){
			$message = "<p style='color:red;'>Problem while uploading.</p>";

		}
		else{

		try{
			$post_assi = $this->db->prepare('INSERT INTO swastik_assignments(assi_title, assi_desc, assi_due_date, assi_author, assi_file)VALUES(:a,:b,:c,:d,:e)');
			$post_assi->bindparam(':a', $assi_title);
			$post_assi->bindparam(':b', $assi_desc);
			$post_assi->bindparam(':c', $assi_due_date);
			$post_assi->bindparam(':d', $_SESSION['user_fullname']);
			$post_assi->bindparam(':e', $filename);
			$post_assi->execute();
			$message = "<p style='color:green;'>Assignment posted successfully.</p>";
		}
		catch(PDOException $exception){
			echo $exception->getMessage();
		}
	}
}

		else{
			try{
				$post_assi = $this->db->prepare('INSERT INTO swastik_assignments(assi_title, assi_desc, assi_due_date, assi_author)VALUES(:a,:b,:c,:d)');
				$post_assi->bindparam(':a', $assi_title);
				$post_assi->bindparam(':b', $assi_desc);
				$post_assi->bindparam(':c', $assi_due_date);
				$post_assi->bindparam(':d', $_SESSION['user_fullname']);
				
				$post_assi->execute();
				$message = "<p style='color:green;'>Posted.</p>";
			}
			catch(PDOException $exception){
				echo $exception->getMessage();
			}

		}
	}else{
		$message = "<p style='color:red;'>Please fill all required fields.</p>";

	}
		return $message;
	}	

	// --------------------------Display Assignments--------------------------

	public function display_assi(){
		
		try{
			$sql = "SELECT * FROM swastik_assignments ORDER BY assi_id DESC LIMIT 10";
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$assignments = $stmt->fetchAll();
			return $assignments;
		} catch (PDOException $exception) {
			echo $exception->getMessage();
		  }
	}


	// -----------------------------Upload Notes----------------------------------

	public function upload_note($data, $file){

		$note_title = $this->sanitize_input_data($data['note_title']);
		
		$filename = $this->sanitize_input_data($file["name"]);
		$tempname = $file["tmp_name"];	
		if($note_title !=NULL){

		
		if($file['name'] != NULL){

    	$folder = "../Files/Notes/".$filename;
		$FileType = strtolower(pathinfo($folder,PATHINFO_EXTENSION));

		if (file_exists($folder)) {
			$message = "<p style='color:red;'>File Name already exists.</p>";
		  }

		  else if($FileType !=  "pdf" ) {
			$message = "<p style='color:red;'>Only PDF file is allowed.</p>";
			
		  }

		  else{
    	move_uploaded_file($tempname, $folder);

		try{
			$upload_note = $this->db->prepare('INSERT INTO swastik_notes(note_title, note_file, note_author)VALUES(:a,:b,:c)');
			$upload_note->bindparam(':a', $note_title);
			$upload_note->bindparam(':b', $filename);
			$upload_note->bindparam(':c', $_SESSION['user_fullname']);
			$upload_note->execute();
			
			$message = "<p style='color:green;'>File Uploaded Successfully.</p>";
			
			
		}
		catch(PDOException $exception){
			echo $exception->getMessage();
			

		}
	}
} else{
	$message = "<p style='color:red;'>Please select a file.</p>";

}
		}else{
			$message ="<p style='color:red;'>Title can not be empty.</p>";

		}
	return $message;
	}


// --------------------------Display Notes--------------------------

	public function display_notes(){
		
		try{
			$sql = "SELECT * FROM swastik_notes ORDER BY note_id DESC LIMIT 10";
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$notes = $stmt->fetchAll();
			return $notes;
			
		} catch (PDOException $exception) {
			echo $exception->getMessage();
		  }
	}

	// ------------------------Download Notes----------------------

	public function download_notes($data){
		$id = $this->sanitize_input_data($data['id']);
		$sql = "SELECT note_file FROM swastik_notes where note_id=$id";
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$note = $stmt->fetch();

			$file = $note['note_file'];    
			$filepath = "../Files/Notes/" . $file;

			// Process download
				if(file_exists($filepath)) {
					header('Content-Description: File Transfer');
					header('Content-Type: application/octet-stream');
					header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
					header('Expires: 0');
					header('Cache-Control: must-revalidate');
					header('Pragma: public');
					header('Content-Length: ' . filesize($filepath));
					flush(); // Flush system output buffer
					readfile($filepath);
					exit;
				}   

	}




	public function open_notes($data){
		$id = $this->sanitize_input_data($data['id']);
		$sql = "SELECT note_file FROM swastik_notes where note_id=$id";
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$note = $stmt->fetch();

			$file = $note['note_file'];    
			$filepath = "../Files/Notes/" . $file;
			header('Content-type: application/pdf');			
			header('Content-Transfer-Encoding: binary');
			header('Accept-Ranges: bytes');

			// Read the file

			@readfile($filepath);

		}


// ------------------------Download Assignments-----------------------
public function download_assi($data){
	$id = $this->sanitize_input_data($data['id']);
	$sql = "SELECT assi_file FROM swastik_assignments where assi_id=$id";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$assi = $stmt->fetch();

		$file = $assi['assi_file'];    
		$filepath = "../Files/Assignments/" . $file;

		// Process download
			if(file_exists($filepath)) {
				header('Content-Description: File Transfer');
				header('Content-Type: application/octet-stream');
				header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
				header('Expires: 0');
				header('Cache-Control: must-revalidate');
				header('Pragma: public');
				header('Content-Length: ' . filesize($filepath));
				flush(); // Flush system output buffer
				readfile($filepath);
				exit;
			}   

}


public function open_assi($data){
	$id = $this->sanitize_input_data($data['id']);
	
	$sql = "SELECT assi_file FROM swastik_assignments where assi_id=$id";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$assi = $stmt->fetch();

		$file = $assi['assi_file'];    
		$filepath = "../Files/Assignments/" . $file;
		header('Content-type: application/pdf');			
		header('Content-Transfer-Encoding: binary');
		header('Accept-Ranges: bytes');

		// Read the file

		@readfile($filepath);

	}



// --------------Time Ago -----------------------------


public function time_ago($timestamp){

	date_default_timezone_set('Asia/Kathmandu');
    $time_ago = strtotime($timestamp);
    $current_time = time();
    $time_difference = $current_time - $time_ago;
    $seconds = $time_difference;
   
    
    $minutes = round($seconds/60);
    $hours = round($seconds/3600);
    $days = round($seconds/86400);  
    $weeks = round($seconds/604800);
    $months = round($seconds/2629400);

    if($seconds<=60){
        return "Just Now";
        
    }
    else if($minutes <= 60){
        return "$minutes Min ago";
    }
    else if($hours<=24){
        return $hours."H ago";

    }
    else if($days<=7){
        return $days."D ago";
    }
    else if($weeks<=5){
        return $weeks."W ago";
    }
    else if($months<=12){
        return $months."Mo ago";
    }
}
		






}


?>
