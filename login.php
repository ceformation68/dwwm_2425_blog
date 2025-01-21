<?php
	// Variables d'affichage
	$strTitle	= "Se connecter";
	$strDesc	= "Page permettant de se connecter";

	// Variables fonctionnelles
	$strPage	= "login";
	include_once("header.php");

	if (count($_SESSION) > 0 
		&& isset($_SESSION['user']) 
		&& $_SESSION['user']['user_id'] != "") {
		header("Location:index.php");
	}
	
	//var_dump($_POST);
	// Récupération des valeurs du formulaire
	$strMail		= $_POST['mail']??"";
	$strPassword	= $_POST['password']??"";
	
	// Vérifications
	// Initialisation du tableau vide
	$arrErrors	= array();
	// Le formulaire est envoyé
	if (count($_POST) > 0){
		// Vérifier le contenu du mail
		if ($strMail == ""){
			$arrErrors['mail'] = "L'adresse mail est obligatoire";
		//}else if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $strMail)){
		}else if (!filter_var($strMail, FILTER_VALIDATE_EMAIL)) {
			$arrErrors['mail'] = "L'adresse mail n'est pas valide";
		}
		// Vérifier le contenu du mot de passe
		if ($strPassword == ""){
			$arrErrors['password'] = "Le mot de passe est obligatoire";
		}
		
		// On cherche l'utilisateur si pas erreur
		if (count($arrErrors) == 0){
			require("models/user_model.php");
			require("entities/user_entity.php");
			$objUserModel 	= new UserModel();
			$arrUser 		= $objUserModel->findUser($strMail, $strPassword);
			if ($arrUser === false){
				$arrErrors['connect'] = "Erreur de connexion";
			}else{
				// Ajouter l'utilisateur en SESSION
				//$_SESSION['user_id'] = $arrUser['user_id'];
				/*$objUser	= new User;
				$objUser->hydrate($arrUser);*/
				$_SESSION['user'] = $arrUser;//$objUser;
				header("Location:index.php");
			}
			//var_dump($arrUser);
		}
		
	}
	
?>
	<?php if (count($arrErrors) > 0){ ?>
		<div class="alert alert-danger">
		<?php foreach($arrErrors as $strError){ ?>
			<p><?php echo $strError; ?></p>
		<?php } ?>
		</div>
	<?php } ?>
					
	<form method="post">
		<p>
			<label for="mail" class="form-label">Mail</label>
			<input type="text" class="form-control" id="mail" name="mail" value="<?php echo($strMail); ?>" >
		</p>
		<p>
			<label for="password" class="form-label">Mot de passe</label>
			<input type="password" class="form-control" id="password" name="password" >
		</p>
		<p>
			<input type="submit" >
		</p>
	</form>

<?php

	include_once("footer.php");
?>