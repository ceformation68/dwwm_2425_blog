<?php
	
	class PageCtrl extends MotherCtrl{
	
		public function __construct(){
			parent::__construct();
		}
		
		public function about(){
			// Variables d'affichage
			$this->_arrData['strTitle']	= "A propos";
			$this->_arrData['strDesc']	= "Page de contenu";

			// Variables fonctionnelles
			$this->_arrData['strPage']	= "about";
			
			$this->display("about");
			
		}
		
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
	}