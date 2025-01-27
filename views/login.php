	<?php if (count($arrErrors) > 0){ ?>
		<div class="alert alert-danger">
		<?php foreach($arrErrors as $strError){ ?>
			<p><?php echo $strError; ?></p>
		<?php } ?>
		</div>
	<?php } ?>
					
	<form method="post">
		<p>
			<label for="mail" class="form-label">Mail</label>
			<input type="text" class="form-control" id="mail" name="mail" value="<?php echo($strMail); ?>" >
		</p>
		<p>
			<label for="password" class="form-label">Mot de passe</label>
			<input type="password" class="form-control" id="password" name="password" >
		</p>
		<p>
			<input type="submit" >
		</p>
	</form>
