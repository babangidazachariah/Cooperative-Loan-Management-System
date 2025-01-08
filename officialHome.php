<?php
SESSION_START();
	$_SESSION['officialTag'] ="";
	if($_SESSION['adminAllow'] == 1){
		
		if($_SESSION['official'] == "Administrator"){
			$_SESSION['officialTag'] = "Administrators Login!!!";
			$_SESSION['title'] = "Administrators Login";
			$_SESSION['official']  ="";
			header('location:officialLogin.php');
		}elseif($_SESSION['official'] == "President"){
			$_SESSION['officialTag'] = "President's Login!!!";
			$_SESSION['title'] = "President Login";
			$_SESSION['official']  ="";
			header('location:officialLogin.php');
		}elseif($_SESSION['official'] == "Treasurer"){
			$_SESSION['officialTag'] = "Treasurer's Login!!!";
			$_SESSION['title'] = "Treasurer Login";
			$_SESSION['official']  ="";
			header('location:officialLogin.php');
		}elseif($_SESSION['official'] == "Secretary"){
			$_SESSION['officialTag'] = "Secretary's Login!!!";
			$_SESSION['title'] = "Secretary Login";
			$_SESSION['official']  ="";
			header('location:officialLogin.php');
		}elseif($_SESSION['official'] == "Financial Secretary"){
			$_SESSION['officialTag'] = "Financial Secretary's Login!!!";
			$_SESSION['title'] = "Financial Secretary Login";
			$_SESSION['official']  ="";
			header('location:officialLogin.php');
		}
	}else{
		header('location:officialLogin.php');
	}
	
?>
<html>
<head>
<title>Official Home</title>
<script type="text/javascript">
<!--
	function SubmitForm(routine){
	
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
				
				document.forms['officialHome'].submit();
			}
		}
		
		xmlhttp.open("GET", "RoutinePage.php?routine=" + routine, true);
		xmlhttp.send();
		
	}
	

//-->

</script>
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

</head>
<body>
	<form action="officialHome.php" method="POST" id='officialHome'>
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
								<h2><a href="index.php">Home </a>  ||  <a href="officialLogin.php">Official </a> ||  <a href="unifiedUtmeResult.php" >Registration/Result</a>  ||  <a href="contactUs.php">Contact Us</a>  || <a href="aboutUs.php">About Us </a></h2>
							</td>
						</tr>
						<tr>
							<td align="center" colspan ="3">
								
							</td>	
						</tr>	
						<tr>
							<td align='center'>
								<table bgcolor='silver' border="1" width="350" style ="border-style: double; border-color: green; border-width: 4;">
									<tr style="background-color: green;">
										<td align="center" colspan ="2" >
											<font color="white" name="Arial" size="5"><b><em>Welcome To Officials Home</em></b></font>
										</td									
									</tr>
									<tr style="background-color: #EEEEEE;">
										<td align="center" >
											<font color="green" name="Arial" size="4"><b>Administrator's Routines</b></font>
										</td>
										<td align="center" >
											<font color="green" name="Arial" size="4"><b><em><a href='JavaScript:SubmitForm("administrator")' name='administrator' id='admin'>Login</a></em></b></font>
										</td>
									</tr>
									<tr style="background-color: #FFFFFF;">
										<td align="center" >
											<font color="green" name="Arial" size="4"><b>President's Routines</b></font>
										</td>
										<td align="center" >
											<font color="green" name="Arial" size="4"><b><em><a href='JavaScript:SubmitForm("president")' name='president' id='president'>Login</a></em></b></font>
										</td>
									</tr>
									
									<tr style="background-color: #EEEEEE;">
										<td align="center" >
											<font color="green" name="Arial" size="4"><b>Sectretary's Routines</b></font>
										</td>
										<td align="center">
											<font color="green" name="Arial" size="4"><b><em><a href='JavaScript:SubmitForm("secretary")' name='secretary' id='secretary'>Login</a></em></b></font>
										</td>
									</tr>
									<tr style="background-color: #FFFFFF;">
										<td align="center">
											<font color="green" name="Arial" size="4"><b>Treasurer's Routines</b></font>
										</td>
										<td align="center" >
											<font color="green" name="Arial" size="4"><b><em><a href='JavaScript:SubmitForm("treasurer")' name='treasurer' id='treasurer'>Login</a></em></b></font>
										</td>
									</tr>
									<tr style="background-color: #EEEEEE;">
										<td align="center" >
											<font color="green" name="Arial" size="4"><b>Finacial Sectretary's Routines</b></font>
										</td>
										<td align="center" colspan="2">
											<font color="green" name="Arial" size="4"><b><em><a href='JavaScript:SubmitForm("financialSecretary")' name='finacialSecretary' id='financialSecretary'>Login</a></em></b></font>
										</td>
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