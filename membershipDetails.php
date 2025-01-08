<?php
SESSION_START();
	if($_SESSION['registered'] != 1){
		header('location:index.php');
	}
	
	if(isset($_POST['submit'])){
		$isError = "false";
		if(empty($_SESSION['staffNumber'])){
			$staffNumberError ="Cannot be NULL!!!";
			$isError = "true";
		}
		
		if(empty($_POST['fName'])){
			$fNameError ="Cannot be NULL!!!";
			$isError = "true";
		}
		
		if(empty($_POST['lName'])){
			$lNameError ="Cannot be NULL!!!";
			$isError = "true";
		}
		
		if(empty($_POST['phone'])){
			$phoneError ="Cannot be NULL!!!";
			$isError = "true";
		}
		
		if(empty($_POST['gender'])){
			$genderError ="Cannot be NULL!!!";
			$isError = "true";
		}
		if(empty($_POST['rank'])){
			$rankError ="Cannot be NULL!!!";
			$isError = "true";
		}
		if(empty($_POST['department'])){
			$departmentError ="Cannot be NULL!!!";
			$isError = "true";
		}
		if(empty($_POST['monthlyContribution'])){
			$monthlyContributionError ="Cannot be NULL!!!";
			$isError = "true";
		}
		if(empty($_POST['gradeLevel'])){
			$gradeError ="Cannot be NULL!!!";
			$isError = "true";
		}
		
		if($isError == "false"){
		
			$staffNumber = trim($_SESSION['staffNumber']);
			$fname = trim($_POST['fName']);
			$mname = trim($_POST['mName']);
			$lname = trim($_POST['lName']);
			$rank = trim($_POST['rank']);
			$monthlyContribution = trim($_POST['monthlyContribution']);
			$grade = trim($_POST['gradeLevel']);
			$department = $_POST['department'];
			$gender = $_POST['gender'];
			$phone = $_POST['phone'];
			$number = 0;
			require_once 'connection.php';
			try{
			
				$sql = "SELECT * FROM tblMembers WHERE staffNumber ='" .$staffNumber ."'";
				///require_once 'connection.php';
				$result = mysql_query($sql,$db) or die("Could Not Be Executed tblAccount SELECT  ". mysql_error($db));
			}catch(Exception $e) {
				//die("Could Not Be Executed 37 tblAccount SELECT  ". mysql_error($db));
			}		 
			if(mysql_num_rows($result) < 1){ 
			
				$sql = "SELECT number FROM tblDepartments WHERE departmentCode ='" .$department ."'";
				require_once 'connection.php';
				//$result = mysql_query($sql,$db) or die("Could Not Be Executed tblDepartments SELECT  ". mysql_error($db));
				while($row = mysql_fetch_array($result))
				{
					$number = $row['number'];
				}
				
				$number += 1;
				$memberNumber ="KASU/". $department. "/".$number;
				
				$sql = "UPDATE tblDepartments  SET number =". $number." WHERE departmentCode ='" .$department ."'";
				//require_once 'connection.php';
				$result = mysql_query($sql,$db) or die("Could Not Be Executed 37 tblDepartments SELECT  ". mysql_error($db));
				$_SESSION['memberNumber'] = $memberNumber;
				$_SESSION['fullName'] = $fname . " ". $name ." ". $lname;
				
				$Sql ="INSERT INTO tblMembers (staffNumber, memberNumber,firstName,middleName, lastName, phoneNumber, gender, rank, department, monthlyContribution, grade) Values('".$staffNumber."','".$memberNumber."','".$fname."','".$mname."','".$lname."','".$phone."','".$gender."','".$rank."','".$department."',".$monthlyContribution.",'".$grade."')";
				$result = mysql_query($Sql,$db) or die("Could Not Be Executed 41 tblMembers INSERT". mysql_error($db));
				$_SESSION['allowed'] = 1;
				header('location:uploadPassport.php');	
					
			}else{
				$entireError ="Account Already Created. <a href='index.php'>Login</a> instead!!!";
			}
		}else{
			$entireError ="There was problem receiving you data. Please try again!!!";
		}
	}elseif(isset($_POST['cancel'])){
		//check if user previousely have filled this form. or better still he may have to login again.
		header('location:index.php');
	}

?>
<html>
<head>
	<title>Membership Details</title>
