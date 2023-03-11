<?php
	$matricule=$_POST['matricule'];
	$password=$_POST['password'];
	include('../DAO.php');
	$dao=new DAO();
	if($dao->authentificationProf($matricule,$password)){
		session_start();
		$info=$dao->Prof($matricule);
        foreach($info as $in){
			$matricule=$in[2];
        }

		$_SESSION['matricule']=$matricule; 
	
		header("location:../InterfaceProf.php");

	}else{
		header("location:../ConnexionProf.php?erreur=2");	
		die();
	}




?>