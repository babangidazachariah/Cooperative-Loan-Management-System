<?php
SESSION_START();
	if($_SESSION['allowed'] == 1 &&  $_SESSION['staffNumber'] != ""){
		if(!empty($_SESSION['toBeGuaranteed']) AND !empty($_SESSION['guaranteeAs'])){
			
			if($_SESSION['guarantee'] == "Membership"){
				header("location:guaranteeMembership.php");
			}else{
				header("location:guaranteeLoan.php");
			}
		
		}
		$thereAre = false;
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
		$staff = '';
		$guaranteeMembership = "<table border='1'><tr>
		
													<td>
														<font size='7' color='green'>Membership Guarantee Request(s).</font>
													</td>
												</tr>";
		$sql = "SELECT staffNumber FROM tblTempMember WHERE firstGuarantor ='". $_SESSION['staffNumber']."'";
		//$even = "true";
		$result = mysql_query($sql,$db) or print("Could Not Be Executed 37 tblAccount SELECT  ". mysql_error($db));
		
		while($row = mysql_fetch_array($result))
		{
			$staff = $row['staffNumber'];
			if($staff != ''){
				$sql = "SELECT firstName, middleName, lastName FROM tblMembers WHERE staffNumber ='". $staff."'";
				//$even = "true";
				$result = mysql_query($sql,$db) or print("Could Not Be Executed 37 tblAccount SELECT  ". mysql_error($db));
				
				while($row = mysql_fetch_array($result))
				{
					$staffName = $row['firstName'] . "  ".$row['middleName']."  ".$row['lastName'];
					$thereAre = true;
					$guaranteeMembership = $guaranteeMembership."<tr>
																	<td>
																		".
																			$taffName
																		."
																	</td>
																	<td align='right' >   <a href='' onclick='JavaScript:ViewAndGuarantee(".$staff.",1,1)' id='ViewAndGuarantee'>View/Guarantee</a> </font></td>
																</tr>";
				}
			}
			
		}
		try{
			$sql = "SELECT staffNumber FROM tblTempLoans WHERE firstGuarantor ='". $_SESSION['staffNumber']."'";
			//$even = "true";
			$result = mysql_query($sql,$db) or print("Could Not Be Executed 37 tblAccount SELECT  ". mysql_error($db));
			
			while($row = mysql_fetch_array($result))
			{
				$staff = $row['staffNumber'];
				if($staff != ''){
					$sql = "SELECT firstName, middleName, lastName FROM tblMembers WHERE staffNumber ='". $staff."'";
					//$even = "true";
					$result = mysql_query($sql,$db) or print("Could Not Be Executed 37 tblAccount SELECT  ". mysql_error($db));
					
					
					$guaranteeMembership = $guaranteeMembership."<tr>
		
																<td>
																	<font size='7' color='green'>Loan Guarantee Request(s).</font>
																</td>
															</tr>";
					while($row = mysql_fetch_array($result))
					{
						$staffName = $row['firstName'] . "  ".$row['middleName']."  ".$row['lastName'];
						$thereAre = true;
						$guaranteeMembership = $guaranteeMembership."<tr>
																		<td>
																			".
																				$taffName
																			."
																		</td>
																		<td align='right' >   <a href='' onclick='JavaScript:ViewAndGuarantee(".$staff.",2,2)' id='ViewAndGuarantee'>View/Guarantee</a> </font></td>
																	</tr>";
					}
				}
				
			}
			
			
			$sql = "SELECT staffNumber FROM tblTempMember WHERE firstGuarantor ='". $_SESSION['staffNumber']."'";
			//$even = "true";
			$result = mysql_query($sql,$db) or print("Could Not Be Executed 37 tblAccount SELECT  ". mysql_error($db));
			
			while($row = mysql_fetch_array($result))
			{
				$staff = $row['staffNumber'];
				if($staff != ''){
					$sql = "SELECT firstName, middleName, lastName FROM tblMembers WHERE staffNumber ='". $staff."'";
					//$even = "true";
					$result = mysql_query($sql,$db) or print("Could Not Be Executed 37 tblAccount SELECT  ". mysql_error($db));
					
					while($row = mysql_fetch_array($result))
					{
						$staffName = $row['firstName'] . "  ".$row['middleName']."  ".$row['lastName'];
						$thereAre = true;
						$guaranteeMembership = $guaranteeMembership."<tr>
																		<td>
																			".
																				$taffName
																			."
																		</td>
																		<td align='right' >   <a href='' onclick='JavaScript:ViewAndGuarantee(".$staff.",2)' id='ViewAndGuarantee'>View/Guarantee</a> </font></td>
																	</tr>";
					}
				}
				
			}
			
			$guaranteeMembership = $guaranteeMembership."</table>";
		}catch(Exception $e){

		}
					
	}else{
		//$entireError ="Wrong Username or Password!!!";
		header('location:index.php');
	}
	
?>
<html>
<head>
	<title>Member Home</title>
	<script type='text/javascript'>
		<!--
		function ViewAndGuarantee(staffNumber,number,request){
			
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
					document.forms['memberHome'].submit();
				}
			}
			//alert(routine);
			xmlhttp.open("GET", "SetGuarantee.php?toBe=" + staffNumber+"&num="+number+"&request="+request,true);
			xmlhttp.send();
			
		}
		-->
	</script>
</head>
<body>
	<form action="memberHome.php" method="POST" id="memberHome">
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
								<marquee direction = "left" scrollamount="2" loop="true" width ="500" bgcolor="#ff6728" >
											<h1>Welcome to Kaduna State University Staff Multi-Purpose Cooperative Society Limited Portal</h1></marquee><br />
							</td>
						</tr>
						
						
						<tr>
							<td >
								<table border ="1" width='800' align='center' style="outset:5pt;"><!-- body table-->
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
											<h3><a href="index.php"><img src='images/mainhome.png' alt='Main Home' /> </a>    <a href="loanApplication.php"><img src='images/loanapplication.png' alt='Loan Application' /> </a>   <a href="viewLoanStatus.php" ><img src='images/viewstatus.png' alt='View Loan Application Status' /> </a>    <!--<a href="guaranteeLoan.php"><img src='images/guaranteeloan.png' alt='Guarantee Loan' /> </a>   <a href="guaranteeMembership.php"><img src='images/guaranteemembership.png' alt='Guarantee Membership' /> </a>  -->   <a href="index.php"><img src='images/logout.png' alt='Logout' /> </a></h3>
										</td>
									</tr>
									<tr>
										<td height='10'></td><td height='10'></td>
									</tr>
									<tr>
										<td colspan='2'>
											<?php
												if($thereAre){
													print($guaranteeMembership);
												}
											?>	
										</td>
									</tr>
									
									
									<!--LOAN STATUS DETAILS BE PRINTED HERE!!!-->
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