</head>
<body>
	<form action="membershipDetails.php" method="POST" id="membershipDetails">
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
							<!-- Menu row-->
								<td align ="center" bgcolor="green" colspan='3'> 
									<h2><a href="index.php">Home </a>  ||  <a href="officialLogin.php">Official </a> ||  <a href="contactUs.php">Contact Us</a>  || <a href="aboutUs.php">About Us </a></h2>
								</td>
							</tr>
								
							<tr>
								<td >
									<table border ="1" width='800' align='center'><!-- body table-->
										<tr>
											<td colspan ="3" bgcolor="green" align='center'><!-- body table First Column-->
												<font color="white" name="Arial" size="7"><b>Membership Application Details</b></font>
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
													<input type='text' width='100' name = 'staffNumber' cols='100' value =" <?php print($_SESSION['staffNumber']); ?> " disabled ="disabled">
													
													
												</td>
												<td>
													<font color="red" name="Arial" size="4">* <?php Print($staffNumberError); ?></font>
												</td>
											
										</tr>
										
										<tr>
											
												<td   align="right" ><!-- body table First Column-->
													<font color="black" name="Arial" size="4"><b>First Name  :</b></font>
												</td>
												<td>
													<input type="text" cols="30" name="fName" id="fName" onBlur='InitializeError("fName","fnameError")' />
													
												</td>
												<td >
													<font color="red" name="Arial" size="4">*</font>
													<font color="red" name="Arial" size="4" id="fnameError"><?php print($fNameError);?></font><!-- institution error-->
												</td>
											
										</tr>
										
										<tr>
										
											<td   align="right" ><!-- body table First Column-->
												<font color="black" name="Arial" size="4"><b>Middle Name  :</b></font>
											</td>
											<td>
												<input type="text" cols="30" name="mName" id="mName" />
												
											</td>
											
										</tr>
										 
										<tr>
											
												<td   align="right" ><!-- body table First Column-->
													<font color="black" name="Arial" size="4"><b>Last Name  :</b></font>
												</td>
												<td>
													<input type="text" cols="30" name="lName" id="lName" onBlur='InitializeError("lName","lnameError")' />
													
												</td>
												<td >
													<font color="red" name="Arial" size="4">*</font>
													<font color="red" name="Arial" size="4" id="lnameError"><?php print($lNameError);?></font><!-- institution error-->
												</td>
											
										</tr>
										<tr>
											
												<td   align="right" ><!-- body table First Column-->
													<font color="black" name="Arial" size="4"><b>Phone Number  :</b></font>
												</td>
												<td>
													<input type="text" cols="30" name="phone" id="phone" onBlur='InitializeError("phone","phoneError")' />
													
												</td>
												<td >
													<font color="red" name="Arial" size="4">*</font>
													<font color="red" name="Arial" size="4" id="phoneError"><?php print($phoneError);?></font><!-- institution error-->
												</td>
											
										</tr>
										<tr>
											
												<td   align="right" ><!-- body table First Column-->
													<font color="black" name="Arial" size="4"><b>Gender  :</b></font>
												</td>
												<td>
													<select name="gender" id="gender" onBlur='InitializeError("gender","genderError")'> 
														<option value="">Select Gender</option>
														<option value="M">Male</option>
														<option value="F">Female</option>
													</select>
												</td>
												<td>
													<font color="red" name="Arial" size="4">*</font>
													<font color="red" name="Arial" size="4" id="genderError"><?php print($genderError);?></font><!-- institution error-->
												</td>
											<td height='10'></td>
										</tr>
										<tr>
											
												<td   align="right" ><!-- body table First Column-->
													<font color="black" name="Arial" size="4"><b>Rank :</b></font>
												</td>
												<td>
													<input type='text' width='100' name = 'rank' id = 'rank' >
													
													
												</td>
												<td>
													<font color="red" name="Arial" size="4">* <?php Print($rankError); ?></font>
												</td>
											
										</tr>
										<tr>
												<td   align="right" ><!-- body table First Column-->
													<font color="black" name="Arial" size="4"><b>Department :</b></font>
												</td>
												<td>
													<select name = 'department'><option value=''>Select Department</option>
													<!--PHP code to display institution here-->
													<?php
														require_once "connection.php";
														$sql ="SELECT departmentCode, departmentName FROM tblDepartments";
														$result = mysql_query($sql,$db) or die("Could Not Be Executed");
														while($row = mysql_fetch_array($result))
																{

																	Print("<option value ='" . $row['departmentCode'] ."'> " .$row['departmentName'] ." </option>");

																}
													?>
													
												</td>
												<td>
													<font color="red" name="Arial" size="4">* <?php print($departmentError);?></font><!-- institution error-->
												</td>
											
										</tr>
										<tr>
											
												<td   align="right" ><!-- body table First Column-->
													<font color="black" name="Arial" size="4"><b>Monthly Contribution (<strike>N</strike>) :</b></font>
												</td>
												<td>
													<input type='text' width='100' name = 'monthlyContribution' id = 'monthlyContribution' >
													
													
												</td>
												<td>
													<font color="red" name="Arial" size="4">* <?php Print($monthlyContributionError); ?></font>
												</td>
											
										</tr>
										<tr>
											
												<td   align="right" ><!-- body table First Column-->
													<font color="black" name="Arial" size="4"><b>Grade Level :</b></font>
												</td>
												<td>
													<input type='text' width='100' name = 'gradeLevel' id = 'gradeLevel' >
													
													
												</td>
												<td>
													<font color="red" name="Arial" size="4">* <?php Print($gradeError); ?></font>
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