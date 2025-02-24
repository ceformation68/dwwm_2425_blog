<?php 
	class UserCtrl extends MotherCtrl{
		
		private object $_objUserModel;
		
		/**
		* Constructeur
		*/
		public function __construct(){
			// inclure les fichiers modèle et entité 
			require_once("models/user_model.php");
			require_once("entities/user_entity.php");
			// instancier
			$this->_objUserModel	= new UserModel();
			parent::__construct();
		}		
		
		/**
		* Page de connexion
		*/
		public function login(){
			// Variables d'affichage
			$this->_arrData['strTitle']	= "Se connecter";
			$this->_arrData['strDesc']	= "Page permettant de se connecter";
			
			// Variables fonctionnelles
			$this->_arrData['strPage']	= "login";
			
			if (count($_SESSION) > 0 
				&& isset($_SESSION['user']) 
				&& $_SESSION['user']->getId() != "") {
				header("Location:index.php");
			}

			//var_dump($_POST);
			// Récupération des valeurs du formulaire
			$strMail		= $_POST['mail']??"";
			$strPassword	= $_POST['password']??"";
			
			// Vérifications
			// Initialisation du tableau vide
			//$this->_arrErrors	= array();
			// Le formulaire est envoyé
			if (count($_POST) > 0){
				// Vérifier le contenu du mail
				if ($strMail == ""){
					$this->_arrErrors['mail'] = "L'adresse mail est obligatoire";
				//}else if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $strMail)){
				}else if (!filter_var($strMail, FILTER_VALIDATE_EMAIL)) {
					$this->_arrErrors['mail'] = "L'adresse mail n'est pas valide";
				}
				// Vérifier le contenu du mot de passe
				if ($strPassword == ""){
					$this->_arrErrors['password'] = "Le mot de passe est obligatoire";
				}
				
				// On cherche l'utilisateur si pas erreur
				if (count($this->_arrErrors) == 0){
					$arrUser 		= $this->_objUserModel->findUser($strMail, $strPassword);
					if ($arrUser === false){
						$this->_arrErrors['connect'] = "Erreur de connexion";
					}else{
						// Ajouter l'utilisateur en SESSION
						//$_SESSION['user_id'] = $arrUser['user_id'];
						$objUser	= new User;
						$objUser->hydrate($arrUser);
						$_SESSION['user'] = $objUser;
						header("Location:index.php");
					}
					//var_dump($arrUser);
				}
				
			}
			//$this->_arrData['arrErrors']	= $this->_arrErrors;
			$this->_arrData['strMail']		= $strMail;
			$this->display("login");
		}
	
		/**
		* Méthode de deconnexion d'un utilisateur
		*/
		public function logout(){
			// Je détruit la session
			session_destroy();
			// Je redirige
			header("Location:index.php?ctrl=user&action=login");
		}
		
		/**
		* Page de création de compte 
		*/
		public function create_account(){
			// Variables d'affichage
			$this->_arrData['strTitle']	= "Créer un compte";
			$this->_arrData['strDesc']	= "Page permettant de créer un compte";
			
			// Variables fonctionnelles
			$this->_arrData['strPage']	= "create_account";
			
			// Objet user "vide"
			$objUser	= new User;
			/** Si le formulaire est envoyé **/
			//var_dump($_POST);
			//$this->_arrErrors	= array();
			if (count($_POST) > 0){
				// Vérification csrf
				//var_dump($_SESSION['csrf_token']);
				//var_dump($_POST['csrf_token']);
				if(!$this->_verifyCsrfToken($_POST['csrf_token'])){
					header("Location:index.php?ctrl=error&action=show_403");
				}
				// Créer un objet User
				//require_once("entities/user_entity.php");
				$objUser->hydrate($_POST);
				//$objUser->setName($_POST['name']);
				//$objUser->setFirstname($_POST['firstname']);

				// Vérifications du formulaire => Affichage des erreurs
				if ($objUser->getName() == ""){
					$this->_arrErrors['name'] = "Le nom est obligatoire";
				}
				if ($objUser->getFirstname() == ""){
					$this->_arrErrors['firstname'] = "Le prénom est obligatoire";
				}
				
				// Vérifier le contenu du mail
				if ($objUser->getMail() == ""){
					$this->_arrErrors['mail'] = "L'adresse mail est obligatoire";
				}else if (!filter_var($objUser->getMail(), FILTER_VALIDATE_EMAIL)) {
					$this->_arrErrors['mail'] = "L'adresse mail n'est pas valide";
				}else if ($this->_objUserModel->verifMail($objUser->getMail())){
					$this->_arrErrors['mail'] = "L'adresse mail est déjà utilisée";
				}

				// Vérification du mot de passe
				if ($objUser->getPwd() == ""){
					$this->_arrErrors['pwd'] = "Le mot de passe est obligatoire";
				}else if ($objUser->getPwd() != $_POST['confirm_pwd']){
					$this->_arrErrors['pwd'] = "Le mot de passe et sa confirmation ne sont pas identique";
				}else if (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{16,}$/", $objUser->getPwd())){
					$this->_arrErrors['pwd'] = "Le mot de passe ne correspond pas aux règles de sécurité";
				}
				
				/** Si pas d'erreur **/
				if (count($this->_arrErrors) === 0){
					// Appel une méthode dans le modèle, avec en paramètre l'objet	
					$boolOK = $this->_objUserModel->insert($objUser);
					// Informer l'utilisateur si insertion ok/pas ok 
					if ($boolOK){
						var_dump("ok"); // => Utiliser les session pour les message de succès
						// Redirection sur login
					}else{
						$this->_arrErrors[] = "L'insertion s'est mal passée";
					}
				}
			}
			//var_dump($this->_arrErrors);
			//$this->_arrData['arrErrors']	= $this->_arrErrors;
			$this->_arrData['objUser']		= $objUser;
			$token	= $this->_generateCsrfToken();

			$this->_arrData['token']		= $token;
			$this->display("create_account");
		}

		/**
		* Page de modification de son compte 
		*/
		public function edit_account(){
			// Variables d'affichage
			$this->_arrData['strTitle']	= "Modifier un compte";
			$this->_arrData['strDesc']	= "Page permettant de modifier un compte";
			
			// Variables fonctionnelles
			$this->_arrData['strPage']	= "edit_account";

			// Uniquement si user connecté
			if (isset($_GET['id']) && ($_GET['id'] != $_SESSION['user']->getId())){
				header("Location:index.php?ctrl=error&action=show_403");
			}	

			var_dump($_SESSION);
			
			// Rechercher l'utilisateur courant		
			$arrUser = $this->_objUserModel->get();
			// => Vérifier que l'utilisateur existe
			
			$objUser = new User;
			$objUser->hydrate($arrUser);
			
			// Si le formulaire est envoyé
			if (count($_POST) > 0){
				$objUser->hydrate($_POST);
				// => Mettre à jour l'utilisateur en BDD avec tests de vérification

				if (count($this->_arrErrors) == 0){
					// Rafraichir l'utilisateur en session
					$_SESSION['user'] = $objUser; 
					$strPseudo = trim($_POST['pseudo']);
					
					setcookie('pseudo', "", $this->_arrCookieOptions);
					if ($strPseudo != ''){
						setcookie('pseudo', $strPseudo, $this->_arrCookieOptions);
					}
					$_SESSION['success'] = "L'utilisateur a bien été modifié";
					header("Location:index.php");
					exit();
				}
			}
			
			$this->_arrData['objUser']	= $objUser;

			$this->display("edit_account");			
		}
		
		public function del_account(){
			
		}
	}