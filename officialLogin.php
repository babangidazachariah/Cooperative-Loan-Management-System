<?php
SESSION_START();
	if(($_SESSION['title'] =="Official Login") || ($_SESSION['title'] =="")) {
		$_SESSION['officialTag'] = "";
	}

	if(isset($_POST['adminLogin'])){
		//we perform authentication here before redirecting.
		$isError = "false";
		if(empty($_POST['adminUserName'])){
			$adminUserNameError ="Cannot be NULL!!!";
			$isError = "true";
		}
		
		if(empty($_POST['adminPassword'])){
			$adminPasswordError ="Cannot be NULL!!!";
			$isError = "true";
		}
		if($isError == "false"){
			require_once 'connection.php';
			$sql = "SELECT * FROM tblAdministratorsAccount WHERE userName ='".$_POST['adminUserName']. "' AND password ='".$_POST['adminPassword']."'";
			
			$result = mysql_query($sql,$db) or print("Could Not Be Executed 37 tblAccount SELECT  ". mysql_error($db));
			if(mysql_num_rows($result) > 0){ //already has an account
				$_SESSION['adminAllow'] = 1;
				if($_SESSION['officialTag'] == ""){
					header('location:officialHome.php');//first login
				}elseif($_SESSION['officialTag'] == "Administrators Login!!!"){
					require_once 'connection.php';
					$sql = "SELECT * FROM tblAdministratorsAccount WHERE userName ='".$_POST['adminUserName']. "' AND password ='".$_POST['adminPassword']."' AND designation ='administrator'";
					
					$result = mysql_query($sql,$db) or print("Could Not Be Executed 37 tblAccount SELECT  ". mysql_error($db));
					if(mysql_num_rows($result) > 0){ //already has an account
						$_SESSION['administrator'] = 1;
						header('location:administratorHome.php');
					
					}
				}elseif($_SESSION['officialTag'] == "President's Login!!!"){
					require_once 'connection.php';
					$sql = "SELECT * FROM tblAdministratorsAccount WHERE userName ='".$_POST['adminUserName']. "' AND password ='".$_POST['adminPassword']."' AND designation ='President'";
					
					$result = mysql_query($sql,$db) or print("Could Not Be Executed 37 tblAccount SELECT  ". mysql_error($db));
					if(mysql_num_rows($result) > 0){ //already has an account
						$_SESSION['president'] = 1;
						header('location:presidentHome.php');
					
					}
				}elseif($_SESSION['officialTag'] == "Treasurer's Login!!!"){
					require_once 'connection.php';
					$sql = "SELECT * FROM tblAdministratorsAccount WHERE userName ='".$_POST['adminUserName']. "' AND password ='".$_POST['adminPassword']."' AND designation ='Treasurer'";
					
					$result = mysql_query($sql,$db) or print("Could Not Be Executed 37 tblAccount SELECT  ". mysql_error($db));
					if(mysql_num_rows($result) > 0){ //already has an account
						$_SESSION['treasurer'] = 1;
						header('location:treasurerHome.php');
					
					}
				}elseif($_SESSION['officialTag'] == "Secretary's Login!!!"){
					require_once 'connection.php';
					$sql = "SELECT * FROM tblAdministratorsAccount WHERE userName ='".$_POST['adminUserName']. "' AND password ='".$_POST['adminPassword']."' AND designation ='Secretary'";
					
					$result = mysql_query($sql,$db) or print("Could Not Be Executed 37 tblAccount SELECT  ". mysql_error($db));
					if(mysql_num_rows($result) > 0){ //already has an account
						$_SESSION['secretary'] = 1;
						header('location:secretaryHome.php');
					
					}
				}elseif($_SESSION['officialTag'] == "Financial Secretary"){
					require_once 'connection.php';
					$sql = "SELECT * FROM tblAdministratorsAccount WHERE userName ='".$_POST['adminUserName']. "' AND password ='".$_POST['adminPassword']."' AND designation ='Financial Secretary'";
					
					$result = mysql_query($sql,$db) or print("Could Not Be Executed 37 tblAccount SELECT  ". mysql_error($db));
					if(mysql_num_rows($result) > 0){ //already has an account
						$_SESSION['financial'] = 1;
						header('location:finacialSecretaryHome.php');
					
					}
				}
			}else{
				
				$errormsg ="Incorrect Password and/or Username!!!";
			}
			
		}
	}
	
