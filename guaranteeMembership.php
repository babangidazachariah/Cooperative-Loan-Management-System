<?php
SESSION_START();
	if($_SESSION['allowed'] == 1 &&  $_SESSION['staffNumber'] != ""){
		
		require_once 'connection.php';
		$sql = "SELECT * FROM tblMembers WHERE staffNumber ='". $_SESSION['staffNumber']."'";
		//$even = "true";
		$result = mysql_query($sql,$db) or print("Could Not Be Executed 37 tblAccount SELECT  ". mysql_error($db));
		while($row = mysql_fetch_array($result))
		{
			$fullName = $row['firstName'] . "  ".$row['middleName']."  ".$row['lastName'];
			$_SESSION['fullName'] = $fullName;
			$memberNumber = $row['memberNumber'];
			$_SESSION['memberNumber'] = $memberNumber;
		}
		//print($fullName);
	
	}else{
		//$entireError ="Wrong Username or Password!!!";
		header('location:index.php');
	}
	
	
	$name = "";
	$membershipNumber = "";
	$rank = "";
	$staffNumber = "";
	
	
	$membershipNumberError = "";
	$rankError = "";
	if(isset($_POST['submit'])){
		$isError = "false";
		if(empty($_SESSION['staffNumber'])){
			header('location:index.php');
		}
		if(empty($_POST['name'])){
			$loanApplicationNumberError = "Cannot be EMPTY!!!";
			$isError = "true";
		}
		if(empty($_POST['membershipNumber'])){
			$membershipNumberError = "Cannot be EMPTY!!!";
			$isError = "true";
		}else{
			$membershipNumber = $_POST['membershipNumber'];
		}
		if(empty($_POST['rank'])){
			$rankError = "Cannot be EMPTY!!!";
			$isError = "true";
		}else{
			$rank = $_POST['rank'];
		}
		$toBeGuaranteed = "";
		if(empty($_SESSION['guaranteeAs']) OR empty($_SESSION['toBeGuaranteed'])){
			header("location:memberHome.php");
		}else{
		
			$sql = "SELECT * FROM tblMembers WHERE staffNumber ='". $_SESSION['toBeGuaranteed']."'";
			//$even = "true";
			$result = mysql_query($sql,$db) or print("Could Not Be Executed 37 tblAccount SELECT  ". mysql_error($db));
			while($row = mysql_fetch_array($result))
			{
				$toBeGuaranteed = $row['firstName'] . "  ".$row['middleName']."  ".$row['lastName'];
				
			}
		}
		
		
		if($isError = "false"){
		
			require_once 'connection.php';
			
			$sql = "SELECT staffNumber, memberNumber FROM tblmembers WHERE staffNumber ='".$_SESSION['staffNumber']."' AND memberNumber = '".$_SESSION['memberNumber']."'";
			
			$result = mysql_query($sql,$db) or print("Could Not Be Executed 37 tblAccount SELECT  ". mysql_error($db));
			if(mysql_num_rows($result) = 0){
			
				if($_SESSION['guaranteeAs'] == 1){
					$sql = "UPDATE tblTempMember SET firstGuarantor ='".$_SESSION['staffNumber']."' WHERE staffNumber = '".$_SESSION['toBeGuaranteed']."'";
					$result = mysql_query($sql,$db) or print("Could Not Be Executed 37 tblAccount SELECT  ". mysql_error($db));
				}else{
					$sql = "UPDATE tblTempMember SET secondGuarantor ='".$_SESSION['staffNumber']."' WHERE staffNumber = '".$_SESSION['toBeGuaranteed']."'";
					$result = mysql_query($sql,$db) or print("Could Not Be Executed 37 tblAccount SELECT  ". mysql_error($db));
				}
			}
		}
	}
?>
<html>
<head>
	<title>Guarantee Membership</title>
