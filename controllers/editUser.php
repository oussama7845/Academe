<?php
	$nom=$_POST['name'];
    $prenom=$_POST['prenom'];
	$email=$_POST['email'];
    $adresse=$_POST['address'];
    $numero=$_POST['numero'];
    $cycle=$_POST['cycle'];
    $filiere=$_POST['filiere'];
    $sexe=$_POST['sexe'];
	$nationalite=$_POST['nationalite'];
    $date=$_POST['date'];
	$CodeMassar=$_POST['CodeMassar'];
    $idUser=$_POST['idUser'];
    session_start();
    
	include('../DAO.php');
	$dao=new DAO();
	if($dao->EditUser($idUser,$nom,$prenom,$email,$adresse,$numero,$cycle,$filiere,$sexe,$nationalite,$date,$CodeMassar)){
		header("location:../InterfaceStudent.php");
	}else{
		header("location:../InterfaceStudent.php?erreur=2");
		die();
	}

?>