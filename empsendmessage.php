<?php ob_start(); ?>
<?php

session_start();

if (!isset($_SESSION['username'])) 
	{
		header('Location:index.php?profile=EMP');
	}
include("./Class_Database.php");
$db= new database();
//$db->setup("kaushal", "kaushal", "localhost", "jobportaldb");	
//$userid=$_GET['id'];
if(isset($_SESSION['to_user']))
$to_user=$_SESSION['to_user'];
else
$to_user="";
if(isset($_SESSION['from_user']))
$from_user=$_SESSION['from_user'];
else
$from_user="";

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Employer Dashboard</title>
<link rel="stylesheet" type="text/css" media="screen" href="css/maincss.css">
<script type="text/javascript">

function ValidateForm(form)
{
	for(var i = 0; i < form.elements.length; i++)
	{
		if(form.elements[i].value.length == 0)
		{
			document.getElementById("errormessage").innerHTML="<b style='color:red'>Please "+form.elements[i].placeholder+"</b>";
			form.elements[i].focus();
			return false;
		}
		if(form.elements[i].value.length > 500)
		{
			document.getElementById("errormessage").innerHTML="<b style='color:red'>Message limit is 500 character.</b>";
			form.elements[i].focus();
			return false;
		}
		
	} 
	return true;
	
}
</script>
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
      <div style="float:left; width:70%; background-color:#FFF">
      	<div style="padding:10px">
	         <h2>Send Message</h2>
             
              <?php   
			
			$query2="Select * from admin_message where to_user='$from_user' and from_user='$to_user'and blockmessage= 1";
			//echo $query2;
				$res2=$db->send_sql($query2);	
			
			if (mysql_num_rows($res2)>0)
			{
				 echo "You are blocked by $from_user";
			}
			else
			{
		?>
             
             <form action="empsavesendmessage.php" name="frmmessage" method="post"  onSubmit="return ValidateForm(this)">
           	 <table border="0" cellpadding="2" cellspacing="0" style="font-family:Verdana, Geneva, sans-serif; font-size:12px">
				 <tr>
					<td id="errormessage" colspan="2" align="left">
					<?php
						if(isset($_GET['e']) && $_GET['e']==1)
							echo "<b style='color:red'>Please Enter Subject Name!</b>";	
						else if(isset($_GET['e']) && $_GET['e']=="2")
					{
						echo "<b style='color:red'>Please Enter Message Body!</b>";	
					}
					else if(isset($_GET['e']) && $_GET['e']=="3")
					{
						echo "<b style='color:red'>Message limit is 500 character!</b>";	
					}
					?>
					</td>
				 </tr>
             	<tr>
					<td align="right"><label style="font-weight:bold"> <strong>From</strong>:</label><label style="color:red; font-weight:bold"></label></td>
					<td><input type="text" name="from" size="40" value="<?php if(isset($to_user)&& $to_user!="")echo $to_user; ?>"  readonly="readonly"  placeholder="" />
					</td>
				 </tr>
					
				 <tr>
					<td align="right"><label style="font-weight:bold" > <strong>To</strong>:</label><label style="color:red; font-weight:bold"></label></td>
					<td><input type="text" name="to"   readonly="readonly" size="40"  value="<?php if(isset($from_user)&& $from_user!="")echo $from_user; ?>" placeholder="" />
					</td>
				 </tr>
              	                   
                 <tr>
					<td align="right"><label style="color:red; font-weight:bold">*</label><label style="font-weight:bold"> <strong>Subject</strong>:</label><label style="color:red; font-weight:bold"></label></td>
					<td><input type="text" name="subject" size="40"value="<?php if(isset($subject)&& $subject!="")echo $subject; ?>" placeholder="Enter Subject Name" />
					</td>
				 </tr>
              	 <tr>
              	 <tr>
                               
					<td align="right"><label style="color:red; font-weight:bold">*</label><label style="font-weight:bold"> <strong>Body</strong>:</label><label style="color:red; font-weight:bold"></label></td>
                    <td> <textarea name="body" id="body" rows="6" cols="50"  placeholder="Enter Message Body"><?php if(isset($body)&& $body!="")echo $body; ?></textarea></td>	
                   
                    			
					
				 </tr>
				
									         
				 
             
            </table>
            
				
					
					 <div align="right"><input class="button" type="submit" name="send" id="send" value="Send" /> 
                       <?php
					 
			}
			
            ?>	
                     <a class="button" name="cancel" value="Cancel" onClick='javascript:history.back();' />Back</a>
             
             </div>
					 
								 
            </form>
      	</div>
    </div>
        <!--SECOND COLUMN-->
        
    </div> <!--Width-->   
    </div><!-- Content-->
        
</div><!-- Centered-->
</body>
</html>