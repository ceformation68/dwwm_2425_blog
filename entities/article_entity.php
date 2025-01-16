<?php
	/**
	* Classe d'un article
	* @author Christel Ehrhart
	*/
	
	class Article {
		private int $_id;
		private string $_title;
		private string $_img;
		private string $_content;
		private string $_createdate;
		private string $_creator;
		
		/**
		* Récupération de l'id
		* @return int l'identifiant
		*/
		public function getId(){
			return strtoupper($this->_id);
		}
		/**
		* Mise à jour de l'id
		* @param int l'identifiant
		*/
		public function setId(int $intId){
			$this->_id = $intId;
		}

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
		* Récupération de l'image
		* @return string nom de l'image
		*/
		public function getImg(){
			return $this->_img;
		}
		/**
		* Mise à jour de l'image
		* @param string nom de l'image
		*/
		public function setImg(string $strImg){
			$this->_img = $strImg;
		}

		/**
		* Récupération du contenu
		* @return string contenu
		*/
		public function getContent(){
			return $this->_content;
		}
		/**
		* Mise à jour du contenu
		* @param string contenu 
		*/
		public function setContent(string $strContent){
			$this->_content = $strContent;
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
		
		/**
		* Récupération du créateur
		* @return string créateur
		*/
		public function getCreator(){
			return $this->_creator;
		}
		/**
		* Mise à jour du créateur
		* @param string créateur 
		*/
		public function setCreator(string $strCreator){
			$this->_creator = $strCreator;
		}
		
	}