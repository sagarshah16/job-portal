<?php ob_start(); ?>
<?php

session_start();

$userid= $_GET['id'];
include ("./Class_Database.php");
$db= new database();
//$db->setup("kaushal", "kaushal", "localhost", "jobportaldb");	

$query= "UPDATE users SET blockuser = '1' WHERE id_user = $userid;";
	if ($res=$db->send_sql($query))
		{
			header("Location:adminuserdetail.php");
		}
	else
		{
			echo "Try Again!";
		}
?>