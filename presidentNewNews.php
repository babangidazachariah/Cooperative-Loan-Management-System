<?php
SESSION_START();
	if($_SESSION['president'] == 1){
		if($_SESSION['title'] == "Edit News"){
			//we want to edit news.
			//we get the id of the news to be edited
			$newsID = $_SESSION['iden'];
			
			require_once 'connection.php';
			$sql = "SELECT * FROM tblNews WHERE newsID =". $newsID;
			$even = "true";
			$result = mysql_query($sql,$db) or print("Could Not Be Executed 37 tblAccount SELECT  ". mysql_error($db));
			while($row = mysql_fetch_array($result))
			{
				$theNewsHeading = htmlentities($row['newsHeading']);
				$theNewsBody = htmlentities($row['newsBody']);
				$theStartDate = $row['startDate'];
				$theEndDate = $row['endDate'];
			}
			//print($theNewsBody);
		}
		
		//when form is submitted.
		if(isset($_POST['submit'])){
			$isError = "false";
			if(empty($_POST['newsHeading'])){
				$newsHeadingError ="Cannot be NULL!!!";
				$isError = "true";
			}
			
			if(empty($_POST['newsBody'])){
				$newsBodyError ="Cannot be NULL!!!";
				$isError = "true";
			}
			
			if(empty($_POST['startDate']) ){
				$startDateError ="Cannot be NULL!!!";
				$isError = "true";
			}
			if(!ereg("^[0-9]{4}-[0-9]{2}-[0-9]{2}$",$_POST['startDate'])){
				$startDateError ="Invalid Format!!!";
				$isError = "true";
			}
			if(!ereg("^[0-9]{4}-[0-9]{2}-[0-9]{2}$",$_POST['endDate'])){
				$endDateError ="Invalid Format!!!";
				$isError = "true";
			}
			if(empty($_POST['endDate'])){
				$endDateError ="Cannot be NULL!!!";
				$isError = "true";
			}
			if($isError ="false"){
			
				require_once 'connection.php';
				
				$newsHeading = mysql_real_escape_string(htmlspecialchars($_POST['newsHeading']));
				$newsBody = mysql_real_escape_string(htmlspecialchars($_POST['newsBody']));
				$startDate = $_POST['startDate'];
				$endDate = $_POST['endDate'];
				$publisher = "President";
				if($_SESSION['title'] == "Fresh News"){
					//we insert a record
					
					$sql = "INSERT INTO tblNews (newsHeading, newsBody,startDate, endDate, publisher) VALUES('".$newsHeading.
						"','".$newsBody."','".$startDate."','".$endDate."','".$publisher."')";
					$notify ="News Posted Successfully!!!";
					$result = mysql_query($sql,$db) or print("Could Not Be Executed 37 tblAccount SELECT  ". mysql_error($db));
				}elseif($_SESSION['title'] == "Edit News"){
					//we update a record
					
					$sql = "UPDATE tblNews SET newsHeading ='".$newsHeading."', newsBody ='".$newsBody."', startDate ='".$startDate."', endDate ='".$endDate."', publisher ='".$publisher."' WHERE newsID =".$_SESSION['iden'];
					$notify ="News Posted Successfully!!!";
					$result = mysql_query($sql,$db) or print("Could Not Be Executed 37 tblAccount SELECT  ". mysql_error($db));
				}
			}
		}elseif(isset($_POST['cancel'])){
			header('location:presidentHome.php');
		}
	}else{
		$_SESSION['officialTag'] = "President Login!!!";
		header('location:officialLogin.php');
	}
