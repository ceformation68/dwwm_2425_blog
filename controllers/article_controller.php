<?php 
	/**
	* Controleur des pages contenant des articles 
	* @author Christel
	* @date 27/01/2025
	*/
	class ArticleCtrl extends MotherCtrl{
		
		private object $_objArticleModel;
		
		/**
		* Constructeur
		*/
		public function __construct(){
			// inclure les fichiers modèle et entité 
			require_once("models/article_model.php");
			require_once("entities/article_entity.php");
			// instancier
			$this->_objArticleModel	= new ArticleModel();
		}
		
		/**
		* Page d'Accueil
		*/
		public function home(){
			// Variables d'affichage
			$this->_arrData['strTitle']	= "Accueil";
			$this->_arrData['strDesc']	= "Page affichant les 4 derniers articles";

			// Variables fonctionnelles
			$this->_arrData['strPage']	= "index";			

			// Tableau de tableau - liste des articles
			$arrArticles			= $this->_objArticleModel->findAll(4);
			//var_dump($arrArticles);
			
			$arrArticlesToDisplay 	= array();
			foreach ($arrArticles as $arrDetArticle){
				$objArticle = new Article(); // Article 'coquille vide' 
				// hydrater l'objet
				$objArticle->hydrate($arrDetArticle);
				$arrArticlesToDisplay[] = $objArticle;
			}
			//var_dump($arrArticlesToDisplay);
			// Donner le tableau $arrArticlesToDisplay à la vue
			$this->_arrData['arrArticles']	= $arrArticlesToDisplay;
			/* Equivalent à 
			$this->_arrData['arrArticles']	= $objArticleModel->findAll(4);
			*/

			$this->display("home");
		}
		
		/**
		* Page blog
		*/
		public function blog(){
			
			// Variables d'affichage
			$this->_arrData['strTitle']	= "Blog";
			$this->_arrData['strDesc']	= "Page affichant tous les articles, avec une zone de recherche sur les articles";
			
			// Variables fonctionnelles
			$this->_arrData['strPage']	= "blog";
			
			// inclure les fichiers modèles
			require("models/user_model.php");
			require_once("entities/user_entity.php");
			
			// Récupération des données du formulaire
			$this->_objArticleModel->strKeywords 	= $_POST['keywords']??"";
			$this->_objArticleModel->strDate 		= $_POST['date']??"";
			$this->_objArticleModel->strStartDate 	= $_POST['startdate']??"";
			$this->_objArticleModel->strEndDate 	= $_POST['enddate']??"";
			$this->_objArticleModel->intPeriod		= $_POST['period']??0;
			$this->_objArticleModel->intCreator	= $_POST['creator']??0;

			// Utiliser
			$arrArticles		= $this->_objArticleModel->findAll();	
			// Transformer tableau en tableau d'objet dans une méthode
			$arrArticlesToDisplay 	= array();
			foreach ($arrArticles as $arrDetArticle){
				$objArticle = new Article(); // Article 'coquille vide' 
				// hydrater l'objet
				$objArticle->hydrate($arrDetArticle);
				$arrArticlesToDisplay[] = $objArticle;
			}			
			// Recherche de la liste des utilisateurs
			$objUserModel		= new UserModel();
			$arrUsers			= $objUserModel->findAllCreator();			
			$arrUserToDisplay	= array();
			foreach ($arrUsers as $arrDetUser){
				$objUser = new User();
				$objUser->hydrate($arrDetUser);
				$arrUserToDisplay[] = $objUser;
			}					
			$this->_arrData['objArticleModel']	= $this->_objArticleModel;
			$this->_arrData['arrArticles']		= $arrArticlesToDisplay;
			$this->_arrData['arrUsers']			= $arrUserToDisplay;
			
			$this->display("blog");
		}

		public function edit_article(){
			// Si id => sinon 403 ou 404
			// Si article existe => sinon 404
			// si on n'est PAS le créateur => 403
			// Afficher le formulaire pré-rempli
			$arrArticle = $this->_objArticleModel->get($_GET['id']);

			$objArticle = new Article();
			$objArticle->hydrate($arrArticle);
			//$objArticle->setId($_GET['id']);
			
			// Si le formulaire est envoyé
			if(count($_POST) > 0){
				$objArticle->hydrate($_POST);
				// Tests de vérification 
				if ($objArticle->getTitle() == ""){
					$this->_arrErrors['title'] = "Le titre est obligatoire";
				}
				if ($objArticle->getContent() == ""){
					$this->_arrErrors['content'] = "Le contenu est obligatoire";
				}
				// Image si l'utilisateur veut la changer
				$arrImage	= $_FILES['image']; // on utilise une variable pour éviter de rappeler le name de l'input
				if ($arrImage['name'] != ""){
					if ($arrImage['error'] == 4){
						$this->_arrErrors['image'] = "Le fichier est obligatoire";
					}else{
						if ($arrImage['error'] != 0){
							$this->_arrErrors['image'] = "Le fichier a rencontré un pb";
						}elseif ($arrImage['type'] != 'image/jpeg'){
							$this->_arrErrors['image'] = "Uniquement les images jpeg sont acceptés";
						//}elseif ($arrImage['size'] > 100000){
							//$this->_arrErrors['image'] = "Le fichier ne doit pas dépasser 100Ko";
						}
					}

					//if (count($arrErrors) == 0){
					if (!isset($this->_arrErrors['image'])){
						// fichier temporaire = source
						$strSource		= $arrImage['tmp_name'];
						// destination du fichier
						$arrFileExplode	= explode(".", $arrImage['name']);
						$strFileExt		= $arrFileExplode[count($arrFileExplode)-1];
						$strFileName 	= bin2hex(random_bytes(10)).".webp";//.$strFileExt;
						$strDest		= "assets/images/".$strFileName;

						// Dimensions de mon image
						list($intWidth, $intHeight) = getimagesize($strSource);
						// Redimensionner
						$objDest		= imagecreatetruecolor(500, 500); // vide;
						$objSource		= imagecreatefromjpeg($strSource);
						
						var_dump(imagecopyresized($objDest, $objSource, 0, 0, 0, 0, 500, 500, $intWidth, $intHeight));
						
						var_dump(imagewebp($objDest, $strDest));
						
						$objArticle->setImg($strFileName);
						
						// On déplace le fichier
						/*if (!move_uploaded_file($strSource, $strDest)){
							$arrErrors['image'] = "Le fichier ne s'est pas correctement téléchargé";
						}else{
							// si le fichier est bien enregistré on ajoute le nom du fichier dans l'objet
							$objArticle->setImg($strFileName);
						}*/
					}
				}					
				
				$boolOk = $this->_objArticleModel->update($objArticle);
				/*
				Informer l'utilisateur des erreurs ou si c'est ok 
				*/
			}	
			
			// Variables d'affichage
			$this->_arrData['strTitle']	= "Modifier un article";
			$this->_arrData['strDesc']	= "Page permettant de modifier un article";

			// Variables fonctionnelles
			$this->_arrData['strPage']		= "edit_article";	
			$this->_arrData['objArticle']	= $objArticle;	
			
			$this->display("edit_article");
		}
	}