<?php
	$matricule=$_POST['matricule'];
	$nom=$_POST['name'];
    $prenom=$_POST['prenom'];
	$email=$_POST['email'];
    $adresse=$_POST['address'];
    $numero=$_POST['numero'];
    $filiere=$_POST['filiere'];
    $sexe=$_POST['sexe'];
	$nationalite=$_POST['nationalite'];
    $date=$_POST['date'];
 
    session_start();
    
	include('../DAO.php');
	$dao=new DAO();
	if($dao->EditChef($matricule,$nom,$prenom,$email,$adresse,$numero,$filiere,$sexe,$nationalite,$date)){
		header("location:../editprof.php");
	}else{
		header("location:../editprof.php?erreur=2");
		die();
	}

?>