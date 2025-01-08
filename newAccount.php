<?php
SESSION_START();
	if(isset($_POST['submit'])){
	$isError = "false";
		if(empty($_POST['staffNumber'])){
			$staffNumberError ="Cannot be NULL!!!";
			$isError = "true";
		}
		
		if(empty($_POST['email'])){
			$emailError ="Cannot be NULL!!!";
			$isError = "true";
		}
		
		if(empty($_POST['password'])){
			$passwordError ="Cannot be NULL!!!";
			$isError = "true";
		}
		
		if(empty($_POST['confirmPassword'])){
			$confirmPasswordError ="Cannot be NULL!!!";
			$isError = "true";
		}
		if(!($_POST['confirmPassword'] == $_POST['password'])){
			$entireError = "Password Mismatch";
			$isError = "true";
		}
		if($isError == "false"){
		
			$staffNumber = trim($_POST['staffNumber']);
			$email = trim($_POST['email']);
			$password = trim($_POST['password']);
			//$_SESSION['staffNumber'] = $staffNumber;
			//$_SESSION['allow'] = 1;
			//require_once 'Connection.php';
			try{
			
				$sql = "SELECT staffNumber FROM tblAccount WHERE staffNumber ='" .$staffNumber ."' OR email ='". $email ."'";
				require_once 'connection.php';
				$result = mysql_query($sql,$db) or die("Could Not Be Executed 37 tblAccount SELECT  ". mysql_error($db));
			}catch(Exception $e) {
				//die("Could Not Be Executed 37 tblAccount SELECT  ". mysql_error($db));
			}		
			if(mysql_num_rows($result) < 1){ //account is not in database, so we allow.
				$Sql ="INSERT INTO tblAccount (staffNumber, email, password) Values('".$staffNumber."','".$email."','".$password."')";
				$result = mysql_query($Sql,$db) or die("Could Not Be Executed 41 tblAccount INSERT". mysql_error($db));
				$_SESSION['registered'] = 1;
				$_SESSION['staffNumber'] = $staffNumber;
				header('location:membershipDetails.php');	
					
			}else{
				$entireError ="Account Already Created. <a href='index.php'>Login</a> instead!!!";
			}
			
		}
	}elseif(isset($_POST['cancel'])){
	
		header('location:index.php');
	}
?>
<html>
<head>
	<title>Create New Accoung</title>
</head>
<body>
	<form action="newAccount.php" method="POST" id="newAccount">
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
								<marquee direction = "right" scrollamount="2" loop="true" width ="500" bgcolor="#ff6728" >
											<h1>Welcome to Kaduna State University Staff Multi-Purpose Cooperative Society Limited Portal</h1></marquee><br />
							</td>
						</tr>
						
						<tr>
							<!-- Menu row-->
								<td align ="center" bgcolor="green" colspan='3'> 
									<h2><a href="index.php">Home </a>  ||  <a href="officialLogin.php">Official </a> || <a href="aboutUs.php">About Us </a></h2>
								</td>
							</tr>
								
							<tr>
								<td >
									<table border ="1" width='800' align='center'><!-- body table-->
										<tr>
											<td colspan ="3" bgcolor="green" align='center'><!-- body table First Column-->
												<font color="white" name="Arial" size="7"><b>Create New Account</b></font>
											</td>
										</tr>
										<tr>
											<td colspan ="3" bgcolor="green" align ='center'><!-- body table First Column-->
												<font color="white" name="Arial" size="5"><i>Fields marked with <font color="red" name="Arial" size="6">* <!-- display success or error message--></font> must be provided</i></font>
											</td>
										</tr>
										<tr>
											<td colspan ="3" bgcolor="green" ><!-- body table First Column-->
												<font color="red" name="Arial" size="6"><?php print($entireError); ?><!-- display success or error message--></font>
											</td>
										</tr>
										<tr>
											<td colspan ="3" bgcolor="green" align="right" ><!-- body table First Column-->
												<!-- an empty row here!!!-->
											</td>
										</tr>
										<tr>
											
												<td   align="right" ><!-- body table First Column-->
													<font color="black" name="Arial" size="4"><b>Staff Number :</b></font>
												</td>
												<td>
													<input type='text' width='100' name = 'staffNumber' cols='100'>
													
													<font color="red" name="Arial" size="4">*</font>
												</td>
												<td>
													<font color="red" name="Arial" size="4"><?php Print($staffNumberError); ?></font>
												</td>
											
										</tr>
										
										<tr>
											
												<td   align="right" ><!-- body table First Column-->
													<font color="black" name="Arial" size="4"><b>E-Mail :</b></font>
												</td>
												<td>
													<input type='text' width='30' name = 'email' >
													
													<font color="red" name="Arial" size="4">*</font>
												</td>
												<td>
													<font color="red" name="Arial" size="4"><?php print($emailError); ?> </font><!-- institution error-->
												</td>
											
										</tr>
										
										<tr>
											<td  align="right" width='300' ><!-- body table First Column-->
													<font color="black" name="Arial" size="4" ><b>Password :</b></font>
												</td>
												<td>
												<input type='password'  name = 'password' cols='30' height='5' text='' /> 
													
													<font color="red" name="Arial" size="4">*</font>
												</td>
												<td>
													<font color="red" name="Arial" size="4"><?php print($passwordError);?></font><!-- institution error-->
												</td>
											
										</tr>
										<tr>
											<td  align="right" width='300' ><!-- body table First Column-->
													<font color="black" name="Arial" size="4" ><b>Confirm Password :</b></font>
												</td>
												<td>
												<input type='password'  name = 'confirmPassword' cols='30' height='5' text='' /> 
													
													<font color="red" name="Arial" size="4">*</font>
												</td>
												<td>
													<font color="red" name="Arial" size="4"><?php print($confirmPasswordError);?></font><!-- institution error-->
												</td>
											
										</tr>
										<tr>
											<td height='10'></td><td height='10'></td>
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