?>
<html>
<head>
<title><?php if($_SESSION['title']==""){print("Post News");}else{print($_SESSION['title']);} ?></title>
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
				
				document.forms['presidentNewNews'].submit();
			}
		}
		
		xmlhttp.open("GET", "SetNewsPage.php?page=" + routine, true);
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
<body onLoad="InitializeNotify()">
	<form action="presidentNewNews.php" method="POST" id='presidentNewNews'>
		<table align ="center" >
			
			<tr>
				<td width="20%" >
				
				</td>
			</tr>
			<tr>
				<td  width = "50%" align="center">
				
					<table style ="border-style: double; border-color: green; border-width: 4; width : 60% " >
					
						<tr>
						
							<td colspan="3" align="center">
								<img src ="Images/logo.png" width="500" height="200" alt="LOGO" />
							</td>
						</tr>
						<tr>
							
							<td  align ="center" colspan='3'><marquee direction = "up" scrollamount="2" loop="true" width ="150" height='80' bgcolor="#ff6728" >
											<h1><em>Welcome to</em></h1></marquee>
								<marquee direction = "left" scrollamount="2" loop="true" width ="300" bgcolor="#ff6728" >
											<h1>Kaduna State University Staff Multi-Purpose Cooperative Society Limited Portal</h1></marquee><br />
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
								<table bgcolor='silver' border="1" width="650" style ="border-style: double; border-color: green; border-width: 4;">
									<tr style="background-color: green;">
										<td align="center" colspan ="4" >
											<font color="white" name="Arial" size="5"><b><em><?php if($_SESSION['pageTag']==""){print("Post Fresh News!!!");}else{print($_SESSION['pageTag']);} ?></em></b></font>
										</td									
									></tr>
									<tr>
										<td align="center" colspan ="4" id ='notify'><font color="red" name="Arial" size="5"><b><em>
										<?php if($notify != ""){print($notify); $notify="";} ?></em></b></font>
										</td>
									</tr>
									<tr>
									
										<td   align="right" ><!-- body table First Column-->
											<font color="black" name="Arial" size="4"><b>News Heading :</b></font>
										</td>
										<td>
											<input type='text' width='25' name = 'newsHeading' <?php if($_SESSION['title'] == "Edit News"){print("value ='".$theNewsHeading."'");} ?> />
											<font color="red" name="Arial" size="4">*</font>
										</td>
										<td>	
											
										</td>
										<td>
											<font color="red" name="Arial" size="4"><?php print($newsHeadingError); ?> </font><!-- institution error-->
										</td>
									</tr>
									<tr>
									
										<td  align="right" width='' ><!-- body table First Column-->
											<font color="black" name="Arial" size="4" ><b>News :</b></font>
										</td>
										<td>
											<textarea  width='25' name = 'newsBody' cols='30' height='5'><?php if($_SESSION['title'] == "Edit News"){print($theNewsBody);} ?> </textarea>
											
										</td>
										<td>	
											<font color="red" name="Arial" size="4">*</font>
										</td>
										<td>
											<font color="red" name="Arial" size="4"><?php print($newsBodyError);?></font><!-- institution error-->
										</td>
									
									</tr>
									<tr>
									
										<td   align="right" ><!-- body table First Column-->
											<font color="black" name="Arial" size="4"><b>Publication Start Date :</b></font>
										</td>
										<td>
											<input type='text' width='30' name = 'startDate' <?php if($_SESSION['title'] == "Edit News"){print("value ='".$theStartDate."'");} ?> />
											<font color="red" name="Arial" size="4">*</font>
										</td>
										<td>
											<font color="blue" name="Arial" size="4">Format: yyyy-mm-dd</font>
										</td>
										<td>
											<font color="red" name="Arial" size="4"><?php print($startDateError); ?> </font><!-- institution error-->
										</td>
									</tr>
									<tr>
									
										<td   align="right" ><!-- body table First Column-->
											<font color="black" name="Arial" size="4"><b>Publication End Date :</b></font>
										</td>
										<td>
											<input type='text' width='30' name = 'endDate' <?php if($_SESSION['title'] == "Edit News"){print("value ='".$theEndDate."'");} ?> />
											<font color="red" name="Arial" size="4">*</font>
										</td>
										<td>	
											<font color="blue" name="Arial" size="4">Format: yyyy-mm-dd</font>
										</td>
										<td>
											<font color="red" name="Arial" size="4"><?php print($endDateError); ?> </font><!-- institution error-->
										</td>
									</tr>
									<tr>
										<td  align="right" width='300' ><!-- body table First Column-->
												<font color="black" name="Arial" size="4" ><b></b></font>
											</td>
											<td>
												<button type='submit'  width='6000' id="submit" name = 'submit' height='5000' > <img src="Images/submit.png" alt ="Submit" /></button>
												<button type='submit'  width='6000' id="cancel" name = 'cancel' height='5000' > <img src="Images/cancel.png" alt ="Cancel" /></button>
											</td>
											<td>
												<!-- institution error-->
											</td>
										
									</tr>
									<tr>
										<td></td><td align="right"><b>Return to <a href='presidentHome.php'>President's Home Here!</b></td>
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