<?php
SESSION_START();
	if($_SESSION['allow'] == 1){
		if(isset($_POST['upload'])){
			//print("entered successfully");
			if(!empty($_SESSION['memberNumber'])){
				$memberNumber = $_SESSION['memberNumber'];
			}else{
				header("location:index.php");
			}
			if(!empty($_FILES['uploadfile'])){
				require_once'connection.php';
				
				//change this path to match your images directory
				$dir ="C:/wamp/www/Cooperative/passport";
				//make sure the uploaded file transfer was successful
				if ($_FILES['uploadfile']['error'] != UPLOAD_ERR_OK) {
				
					switch ($_FILES['uploadfile']['error']) {
						case UPLOAD_ERR_INI_SIZE:
							$passportError = 'The uploaded file exceeds the upload_max_filesize directive in php.ini.';
							die();
							break;
						case UPLOAD_ERR_FORM_SIZE:
							$passportError = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.';
							die();
							break;
						
						case UPLOAD_ERR_PARTIAL:
							$passportError = 'The uploaded file was only partially uploaded.';
							die();
							
							break;
						case UPLOAD_ERR_NO_FILE:
							$passportError = 'No file was uploaded.';
							die();
							break;
						case UPLOAD_ERR_NO_TMP_DIR:
							$passportError ='The server is missing a temporary folder.';
							die();
							break;
						case UPLOAD_ERR_CANT_WRITE:
							$passportError = 'The server failed to write the uploaded file to disk.';
							die();
							break;
						case UPLOAD_ERR_EXTENSION:
							$passportError = 'File upload stopped by extension.';
							die();
							break;
					}
				}
				//get info about the image being uploaded
				//$password = $_POST['password'];
				//$userName = $_POST['username'];
				$imageDate = date('Y-m-d');
				list($width, $height, $type, $attr) = getimagesize($_FILES['uploadfile']['tmp_name']);
				// make sure the uploaded file is really a supported image
				$image = "";
				$ext ="";
				switch ($type) {
					case IMAGETYPE_GIF:
						try{
							$image = imagecreatefromgif($_FILES['uploadfile']['tmp_name']);
							$ext = '.gif';
						}catch(Exception $e) {
							//echo $e->getMessage();
							//echo 'Sorry, could not upload file';
							$passportError = 'The file you uploaded was not a supported filetype.';
							die();
							}
						break;
					case IMAGETYPE_JPEG:
						try{
							$image = imagecreatefromjpeg($_FILES['uploadfile']['tmp_name']);
							//print($image);
							$ext = '.jpg';
						}catch(Exception $e) {
							//echo $e->getMessage();
							//echo 'Sorry, could not upload file';
							$passportError = 'The file you uploaded was not a supported filetype.';
							die();
						}
						break;
					case IMAGETYPE_PNG:
						try{
							$image = imagecreatefrompng($_FILES['uploadfile']['tmp_name']);
							$ext = '.png';
						}catch(Exception $e) {
							//echo $e->getMessage();
							//echo 'Sorry, could not upload file';
							$passportError = 'The file you uploaded was not a supported filetype.';
							die();
						}
						break;
					default:
						$passportError = 'The file you uploaded was not a supported filetype.';
						die();
				}
				//insert information into image table
				$query = "INSERT INTO tblPassports (memberNumber, uploadDate) VALUES ('" . $memberNumber. "','" . $imageDate ."')";
				$result = mysql_query($query, $db) or die (mysql_error($db));
				//print("inserted successfully");
				//retrieve the image_id that MySQL generated automatically when we inserted
				//the new record
				$last_id = mysql_insert_id();
				//because the id is unique, we can use it as the image name as well to make
				//sure we don't overwrite another image that already exists
				$imagename = $last_id. $ext;
				// update the image table now that the final filename is known.
				$query = "UPDATE tblPassports SET passportName = '" . $imagename . "'	WHERE passportID = " . $last_id;
				$result = mysql_query($query, $db) or die (mysql_error($db));
				//print("updated successfully");
				//save the image to its final destination
				switch ($type) {
					case IMAGETYPE_GIF:
						imagegif($image, $dir . '/' . $imagename);
						break;
					case IMAGETYPE_JPEG:
						imagejpeg($image, $dir . '/' . $imagename, 100);
						//print("Success");
						break;
					case IMAGETYPE_PNG:
						imagepng($image, $dir . '/' . $imagename);
						break;
				}
				
				imagedestroy($image);
				header("location:requestMembershipGuarantor.php");
				//header("location:memberHome.php");
			}else{
				$passportError ="Select/Browse Passport First!!!";
				
			}
			
		}
	}
?>
	



<html>
<head>
<style>
	  #progress_bar {
		margin: 10px 0;
		padding: 3px;
		border: 1px solid #000;
		font-size: 14px;
		clear: both;
		opacity: 0;
		-moz-transition: opacity 1s linear;
		-o-transition: opacity 1s linear;
		-webkit-transition: opacity 1s linear;
	  }
	  #progress_bar.loading {
		opacity: 1.0;
	  }
	  #progress_bar .percent {
		background-color: #99ccff;
		height: auto;
		width: 0;
	  }
	</style>

	<script>
		<!--
			function SetImg(){
				document.getElementById("passport").innerHTML = ['<img height="150px" width="200px" class="thumb" src="', 'Images/icon_photo.png',
								'" title="', escape("Images/icon_photo.png"), '"/>'].join('');
			
			}
		-->
	</script>

	
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="media/css/demos.css" />
		<link rel="stylesheet" type="text/css" href="media/css/alert.css" />
		
		<script type="text/javascript" src="media/js/js-core.js"></script>
		<script type="text/javascript" src="media/js/alert.js"></script>