</head>
<body>
	<form action="guranteeMembership.php" method="POST" id="guranteeMembership">
		<table align ="center" >
			
			<tr>
				<td width="20%" >
				
				</td>
			</tr>
			<tr>
				<td  width = "50%" align="center">
					<table align ="center" style ="border-style: double; border-color: green; border-width: 4; width : 50% " >
						
						<tr>
						
							<td colspan="3" align="center">
								<img src ="Images/logo.png" width="500" height="200" alt="LOGO" />
							</td>
						</tr>
						<tr>
							
							<td  align ="center" colspan='3'>
								<marquee direction = "left" scrollamount="2" loop="true" width ="500" bgcolor="#ff6728" >
											<h1>Welcome to Kaduna State University Staff Multi-Purpose Cooperative Society Limited Portal</h1></marquee><br />
							</td>
						</tr>
						
						
						<tr>
							<td >
								<table bgcolor='silver' border ="1" width='800' align='center' style="outset:5pt;"><!-- body table-->
									<tr>
										<td colspan ="3" bgcolor="green" align="left" >
											<font color="white" name="Arial" size="4"><b>Welcome To Your Home</b></font>
										</td>
									</tr>
									<tr>
										<td  colspan ="3" bgcolor="green" align='center'><!-- body table First Column-->
											<font color="white" name="Arial" size="6"><b><?php if($_SESSION['fullName'] == ""){print("XXXXX XXXXX XXXXX");}else{print($_SESSION['fullName']);} ?></b></font>
										</td>
									</tr>
									
									
									<tr>
										<td height='10'></td><td height='10'></td>
									</tr>
									<tr>
									<!-- Menu row-->
										<td align ="left" colspan='3'> 
											<h3><a href="index.php"><img src='images/mainhome.png' alt='Main Home' /> </a>    <a href="loanApplication.php"><img src='images/loanapplication.png' alt='Loan Application' /> </a>   <a href="viewLoanStatus.php" ><img src='images/viewstatus.png' alt='View Loan Application Status' /> </a>    <a href="guaranteeLoan.php"><img src='images/guaranteeloan.png' alt='Guarantee Loan' /> </a>   <a href="guaranteeMembership.php"><img src='images/guaranteemembership.png' alt='Guarantee Membership' /> </a>     <a href="index.php"><img src='images/logout.png' alt='Logout' /> </a></h3>
										</td>
									</tr>
									<tr>
										<td  colspan ="3" bgcolor="green" align='center'><!-- body table First Column-->
											<font color="white" name="Arial" size="8"><b><em>Guarantee Membership</em></b></font>
										</td>
									</tr>
									<tr>
										
										<td   align="right" ><!-- body table First Column-->
											<font color="black" name="Arial" size="4"><b>Staff Number :</b></font>
										</td>
										<td>
											<input type='text' width='100' name = 'staffNumber' cols='100' value =" <?php print($_SESSION['staffNumber']); ?> " disabled ="disabled">
											
											
										</td>
										<td>
											<font color="red" name="Arial" size="4">* <?php Print($staffNumberError); ?></font>
										</td>
									
									</tr>
									
									
									
									<tr>
									
										<td   align="right" ><!-- body table First Column-->
											<font color="black" name="Arial" size="4"><b>Name  :</b></font>
										</td>
										<td>
											<input type="text" cols="30" name="name" id="name" disabled='disabled' value ='<?php Print($fullName); ?>' />
											
										</td>
									
										<td >
											<font color="red" name="Arial" size="4">*</font>
											<font color="red" name="Arial" size="4" id="nameError"><?php print($nameError);?></font><!-- institution error-->
										</td>
									
									</tr>
									<tr>
									
										<td   align="right" ><!-- body table First Column-->
											<font color="black" name="Arial" size="4"><b>Membership Number  :</b></font>
										</td>
										<td>
											<input type="text" cols="30" name="membershipNumber" id="membershipNumber" />
											
										</td>
									
										<td >
											<font color="red" name="Arial" size="4">*</font>
											<font color="red" name="Arial" size="4" id="membershipNumberError"><?php print($membershipNumberError);?></font><!-- institution error-->
										</td>
									
									</tr>
								<!--
									<tr>
											
												<td   align="right" ><!-- body table First Column--
													<font color="black" name="Arial" size="4"><b>Rank :</b></font>
												</td>
												<td>
													<input type='text' width='100' name = 'rank' id = 'rank' >
													
													
												</td>
												<td>
													<font color="red" name="Arial" size="4">* <?php //Print($rankError); ?></font>
												</td>
											
										</tr>
								
									<tr>
									
										<td   align="right" ><!-- body table First Column
											<font color="black" name="Arial" size="4"><b>Private Key  :</b></font>
										</td>
										<td>
											<input type="password" cols="30" name="privateKey" id="privateKey" />
											
										</td>
									
										<td >
											<font color="red" name="Arial" size="4">*</font>
											<font color="red" name="Arial" size="4" id="privateKeyError"><?php// print($privateKeyError);?></font><!-- institution error
										</td>
									
									</tr>
									-->
									<tr>
										<td height='10'></td><td height='10'></td>
									</tr>
									
									<tr>
										<td height='10' colspan='3' align='justify'><font color="red" name="Arial" size="4"><em><u><b>GUARANTOR'S UNDERTAKING </b></u></em></font><P />
											<b>I <?php if($fullName ==""){print("SSSSS SSSSS SSSSS");}else{print($fullName);}?>  agree to guarantee the candidate, <?php if($toBeGuaranteed  ==""){print("XXXXX XXXXX XXXXX");}else{print($toBeGuaranteed );}?> of the amount
												<?php  if($amount == 0){print("#######");}else{print($amount);}?> being requested. I also Authorize KADUNA STATE UNIVERSITY STAFF MULTI-PURPOSE
												COOPERATIVE SOCIETY LTD to deduct at source any amount not paid by the said borrower within the repayment period.
												<p /><input type="radio" name="declaration" value="accepted"> Agree
													<input type="radio" name="declaration" value="unaccepted"> Don't Agree
											</b>
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
								</table>
							</td>
							<td>
							
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td width="25%">
				
				</td>
			</tr>
		</table>
		
	</form>
</body>
</html>