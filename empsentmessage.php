<?php ob_start(); ?>
<?php

session_start();

if (!isset($_SESSION['username'])) 
	{
		header('Location:index.php?profile=EMP');
	}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Employer Dashboard</title>
<link rel="stylesheet" type="text/css" media="screen" href="css/maincss.css">
</head>

<body>

<div id="centered"><!-- Centered-->
<div align="right" style="color:#045"><a href="" style="color:#045">Welcome <b style='color:#933'><?php  if (isset($_SESSION['username'])) echo $_SESSION['username']; ?></b></a>  , <a href="logout.php" style="color:#045">Logout</a></div>
	<?php include("header.html"); 
	include("empjobsearchbar.php");?>
    
	<div class="content"><!-- Content-->
  	<div style="width:100%"><!--Width-->
        	
       <!--FIRST COLUMN-->
      <div style="float:left; width:30%; background-color:#FFF;">
      	<div style="padding:10px; min-height:680px; background-color:#CCC">
        	<table border="0" cellpadding="0" cellspacing="0">
            <tr>
            	<td><label style="font-size:14px; font-weight:bold; cursor:pointer" onClick="">Employer Profile</label></td>
            </tr>
            <tr>
               	<td>
                <ul>
                    
		     <li><a href="emppersonalinfo.php" style="font-size:12px; font-weight:bold; cursor:pointer" onClick="">Company Information</a></li>
		    		 <li><a href="empjobdetail.php" style="font-size:12px; font-weight:bold; cursor:pointer" onClick="">Post New Job</a></li>
	
		
                </ul>
               </td>
	</tr>
				 <tr>
            	<td><label style="font-size:14px; font-weight:bold; cursor:pointer; color:#000;float:left">Find Jobs</label></td>
            </tr>
            <tr>
            	<td>
                <ul style="text-align:left">
                <li style="margin:0px;"><a href="empadvancedsearch.php" style="font-size:12px; font-weight:bold; cursor:pointer;" onClick="">Advanced Search</a></li>
                </ul>
              	</td>
            </tr>
            <tr>
           		<td><label style="font-size:13px; font-weight:bold; cursor:pointer; color:#000;"><a href="empviewprofile.php">View Company Information</a></label></td>
      			 </tr>
				<tr>
            	<td><label style="font-size:13px; font-weight:bold; cursor:pointer"><a href="empviewjobdetail.php"></br>View Posted Job</a></label></td>
                </tr>
          		 
            <tr>
           		
      			 </tr>
                 <tr>
           		<td><label style="font-size:13px; font-weight:bold; cursor:pointer; color:#000;"><a href="empjobapplications.php"></br>View Job Applications</a></label></td>
      			 </tr>
            
           <tr>
            	<td><label style="font-size:14px; font-weight:bold; cursor:pointer; float:left">
                <a href="empinbox.php"><br/>Inbox</a></label></td>
            </tr>
             <tr>
            	<td><label style="font-size:14px; font-weight:bold; cursor:pointer; float:left">
                <a href="empsentmessage.php"><br/>Sent Message</a></label></td>
            </tr>
             <tr>
            	<td><label style="font-size:14px; font-weight:bold; cursor:pointer; float:left">
                <a href="emptrash.php"><br/>Trash</a></label></td>
            </tr>
            </table>
      	</div>
      </div>
      <!--FIRST COLUMN-->
      
      <!--SECOND COLUMN-->
      
       <!--Inbox-->
            <div style="float:left; width:70%; background-color:#FFF">
      	<div style="padding:10px">
	     
           <hr size="1" color="#069"  align="center">
	         <h2>Sent Message</h2>
             <hr size="1" color="#069"  align="center">
             <br/>
		   <?php
		   include("./Class_Database.php");
$db= new database();
//$db->setup("kaushal", "kaushal", "localhost", "jobportaldb");	
$user=$_SESSION['username'];
$query="select * from users where name_user='$user'";
//echo $query;
$res=$db->send_sql($query);	
if (mysql_num_rows($res)>0)
			{
				while ($row = mysql_fetch_array($res))
				{
				$from=stripslashes($row["email_user"]);
				//echo $from;
				}
			}
			
			if(isset($res))
			{
				unset($res);
			}
			
			//$username = $_SESSION['username'];

			
			$query="Select * from admin_message where from_user='$from' and is_deletesent=0";
			//echo $query;
			$res=$db->send_sql($query);	
			
			//If Experience Detail is available show them in one table.
			if (mysql_num_rows($res)>0)
			{
				echo "<table width='100%' cellpadding='2' cellspacing='0' border='0' style='font-family:Verdana, Geneva, sans-serif; font-size:12px'>";
					echo"<tr style='background-color:#045; color:#FFF' >";
					echo "<th width='3%'></th>";
					
					echo "<th width='3%'></th>";
					echo"<th width='25%'>From</th>";
					echo"<th width='25%'>To</th>";
					echo"<th width='27%'>Subject</th>";
					echo"<th width='15%'>Date</th>";
					echo"</tr>";
				
				while ($row = mysql_fetch_array($res))
				{
					$to_user=stripslashes($row["to_user"]);
					$from_user=stripslashes($row["from_user"]);
					$subject_user=stripslashes($row["subject_user"]);
					$senton=stripslashes($row["senton"]);
					$id_message=stripslashes($row["id_message"]);
					
					echo "\t\t\t<form action='empviewmessageinbox.php?id=$id_message' method='post'>\n";
					echo "<input type='hidden' name='sent' value='sent' />";
					echo "\t\t\t<tr style='background-color:#CCC'>\n";
					echo "\t\t\t\t<td width='3%' align='center'><input type='submit' name='viewmessage' style='border:none;  cursor:pointer;  background:none; background-image:url(Images/message.png); width:26px; height:26px' value='' /></td>\n";
					echo "\t\t\t</form>\n";
					echo "\t\t\t<form action='empmessagedeleteinbox.php?id=$id_message' method='post'>\n";
					echo "<input type='hidden' name='sent' value='sent' />";
					echo "\t\t\t\t<td width='3%' align='center'><input type='submit' name='edit' style='border:none;  cursor:pointer;  background:none; background-image:url(Images/delete.png); width:16px; height:16px' value='' /></td>\n";
					echo "\t\t\t</form>\n";
					echo "\t\t\t\t<td width='25%' align='center'>$from_user</td>\n";
					echo "\t\t\t\t<th width='25%'>$to_user</th>";
					echo "\t\t\t\t<td width='27%' align='center'>$subject_user</td>\n";
					echo "\t\t\t\t<td width='15%' align='center'>$senton</td>\n";
					echo "\t\t\t</tr>\n";
				}
				echo"</table>";
				
			}
			// If Experience Detail is not filled by the job seeker.
			else
			{
				echo "<div align='center'>";
				echo "<font color='#FF0000'>No Message</font> ";
				echo "</div>";
			}
		  
          ?>
                  
		<br />
        <hr size="1" color="#069"  align="center">
		  
    
          
      	</div>
      </div>
      
        <!--SECOND COLUMN-->
        
    </div> <!--Width-->   
    </div><!-- Content-->
        
</div><!-- Centered-->




</body>
</html>