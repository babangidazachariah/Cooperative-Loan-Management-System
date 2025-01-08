<?php
SESSION_START();
	require_once 'createStuffs.php';	
	if(isset($_POST['membershipLogin'])){
		$isError = "false";
		if(empty($_POST['staffNumber'])){
			$staffNumberError ="Cannot be NULL!!!";
			$isError = "true";
		}
		
		if(empty($_POST['password'])){
			$passwordError ="Cannot be NULL!!!";
			$isError = "true";
		}
		if($isError == "false"){
			require_once 'connection.php';
			$sql = "SELECT * FROM tblAccount WHERE staffNumber ='". $_POST['staffNumber'] ."' AND password='".$_POST['password']."'";
			//$even = "true";
			$result = mysql_query($sql,$db) or print("Could Not Be Executed 37 tblAccount SELECT  ". mysql_error($db));
			if(mysql_num_rows($result) > 0){ //already has an account
			
				$_SESSION['allowed'] = 1;
				$_SESSION['staffNumber'] = $_POST['staffNumber'];
				$sql = "SELECT * FROM tblMembers WHERE staffNumber ='". $_POST['staffNumber']."'";
				//$even = "true";
				$result = mysql_query($sql,$db) or print("Could Not Be Executed 37 tblAccount SELECT  ". mysql_error($db));
				
				
				if(mysql_num_rows($result) > 0){ //already registered
					//CHECK IF MEMBER HAS BEEN GUARANTEED OR NOT
					$sql = "SELECT * FROM tblTempMember WHERE firstGuarantor != '' AND secondGuarantor != '' AND staffNumber ='". $_POST['staffNumber']."'";
					$result = mysql_query($sql,$db) or print("Could Not Be Executed 37 tblTempMember SELECT  ". mysql_error($db));
					
					if(mysql_num_rows($result) > 0){ //already guaranteed!
						
						header('location:memberHome.php');
						
					}else{ 
						//Prompt user thst he has not been guaranteed yet.
						$entireError = "You Have not Been Fully Guaranteed!!!";
					}
				

				}else{
				
					header('location:membershipDetails.php');
				}
			}else{
				$entireError ="Wrong Username or Password!!!";
				//header('location:index.php');
			}
		}
	}
?>
<html>
<head>
<title>Home</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="media/css/demos.css" />
		<link rel="stylesheet" type="text/css" href="media/css/alert.css" />
		
		<script type="text/javascript" src="media/js/js-core.js"></script>
		<script type="text/javascript" src="media/js/alert.js"></script>
<script type="text/JavaScript">
	function DisplayAlert(str){
		alert(str);
		//window.onload = function() {
				/*
				 * You'll probably want to replace this with $('#demo').click( fn ); or whatever the
				 * JS library you are using uses. If none then this will do nicly!
				 */
				jsCore.addListener( {
					"mElement":  "addCourse",
					"sType":     "click",
					"fnCallback": function() {
						Alert.fnCustom( {
							'sTitle': 'Alert',
							'sMessage': "This alert box is some what different from the other examples",
							'sClass': 'different',
							'bAnimate': false,
							'sDisplay': 'abbc',
							'aoButtons': [
								{
									'sLabel': 'Funky',
									'sClass': 'selected',
									'cPosition': 'b'
								}
							]
						} );
					}
				} );
			//}
	}
	
	
	
