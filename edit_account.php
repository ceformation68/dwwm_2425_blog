<?php

	// Variables d'affichage
	$strTitle	= "Modifier son compte";
	$strDesc	= "Page permettant de modifier son compte";

	// Variables fonctionnelles
	$strPage	= "edit_account";
	include_once("header.php");

	if (isset($_GET['id']) && ($_GET['id'] != $_SESSION['user']->getId())){
		header("Location:error_403.php");
	}	

	var_dump($_SESSION);
	
	// Rechercher l'utilisateur courant