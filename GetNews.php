<?php
	require_once 'connection.php';
	$sql = "SELECT newsHeading, newsBody, startDate, endDate, publisher FROM tblNews WHERE newsID =".$_GET['id'];

	$result = mysql_query($sql,$db) or print("Could Not Be Executed 37 tblAccount SELECT  ". mysql_error($db));
	while($row = mysql_fetch_array($result))
	{

	//Print('<font color="green" name="Arial" size="5"><b>'.strip_tags($row['newsHeading']).'</b></font><br />');
	Print('<font color="green" name="Arial" size="1">Published By: <b><em>'.$row['publisher'].'</em></b></font><br />');
	Print('<font color="green" name="Arial" size="1">Published Date: <b><em>'.$row['startDate'].'</em></b></font><p />');
	Print('<font color="black" name="Arial" size="3">'.strip_tags($row['newsBody']).'</font><p />');
	}
?>
