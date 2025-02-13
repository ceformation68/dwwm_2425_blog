<?php 
	header('Content-Type: application/json');
	/**
	* Controleur des API
	* @author Christel
	* @date 13/02/2025
	*/
	class ApiCtrl {
		public function index(){
			$strMethodHTTP = $_SERVER['REQUEST_METHOD'];
			$strEndpoint	= $_GET['endpoint'];
			switch ($strEndpoint){
				case 'articles' : 
					require_once('models/article_model.php');
					require_once('entities/article_entity.php');
					$article_model 	= new ArticleModel();
					switch ($strMethodHTTP){
						case 'GET':
							$arrData		= $article_model->findAll();
							
							$response = ['status' 	=> 200,
										 'data' 	=> json_encode($arrData)];
						break;
						case 'PATCH':
							$id = $_GET['id'];
							$arrArticle	= $article_model->get($id);
							$objArticle = new Article();
							$objArticle->hydrate($arrArticle);
							$arrData = json_decode(file_get_contents('php://input'), true);
							$objArticle->hydrate($arrData);
							$boolOk = $article_model->update($objArticle);
							if ($boolOk){
								$response['status']		= 200;
								$response['message'] 	= "L'article à bien été modifié";
							}else{
								$response['status']		= 400;
								$response['message'] 	= "Requête invalide";
							}
							
						break;
					}
				break;
				case 'users' : 
				break;
			}
			
			echo json_encode($response);
		}
	}
	
	