<script type="text/JavaScript">
	function CheckImage(){
		
	}
</script>

</head>
<body onload='SetImg()'>
	<form action="uploadPassport.php" method="POST" enctype="multipart/form-data">
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
								<td align="center" colspan ="3"><br /><p />
										
								</td>	
							</tr>	
							<tr>
							<tr>
								<td>
								</td>
								
								<td>
								</td>
								<td rowspan ="10" > <!-- body table First Column-->
									
								</td>
							
							</tr>
							<tr>
								<td >
									<table width='800' align='center'bgcolor='silver'> <!-- body table-->
										<tr>
											<td colspan ="3" bgcolor="green" align='center'> <!-- body table First Column -->
												<font color="white" name="Arial" size="10"><b>Member's Passport</b></font>
											</td>
										</tr>
										
										<tr>
											<td colspan ="3" bgcolor="green" > <!-- body table First Column-->
												<font color="red" name="Arial" size="8"><?php print($passportError); ?><!-- display success or error message--></font>
											</td>
										</tr>
										
										<tr>
											<td colspan ="3" bgcolor="green" align="right" ><!-- body table First Column-->
												<!-- an empty row here!!!-->
											</td>
										</tr>
										
										
										<tr>
							
											<td colspan="3" height="20px" align="center"><br /><p />
												<font color="green"><b>Upload Passport Here!!!</b></font>
											</td>
										</tr>
										<tr>
											<td id="passport" border="2" colspan="3"  align="center"><br /><p />
												
											</td>
										</tr>
										<tr>
							
											<td colspan="3" height="20px" align="center">
												<font color="red"><b>Must be 2MB or less</b></font>
											</td>
										</tr>
										<tr>
											<td align="center" colspan="3">
												<input type="file" id="uploadfile" name="uploadfile" />
												<!--<button onclick="abortRead();">Cancel read</button>-->
												<div id="progress_bar"><div class="percent">0%</div></div>

												<script>
												  var reader;
												  var progress = document.querySelector('.percent');

												  function abortRead() {
													reader.abort();
												  }

												  function errorHandler(evt) {
													switch(evt.target.error.code) {
													  case evt.target.error.NOT_FOUND_ERR:
														alert('File Not Found!');
														break;
													  case evt.target.error.NOT_READABLE_ERR:
														alert('File is not readable');
														break;
													  case evt.target.error.ABORT_ERR:
														break; // noop
													  default:
														alert('An error occurred reading this file.');
													};
												  }

												  function updateProgress(evt) {
													// evt is an ProgressEvent.
													if (evt.lengthComputable) {
													  var percentLoaded = Math.round((evt.loaded / evt.total) * 100);
													  // Increase the progress bar length.
													  if (percentLoaded < 100) {
														progress.style.width = percentLoaded + '%';
														progress.textContent = percentLoaded + '%';
													  }
													}
												  }

												  function handleFileSelect(evt) {
													
													// Reset progress indicator on new file selection.
													progress.style.width = '0%';
													progress.textContent = '0%';

													reader = new FileReader();
													reader.onerror = errorHandler;
													reader.onprogress = updateProgress;
													reader.onabort = function(e) {
													  alert('File read cancelled');
													};
													reader.onloadstart = function(e) {
													  document.getElementById('progress_bar').className = 'loading';
													};
														reader.onload = function(e) {
															  // Ensure that the progress bar displays 100% at the end.
															  progress.style.width = '100%';
															  progress.textContent = '100%';
															  setTimeout("document.getElementById('progress_bar').className='';", 2000);
														};
														// Read in the image file as a binary string.
														reader.readAsBinaryString(evt.target.files[0]);
														// Loop through the FileList and render image files as thumbnails.
														var files = evt.target.files; // FileList object
														for (var i = 0, f; f = files[i]; i++) {
															//alert("Here");
														  // Only process image files.
															 if (!f.type.match('image.*')) {
																continue;
															 }

															var readerImage = new FileReader();

															  // Closure to capture the file information.
															 readerImage.onload = (function(theFile) {
																return function(e) {
																  // Render thumbnail.
																  document.getElementById("passport").innerHTML = ['<img height="150px" width="200px" class="thumb" src="', e.target.result,
																	'" title="', escape(theFile.name), '"/>'].join('');
																
																};
															})(f);

															  // Read in the image file as a data URL.
															 readerImage.readAsDataURL(f);
														}
													
												  }

												  document.getElementById('uploadfile').addEventListener('change', handleFileSelect, false);
												</script>
											</td>
										</tr>
										
										<tr>
											<td  align="right" width='300' ><!-- body table First Column-->
													<font color="black" name="Arial" size="4" ><b></b></font>
												</td>
												<td>
												<button type='submit'  width='6000' id="upload" name = 'upload' height='5000' > <img src="Images/upload.png" alt ="UPLOAD" /></button>
													
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
			</tr>
		</table>
		
	</form>
</body>
</html>