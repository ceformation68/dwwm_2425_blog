<?php
	// Variables d'affichage
	$strTitle	= "Blog";
	$strDesc	= "Page affichant tous les articles, avec une zone de recherche sur les articles";
	
	// Variables fonctionnelles
	$strPage	= "blog";
	
	include_once("header.php");
	/*require_once("connexion.php");*/
	
	// inclure les fichiers modèles
	require("models/article_model.php");
	require("models/user_model.php");
	
	require_once("entities/article_entity.php");
	
	// instancier
	$objArticleModel	= new ArticleModel();

	// Récupération des données du formulaire
	$objArticleModel->strKeywords 	= $_POST['keywords']??"";
	$objArticleModel->strDate 		= $_POST['date']??"";
	$objArticleModel->strStartDate 	= $_POST['startdate']??"";
	$objArticleModel->strEndDate 	= $_POST['enddate']??"";
	$objArticleModel->intPeriod		= $_POST['period']??0;
	$objArticleModel->intCreator	= $_POST['creator']??0;

	// Utiliser
	$arrArticles		= $objArticleModel->findAll();	
	
	/*$strQuery		= "SELECT articles.*, 
						CONCAT(user_name, \" \", user_firstname) AS \"user_name\"
						FROM articles
							INNER JOIN users ON article_creator = user_id";
	
	
	
	// Définition du mot clé de condition
	$strWhere		= " WHERE ";
	// Recherche par mots clés
	if ($strKeywords != ""){
		$strQuery	.= $strWhere." (article_title LIKE '%".$strKeywords."%' 
							OR article_content LIKE '%".$strKeywords."%') ";
		$strWhere	= " AND "; // un seul where possible => And
	}		
							
	// Recherche par date exacte
	if ($intPeriod == 0 && $strDate != ""){
		$strQuery	.= $strWhere." article_createdate = '".$strDate."'";
		$strWhere	= " AND "; // un seul where possible => And
	}		
							
	// Recherche par période de dates
	if ($intPeriod == 1 && $strStartDate != "" && $strEndDate != ""){
		$strQuery	.= $strWhere." article_createdate 
								BETWEEN '".$strStartDate."' AND '".$strEndDate."'";
		$strWhere	= " AND "; // un seul where possible => And
	}		
							
	// Recherche par créateur
	if ($intCreator > 0){
		$strQuery	.= $strWhere." article_creator = ".$intCreator; // numérique pas de ''
		$strWhere	= " AND "; // un seul where possible => And
	}		
	
	$strQuery		.= " ORDER BY article_createdate DESC;";
	$arrArticles	= $db->query($strQuery)->fetchAll();
	*/
	
	// Recherche de la liste des utilisateurs
	// instancier
	$objUserModel	= new UserModel();
	// Utiliser
	$arrUsers		= $objUserModel->findAllCreator();
	
	
?>

	<div class="row mb-2">
		<form name="formSearch" method="post" action="#">
			<fieldset>
				<legend>Rechercher des articles</legend>
				<p>
					<label for="keywords">Mots clés</label>
					<input id="keywords" type="text" name="keywords" value="<?php echo($objArticleModel->strKeywords); ?>" />
				</p>
				<p>	
					<input type="radio" name="period" <?php if ($objArticleModel->intPeriod == 0){ echo("checked"); } ?> value="0" onclick="changePeriod()" /> Par date exacte
					<input type="radio" name="period" <?php echo(($objArticleModel->intPeriod == 1)?"checked":""); ?> value="1" onclick="changePeriod()" /> Par période
				</p>
				<p id="uniquedate">
					<label for="date">Date</label>
					<input id="date" type="date" name="date" value="<?php echo($objArticleModel->strDate); ?>" />
				</p>
				<p id="period">
					<label for="startdate">Date de début</label>
					<input id="startdate" type="date" name="startdate" value="<?php echo($objArticleModel->strStartDate); ?>" />
					<label for="enddate">Date de fin</label>
					<input id="enddate" type="date" name="enddate" value="<?php echo($objArticleModel->strEndDate); ?>"/>
				</p>
				<p>
					<label for="author">Auteur</label>
					<select id="author" name="creator">
						<option value="0" <?php echo(($objArticleModel->intCreator == 0)?"selected":"");?> > -- </option>
						<?php foreach ($arrUsers as $arrDetUser) { ?>
						<option value="<?php echo($arrDetUser['user_id']); ?>" 
								<?php echo(($objArticleModel->intCreator == $arrDetUser['user_id'])?"selected":"");?> >
							<?php echo($arrDetUser['user_name']); ?> <?php echo($arrDetUser['user_firstname']); ?>
						</option>
						<?php }	?>
					</select>
				</p>
				<p><input type="submit" value="Rechercher" /> <input type="reset" value="Réinitialiser" />
			</fieldset>
		</form>
	
	<?php
		foreach($arrArticles as $arrDetArticle){
			$objArticle = new Article(); // Article 'coquille vide' 
			$objArticle->setId($arrDetArticle['article_id']);
			$objArticle->setTitle($arrDetArticle['article_title']);
			$objArticle->setImg($arrDetArticle['article_img']);
			$objArticle->setContent($arrDetArticle['article_content']);
			$objArticle->setCreatedate($arrDetArticle['article_createdate']);
			$objArticle->setCreator($arrDetArticle['user_name']);
			include("article.php");
		}
	?>
	</div>
<?php
	include_once("footer.php");
?>