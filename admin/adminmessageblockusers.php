<?php ob_start(); ?>
<?php

session_start();

$messageid= $_GET['id'];
$to_user=$_SESSION['to_user'];
$from_user=$_SESSION['from_user'];
include ("./Class_Database.php");
$db= new database();
//$db->setup("kaushal", "kaushal", "localhost", "jobportaldb");	
$query= "select * from admin_message WHERE id_message =$messageid";
$res=$db->send_sql($query);	
if (mysql_num_rows($res)>0)
			{
				while ($row = mysql_fetch_array($res))
				{
					$to_user=stripslashes($row["to_user"]);
					$from_user=stripslashes($row["from_user"]);
				}
			}
			unset($res);
				
$query= "UPDATE admin_message SET blockmessage = '1' WHERE from_user ='$from_user' and to_user = '$to_user'";

	if ($res=$db->send_sql($query))
		{
			header("Location:admininbox.php");
		}
	else
		{
			echo "Try Again!";
		}
?>