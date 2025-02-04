<?php
	use Smarty\Smarty;
	
	/**
	* Classe mère des controllers
	*/
	class MotherCtrl{
		
		/*protected string $_strPage;
		protected string $_strTitle;
		protected string $_strDesc;*/
		protected array $_arrData = array();
		
		public function __construct(){
		}
		
		/** 
		* Fonction permettant l'affichage d'une page
		*/
		public function display_old(string $strView){
			/*$strPage	= $this->_strPage;
			$strTitle	= $this->_strTitle;
			$strDesc	= $this->_strDesc;*/
			foreach ($this->_arrData as $key=>$value){
				$$key	= $value;
			}
			
			include_once("views/_partial/header.php");
			include_once("views/".$strView.".php");
			include_once("views/_partial/footer.php");
		}
		
		/** 
		* Fonction permettant l'affichage d'une page avec Smarty
		*/
		public function display(string $strView){
			$objSmarty	= new Smarty();
			//$objSmarty->setEscapeHtml(true);
			foreach ($this->_arrData as $key=>$value){
				$objSmarty->assign($key, $value);
			}
			$objSmarty->display("views/".$strView.".tpl");
			
			/*foreach ($this->_arrData as $key=>$value){
				$$key	= $value;
			}
			
			include_once("views/_partial/header.php");
			include_once("views/".$strView.".php");
			include_once("views/_partial/footer.php");
			*/
		}		
		
	}