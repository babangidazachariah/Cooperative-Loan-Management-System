<?php
SESSION_START();
	if($_GET['routine'] == "administrator"){
		$_SESSION['official'] = "Administrator";
		//header('location:officialLogin.php');
	}elseif($_GET['routine'] == "president"){
		$_SESSION['official'] = "President";
		//header('location:officialLogin.php');
	}elseif($_GET['routine'] == "treasurer"){
		$_SESSION['official'] = "Treasurer";
		//header('location:officialLogin.php');
	}elseif($_GET['routine'] == "financialSecretary"){
		$_SESSION['official'] = "Financial Secretary";
		//header('location:officialLogin.php');
	}elseif($_GET['routine'] == "secretary"){
		$_SESSION['official'] = "Secretary";
		//header('location:officialLogin.php');
	}
?>