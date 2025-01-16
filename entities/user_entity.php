<?php
	/**
	* Classe d'un utilisateur
	* @author Christel Ehrhart
	*/
	require_once("mother_entity.php");
	
	class User extends MotherEntity{

		private string $_name;
		private string $_firstname;
		
		public function __construct(){
			parent::__construct();
			$this->_prefixe = 'user';
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