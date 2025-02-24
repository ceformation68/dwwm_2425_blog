<?php
	use Smarty\Smarty;
	
	/**
	* Classe mère des controllers
	*/
	class MotherCtrl{
		
		/*protected string $_strPage;
		protected string $_strTitle;
		protected string $_strDesc;*/
		protected array $_arrData 			= array();
		protected array $_arrErrors 		= array();
		protected string $_strSuccess 		= "";
		
		protected array $_arrCookieOptions 	=  array();
		
		public function __construct(){
			$this->_arrCookieOptions		= array (
												'expires' => time() + 60*60*24*30, // calcul temps
												'path' => '/', 
												'domain' => 'localhost', // essentiel pour Firefox
												'secure' => true, // https ou non
												'httponly' => true, // http mais pas javascript
												'samesite' => 'Strict' // None || Lax || Strict
												);
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
		
		
		// Générer et stocker le token CSRF dans la session avec une expiration
		protected function _generateCsrfToken() {
			$token = bin2hex(random_bytes(32)); // Génère un token aléatoire
			$_SESSION['csrf_token'] = $token;
			// Définir une expiration (par exemple, 30 minutes à partir de maintenant)
			$_SESSION['csrf_token_expiration'] = time() + (30 * 60); // 30 minutes en secondes
			return $token;
		}

		// Vérifier le token CSRF et son expiration
		protected function _verifyCsrfToken($token) {
			return isset($_SESSION['csrf_token']) 
				&& $_SESSION['csrf_token'] === $token 
				&& isset($_SESSION['csrf_token_expiration']) 
				&& $_SESSION['csrf_token_expiration'] >= time(); // Vérifie si le token n'a pas expiré
		}
		
	}