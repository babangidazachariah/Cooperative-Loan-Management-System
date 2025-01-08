<?php
SESSION_START();
	if($_SESSION['allowed'] == 1 &&  $_SESSION['staffNumber'] != ""){
	
		if(isset($_POST['submit'])){
			$isError = "false";
			if(empty($_SESSION['staffNumber'])){
				$staffNumberError ="Cannot be NULL!!!";
				$isError = "true";
			}
			if(empty($_SESSION['typeOfLoan'])){
				$typeOfLoanError ="Cannot be NULL!!!";
				$isError = "true";
			}
			if(empty($_SESSION['fullName'])){
				$fullNameError ="Cannot be NULL!!!";
				$isError = "true";
			}
			if(empty($_POST['membershipNumber'])){
				$membershipNumberError ="Cannot be NULL!!!";
				$isError = "true";
			}
			if(empty($_POST['bankers'])){
				$bankersError ="Cannot be NULL!!!";
				$isError = "true";
			}
			if(empty($_POST['amountRequested'])){
				$amountRequestedError ="Cannot be NULL!!!";
				$isError = "true";
			}
			if(empty($_POST['indebtednessToSociety'])){
				$indebtednessToSocietyError ="Cannot be NULL!!!";
				$isError = "true";
			}
			if(empty($_POST['bursary'])){
				$bursaryError ="Cannot be NULL!!!";
				$isError = "true";
			} 
			if(empty($_POST['periodOfRepayment'])){
				$periodOfRepaymentError ="Cannot be NULL!!!";
				$isError = "true";
			}
			/*
			if(empty($_POST['privateKey'])){
				$privateKeyError ="Cannot be NULL!!!";
				$isError = "true";
			}
			*/
			if(!isset($_POST['declaration'])){
				$declarationError ="Select an OPTION!!!";
				$isError = "true";
			}
			
			if($isError == "false"){
				
				
				require_once 'connection.php';
				$sql = "INSERT INTO tblLoans (borrower, typeOfLoan, amountRequested, periodOfRepayment, indebtednessToSociety,bursary, president,
					treasurer, financialSecretary, monthlyPayment, cummulativePayment, balance, status) VALUES('".trim($_POST['membershipNumber'])."',".$_POST['typeOfLoan'].",".$_POST['amountRequested'].",
					'".trim($_POST['periodOfRepayment'])."','".trim($_POST['indebtednessToSociety'])."','".trim($_POST['bankers'])."',
					'Pending','Pending','Pending',0.000,0.000,". trim($_POST['amountRequested']).",'UNCLEARED')";
				
				$result = mysql_query($sql,$db) or print("Could Not Be Executed 37 tblAccount SELECT  ". mysql_error($db));
				//$notify ="Application Was Successfully Received.";
				header("location:requestLoanGuarantor.php");
			}
		}
		
	}else{
		//$entireError ="Wrong Username or Password!!!";
		header('location:index.php');
	}
?><html>
<head>
	<title>Loan Application</title>
	
	<script type="text/javascript">
<!--
	function InitializeNotify(){
		
		setTimeout(function Reset(){
			document.getElementById("staffNumberError").innerHTML ="";
			document.getElementById("nameError").innerHTML ="";
			document.getElementById("membershipNumberError").innerHTML ="";
			document.getElementById("amountRequestedError").innerHTML ="";
			document.getElementById("bankersError").innerHTML ="";
			document.getElementById("declarationError").innerHTML ="";
			document.getElementById("bursaryError").innerHTML ="";
			document.getElementById("periodOfRepaymentError").innerHTML ="";
			document.getElementById("privateKeyError").innerHTML ="";
			document.getElementById("indebtednessToSocietyError").innerHTML ="";
			document.getElementById("typeOfLoanError").innerHTML ="";
			document.getElementById("notify").innerHTML ="";
		}, 7000);
	}
	-->
