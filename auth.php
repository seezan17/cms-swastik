<?php 

ob_start();
session_start();
require '../classes/control_class.php';
$obj_admin = new control_Class();

if(isset($_GET['logout'])){
	$obj_admin->admin_logout();
}