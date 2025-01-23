<?php
	/**
	*
	*/
	class MotherEntity{
		
		protected string $_prefixe;
		private int $_id;
		
		public function __construct(){
		}
		
		/**
		* Fonction d'hydratation qui permet d'utiliser de manière 
		*	dynamique les setters, sous réserve qu'ils existent
		*/
		public function hydrate(array $arrData){
			foreach ($arrData as $key=>$value){
				//var_dump($key);
				//var_dump($this->_prefixe);
				//var_dump(str_replace($this->_prefixe.'_', '', $key));
				//var_dump(ucfirst(str_replace($this->_prefixe.'_', '', $key)));
				$strMethod = "set".ucfirst(str_replace($this->_prefixe.'_', '', $key));
				//var_dump($strMethod);
				// On appel le setter uniquement s'il existe
				if(method_exists($this, $strMethod)){
					$this->$strMethod($value);
				}
			}
		}	
		
		/**
		* Récupération de l'id
		* @return int l'identifiant
		*/
		public function getId(){
			return $this->_id;
		}
		/**
		* Mise à jour de l'id
		* @param int l'identifiant
		*/
		public function setId(int $intId){
			$this->_id = $intId;
		}
		
	}