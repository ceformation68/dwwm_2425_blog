<?php
	/**
	* Classe de gestion de la base de données pour les utilisateurs
	* @author Christel Ehrhart
	* @version 1.0
	* @date 14/01/2025
	*/

	require_once("mother_model.php");

	class UserModel extends MotherModel{
		
		/**
		* Constructeur de la classe
		*/
		public function __construct(){
			parent::__construct();
		}
		
		/**
		* Récupération de tous les utilisateurs
		* @return array Tableau des utilisateurs de la bdd
		*/
		public function findAll():array{
			$strUserQuery	= "SELECT user_id, user_name, user_firstname
								FROM users";
			return $this->_db->query($strUserQuery)->fetchAll();
		}
		
		/**
		* Récupération de tous les utilisateurs qui ont posté un article
		* @return array Tableau des utilisateurs de la bdd
		*/
		public function findAllCreator():array{
			$strUserQuery	= "SELECT user_id, user_name, user_firstname
								FROM users
								WHERE user_id IN (SELECT article_creator FROM articles)";
			return $this->_db->query($strUserQuery)->fetchAll();
		}		
	}
			