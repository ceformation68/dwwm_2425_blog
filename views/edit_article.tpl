{extends file="views/layout.tpl"}

{block name="title_head" append}
 - {$strTitle}
{/block}

{block name="contenu"}
<form action="" method="post" enctype="multipart/form-data">
	<p>
		<label>Titre</label>
		<input type="text" name="title" value="{$objArticle->getTitle()}" class="form-control" >
	</p>
	<p>
		<label>Contenu</label>
		<textarea name="content" class="form-control">{$objArticle->getContent()}</textarea>
	</p>
	<img src="assets/images/{$objArticle->getImg()}" >
	<p>
		<input type="file" name="image" value="" class="form-control" >
	</p>
	<p>
		<input type="submit">
	</p>

</form>
{/block}