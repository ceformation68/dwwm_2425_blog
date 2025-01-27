<?php
	require_once('entities/user_entity.php');
	session_start();

	//?ctrl=article&action=article_detail&id=5
	//var_dump($_GET);
	// Récupération des informations dans l'url
	$strController	= $_GET['ctrl']??"article";
	//var_dump($strController);
	$strAction		= $_GET['action']??"home";
	//var_dump($strAction);
	
	// Appeler le controller et la méthode 
	require_once("controllers/mother_controller.php");
	require_once("controllers/".$strController."_controller.php");
	// Construction du nom du controller
	$strCtrlName	= ucfirst($strController)."Ctrl";
	//var_dump($strCtrlName);
	// Instanciation du controller
	$objController 	= new $strCtrlName();
	// Appel de la méthode
	$objController->$strAction();
	
	/***** ATTENTION *****
		Prévoir les erreurs fichier, classe, méthode
	*/
	