?>
<html>
<head>
<title><?php if($_SESSION['title']==""){print("Official Login");}else{print($_SESSION['title']);} ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="media/css/demos.css" />
		<link rel="stylesheet" type="text/css" href="media/css/alert.css" />
		
		<script type="text/javascript" src="media/js/js-core.js"></script>
		<script type="text/javascript" src="media/js/alert.js"></script>
<script type="text/JavaScript">
	<!--
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
	
	
	
	
	function InitializeNotify(){
		
		setTimeout(function Reset(){
			document.getElementById("notify").innerHTML ="";
			document.getElementById("user").innerHTML ="";
			document.getElementById("pass").innerHTML ="";
		}, 5000);
	}
-->
</script>

</head>
<body onLoad="InitializeNotify()">
	<form action="officialLogin.php" method="POST" id="officalLogin">
		<table align ="center" >
			
			<tr>
				<td width="20%" >
				
				</td>
			</tr>
			<tr>
				<td  width = "50%" align="center">
				
					<table style ="border-style: double; border-color: green; border-width: 4; width : 60% " bgcolor='' >
					
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
								<h2><a href="index.php">Home </a>  ||  <a href="admin.php">Administrator </a> ||  <a href="unifiedUtmeResult.php" >Registration/Result</a>  ||  <a href="contactUs.php">Contact Us</a>  || <a href="aboutUs.php">About Us </a></h2>
							</td>
						</tr>
						<tr>
							<td align="center" colspan ="3">
								
							</td>	
						</tr>	
						<tr>
							<td align='center'>
								<table bgcolor='silver' border="1" width="400" style ="border-style: double; border-color: green; border-width: 4;">
									<tr>
										<td align="center" colspan="3"  bgcolor='green'>
											<font color="white" name="Arial" size="5"><b><em><?php if($_SESSION['officialTag']==""){print("Official Login!!!");}else{print($_SESSION['officialTag']);} ?></em></b></font>
										</td>
									</tr>
									<tr>
										<td align="center" colspan="2">
											<font color="red" name="Arial" size="5"><b><em id='notify'><?php print($errormsg);/*/error message here*/ ?></em></b></font>
										</td>
									</tr>
									<tr>
										<td align="right"><b>Username :</b></td><td><input type="text" name="adminUserName" id="adminUserName" /><font color="red" name="Arial" size="3">*</font></td></td>
										<td><font color="red" name="Arial" size="3" id='user'><?php print($adminUserNameError);/*/error message here*/ ?></font></td>
									</tr> 
									<tr>
										<td align="right"><b>Password :</b></td>
										<td><input type="password" name="adminPassword" id="adminPassword" /><font color="red" name="Arial" size="3">*</font></td></td>
										<td><font color="red" name="Arial" size="3" id='pass'><?php print($adminPasswordError);/*/error message here*/ ?></font></td>
									</tr> 
									<tr>
										<td align="right"><b></b></td><td>
										<button type='submit' name="adminLogin" id="adminLogin"><img src="Images/login.png" alt="Login" /></button></td>
									</tr> 
									<tr>
										<td></td><td align="right" colspan='2'><b>Return to<a href='officialHome.php'> Official Home Here!</b></td>
									</tr> 
								</table>
								
							</td>
					</tr>
				</td>
			</tr>
			<tr>
				<td width="30%">
					<!-- left panel -->
				</td>
			</tr>
		</table>
		<div>
			<img src="Images/footer.png" width="100%" height="50" alt="Footer Image" />
		</div>
	</form>
</body>
</html>