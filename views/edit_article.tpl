{extends file="views/layout.tpl"}

{block name="title_head" append}
 - {$strTitle}
{/block}

{block name="contenu"}
<form action="" method="post">
	<p>
		<label>Titre</label>
		<input type="text" name="title" value="{$objArticle->getTitle()}" class="form-control" >
	</p>
	<p>
		<label>Contenu</label>
		<textarea name="content" class="form-control">{$objArticle->getContent()}</textarea>
	</p>
	<p>
		<input type="submit">
	</p>

</form>
{/block}