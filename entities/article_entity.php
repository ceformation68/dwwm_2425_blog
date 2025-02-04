<?php
	/**
	* Classe d'un article:
	* <ul>
	* 	<li>Attributs de l'article</li>
	*	<li>Getters et setters </li>
	* </ul>
	* @author Christel Ehrhart
	*/
	require_once("mother_entity.php");
	
	class Article extends MotherEntity{
		private string $_title; /**< Titre de l'article */
		private string $_img;
		private string $_content;
		private string $_createdate;
		private string $_creator;
		
		/**
		* Constructeur de la Classe
		*/
		public function __construct(){
			parent::__construct();
			$this->_prefixe = 'article';
		}		
		/*public function hydrate($arrData){
			foreach ($arrData as $key=>$value){
				$strMethod = "set".ucfirst(str_replace('article_', '', $key));
				$this->$strMethod($value);
			}
			
			$this->setId($arrData['article_id']);
			$this->setTitle($arrData['article_title']);
			$this->setImg($arrData['article_img']);
			$this->setContent($arrData['article_content']);
			$this->setCreatedate($arrData['article_createdate']);
			$this->setCreator($arrData['user_name']);
		}*/
		
		/**
		* Récupération du titre
		* @return string titre
		*/
		public function getTitle():string{
			return strtoupper($this->_title);
		}
		/**
		* Mise à jour du titre
		* @param string titre 
		*/
		public function setTitle(string $strTitle){
			$this->_title = $this->_nettoyage($strTitle);
		}
		
		/**
		* Récupération de l'image
		* @return string nom de l'image
		*/
		public function getImg():string{
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
		public function getContent():string{
			return $this->_content;
		}
		/**
		* Mise à jour du contenu
		* @param string contenu 
		*/
		public function setContent(string $strContent){
			if (strpos($strContent, "<script>") !== false) {
				// ecrire dans un fichier de log ou bdd 
			}
			$this->_content = ($this->_nettoyage($strContent));
		}
		
		public function getContentResume(int $intNbCar = 100):string{
			// Version substr
			/*$strContent = $this->getContent();
			if (strlen($strContent) > $intNbCar){
				$strContent = substr($strContent, 0, $intNbCar)."...";
			}
			return $strContent;*/
			
			// Version mb_strimwidth => Fabrice !!
			return (mb_strimwidth($this->getContent(), 0, $intNbCar+3, "..."));

		}
		

		/**
		* Récupération de la date de création
		* @return string date de création
		*/
		public function getCreatedate():string{
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
		public function getCreator():string{
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