{extends file="views/layout.tpl"}

{block name="title_head" append}
 - {$strTitle}
{/block}

{block name="js_head"}
		<script src="assets/js/period.js"></script>
{/block}
		

{block name="contenu"}
	<div class="row mb-2">
		<form name="formSearch" method="post" action="#" >
			<fieldset>
				<legend>Rechercher des articles</legend>
				<div class="col-4">
				<p>
					<label for="keywords">Mots clés</label>
					<input id="keywords" type="text" name="keywords" value="{$objArticleModel->strKeywords}" class="form-control" >
				</p>
				</div>
				<div class="col-4">
				<p>	
					<input type="radio" name="period" {if ($objArticleModel->intPeriod == 0)} checked {/if} value="0" onclick="changePeriod()" class="form-check-input" > Par date exacte
					<input type="radio" name="period" {(($objArticleModel->intPeriod == 1)?"checked":"")} value="1" onclick="changePeriod()"  class="form-check-input" > Par période
				</p>
				<p id="uniquedate">
					<label for="date">Date</label>
					<input id="date" type="date" name="date" value="{$objArticleModel->strDate}"  class="form-control" >
				</p>
				<p id="period">
					<label for="startdate">Date de début</label>
					<input id="startdate" type="date" name="startdate" value="{$objArticleModel->strStartDate}"  class="form-control" >
					<label for="enddate">Date de fin</label>
					<input id="enddate" type="date" name="enddate" value="{$objArticleModel->strEndDate}"  class="form-control" >
				</p>
				</div>
				<div class="col-4">
				<p>
					<label for="author">Auteur</label>
					<select id="author" name="creator"  class="form-control">
						<option value="0" {(($objArticleModel->intCreator == 0)?"selected":"")} > -- </option>
						{foreach from=$arrUsers item=arrDetUser}
							{*// Instancier objet User
							$objUser = new User();
							$objUser->hydrate($arrDetUser);
						<option value="{$objUser->getId())}" 
								{($objArticleModel->intCreator == $objUser->getId())?"selected":""} >
							{$objUser->getCreatorName()}
						</option>*}
						{/foreach}
					</select>
				</p>
				</div>
				<p><input type="submit" value="Rechercher" /> <input type="reset" value="Réinitialiser" />
			</fieldset>
		</form>
	
	{foreach from=$arrArticles item=objArticle}
		{include file="views/_partial/article.tpl"}
	{/foreach}
	</div>
{/block}