</script>
<script type="text/javascript">
<!--
	function InitializeNotify(){
		
		setTimeout(function Reset(){
			document.getElementById("notify").innerHTML ="";
			document.getElementById("staff").innerHTML ="";
			document.getElementById("pass").innerHTML ="";
		}, 7000);
	}
	
	
	
	function SubmitForm(id){
	
		if(window.XMLHttpRequest)
		{
			
			//code for internet explorer 7 and above, Firefox, safari, opera, and Chrome
			xmlhttp =new XMLHttpRequest();
		}else
		{
			//code for intenet explorer 6 and bellow
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function()
		{
			
			if((xmlhttp.readyState == 4) && (xmlhttp.status == 200))
			{
				if(document.getElementById("news"+id).innerHTML == ""){
					document.getElementById("news"+id).innerHTML = xmlhttp.responseText;
				}else{
					document.getElementById("news"+id).innerHTML =""
				}
			}
		}
		
		xmlhttp.open("GET", "GetNews.php?id=" + id, true);
		xmlhttp.send();
		
	}
	

//-->

</script>
</head>
<body onLoad="InitializeNotify()">
	<form action="index.php" method="POST" id='index'>
		<table align ="center" border='1' >
			
			<tr>
				<td width="20%" >
				
				</td>
			</tr>
			<tr>
				<td  width = "50%" align="center">
				
					<table style ="border-style: double; border-color: green; border-width: 4; width : 50% " bgcolor='' >
					
						<tr>
						
							<td colspan="3" align="center">
								<font color="green" name="Arial" size="6"><b>Kaduna State University Staff Multi-Purpose Cooperative Society Ltd.</b></font>
							</td>
						</tr>
						<tr>
						
							<td colspan="3" align="center">
								<img src ="Images/logo.png" width="500" height="200" alt="LOGO" />
							</td>
						</tr>
						<tr>
							
							<td  align ="center" colspan='3'>
								<marquee direction = "right" scrollamount="2" loop="true" width ="500" bgcolor="#ff6728" >
											<h1>Welcome to Kaduna State University Staff Multi-Purpose Cooperative Society Limited Portal</h1></marquee><br />
							</td>
						</tr>
						
						<tr>
						<!-- Menu row-->
							<td align ="center" bgcolor="green" colspan='3'> 
								<h2><a href="index.php">Home </a>  ||  <a href="officialLogin.php">Official </a>  ||  <a href="contactUs.php">Contact Us</a>  || <a href="aboutUs.php">About Us </a></h2>
							</td>
						</tr>
						<tr>
							<td align="center" colspan ="3">
								
							</td>	
						</tr>	
						<tr>
							<td align="right">
								<table width='650' align='justify' style ="border-style: double; border-color: #ff6728; border-width: 4;"><!-- body table-->
									<tr>
										<td colspan='2'><font color="green" name="Arial" size="5"><b><u>Read Our Latest News!!!</u></b></font>
										
										</td>
									</tr>
									<tr>
									<td align="justify">
										<?php
											require_once 'connection.php';
											$sql = "SELECT newsID, newsHeading FROM tblNews WHERE DATE(startDate) < ". date('Y-m-d') ." OR DATE(endDate) > ". date('Y-m-d');
					
											$result = mysql_query($sql,$db) or print("Could Not Be Executed 37 tblAccount SELECT  ". mysql_error($db));
											while($row = mysql_fetch_array($result))
											{

												Print('<font color="green" name="Arial" size="4"><b><a href="JavaScript:SubmitForm('.$row['newsID'].')" >'.strip_tags($row['newsHeading']).'</a></b></font><br /><div id="news'.$row['newsID'].'"></div>');
												//Print('<font color="blue" name="Arial" size="2">Published By: <b><em>'.$row['publisher'].'</em></b></font><br />');
												//Print('<font color="blue" name="Arial" size="2">Published Date: <b><em>'.$row['startDate'].'</em></b></font><p />');
												//Print('<font color="black" name="Arial" size="4"><b>'.strip_tags($row['newsBody']).'</b></font><p />');
											}
										?>
										
										
										
									</td>
								</tr>
								<tr>
									<td width="40%" align="justify">
										


											
										
									</td>
								</tr>
								</table>
							</td>
							<td>
								<table bgcolor='silver' border="1" width="350" style ="border-style: double; border-color: green; border-width: 4;">
									<tr bgcolor='green'>
										<td align="center" colspan="3">
											<font color="white" name="Arial" size="5"><b><em>Members Login!!!</em></b></font>
										</td>
									</tr>
									<tr>
										<td align="center" colspan="3">
											<font color="red" name="Arial" size="5"><b><em id="notify"><?php print($entireError);/*/error message here*/ ?></em></b></font>
										</td>
									</tr>
									<tr>
										<td align="right"><b>Staff Number :</b></td><td><input type="text" name="staffNumber" id="staffNumber" />
										<font color="red" name="Arial" size="3">*</font></td>
										<td><font color="red" name="Arial" size="3" id="staff"><?php print($staffNumberError);/*/error message here*/ ?></font></td>
									</tr> 
									<tr>
										<td align="right"><b>Password :</b></td><td><input type="password" name="password" id="password" />
										<font color="red" name="Arial" size="3">*</font></td>
										<td><font color="red" name="Arial" size="3" id="pass"><?php print($passwordError);/*/error message here*/ ?></font></td>
									</tr> 
									<tr>
										<td align="right"><b></b></td><td><button type='submit' name="membershipLogin" id="membershipLogin"><img src="Images/login.png" alt="Login" /></button></td>
									</tr> 
									<tr>
										<td align="center" colspan="2">
											<a href="newAccount.php" id="newAccount"><font name="Arial" size="3"><b><em>Create New Account</em></b></font></a>
										</td>
									</tr>
								</table>
								
							</td>
							<tr>
								<td>
									<a rel="nofollow" class="external text" href="http://www.kasu.edu.ng/">KASU Official website</a>
											
								</td>
							</tr>
					</tr>
				</td>
			</tr>
			<tr>
				<td width="30%">
					<!-- left panel -->
				</td>
			</tr>
		</table>
		
	</form>
</body>
</html>