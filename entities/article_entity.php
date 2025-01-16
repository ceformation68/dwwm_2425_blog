<?php
	/**
	* Classe d'un article
	* @author Christel Ehrhart
	*/
	
	class Article {
		private int $_id;
		private string $_title;
		private string $_createdate;
		
		/**
		* Récupération du titre
		* @return string titre
		*/
		public function getTitle(){
			return strtoupper($this->_title);
		}
		/**
		* Mise à jour du titre
		* @param string titre 
		*/
		public function setTitle(string $strTitle){
			$this->_title = $strTitle;
		}
		
		/**
		* Récupération de la date de création
		* @return string date de création
		*/
		public function getCreatedate(){
			return $this->_createdate;
		}
		/**
		* Mise à jour de la date de création
		* @param string date de création 
		*/
		public function setCreatedate(string $strDate){
			$this->_createdate = $strDate;
		}	
		
		/**
		* Récupération de la date selon un format
		* @param string Format de la date, par défaut 'd/m/Y'
		* @return string La date formatée
		*/
		public function getCreateDateFormat(string $strFormat = 'd/m/Y'):string{
			$objDate = new DateTimeImmutable($this->getCreatedate());
			return $objDate->format($strFormat);
		}
		
	}