<?php 
SESSION_START();
	if($_GET['page'] == "loans"){
		$_SESSION['task'] = "loans";
		//print("Loans Here!!!");
		//$_SESSION['iden'] = $_GET['digit'];
		//header('location:officialLogin.php');
	}elseif($_GET['page'] == "newNews"){
		$_SESSION['task'] = "New News";
		//$_SESSION['iden'] = $_GET['digit'];
		//header('location:officialLogin.php');
	}elseif($_GET['page'] == "News"){
		$_SESSION['task'] = "News";
		//print("News Here!!!");
		//$_SESSION['iden'] = $_GET['digit'];
		//header('location:officialLogin.php');
	}elseif($_GET['page'] == "Edit"){
		$_SESSION['task'] = "Edit";
		$_SESSION['iden'] = $_GET['digit'];
		//header('location:officialLogin.php');
	}elseif($_GET['page'] == "Delete"){
		$_SESSION['task'] = "Delete";
		$_SESSION['iden'] = $_GET['digit'];
		//header('location:officialLogin.php');
	}elseif($_GET['page'] == "Approve"){
		$_SESSION['task'] = "Approved";
		$_SESSION['iden'] = $_GET['digit'];
	}elseif($_GET['page'] == "Disapprove") {
		$_SESSION['task'] = "Disapproved";
		$_SESSION['iden'] = $_GET['digit'];
		
	}elseif($_GET['page'] == "deductions") {
		$_SESSION['task'] = "Deductions";
		
	}
?> 