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
	$arrErrors	= array();
	if (count($_POST) > 0){
		$objUserModel	= new UserModel();

		// Créer un objet User
		//require_once("entities/user_entity.php");
		$objUser->hydrate($_POST);
		//$objUser->setName($_POST['name']);
		//$objUser->setFirstname($_POST['firstname']);

		// Vérifications du formulaire => Affichage des erreurs
		if ($objUser->getName() == ""){
			$arrErrors['name'] = "Le nom est obligatoire";
		}
		if ($objUser->getFirstname() == ""){
			$arrErrors['firstname'] = "Le prénom est obligatoire";
		}
		
		// Vérifier le contenu du mail
		if ($objUser->getMail() == ""){
			$arrErrors['mail'] = "L'adresse mail est obligatoire";
		}else if (!filter_var($objUser->getMail(), FILTER_VALIDATE_EMAIL)) {
			$arrErrors['mail'] = "L'adresse mail n'est pas valide";
		}else if ($objUserModel->verifMail($objUser->getMail())){
			$arrErrors['mail'] = "L'adresse mail est déjà utilisée";
		}

		// Vérification du mot de passe
		if ($objUser->getPwd() == ""){
			$arrErrors['pwd'] = "Le mot de passe est obligatoire";
		}else if ($objUser->getPwd() != $_POST['confirm_pwd']){
			$arrErrors['pwd'] = "Le mot de passe et sa confirmation ne sont pas identique";
		}else if (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{16,}$/", $objUser->getPwd())){
			$arrErrors['pwd'] = "Le mot de passe ne correspond pas aux règles de sécurité";
		}

		
		/** Si pas d'erreur **/
		if (count($arrErrors) === 0){
			// Appel une méthode dans le modèle, avec en paramètre l'objet	
			$boolOK = $objUserModel->insert($objUser);
			// Informer l'utilisateur si insertion ok/pas ok 
			if ($boolOK){
				var_dump("ok"); // => Utiliser les session pour les message de succès
				// Redirection sur login
			}else{
				$arrErrors[] = "L'insertion s'est mal passée";
			}
		}
	}
	//var_dump($arrErrors);
	
?>
	<?php if (count($arrErrors) > 0){ ?>
		<div class="alert alert-danger">
		<?php foreach($arrErrors as $strError){ ?>
			<p><?php echo $strError; ?></p>
		<?php } ?>
		</div>
	<?php } ?>
	<!-- formulaire -->
	<form method="post">
	<p>
		<label>Nom d'utilisateur</label>
		<input type="text" name="name" value="<?php echo($objUser->getName()); ?>" >
	</p>
	<p>
		<label>Prénom d'utilisateur</label>
		<input type="text" name="firstname" value="<?php echo($objUser->getFirstname()); ?>" >
	</p>
	<p>
		<label>Mail</label>
		<input id="name" class="form-control <?php if (isset($arrErrors['mail'])) { echo("is-invalid"); } ?>" type="text" name="mail" value="<?php echo($objUser->getMail()); ?>" >
		<div id="nameFeedback" class="invalid-feedback">
		<?php echo($arrErrors['mail']); ?>
		</div>
	</p>
	<p>
		<label>Mot de passe</label>
		<input type="text" name="pwd" >
		<span>Le mot de passe doit contenir une minuscule, une majuscule, un caractère spéciaux et doit faire plus de 16 caractères</span>
		<label>Confirmation du mot de passe</label>
		<input type="text" name="confirm_pwd" >
	</p>
	<input type="submit">
	</form>
<?php
	include_once("footer.php");
?>