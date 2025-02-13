<?php
	use Smarty\Smarty;
	
	/**
	* Classe mère des controllers
	*/
	class MotherCtrl{
		
		/*protected string $_strPage;
		protected string $_strTitle;
		protected string $_strDesc;*/
		protected array $_arrData 		= array();
		protected array $_arrErrors 	= array();
		protected string $_strSuccess 	= "";
		
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
		public function display(string $strView, bool $boolAffiche = true){
			$objSmarty	= new Smarty();
			// Activer le cache => Attention penser au {nocache}
			//$objSmarty->setCaching(Smarty::CACHING_LIFETIME_CURRENT);
			//$objSmarty->setEscapeHtml(true);
			foreach ($this->_arrData as $key=>$value){
				$objSmarty->assign($key, $value);
			}
			$objSmarty->assign("base_url", "http://localhost/blog_html");

			if ($boolAffiche){
				// Donner le tableau des erreurs (construit dans les controllers) au template
				$objSmarty->assign("arrErrors", $this->_arrErrors);
				$objSmarty->assign("strSuccess", $_SESSION['success']??$this->_strSuccess);
				unset($_SESSION['success']);
				$objSmarty->display("views/".$strView.".tpl");
			}else{
				return $objSmarty->fetch("views/".$strView.".tpl");
			}
			
			/*foreach ($this->_arrData as $key=>$value){
				$$key	= $value;
			}
			
			include_once("views/_partial/header.php");
			include_once("views/".$strView.".php");
			include_once("views/_partial/footer.php");
			*/
		}		
		
	}