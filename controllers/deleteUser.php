<?php
	$idUser=$_GET['idUser'];
    session_start();
	include('../DAO.php');
	$dao=new DAO();
	if($dao->deleteUser($idUser)){
		header("location:../InterfaceProf.php");
	}else{
		header("location:../Interface.php?erreur=2");
		die();
	}

?>