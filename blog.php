<?php
	// Variables d'affichage
	$strTitle	= "Blog";
	$strDesc	= "Page affichant tous les articles, avec une zone de recherche sur les articles";
	
	// Variables fonctionnelles
	$strPage	= "blog";
	
	include_once("header.php");
	
	require_once("connexion.php");
	
	var_dump($_POST);
	// Récupération des données du formulaire
	$strKeywords 	= $_POST['keywords']??"";
	$strDate 		= $_POST['date']??"";
	$strStartDate 	= $_POST['startdate']??"";
	$strEndDate 	= $_POST['enddate']??"";
	$intPeriod		= $_POST['period']??0;
	$intCreator		= $_POST['creator']??0;
	
	$strQuery		= "SELECT articles.*, 
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
						
						
	var_dump($strQuery);
	$arrArticles	= $db->query($strQuery)->fetchAll();
	
?>

	<div class="row mb-2">
		<form name="formSearch" method="post" action="#">
			<fieldset>
				<legend>Rechercher des articles</legend>
				<p>
					<label for="keywords">Mots clés</label>
					<input id="keywords" type="text" name="keywords" value="<?php echo($strKeywords); ?>" />
				</p>
				<p>	
					<input type="radio" name="period" <?php if ($intPeriod == 0){ echo("checked"); } ?> value="0" onclick="changePeriod()" /> Par date exacte
					<input type="radio" name="period" <?php echo(($intPeriod == 1)?"checked":""); ?> value="1" onclick="changePeriod()" /> Par période
				</p>
				<p id="uniquedate">
					<label for="date">Date</label>
					<input id="date" type="date" name="date" value="<?php echo($strDate); ?>" />
				</p>
				<p id="period">
					<label for="startdate">Date de début</label>
					<input id="startdate" type="date" name="startdate" value="<?php echo($strStartDate); ?>" />
					<label for="enddate">Date de fin</label>
					<input id="enddate" type="date" name="enddate" value="<?php echo($strEndDate); ?>"/>
				</p>
				<p>
					<label for="author">Auteur</label>
					<select id="author" name="creator">
						<option value="0" <?php echo(($intCreator == 0)?"selected":"");?> > -- </option>
						<option value="1" <?php echo(($intCreator == 1)?"selected":"");?> >christel</option>
						<option value="2" <?php echo(($intCreator == 2)?"selected":"");?> >test</option>
					</select>
				</p>
				<p><input type="submit" value="Rechercher" /> <input type="reset" value="Réinitialiser" />
			</fieldset>
		</form>
	
	<?php
		foreach($arrArticles as $arrDetArticle){
			include("article.php");
		}
	?>
	</div>
<?php
	include_once("footer.php");
?>