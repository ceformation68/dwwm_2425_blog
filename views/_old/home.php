	<div class="row mb-2">
	<?php
		foreach($arrArticles as $arrDetArticle){
			$objArticle = new Article(); // Article 'coquille vide' 
			// hydrater l'objet
			$objArticle->hydrate($arrDetArticle);
			/*
			$objArticle->setId($arrDetArticle['article_id']);
			$objArticle->setTitle($arrDetArticle['article_title']);
			$objArticle->setImg($arrDetArticle['article_img']);
			$objArticle->setContent($arrDetArticle['article_content']);
			$objArticle->setCreatedate($arrDetArticle['article_createdate']);
			$objArticle->setCreator($arrDetArticle['user_name']);
			*/
			//var_dump($objArticle);
			include("views/_partial/article.php");
		}
	?>
	</div>

