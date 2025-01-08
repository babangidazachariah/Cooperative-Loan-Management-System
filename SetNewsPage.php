<?php
SESSION_START();
	if($_GET['page'] == "edit"){
		$_SESSION['pageStatus'] = "Edit";
		$_SESSION['iden'] = $_GET['digit'];
		//header('location:officialLogin.php');
	}elseif($_GET['page'] == "delete"){
		$_SESSION['pageStatus'] = "Delete";
		$_SESSION['iden'] = $_GET['digit'];
		//header('location:officialLogin.php');
	}elseif($_GET['page'] == "new"){
		$_SESSION['pageStatus'] = "New";
		//$_SESSION['iden'] = $_GET['digit'];
		//header('location:officialLogin.php');
	}
	
?>