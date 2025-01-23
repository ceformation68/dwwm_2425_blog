<?php
	// Variables d'affichage
	$strTitle	= "Créer un compte";
	$strDesc	= "Page permettant de créer un compte";

	// Variables fonctionnelles
	$strPage	= "create_account";
	include_once("header.php");
	require_once("models/user_model.php");
	
	// Objet user "vide"
	$objUser	= new User;
	/** Si le formulaire est envoyé **/
	//var_dump($_POST);
	if (count($_POST) > 0){
		// Créer un objet User
		//require_once("entities/user_entity.php");
		$objUser->hydrate($_POST);
		//$objUser->setName($_POST['name']);
		//$objUser->setFirstname($_POST['firstname']);

		// Vérifications du formulaire => Affichage des erreurs
		if ($objUser->getName() == ""){
			var_dump('erreur'); // Traitement des erreurs avec un tableau
		}
		
		/** Si pas d'erreur **/
		// Appel une méthode dans le modèle, avec en paramètre l'objet	
		// instancier
		$objUserModel	= new UserModel();
		$objUserModel->insert($objUser);
		
		// Informer l'utilisateur si insertion ok/pas ok 
		/** **/ 
	}
	var_dump($objUser);
	
?>
	<!-- formulaire -->
	<form method="post">
	<label>Nom d'utilisateur</label>
	<input type="text" name="name" value="<?php echo($objUser->getName()); ?>" >
	<input type="text" name="firstname" value="<?php echo($objUser->getFirstname()); ?>" >
	<input type="submit">
	</form>
<?php
	include_once("footer.php");
?>