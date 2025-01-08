<?php 

	
		$db = mysql_connect("localhost","root") or die ('Unable to connect. Check your connection parameters.');
		$sql= "CREATE DATABASE IF NOT EXISTS Cooperative";
		mysql_query($sql, $db) or die(mysql_error($db));
		//make sure our recently created database is the active one
		mysql_select_db('Cooperative', $db) or die(mysql_error($db));
		
		$sql = "CREATE TABLE IF NOT EXISTS tblMembers (
			memID INTEGER NOT NULL AUTO_INCREMENT,
			staffNumber VARCHAR(15) NOT NULL, 
			memberNumber VARCHAR(15) NOT NULL,
			 
			firstName VARCHAR(30) NOT NULL, 
			middleName VARCHAR(30),
			lastName VARCHAR (30),
			phoneNumber VARCHAR(15),
			gender VARCHAR(2) NOT NULL,
			
			rank VARCHAR(25) NOT NULL, 
			department VARCHAR(5), 
			monthlyContribution INT NOT NULL,
			grade VARCHAR(15),
			PRIMARY KEY (memID)
			)
			ENGINE=MyISAM";
		mysql_query($sql, $db) or die(mysql_error($db));
		
		$sql ="CREATE TABLE IF NOT EXISTS tblDepartments (
			deptID INTEGER NOT NULL AUTO_INCREMENT, 
			departmentCode VARCHAR(10) NOT NULL,
			departmentName VARCHAR(60) NOT NULL, 
			number INT,
			
			PRIMARY KEY (deptID)
			)
			ENGINE=MyISAM
			";
		mysql_query($sql, $db) or die(mysql_error($db));	
		
		$sql ="CREATE TABLE IF NOT EXISTS tblBankTellers (
			tellerID INTEGER NOT NULL AUTO_INCREMENT,
			tellerNumber VARCHAR(20) NOT NULL,
			status INT NOT NULL,
			
			PRIMARY KEY (tellerID)
			)
			ENGINE=MyISAM
			";
		mysql_query($sql, $db) or die(mysql_error($db));		
		
		$sql ="CREATE TABLE IF NOT EXISTS tblLoans (
			loanID INTEGER NOT NULL AUTO_INCREMENT,
			borrower VARCHAR(15) NOT NULL,
			typeOfLoan INT NOT NULL,
			amountRequested DOUBLE,
			periodOfRepayment DATE,
			indebtednessToSociety DOUBLE,
			bursary VARCHAR(25),
			guarantorOne VARCHAR(25),
			guarantorTwo VARCHAR(25),
			amountApproved DOUBLE,
			president VARCHAR(25),
			treasurer VARCHAR(25),
			financialSecretary VARCHAR(25),
			monthlyPayment DOUBLE,
			cummulativePayment DOUBLE,
			balance DOUBLE,
			status VARCHAR(25),
			PRIMARY KEY (loanID)
			)
			ENGINE=MyISAM
			";
		mysql_query($sql, $db) or die(mysql_error($db));
		
		
		$sql ="CREATE TABLE IF NOT EXISTS tblNews (
			newsID INTEGER NOT NULL AUTO_INCREMENT,
			newsHeading VARCHAR(150) NOT NULL,
			newsBody LONGTEXT ,
			startDate DATE,
			endDate DATE,
			publisher VARCHAR(20),
			PRIMARY KEY (newsID)
			)
			ENGINE=MyISAM
			";
		mysql_query($sql, $db) or die(mysql_error($db));
		
		
		$sql ="CREATE TABLE IF NOT EXISTS tblAdministratorsAccount (
			adminID INTEGER NOT NULL AUTO_INCREMENT,
			username VARCHAR(50) NOT NULL,
			password VARCHAR(50) ,
			designation VARCHAR(40),
			PRIMARY KEY (adminID)
			)
			ENGINE=MyISAM
			";
		mysql_query($sql, $db) or die(mysql_error($db));	
		
		
		$sql ="CREATE TABLE IF NOT EXISTS tblTempMember (
			tempID INTEGER NOT NULL AUTO_INCREMENT,
			staffNumber VARCHAR(15) NOT NULL,
			firstGuarantor VARCHAR(15) ,
			secondGuarantor VARCHAR(15) ,
			
			PRIMARY KEY (tempID)
			)
			ENGINE=MyISAM
			";
		mysql_query($sql, $db) or die(mysql_error($db));
		
		
		$sql ="CREATE TABLE IF NOT EXISTS tblTempLoans (
			tempID INTEGER NOT NULL AUTO_INCREMENT,
			staffNumber VARCHAR(15) NOT NULL,
			firstGuarantor VARCHAR(15) ,
			secondGuarantor VARCHAR(15) ,
			
			PRIMARY KEY (tempID)
			)
			ENGINE=MyISAM
			";
		mysql_query($sql, $db) or die(mysql_error($db));
		
		
		$sql ="CREATE TABLE IF NOT EXISTS tblPassports (
			passportID INTEGER NOT NULL AUTO_INCREMENT,
			memberNumber VARCHAR(20) NOT NULL,
			passportName VARCHAR(20),
			
			uploadDate DATE NOT NULL,
		
			PRIMARY KEY (passportID)
			)
			ENGINE=MyISAM
			";
		mysql_query($sql, $db) or die(mysql_error($db));
		
		$sql ="CREATE TABLE IF NOT EXISTS tblAccount (
			accID INTEGER NOT NULL AUTO_INCREMENT,
			staffNumber VARCHAR(20) NOT NULL,
			email VARCHAR(60) NOT NULL,
			password VARCHAR(60) NOT NULL,
			PRIMARY KEY (accID)
			)
			ENGINE=MyISAM
			";
		mysql_query($sql, $db) or die(mysql_error($db));
		
	try{
		$sql ="SELECT *  FROM tblDepartments";
	
		$result = mysql_query($sql, $db); //or die(mysql_error($db));
		//print("SUCCESS". mysql_num_rows($result));
		if(mysql_num_rows($result) < 1){
			
		
			$sql ="INSERT INTO tblDepartments (departmentCode, departmentName, number) VALUES ('MTH','Mathematics', 0), 
				('PHY','Physics', 0),('MCB','Microbiology', 0),('MED','Medicine', 0),('BCH','Biochemistry', 0),    
				('CHM','Chemistry', 0),('ACC','Accounting', 0),('SOC','Sociology', 0),('HAU','Hausa', 0),
				('ACP','Academic Planning', 0), ('REG','Registry', 0),('FRC','French', 0), ('BUS','Business Administration', 0),
				('HIS','History', 0),('CRS','Christian Religious Studies', 0),  ('IRS','Islamic Religious Studies', 0), 
				('BIO','Biology', 0), ('ENG','English', 0) ";
		
			mysql_query($sql, $db); 
		}
	}catch(Exception $e){
	
		$sql ="INSERT INTO tblDepartments (departmentCode, departmentName, number) VALUES ('MTH','Mathematics', 0), 
				('PHY','Physics', 0),('MCB','Microbiology', 0),('MED','Medicine', 0),('BCH','Biochemistry', 0),    
				('CHM','Chemistry', 0),('ACC','Accounting', 0),('SOC','Sociology', 0),('HAU','Hausa', 0),
				('ACP','Academic Planning', 0), ('REG','Registry', 0),('FRC','French', 0), ('BUS','Business Administration', 0),
				('HIS','History', 0),('CRS','Christian Religious Studies', 0),  ('IRS','Islamic Religious Studies', 0), 
				('BIO','Biology', 0), ('ENG','English', 0)";
		
			mysql_query($sql, $db);
			
	}
	
	try{
		$sql ="SELECT *  FROM tblAdministratorsAccount";
	
		$result = mysql_query($sql, $db); //or die(mysql_error($db));
		//print("SUCCESS". mysql_num_rows($result));
		if(mysql_num_rows($result) < 1){
			
			$sql ="INSERT INTO tblAdministratorsAccount (userName, password, designation) VALUES('admin','admin',''),
				('admin','admin','administrator'),('president','president','President'),('admin','admin',''),('tresurer','treasurer','Treasurer'),
				('secretary','secretary','Secretary'),('financial','financial','Financial Secretary')";
		
			mysql_query($sql, $db) ;//or die(mysql_error($db));
		
		}
	}catch(Exception $e){
	
		$sql ="INSERT INTO tblAdministratorsAccount (userName, password, designation) VALUES('admin','admin',''),
				('admin','admin','administrator'),('president','president','President'),('admin','admin',''),('tresurer','treasurer','Treasurer'),
				('secretary','secretary','Secretary'),('financial','financial','Financial Secretary')";
		
		mysql_query($sql, $db) ;//or die(mysql_error($db));
	
		
	}
	try{
		$sql ="SELECT *  FROM tblNews";
	
		$result = mysql_query($sql, $db);// or die(mysql_error($db));
		if(mysql_num_rows($result) < 1){
			$sql ="INSERT INTO tblNews (newsHeading, newsBody, startDate, endDate, publisher) VALUES ('Meeting! Meeting!! Meeting!!!', 'There shall be a congress meeting on the 25th June, 2014 at Faculty of Science Lectur Theater.
			 All members need to be there as crucial issues shall be discussed.','2013-12-17','2014-07-18','Administrator')";
	
			mysql_query($sql, $db); //or die(mysql_error($db));
		}
	}catch(Exception $e){
	
		
		$sql ="INSERT INTO tblNews (newsHeading, newsBody, startDate, endDate, publisher) VALUES ('Meeting! Meeting!! Meeting!!!', 'There shall be a congress meeting on the 25th June, 2014 at Faculty of Science Lectur Theater.
			 All members need to be there as crucial issues shall be discussed.','2013-12-18','2014-07-18','Administrator')";
	
		mysql_query($sql, $db); //or die(mysql_error($db));
	
	}
	
?>