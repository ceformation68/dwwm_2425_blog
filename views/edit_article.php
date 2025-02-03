<?php
	var_dump($objArticle);
?>

<form action="" method="post">
	<p>
		<label>Titre</label>
		<input type="text" name="title" value="<?php echo($objArticle->getTitle()); ?>" class="form-control" >
	</p>
	<p>
		<label>Contenu</label>
		<textarea name="content" class="form-control"><?php echo($objArticle->getContent()); ?></textarea>
	</p>
	<p>
		<input type="submit">
	</p>

</form>