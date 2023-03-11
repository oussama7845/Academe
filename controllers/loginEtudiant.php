<?php
	$email=$_POST['email'];
	$password=$_POST['password'];
	include('../DAO.php');
	$dao=new DAO();
	if($dao->authentificationUser($email,$password)){
		session_start();
		$info=$dao->User($email);
        foreach($info as $in){
            $cne=$in[0];
        }
        $_SESSION['cne']=$cne; 
		header("location:../InterfaceStudent.php");
	}else{
		header("location:../ConnexionStudent.php?erreur=2");
		die();
	}

?>