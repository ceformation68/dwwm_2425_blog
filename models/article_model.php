<?php
	/**
	* Classe de gestion de la base de données pour les articles
	* @author Christel Ehrhart
	* @version 1.0
	* @date 14/01/2025
	*/

	require_once("mother_model.php");

	class ArticleModel extends MotherModel{

		// Attributs pour la recherche
		public string 	$strKeywords 	= "";
		public string 	$strDate 		= "";
		public string 	$strStartDate 	= "";
		public string 	$strEndDate 	= "";
		public int 		$intPeriod 		= 0;
		public int 		$intCreator 	= 0;
		
		/**
		* Constructeur de la classe
		*/
		public function __construct(){
			parent::__construct();
		}

		/**
		* Récupération de tous les articles
		* @param int intNbLimit Nombre de résultats à afficher - si tous = 0
		* @return array Tableau des articles de la bdd
		*/
		public function findAll(int $intNbLimit=0):array{
			$strQuery		= "SELECT articles.*, CONCAT(user_name, \" \", user_firstname) 
								AS \"user_name\"
								FROM articles
									INNER JOIN users ON article_creator = user_id";
			
			// Définition du mot clé de condition
			$strWhere		= " WHERE ";
			// Recherche par mots clés
			if ($this->strKeywords != ""){
				$strQuery	.= $strWhere." (article_title LIKE '%".$this->strKeywords."%' 
									OR article_content LIKE '%".$this->strKeywords."%') ";
				$strWhere	= " AND "; // un seul where possible => And
			}		
							
			// Recherche par date exacte
			if ($this->intPeriod == 0 && $this->strDate != ""){
				$strQuery	.= $strWhere." article_createdate = '".$this->strDate."'";
				$strWhere	= " AND "; // un seul where possible => And
			}		
							
			// Recherche par période de dates
			if ($this->intPeriod == 1 && $this->strStartDate != "" && $this->strEndDate != ""){
				$strQuery	.= $strWhere." article_createdate 
										BETWEEN '".$this->strStartDate."' AND '".$this->strEndDate."'";
				$strWhere	= " AND "; // un seul where possible => And
			}		
							
			// Recherche par créateur
			if ($this->intCreator > 0){
				$strQuery	.= $strWhere." article_creator = ".$this->intCreator; // numérique pas de ''
				$strWhere	= " AND "; // un seul where possible => And
			}		
	
			// Classé par date DESC
			$strQuery		.= " ORDER BY article_createdate DESC";
			
			// Limite d'affichage
			if ($intNbLimit > 0){
				$strQuery	.= " LIMIT ".$intNbLimit." OFFSET 0;";
			}
								
			//var_dump($strQuery);
			$arrArticles	= $this->_db->query($strQuery)->fetchAll();
			return $arrArticles;
		}
		
		public function get(int $intArticleId):array{
			
		}
		
		
	}