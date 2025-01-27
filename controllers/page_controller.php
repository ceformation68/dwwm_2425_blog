<?php
	/**
	* Controleur des pages 
	* @author Christel
	* @date 27/01/2025
	*/

	class PageCtrl extends MotherCtrl{
	
		/**
		* Constructeur
		*/
		public function __construct(){
			parent::__construct();
		}
		/**
		* Page A propos
		*/
		public function about(){
			// Variables d'affichage
			$this->_arrData['strTitle']	= "A propos";
			$this->_arrData['strDesc']	= "Page de contenu";

			// Variables fonctionnelles
			$this->_arrData['strPage']	= "about";
			
			$this->display("about");
			
		}
		
		/**
		* Page mentions légales
		*/
		public function mentions(){
			// Variables d'affichage
			$this->_arrData['strTitle']	= "Mentions légales";
			$this->_arrData['strDesc']	= "Page de contenu";

			// Variables fonctionnelles
			$this->_arrData['strPage']	= "mentions";

			/*include_once("views/_partial/header.php");
			include_once("views/mentions.php");
			include_once("views/_partial/footer.php");*/
			$this->display("mentions");
		}
		
		/**
		* Page contact
		*/
		public function contact(){
			// Variables d'affichage
			$this->_arrData['strTitle']	= "Contact";
			$this->_arrData['strDesc']	= "Page de contact";

			// Variables fonctionnelles
			$this->_arrData['strPage']	= "contact";

			$this->display("contact");			
		}			
	}