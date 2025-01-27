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

			// Utiliser
			$arrArticles		= $this->_objArticleModel->findAll(4);
			// Donner le tableau $arrArticles à la vue
			$this->_arrData['arrArticles']	= $arrArticles;
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
			
			// Recherche de la liste des utilisateurs
			// instancier
			$objUserModel	= new UserModel();
			// Utiliser
			$arrUsers		= $objUserModel->findAllCreator();			
			
			$this->_arrData['objArticleModel']	= $this->_objArticleModel;
			$this->_arrData['arrArticles']		= $arrArticles;
			$this->_arrData['arrUsers']			= $arrUsers;
			
			$this->display("blog");
		}
	}