<?php
SESSION_START();
	if(isset($_POST['submit'])){
		$isError = "false";
		if(empty($_SESSION['firstGuarantor'])){
			$firstGuarantorError ="Cannot be NULL!!!";
			$isError = "true";
		}
		
		if(empty($_SESSION['secondGuarantor'])){
			$secondGuarantorError ="Cannot be NULL!!!";
			$isError = "true";
		}
		
		if($isError == "false"){
			
			$Sql ="INSERT INTO tblTempMembers (staffNumber, firstGuarantor,secondGuarantor) Values('".$staffNumber."','".$_POST['firstGuarantor']."','".$_POST['secondGuarantor']."')";
			$result = mysql_query($Sql,$db) or die("Could Not Be Executed 41 tblMembers INSERT". mysql_error($db));
		
			header("location:memberHome.php");
			//+header("location:uploadPassport.php");
		}
	}elseif(isset($_POST['cancel'])){
		header("location:memberHome.php");
	}
?>
<html>
<head>
	<title>Guarantor Request</title>
	<script type='text/javascript'>
		<!--
		function ViewAndGuarantee(staffNumber,number){
			
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
			xmlhttp.open("GET", "SetGuarantee.php?toBe=" + staffNumber+"&num="+number,true);
			xmlhttp.send();
			
		}
		-->
	</script>
</head>
<body>
	<form action="requestMembershipGuarantor.php" method="POST" id="requestMembershipGuarantor">
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
								<table border ="1" width='800' align='center' style="outset:5pt;" bgcolor="silver"><!-- body table-->
									<tr>
										<td colspan ="3" bgcolor="green" align="center" >
											<font color='white' size='7'><b>Membership Guarantor Request Form</b></font>
										</td>
									</tr>
									
									<tr>
										<td  align="right" >
											<b>First Guarantor Staff Number :</b>
										</td>
										<td  align="left" >
											<input name ='firstGuarantor' id ='firstGuarantor' type='text' />
										</td>
										<td  align="left" id='firstGuarantorError'>
											<font color="red" name="Arial" size="4">* 
												<?php
													print($firstGuarantorError);
												?>
											</font>
										</td>
									</tr>
									
									<tr>
										<td  align="right" >
											<b>Second Guarantor Staff Number :</b>
										</td>
										<td  align="left" >
											<input name ='secondGuarantor' id ='secondGuarantor' type='text' />
										</td>
										<td  align="left" id='secondGuarantorError'>
											<font color="red" name="Arial" size="4">* 
												<?php
													print($secondGuarantorError);
												?>
											</font>
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
		<div>
			<img src="Images/footer.png" width="100%" height="50" alt="Footer Image" />
		</div>
	</form>
</body>
</html>