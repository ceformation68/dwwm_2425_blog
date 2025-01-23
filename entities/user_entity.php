<?php
	/**
	* Classe d'un utilisateur
	* @author Christel Ehrhart
	*/
	require_once("mother_entity.php");
	
	class User extends MotherEntity{

		private string $_name = "";
		private string $_firstname = "";
		private string $_mail = "";
		private string $_pwd = "";
		
		public function __construct(){
			parent::__construct();
			$this->_prefixe = 'user';
		}
		
		/**
		* Récupération du nom
		* @return string nom
		*/
		public function getName():string{
			return $this->_name;
		}
		/**
		* Mise à jour du nom
		* @param string nom 
		*/
		public function setName(string $strName){
			$this->_name = trim($strName);
		}		
		
		/** 
		* Récupération du nom du créateur pour le select
		* @return string Le nom 
		*/
		public function getCreatorName():string{
			return strtoupper($this->getName()).' '.$this->getFirstname();
		}
		
		/**
		* Récupération du prénom
		* @return string prénom
		*/
		public function getFirstname():string{
			return $this->_firstname;
		}
		/**
		* Mise à jour du prénom
		* @param string prénom 
		*/
		public function setFirstname(string $strFirstname){
			$this->_firstname = trim($strFirstname);
		}		

		/**
		* Récupération du mail
		* @return string mail
		*/
		public function getMail():string{
			return $this->_mail;
		}
		/**
		* Mise à jour du mail
		* @param string mail 
		*/
		public function setMail(string $strMail){
			$this->_mail = strtolower(trim($strMail));
		}				
		
		/**
		* Récupération du mot de passe
		* @return string mot de passe
		*/
		public function getPwd():string{
			return $this->_pwd;
		}
		/**
		* Mise à jour du mot de passe
		* @param string mot de passe 
		*/
		public function setPwd(string $strPwd){
			$this->_pwd = $strPwd;
		}	
		/**
		* Récupération du mot de passe haché
		* @return string mot de passe haché
		*/
		public function getPwdHash(){
			return password_hash($this->getPwd(), PASSWORD_DEFAULT);
		}
		
	}