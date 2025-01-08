<?php
SESSION_START();
	if($_SESSION['allowed'] == 1 &&  $_SESSION['staffNumber'] != ""){
		
		require_once 'connection.php';
		
		//a table to display loan status!
		$loanRow = "<table border='1' style ='border-style: double; border-color: #ff6728; border-width: 4; width : 100% '>
			<tr><td colspan='8' bgcolor='green' align='center'><font color='white' name='Arial' size = '6'>
			<b>Loan Application Status</b>  
			</td></tr>
			<tr><font color='blue' name='Arial' size = '4'><td><font color='blue' name='Arial' size = '4'>
			<b>App. No.</b></td><td><b><font color='blue' name='Arial' size = '4'>
			<B>First Guarantor</b></td><td><b><font color='blue' name='Arial' size = '4'>
			<b>Second Guarantor</b></font></td><td><b><font color='blue' name='Arial' size = '4'>
			<b>President</b></font></td></td><td><b><font color='blue' name='Arial' size = '4'>
			<b>Treasurer</b></font></td></td><td><b><font color='blue' name='Arial' size = '4'>
			<b>Fin. Sec.</b></font></td></td><td><b><font color='blue' name='Arial' size = '4'>
			<b>Balance</b></font></td></td><td><b><font color='blue' name='Arial' size = '4'>
			<b>Status</b></font></td></tr>";
	
		$sql = "SELECT * FROM tblLoans WHERE borrower ='". $_SESSION['staffNumber']."'";
		$result = mysql_query($sql,$db) or print("Could Not Be Executed 37 tblAccount SELECT  ". mysql_error($db));
		while($row = mysql_fetch_array($result))
		{
			
			$loanRow = $loanRow ."<tr><td>".$row['loanID']."</td><td>".$row['guarantorOne']."</td><td>".$row['guarantorTwo']."</td><td>"
			.$row['president']."</td><td>".$row['treasurer']."</td><td>".$row['financialSecretary']."</td><td>"
			.$row['balance']."</td><td>".$row['status']."</td></tr></table>";
		}
		//print($fullName);
	
	}else{
		//$entireError ="Wrong Username or Password!!!";
		header('location:index.php');
	}
?>
<html>
<head>
	<title>Loan Status</title>
	<script type="text/javascript">
		function Close()
		{
			document.getElementById("loanRow").innerHTML ="";
		}
	</script>
</head>
<body>
	<form action="memberHome.php" method="POST" id="memberHome">
		<table align ="center" >
			
			<tr>
				<td width="15%" >
				
				</td>
			
			
				<td  width = "70%" align="center">
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
											<h3><a href="index.php"><img src='images/mainhome.png' alt='Main Home' /> </a>    <a href="loanApplication.php"><img src='images/loanapplication.png' alt='Loan Application' /> </a>   <a href="viewLoanStatus.php" ><img src='images/viewstatus.png' alt='View Loan Application Status' /> </a>    <a href="guaranteeLoan.php"><img src='images/guaranteeloan.png' alt='Guarantee Loan' /> </a>   <a href="guaranteeMembership.php"><img src='images/guaranteemembership.png' alt='Guarantee Membership' /> </a>     <a href="index.php"><img src='images/logout.png' alt='Logout' /> </a></h3>
										</td>
									</tr>
									<tr>
										<td height='10'></td><td height='10'></td>
									</tr>
									<tr>
										<td id="loanRow">	<?php if($loanRow != ""){
																	print($loanRow);
																	$loanRow = "";
																} ?></td>
									</tr>
									
								</table>
							</td>
							<td>
							
							</td>
						</tr>
					</table>
				</td>
			
				<td width="15%">
				
				</td>
			</tr>
		</table>
		<div>
			<img src="Images/footer.png" width="100%" height="50" alt="Footer Image" />
		</div>
	</form>
</body>
</html>