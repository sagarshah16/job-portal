<?php ob_start(); ?>
<?php

session_start();

if (!isset($_SESSION['username'])) 
{
	header('Location:index.php');
	
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Message Delete</title>
<link rel="stylesheet" type="text/css" media="screen" href="css/maincss.css">
<script type="text/javascript">

</script>

</head>

<body>

<div id="centered"><!-- Centered-->
<div align="right" style="color:#045"><a href="admindashboard.php" style="color:#045">Welcome <b style='color:#933'><?php  if (isset($_SESSION['username'])) echo $_SESSION['username']; ?></b></a>  , <a href="logout.php" style="color:#045">Logout</a></div>
	
	<?php include("header.html"); ?>
    
	<div class="content"><!-- Content-->
  	<div style="width:100%"><!--Width-->
        	
      <!--FIRST COLUMN-->
      <div style="float:left; width:30%; background-color:#FFF;">
      	<div style="padding:10px; min-height:680px; background-color:#CCC">
        	<table border="0" cellpadding="0" cellspacing="0">
            <tr>
            	<td><label style="font-size:14px; font-weight:bold; cursor:pointer" onClick="">Users Detail</label></td>
            </tr>
            <tr>
               	<td>
                <ul>
                   		 <li><a href="adminuserdetail.php" style="font-size:12px; font-weight:bold; cursor:pointer">Job Seeker Detail</a></li>
                    		<li><a href="adminemployerdetail.php" style="font-size:12px; font-weight:bold; cursor:pointer" onClick="">Employer Detail</a></li>
		     		<li><a href="admincountuser.php" style="font-size:12px; font-weight:bold; cursor:pointer;">Web Visitor Counter</a></li>
                </ul>
               </td>
            </tr>
            </tr>
                  <tr>
            	<td><label style="font-size:14px; font-weight:bold; cursor:pointer" onClick=""><br/>Page Content Change</label></td>
            </tr>
            <tr>
                <td>
					<ul>
						<li><a href="adminhomeedit.php" style="font-size:12px; font-weight:bold; cursor:pointer;">Home Page</a></li>
						<li><a href="admincontactusedit.php" style="font-size:12px; font-weight:bold; cursor:pointer" onClick="">Contact Us</a></li>
						<li><a href="adminaboutusedit.php" style="font-size:12px; font-weight:bold; cursor:pointer" onClick="">About Us</a></li>
					</ul>
                </td>
            </tr> 
            <tr>
              <td>
            	 <li><a href="adminsentmessage.php" style="font-size:12px; font-weight:bold; cursor:pointer">Sent Message</a></li>
                 </td>
            </tr>
            <tr>
            <tr>
             <td>
            	 <li><a href="admintrash.php" style="font-size:12px; font-weight:bold; cursor:pointer">Trash</a></li>
                 </td>
            </tr>
             <td>
            	 <li><a href="admininbox.php" style="font-size:12px; font-weight:bold; cursor:pointer">Inbox</a></li>
                 </td>
            </tr>
            </table>
      	</div>
      </div>
      <!--FIRST COLUMN-->
      
     <?php 
	 $messageid= $_GET['id'];
	
include ("./Class_Database.php");
$db= new database();
//$db->setup("kaushal", "kaushal", "localhost", "jobportaldb");	
if(isset($_POST['sent']))
{
	$query= "UPDATE admin_message SET is_deletesent = 1 WHERE id_message = $messageid;";

if ($res=$db->send_sql($query))
		{
			echo "<br>";
			echo "<h2>Message Deleted Successfully!</h2>";
			echo "<a href='adminsentmessage.php' class='button'>Back</a>  ";
		}
}
	
elseif(isset($_POST['inbox']))
{
$query= "UPDATE admin_message SET is_delete = 1 WHERE id_message = $messageid;";
unset($res);
if ($res=$db->send_sql($query))
		{
			echo "<br>";
			echo "<h2>Message Deleted Successfully!</h2>";
			echo "<a href='adminsentmessage.php' class='button'>Back</a>  ";
		}
}
	
	else
		{
			echo "Try Again!";
		}
		?>