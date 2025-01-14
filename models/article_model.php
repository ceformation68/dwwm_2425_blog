<?php
	/**
	* Classe de gestion de la base de données pour les articles
	* @author Christel Ehrhart
	* @version 1.0
	* @date 14/01/2025
	*/


	require_once("mother_model.php");
	

	class ArticleModel extends MotherModel{

		/**
		* Constructeur de la classe
		*/
		public function __construct(){
			parent::__construct();
		}

		/**
		* Récupération de tous les articles
		* @param int intNbLimit Nombre de résultats à afficher
		* @return array Tableau des articles de la bdd
		*/
		public function findAll(int $intNbLimit):array{
			
			$strQuery		= "SELECT articles.*, CONCAT(user_name, \" \", user_firstname) 
								AS \"user_name\"
								FROM articles
									INNER JOIN users ON article_creator = user_id
								ORDER BY article_createdate DESC
								LIMIT ".$intNbLimit." OFFSET 0;";
			$arrArticles	= $this->_db->query($strQuery)->fetchAll();
			return $arrArticles;
		}
		
		public function get(){
			
		}
		
		
	}