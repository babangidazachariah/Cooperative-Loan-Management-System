<?php
SESSION_START();
	if($_SESSION['administrator'] == 1){
		$_SESSION['publisher'] = "Administrator";
		$_SESSION['pageTag'] ="";
		$_SESSION['title'] ="";
		//if($_SESSION['allow'] == 1){
			
			if($_SESSION['pageStatus'] == "New"){
				$_SESSION['pageTag'] = "Post Fresh News!!!";
				$_SESSION['title'] = "Fresh News";
				$_SESSION['pageStatus']  ="";
				header('location:administratorNewNews.php');
			}elseif($_SESSION['pageStatus'] == "Edit"){
				$_SESSION['pageTag'] = "Edit Previously Posted News!!!";
				$_SESSION['title'] = "Edit News";
				$_SESSION['pageStatus']  ="";
				
				header('location:administratorNewNews.php');
			}elseif($_SESSION['pageStatus'] == "Delete"){
				//$_SESSION['pageTag'] = "Edit Previously Posted News!!!";
				//$_SESSION['title'] = "Delete News";
				$_SESSION['pageStatus']  ="";
				//$_SESSION['pageStatus']  ="";
				$newsID = $_SESSION['iden'];
			
				require_once 'connection.php';
				$sql = "DELETE FROM tblNews WHERE newsID =". $newsID;
				
				$result = mysql_query($sql,$db) or print("Could Not Be Executed 37 tblAccount SELECT  ". mysql_error($db));
				$notify ="News Deleted Successfully";
				//header('location:administratorNewNews.php');
			}	
		//
	}else{
		$_SESSION['officialTag'] = "Administrators Login!!!";
		header('location:officialLogin.php');
	}
?>
<html>
<head>
<title>Administrator Home</title>
<script type="text/javascript">
<!--
	function SubmitForm(routine,digit){
	
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
				//alert(xmlhttp.responseText);
				document.forms['administratorHome'].submit();
			}
		}
		//alert(routine);
		xmlhttp.open("GET", "SetNewsPage.php?page=" + routine+"&digit="+digit, true);
		xmlhttp.send();
		
	}
	
	function InitializeNotify(){
		
		setTimeout(function Reset(){
			document.getElementById("notify").innerHTML ="";
		}, 5000);
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
<body onload="InitializeNotify()">
	<form action="administratorHome.php" method="POST" id='administratorHome'>
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
								<table  bgcolor='silver'border="1" width="450" style ="border-style: double; border-color: green; border-width: 4;">
									<tr style="background-color: green;">
										<td align="center" colspan ="4" >
											<font color="white" name="Arial" size="5"><b><em>Welcome To Administartor's Home</em></b></font>
										</td									
									</tr>
									<tr>
										<td align="center" colspan ="4" id ='notify'><font color="red" name="Arial" size="5"><b><em>
										<?php if($notify != ""){print($notify); $notify="";} ?></em></b></font>
										</td>
									</tr>
									<tr style="background-color: silver;">
										<td align="left" colspan ="4" >
											<font color="green" name="Arial" size="5"><b><em>Published News:</em></b></font>
										</td									
									</tr>
									<tr>
										<td align="center" >
											<font color="blue" name="Arial" size="4"><b><em>News Heading</em></b></font>
										</td
										<td align="center"  >
											<font color="blue" name="Arial" size="4"><b><em>Start Date</em></b></font>
										</td
										<td align="center" >
											<font color="blue" name="Arial" size="4"><b><em>End Date</em></b></font>
										</td
										<td align="center" >
											<font color="blue" name="Arial" size="4"><b><em>Action</em></b></font>
										</td
									</tr>
									<?php
										require_once 'connection.php';
										$sql = "SELECT * FROM tblNews";
										$even = "true";
										$result = mysql_query($sql,$db) or print("Could Not Be Executed 37 tblAccount SELECT  ". mysql_error($db));
										while($row = mysql_fetch_array($result))
										{
											if($even == "true"){
											
												Print('<tr style="background-color: #EEEEEE;">
													<td align="center" >
														<font color="black" name="Arial" size="3"><b>'.$row['newsHeading'].'</b></font>
													</td>
													<td align="center" >
														<font color="black" name="Arial" size="3"><b>'.$row['startDate'].'</b></font>
													</td>
													<td align="center" >
														<font color="black" name="Arial" size="3"><b>'.$row['endDate'].'</b></font>
													</td>
													<td align="center" >
														<font color="black" name="Arial" size="3"><b><em><a href='."'JavaScript:SubmitForm(".'"edit",'.$row['newsID'].")' >Edit</a>
														<a href='JavaScript:SubmitForm(".'"delete",'.$row['newsID'].")' >Delete</a></em></b></font>
													</td>
													</tr>");
												$even ="false";
												
											}else{
											
												Print('<tr style="background-color: #FFFFFF;">
													<td align="center" >
														<font color="black" name="Arial" size="3"><b>'.$row['newsHeading'].'</b></font>
													</td>
													<td align="center" >
														<font color="black" name="Arial" size="3"><b>'.$row['startDate'].'</b></font>
													</td>
													<td align="center" >
														<font color="black" name="Arial" size="3"><b>'.$row['endDate'].'</b></font>
													</td>
													<td align="center" >
														<font color="black" name="Arial" size="3"><b><em><a href='."JavaScript:SubmitForm(".'"edit",'.$row['newsID'].")' name='administratorNewNews' id='administratorNewNews'>Edit</a>
														<a href='JavaScript:SubmitForm(".'"delete",'.$row['newsID'].")'>Delete</a></em></b></font>
													</td>
													</tr>");
												$even ="true";
											}
										}
									?>
									<tr>
										<td height='10'></td><td height='15'></td>
									</tr>
									
									<tr style="background-color: silver;" >
										<td align="right" colspan ="4" >
											<font color="green" name="Arial" size="4"><b><em><a href='JavaScript:SubmitForm("new","#")' >Post Fresh News/Announcement</a></em></b></font>
										</td									
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