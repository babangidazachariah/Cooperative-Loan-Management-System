<?php
	
	$aboutus = "<tr>
					<td>
						<font size='5' color='green'>
						
							<b>History</b>
						
						</font>
						
KASU Staff Multipurpose Cooperative Society (KASUSMCS) was established in 2006 by 12 Senior Staff of the University. At that initial period, it was more of loose contributory programmed with members individually putting in two thousand every month. By the month of August 2006, this same group decided to review contributions to N5000 per person per month. These same contributions are then recycled among members as soft loans.
At the end of the year, the scheme was very impressive that by January 2007 many other Staff members decided to joint and number swelled to around 30. Envisaging the logistical problems that were bound to arise in administering this society, elections were held into various offices. Also, permission was sought from the University Management to formally register this society as a Cooperative. This was graciously granted through a letter dated 5TH June, 2007.
Thereafter, a move was initiated to effect savings/loans recoveries of members at source. This request the University Management also granted and this further gave the society credibility and a better footing for continuity and most importantly at the ability to recover loans granted to members. The initial teething problems of default was wiped off completely given that access has been granted to the society to member’s salary accounts by the direct deductions at source. 
A move was then initiated to register the society into a full-fledged Multipurpose Cooperative society. This was done after a careful but rigorous exercise of writing the bye laws clearly spells out the modus operandi of the society, delineating rules and activities of the various officers and defining the vision and mission of the cooperative.  
Presently, even though relatively new, the society has achieved a great measure of stability through the wealth of experience been brought to bear on it by the officers administering of   whom are Senior Staff. 
The Present chairman of the Cooperative is Shehu S. Makama, who is a Mathematician with the Mathematics department. 
The Secretary, Jeremiah Methuselah is with the department of English and Drama. 
The Treasurer, Mrs. Deborah Bijimi, as a Staff in Academic Planning.
Generally speaking, the society can be said to have achieved some measure of stability. It has granted members loans facilities for various projects and like we said earlier on, incidence of nonpayment has almost being wiped off given deductions at source. They have a monthly savings of close to a million while their loan recoveries are almost on the same level. The total membership presently stands at sixty, and growing. 


						
					</td>
				</tr>
				<tr>
					<td>
						<font size='5' color='green'>
						
						<!--Type Sub-heading Hear!!!-->
						
						</font>
						
						<!--Type Body of heading here-->
						
					</td>
				</tr>
				";
?>

<html>
<head>
<title>Home</title>
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
<script type="text/javascript">
<!--
	function InitializeNotify(){
		
		setTimeout(function Reset(){
			document.getElementById("notify").innerHTML ="";
			document.getElementById("staff").innerHTML ="";
			document.getElementById("pass").innerHTML ="";
		}, 7000);
	}
	
	
	
	function SubmitForm(id){
	
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
				if(document.getElementById("news"+id).innerHTML == ""){
					document.getElementById("news"+id).innerHTML = xmlhttp.responseText;
				}else{
					document.getElementById("news"+id).innerHTML =""
				}
			}
		}
		
		xmlhttp.open("GET", "GetNews.php?id=" + id, true);
		xmlhttp.send();
		
	}
	

//-->

</script>
</head>
<body onLoad="InitializeNotify()">
	<form action="index.php" method="POST" id='index'>
		<table align ="center" >
			
			<tr>
				<td width="20%" >
				
				</td>
			</tr>
			<tr>
				<td  width = "50%" align="center">
				
					<table style ="border-style: double; border-color: green; border-width: 4; width : 50% " bgcolor='' >
					
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
								<marquee direction = "right" scrollamount="2" loop="true" width ="500" bgcolor="#ff6728" >
											<h1>Welcome to Kaduna State University Staff Multi-Purpose Cooperative Society Limited Portal</h1></marquee><br />
							</td>
						</tr>
						
						<tr>
						<!-- Menu row-->
							<td align ="center" bgcolor="green" colspan='3'> 
								<h2><a href="index.php">Home </a>  ||  <a href="officialLogin.php">Official </a>  ||  <a href="contactUs.php">Contact Us</a>  || <a href="aboutUs.php">About Us </a></h2>
							</td>
						</tr>
						<tr>
							<td align="center" colspan ="3">
								
							</td>	
						</tr>	
						<tr>
							<td align="right">
								<table width='300' align='justify' style ="border-style: double; border-color: #ff6728; border-width: 4;"><!-- body table-->
									<tr>
										<td colspan='2'><font color="green" name="Arial" size="5"><b><u>Read Our Latest News!!!</u></b></font>
										
										</td>
									</tr>
									<tr>
									<td align="justify">
										<?php
											require_once 'connection.php';
											$sql = "SELECT newsID, newsHeading FROM tblNews WHERE DATE(startDate) < ". date('Y-m-d') ." OR DATE(endDate) > ". date('Y-m-d');
					
											$result = mysql_query($sql,$db) or print("Could Not Be Executed 37 tblAccount SELECT  ". mysql_error($db));
											while($row = mysql_fetch_array($result))
											{

												Print('<font color="green" name="Arial" size="4"><b><a href="JavaScript:SubmitForm('.$row['newsID'].')" >'.strip_tags($row['newsHeading']).'</a></b></font><br /><div id="news'.$row['newsID'].'"></div>');
												//Print('<font color="blue" name="Arial" size="2">Published By: <b><em>'.$row['publisher'].'</em></b></font><br />');
												//Print('<font color="blue" name="Arial" size="2">Published Date: <b><em>'.$row['startDate'].'</em></b></font><p />');
												//Print('<font color="black" name="Arial" size="4"><b>'.strip_tags($row['newsBody']).'</b></font><p />');
											}
										?>
										
										
										
									</td>
								</tr>
								<tr>
									<td width="40%" align="justify">
										


											
										
									</td>
								</tr>
								</table>
							</td>
							<td>
								<table bgcolor='silver' border="1" width="650" style ="border-style: double; border-color: green; border-width: 4;">
									
									
									<?php
										print($aboutus);
									?>
								</table>
								
							</td>
							<tr>
								<td>
									<a rel="nofollow" class="external text" href="http://www.kasu.edu.ng/">KASU Official website</a>
											
								</td>
							</tr>
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