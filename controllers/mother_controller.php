<?php
	class MotherCtrl{
		
		/*protected string $_strPage;
		protected string $_strTitle;
		protected string $_strDesc;*/
		protected array $_arrData;
		
		public function __construct(){
		}
		
		public function display(string $strView){
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
		
		
	}