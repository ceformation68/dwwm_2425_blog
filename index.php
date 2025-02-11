<?php
	// Autoloader Composer
	require('vendor/autoload.php');

	require_once('entities/user_entity.php');
	session_start();

	//var_dump($_SESSION);
	//?ctrl=article&action=article_detail&id=5
	//var_dump($_GET);
	// Récupération des informations dans l'url
	$strController	= $_GET['ctrl']??"article";
	//var_dump($strController);
	$strAction		= $_GET['action']??"home";
	//var_dump($strAction);
	
	// Utilisation d'un flag pour gérer les problèmes d'url
	$boolPb	= false;
	
	// Appeler le controller et la méthode 
	require_once("controllers/mother_controller.php");
	$strFile	= "controllers/".$strController."_controller.php";
	if (file_exists($strFile)){
		require_once($strFile);
		// Construction du nom du controller
		$strCtrlName	= ucfirst($strController)."Ctrl";
		//var_dump($strCtrlName);
		if(class_exists($strCtrlName)){
			// Instanciation du controller
			$objController 	= new $strCtrlName();
			if (method_exists($objController, $strAction)){
				// Appel de la méthode
				$objController->$strAction();
			}else{
				$boolPb	= true;
			}
		}else{
			$boolPb	= true;
		}
	}else{
		$boolPb	= true;
	}		
	
	// Redirection si problème
	//if ($boolPb === true){
	if ($boolPb){
		header("Location:index.php?ctrl=error&action=show_404");
	}