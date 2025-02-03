	<div class="row mb-2">
		<form name="formSearch" method="post" action="#" >
			<fieldset>
				<legend>Rechercher des articles</legend>
				<div class="col-4">
				<p>
					<label for="keywords">Mots clés</label>
					<input id="keywords" type="text" name="keywords" value="<?php echo($objArticleModel->strKeywords); ?>" class="form-control" >
				</p>
				</div>
				<div class="col-4">
				<p>	
					<input type="radio" name="period" <?php if ($objArticleModel->intPeriod == 0){ echo("checked"); } ?> value="0" onclick="changePeriod()" class="form-check-input" > Par date exacte
					<input type="radio" name="period" <?php echo(($objArticleModel->intPeriod == 1)?"checked":""); ?> value="1" onclick="changePeriod()"  class="form-check-input" > Par période
				</p>
				<p id="uniquedate">
					<label for="date">Date</label>
					<input id="date" type="date" name="date" value="<?php echo($objArticleModel->strDate); ?>"  class="form-control" >
				</p>
				<p id="period">
					<label for="startdate">Date de début</label>
					<input id="startdate" type="date" name="startdate" value="<?php echo($objArticleModel->strStartDate); ?>"  class="form-control" >
					<label for="enddate">Date de fin</label>
					<input id="enddate" type="date" name="enddate" value="<?php echo($objArticleModel->strEndDate); ?>"  class="form-control" >
				</p>
				</div>
				<div class="col-4">
				<p>
					<label for="author">Auteur</label>
					<select id="author" name="creator"  class="form-control">
						<option value="0" <?php echo(($objArticleModel->intCreator == 0)?"selected":"");?> > -- </option>
						<?php foreach ($arrUsers as $arrDetUser) { 
							// Instancier objet User
							$objUser = new User();
							$objUser->hydrate($arrDetUser);
							// Remplir l'objet => set
							/*$objUser->setId($arrDetUser['user_id']);
							$objUser->setName($arrDetUser['user_name']);
							$objUser->setFirstname($arrDetUser['user_firstname']);*/
							
						?>
						
						<option value="<?php echo($objUser->getId()); //=> Utiliser le getter ?>" 
								<?php echo(($objArticleModel->intCreator == $objUser->getId())?"selected":"");?> >
							<?php echo($objUser->getCreatorName()); ?> 
						</option>
						<?php }	?>
					</select>
				</p>
				</div>
				<p><input type="submit" value="Rechercher" /> <input type="reset" value="Réinitialiser" />
			</fieldset>
		</form>
	
	<?php
		foreach($arrArticles as $arrDetArticle){
			$objArticle = new Article(); // Article 'coquille vide' 
			// hydrater l'objet
			$objArticle->hydrate($arrDetArticle);			
			include("views/_partial/article.php");
		}
	?>
	</div>
