<?php 
	class ErrorCtrl extends MotherCtrl{
		
		/**
		* Constructeur
		*/
		public function __construct(){
			parent::__construct;
		}		
		
		/**
		* Page d'erreur 404
		*/
		public function show_404(){
			// Variables d'affichage
			$this->_arrData['strTitle']	= "Erreur 404";
			$this->_arrData['strDesc']	= "La page demandée n'existe pas";
			
			// Variables fonctionnelles
			$this->_arrData['strPage']	= "error404";			

			$this->display("error_404");
		}
		/**
		* Page d'erreur 403
		*/
		public function show_403(){
			// Variables d'affichage
			$this->_arrData['strTitle']	= "Erreur 403";
			$this->_arrData['strDesc']	= "Vous n'êtes pas autorisé à accéder à cette page";
			
			// Variables fonctionnelles
			$this->_arrData['strPage']	= "error403";			

			$this->display("error_403");
		}
?>