</script>
</head>
<body onload="InitializeNotify()">
	<form action="loanApplication.php" method="POST" id="loanApplication">
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
								<table  bgcolor='silver' border ="1" width='800' align='center' style="outset:5pt;"><!-- body table-->
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
											<h3><a href="index.php"><img src='images/mainhome.png' alt='Main Home' /> </a>   
											<a href="loanApplication.php"><img src='images/loanapplication.png' alt='Loan Application' /> </a>
											<a href="viewLoanStatus.php" ><img src='images/viewstatus.png' alt='View Loan Application Status' /> </a>    
											<a href="guaranteeLoan.php"><img src='images/guaranteeloan.png' alt='Guarantee Loan' /> </a>   
											<a href="guaranteeMembership.php"><img src='images/guaranteemembership.png' alt='Guarantee Membership' /> </a>   
											<a href="index.php"><img src='images/logout.png' alt='Logout' /> </a></h3>
										</td>
									</tr>
									<tr>
										<td  colspan ="3" bgcolor="green" align='center'><!-- body table First Column-->
											<font color="white" name="Arial" size="8"><b><em>Loan Application</em></b></font>
										</td>
									</tr>
									<tr>
										<td  colspan ="3" bgcolor="green" align='center'><!-- body table First Column-->
											<font color="white" name="Arial" size="4"><b><em id ='notify'><?php print($notify);?></em></b></font>
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
											<font color="red" name="Arial" size="4">* </font>
											<font color="red" name="Arial" size="4" id="staffNumberError"><?php print($nameError);?></font><!-- institution error-->
										</td>
									
									</tr>
									
									<tr>
									
										<td   align="right" ><!-- body table First Column-->
											<font color="black" name="Arial" size="4"><b>Name  :</b></font>
										</td>
										<td>
											<input type="text" cols="30" name="name" id="name" value ='<?php print($_SESSION['fullName']); ?>' disabled ="disabled" />
											
										</td>
									
										<td >
											<font color="red" name="Arial" size="4">*</font>
											<font color="red" name="Arial" size="4" id="nameError"><?php print($nameError);?></font><!-- institution error-->
										</td>
									
									</tr>
									
									
									<tr>
									
										<td   align="right" ><!-- body table First Column-->
											<font color="black" name="Arial" size="4"><b>Type of Loan  :</b></font>
										</td>
										<td>
											<select name="typeOfLoan" id="typeOfLoan">
												
												<option value =''></option>
												<option value ='1'>Emergency Loan</option>
												<option value ='2'>Short Term Loan</option>
												<option value ='3'>Long Term Loan</option>
											
											</select
											
										</td>
									
										<td >
											<font color="red" name="Arial" size="4">*</font>
											<font color="red" name="Arial" size="4" id="typeOfLoanError"><?php print($typeOfLoanError);?></font><!-- institution error-->
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
									
									<tr>
									
										<td   align="right" ><!-- body table First Column-->
											<font color="black" name="Arial" size="4"><b>Bankers  :</b></font>
										</td>
										<td>
											<input type="text" cols="30" name="bankers" id="bankers" />
											
										</td>
									
										<td >
											<font color="red" name="Arial" size="4">*</font>
											<font color="red" name="Arial" size="4" id="bankersError"><?php print($bankersError);?></font><!-- institution error-->
										</td>
									
									</tr>
									<tr>
									
										<td   align="right" ><!-- body table First Column-->
											<font color="black" name="Arial" size="4"><b>Amount Requested (<strike>N</strike>) :</b></font>
										</td>
										<td>
											<input type="text" cols="30" name="amountRequested" id="amountRequested" />
											
										</td>
									
										<td >
											<font color="red" name="Arial" size="4">*</font>
											<font color="red" name="Arial" size="4" id="amountRequestedError"><?php print($amountRequestedError);?></font><!-- institution error-->
										</td>
									
									</tr>
									<tr>
										
										<td   align="right" ><!-- body table First Column-->
											<font color="black" name="Arial" size="4"><b>Period of Repayment :</b></font>
										</td>
										<td>
											<input type="text" cols="30" name="periodOfRepayment" id="periodOfRepayment"  />
											
										</td>
										<td >
											<font color="red" name="Arial" size="4">*</font>
											<font color="red" name="Arial" size="4" id="periodOfRepaymentError"><?php print($periodOfRepaymentError);?></font><!-- institution error-->
										</td>
										
									</tr>
									<tr>
										
										<td   align="right" ><!-- body table First Column-->
											<font color="black" name="Arial" size="4"><b>Indebtedness to Society :</b></font>
										</td>
										<td>
											<input type="text" cols="30" name="indebtednessToSociety" id="indebtednessToSociety"  />
											
										</td>
										<td >
											<font color="red" name="Arial" size="4">*</font>
											<font color="red" name="Arial" size="4" id="indebtednessToSocietyError"><?php print($indebtednessToSocietyError);?></font><!-- institution error-->
										</td>
										
									</tr>
									<tr>
										
										<td   align="right" ><!-- body table First Column-->
											<font color="black" name="Arial" size="4"><b>Busary :</b></font>
										</td>
										<td>
											<input type="text" cols="30" name="bursary" id="bursary"  />
											
										</td>
										<td >
											<font color="red" name="Arial" size="4">*</font>
											<font color="red" name="Arial" size="4" id="bursaryError"><?php print($bursaryError);?></font><!-- institution error-->
										</td>
										
									</tr>
								<!--
									<tr>
									
										<td   align="right" >			<!-- body table First Column
										
											<font color="black" name="Arial" size="4"><b>Private Key  :</b></font>
										</td>
										<td>
											<input type="password" cols="30" name="privateKey" id="privateKey" />
											
										</td>
									
										<td >
											<font color="red" name="Arial" size="4">*</font>
											<font color="red" name="Arial" size="4" id="privateKeyError"><?php //print($privateKeyError);?></font>		<!-- institution error--
										</td>
									
									</tr>
								-->
									<tr>
										<td height='10'></td><td height='10'></td>
									</tr>
									
									<tr>
										<td height='10' align='justify' colspan='2' ><font color="red" name="Arial" size="4"><em><u><b>APPLICANT'S UNDERTAKING </b></u></em></font><P />
											<b>I <?php print($_SESSION['fullName']);?>  Authorize KADUNA STATE UNIVERSITY STAFF MULTI-PURPOSE
												COOPERATIVE SOCIETY LTD to deduct at source any amount not repaid by me within the specified period and/or access my retirement/death 
												benefit for the said repayment.
												<p /><input type="radio" name="declaration" value="accepted"> Agree
													<input type="radio" name="declaration" value="unaccepted"> Don't Agree
											</b>
										</td>
										<td>
											<font color="red" name="Arial" size="4">*</font>
											<font color="red" name="Arial" size="4" id="declarationError"><?php print($declarationError);?></font><!-- institution error-->
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