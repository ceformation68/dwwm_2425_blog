<?php

	// Variables d'affichage
	$strTitle	= "Erreur 403";
	$strDesc	= "Vous n'êtes pas autorisé à accéder à cette page";

	// Variables fonctionnelles
	$strPage	= "error403";
	include_once("header.php");
?>
	<!-- uniquement si pas de session -->
	<p> Vous pouvez vous connecter en cliquant sur le lien suivant : 
	<a href="login.php">Se connecter</a>
	</p>