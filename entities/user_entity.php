<?php
	/**
	* Classe d'un utilisateur
	* @author Christel Ehrhart
	*/
	
	class User {
		private int $_id;
		private string $_name;
		private string $_firstname;
		
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
		
		/**
		* Récupération du nom
		* @return string nom
		*/
		public function getName(){
			return $this->_name;
		}
		/**
		* Mise à jour du nom
		* @param string nom 
		*/
		public function setName(string $strName){
			$this->_name = $strName;
		}		
		
		/** 
		* Récupération du nom du créateur pour le select
		* @return string Le nom 
		*/
		public function getCreatorName(){
			return strtoupper($this->getName()).' '.$this->getFirstname();
		}
		
		/**
		* Récupération du prénom
		* @return string prénom
		*/
		public function getFirstname(){
			return $this->_firstname;
		}
		/**
		* Mise à jour du prénom
		* @param string prénom 
		*/
		public function setFirstname(string $strFirstname){
			$this->_firstname = $strFirstname;
		}		
		
		
	}