<?php
SESSION_START();
	function LoanDetails(){
	
	  $loanRow = "<table border='1' style ='border-style: double; border-color: #ff6728; border-width: 4; width : 100% '><tr><td colspan='8' bgcolor='green' align='center'><font color='white' name='Arial' size = '6'><b>Approve or Disapprove Loan Applications</b>  
		</td><td align='right' bgcolor='silver'>   <a href='' onclick='JavaScript:Close()' id='close'><img src='images/close.png' alt='Close' /></a> </font></td></tr>
		<tr><font color='blue' name='Arial' size = '4'><td><font color='blue' name='Arial' size = '4'>
		<b>Applicant</b></td><td><font color='blue' name='Arial' size = '4'>
		<b>Type</b></td><td><font color='blue' name='Arial' size = '4'>
		<b>Amt. Requested</b></td><td><font color='blue' name='Arial' size = '4'>
		<b>Repayment Per.</b></td><td><font color='blue' name='Arial' size = '4'>
		<b>Indebt. to Soc.</b></td><td><b><font color='blue' name='Arial' size = '4'>
		<B>Bursary</b></td><td><b><font color='blue' name='Arial' size = '4'>
		<B>1st Guar.</b></td><td><b><font color='blue' name='Arial' size = '4'>
		<b>2nd Guar.</b></font></td><td><b><font color='blue' name='Arial' size = '4'>
		<b>Approval Stat.</b></font></td></tr>";
		
		require_once 'connection.php';
		$sql = "SELECT borrower, typeOfLoan, amountRequested, periodOfRepayment, indebtednessToSociety, bursary, guarantorOne, guarantorTwo, president FROM tblLoans";		
		$result = mysql_query($sql,$db) or print("Could Not Be Executed 37 tblAccount SELECT  ". mysql_error($db));
		while($row = mysql_fetch_array($result))
		{
			$borrower = $row['borrower'];
			$borrowerID = $borrower;
			$typeOfLoan = $row['typeOfLoan'];
			$amountRequested = $row['amountRequested'];
			$periodOfRepayment = $row['periodOfRepayment'];
			$indebtednessToSociety = $row['indebtednessToSociety'];
			$bursary = $row['bursary'];
			$guarantorOne = $row['guarantorOne'];
			$guarantorTwo = $row['guarantorTwo'];
			$approvalStatus = $row['president'];
			
			if($typeOfLoan == 1){
				$typeOfLoan = "Emergency";
			}elseif($typeOfLoan == 2){
				$typeOfLoan = "Short Term";
			}else{
				$typeOfLoan = "Long Term";
			}
			$sql = "SELECT firstName, middleName, lastName FROM tblMembers WHERE memberNumber ='".$borrower."'";		
			$result = mysql_query($sql,$db) or print("Could Not Be Executed 37 tblAccount SELECT  ". mysql_error($db));
			while($row = mysql_fetch_array($result)){
				$borrower = $row['firstName']."  ".$row['middleName']."  ".$row['lastName'];
			}
			
			//$sql = "SELECT firstName, middleName, lastName FROM tblMembers WHERE memberNumber =(SELECT memberNumber FROM tblDigital WHERE public ='".$guarantorOne."')";
			$sql = "SELECT firstName, middleName, lastName FROM tblMembers WHERE memberNumber ='".$guarantorOne."'";		
			$result = mysql_query($sql,$db) or print("Could Not Be Executed 37 tblAccount SELECT  ". mysql_error($db));
			while($row = mysql_fetch_array($result)){
				$guarantorOne = $row['firstName']."  ".$row['middleName']."  ".$row['lastName'];
			}
			//$sql = "SELECT firstName, middleName, lastName FROM tblMembers WHERE memberNumber =(SELECT memberNumber FROM tblDigital WHERE public ='".$guarantorTwo."')";	
			$sql = "SELECT firstName, middleName, lastName FROM tblMembers WHERE memberNumber ='".$guarantorTwo."'";	
			$result = mysql_query($sql,$db) or print("Could Not Be Executed 37 tblAccount SELECT  ". mysql_error($db));
			while($row = mysql_fetch_array($result)){
				$guarantorTwo = $row['firstName']."  ".$row['middleName']."  ".$row['lastName'];
			}
			
			$loanRow = $loanRow .'<tr style="background-color: #EEEEEE;">
					<td align="center" >
						<font color="green" name="Arial" size="3">'.$borrower.'</font>
					</td>
					<td align="center" >
						<font color="green" name="Arial" size="3">'.$typeOfLoan.'</font>
					</td>
					<td align="center" >
						<font color="green" name="Arial" size="3">'.$amountRequested.'</font>
					</td>
					<td align="center" >
						<font color="green" name="Arial" size="3">'.$periodOfRepayment.'</font>
					</td>
					<td align="center" >
						<font color="green" name="Arial" size="3">'.$indebtednessToSociety.'</font>
					</td>
					<td align="center" >
						<font color="green" name="Arial" size="3">'.$bursary.'</font>
					</td>
					<td align="center" >
						<font color="green" name="Arial" size="3">'.$guarantorOne.'</font>
					</td>
					<td align="center" >
						<font color="green" name="Arial" size="3">'.$guarantorTwo.'</font>
					</td>
					<td align="center" >
						<font color="green" name="Arial" size="3">'.$approvalStatus.'</font>
					</td>
					<td align="center" >
						<font color="green" name="Arial" size="3"><b><em><a href='."'JavaScript:SubmitForm(".'"Approve","'.$borrowerID.'")'."' >Approve</a>  ||  <a href='".'JavaScript:SubmitForm("Disapprove","'.$borrowerID.'")'."' >Disapprove</a></em></b></font>
					</td>
				</tr>";
			
			
		}
		//#ff6728
		$loanRow = $loanRow ."</table>";
		return $loanRow;
	}
	function LoanDeductions(){
	
		$loanRow ="<table border='1' style ='border-style: double; border-color: #ff6728; border-width: 4; width : 100% '><tr><td colspan='7' bgcolor='green' align='center'><font color='white' name='Arial' size = '6'><b>Deductions of Memebers' Payment.</b>  
			</td><td align='right' bgcolor='silver'>   <a href='' onclick='JavaScript:Close()' id='close'><img src='images/close.png' alt='Close' /></a> </font></td></tr>
			<tr><font color='blue' name='Arial' size = '4'><td><font color='blue' name='Arial' size = '4'>
			<b>Applicant</b></td><td><font color='blue' name='Arial' size = '4'>
			<b>Monthly Payment</b></td><td><font color='blue' name='Arial' size = '4'>
			<b>Cummulative Payment</b></td><td><font color='blue' name='Arial' size = '4'>
			<b>Balance</b></td><td><b><font color='blue' name='Arial' size = '4'>
			<B>Date Due</b></td><td><b><font color='blue' name='Arial' size = '4'>
			<B>Status</b></td></tr>";
		
		require_once 'connection.php';
		$sql = "SELECT borrower, periodOfRepayment, amountRequested, monthlyPayment, cummulativePayment, balance, status FROM tblLoans WHERE status ='UNCLEARED'";		
		$result = mysql_query($sql,$db) or print("Could Not Be Executed 37 tblAccount SELECT  ". mysql_error($db));
		while($row = mysql_fetch_array($result))
		{
			$borrower = $row['borrower'];
			$borrowerID = $borrower;
			$amountRequested = $row['amountRequested'];
			$periodOfRepayment = $row['periodOfRepayment'];
			$monthlyPayment = $row['monthlyPayment'];
			$cummulativePayment = $row['cummulativePayment'];
			$balance = $row['balance'];
			$status = $row['status'];
			
			$sql = "SELECT firstName, middleName, lastName FROM tblMembers WHERE memberNumber ='".$borrower."'";		
			$result = mysql_query($sql,$db) or print("Could Not Be Executed 37 tblAccount SELECT  ". mysql_error($db));
			while($row = mysql_fetch_array($result)){
				$borrower = $row['firstName']."  ".$row['middleName']."  ".$row['lastName'];
			}
			$balance = $amountRequested - $cummulativePayment ;
			
			$loanRow = $loanRow .'<tr style="background-color: #EEEEEE;">
					<td align="center" >
						<font color="green" name="Arial" size="3">'.$borrower.'</font>
					</td>
					<td align="center" >
						<font color="green" name="Arial" size="3">'.$monthlyPayment.'</font>
					</td>
					<td align="center" >
						<font color="green" name="Arial" size="3">'.$cummulativePayment.'</font>
					</td>
					<td align="center" >
						<font color="green" name="Arial" size="3">'.$balance.'</font>
					</td>
					<td align="center" >
						<font color="green" name="Arial" size="3">'.$periodOfRepayment.'</font>
					</td>
					<td align="center" >
						<font color="green" name="Arial" size="3">'.$status.'</font>
					</td>
					
					<td align="center" >
						<font color="green" name="Arial" size="3"><b><em><a href='."'JavaScript:SubmitForm(".'"Deduct","'.$borrowerID.'")'."' >Deduct</a> </em></b></font>
					</td>
				</tr>";
			
			
		}
		//#ff6728
		$loanRow = $loanRow ."</table>";
		return $loanRow;
	}
	
	if($_SESSION['president'] == 1){
		if($_SESSION['task'] == "loans"){
			$_SESSION['task'] ="";
			
			$loanRow = LoanDetails();
			
			
		}elseif($_SESSION['task'] == "News"){
			$_SESSION['task'] = "";
			$_SESSION['title'] = "President's Fresh News";
			$news ="<table border='1' style ='border-style: double; border-color: #ff6728; border-width: 4; width : 60% '><tr><td colspan='7' bgcolor='green' align='center'><font color='white' name='Arial' size = '6'><b>President's Published News</b>  
			</td><td align='right' bgcolor='silver'>   <a href='' onclick='JavaScript:Close()' id='close'><img src='images/close.png' alt='Close' /></a> </font></td></tr>
			<tr><font color='blue' name='Arial' size = '4'><td><font color='blue' name='Arial' size = '4'>
			<b>News Heading</b></td><td><font color='blue' name='Arial' size = '4'>
			<b>Published Date</b></td><td><font color='blue' name='Arial' size = '4'>
			<b>Action</b></td><td></tr>";
			$sql = "SELECT * FROM tblNews WHERE publisher = 'President'";
			require_once 'connection.php';
			$result = mysql_query($sql,$db) or print("Could Not Be Executed 37 tblAccount SELECT  ". mysql_error($db));
			while($row = mysql_fetch_array($result)){
				$news = $news. "<tr><td>".$row['newsHeading']."</td><td>".$row['startDate']."</td><td align='center' >
							<font color='black' name='Arial' size='3'><b><em><a href='JavaScript:SubmitForm(".'"Edit",'.$row['newsID'].")' >Edit</a>  ||  
							<a href='JavaScript:SubmitForm(".'"Delete",'.$row['newsID'].")' >Delete</a></em></b></font>
						</td>
					</tr>";
			}
			$news = $news ."</table>";
			//header('location:presidentNewNews.php');
		
		}elseif($_SESSION['task'] == "Edit"){
			$_SESSION['task'] = "";
			$_SESSION['title'] = "Edit News";
			header('location:presidentNewNews.php');
		
		}elseif($_SESSION['task'] == "New News"){
			$_SESSION['task'] = "";
			$_SESSION['title'] = "Fresh News";
			header('location:presidentNewNews.php');
		
		}elseif($_SESSION['task'] == "Delete"){
			$_SESSION['task'] = "";
			require_once 'connection.php';
			$newsID = $_SESSION['iden'];
			$sql = "DELETE FROM tblNews WHERE newsID =". $newsID;
			mysql_query($sql,$db) or print("Could Not Delete News!!!");
			$notify ="News Deleted Successfully!!!";
		}elseif($_SESSION['task'] == "Approved"){
			$_SESSION['task'] = "";
			require_once 'connection.php';
			$loanID = $_SESSION['iden'];
			//when the president wants to approve a particular loan.
			//require_once 'connection.php';
			$sql ="UPDATE tblLoans SET president ='Approved' WHERE loanID =".$loanID ;
			mysql_query($sql,$db) or print("Could Not Approve Loan!!!");
			$notify ="Loan Approved Successfully!!!";
			$loanRow = LoanDetails();
		}elseif($_SESSION['task'] == "Approved"){
			$_SESSION['task'] = "";
			require_once 'connection.php';
			$loanID = $_SESSION['iden'];
			//when the president wants to approve a particular loan.
			//require_once 'connection.php';
			$sql ="UPDATE tblLoans SET president ='Disapproved' WHERE loanID =".$loanID;
			mysql_query($sql,$db) or print("Could Not Approve Loan!!!");
			$notify ="Loan Disapproved Successfully!!!";
			$loanRow = LoanDetails();
		}elseif($_SESSION['task'] == "Deductions"){
			$_SESSION['task'] = "";
			$loanRow = LoanDeductions();
		
		}
		
		
	}else{
		$_SESSION['officialTag'] = "President's Login!!!";
		header('location:officialLogin.php');
	}
	
?>
<html>
<head>
<title>President Home</title>
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
				document.forms['presidentHome'].submit();
			}
		}
		//alert(routine);
		xmlhttp.open("GET", "SetPresidentTask.php?page=" + routine+"&digit="+digit,true);
		xmlhttp.send();
		
	}
	
	function InitializeNotify(){
		
		setTimeout(function Reset(){
			document.getElementById("notify").innerHTML ="";
		}, 5000);
	}
	
	
	function Close(){
		document.getElementById('content').innerHTML ="";
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
	<form action="presidentHome.php" method="POST" id='presidentHome'>
		<table align ="center" >
			
			<tr>
				<td width="20%" >
				
				</td>
			</tr>
			<tr>
				<td  width = "50%" align="center">
				
					<table style ="border-style: double; border-color: green; border-width: 4; width : 100% " bgcolor='' >
					
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
								<h2><a href="index.php">Home </a>  ||  <a href="officialLogin.php">Official </a> ||  <a href="contactUs.php">Contact Us</a>  || <a href="aboutUs.php">About Us </a></h2>
							</td>
						</tr>
						<tr>
							<td align="center" colspan ="3">
								
							</td>	
						</tr>	
						<tr>
							<td align='center'>
								<table bgcolor='silver' border="1" width="500" style ="border-style: double; border-color: green; border-width: 4;">
									<tr style="background-color: green;">
										<td align="center" colspan ="2" >
											<font color="white" name="Arial" size="5"><b><em>Welcome To President's Home</em></b></font>
										</td>									
									</tr>
									<tr style="background-color: green;">
										<td align="center" colspan ="2" >
											<font color="red" name="Arial" size="5"><b><em id='notify'><?php if($notify != ""){print($notify); $notify="";} ?></em></b></font>
										</td>									
									</tr>
									
									<tr style="background-color: #EEEEEE;">
										<td align="center" >
											<font color="green" name="Arial" size="4"><b>End of Month's Accounting </b></font>
										</td>
										<td align="center" >
											<font color="green" name="Arial" size="4"><b><em><a href='JavaScript:SubmitForm("deductions","#")'>Deductions</a></em></b></font>
										</td>
									</tr>
									
									<tr style="background-color: #EEEEEE;">
										<td align="center" >
											<font color="green" name="Arial" size="4"><b>Loan Applications </b></font>
										</td>
										<td align="center" >
											<font color="green" name="Arial" size="4"><b><em><a href='JavaScript:SubmitForm("loans","#")'>Approval/Disapproval</a></em></b></font>
										</td>
									</tr>
									
									<tr style="background-color: #FFFFFF;">
										<td align="center" >
											<font color="green" name="Arial" size="4"><b>News Publication</b></font>
										</td>
										<td align="center" >
											<font color="green" name="Arial" size="4"><b><em><a href='JavaScript:SubmitForm("News","#")'>View/Edit </a> </em></b></font>
										</td>
									</tr>
									<tr style="background-color: silver;" >
										<td align="right" colspan ="4" >
											<font color="green" name="Arial" size="4"><b><em><a href='JavaScript:SubmitForm("newNews")' >Post Fresh News/Announcement</a></em></b></font>
										</td									
									</tr>
								</table>
								
							</td>
					</tr>
					<tr>
						<td align="center" colspan ="3" id='content'>
							<?php
								if($loanRow != ""){
									print($loanRow);
									$loanRow = "";
								}elseif($news != ""){
									print($news);
									$news ="";
								}
							?>
							
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
		
	</form>
</body>
</html>