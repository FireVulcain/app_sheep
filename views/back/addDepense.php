<?php ob_start() ; ?>
<a href="/admin">Accueil</a>
<form action="" method="POST">
	<br>
	<input type="text" placeholder="Titre" name="titre"><br>
	<input type="number" placeholder="Prix" min="0" name="price"><br>
	<input type="datetime-local" placeholder="Date" name="date"><br>
	<textarea name="description" placeholder="Déscription"></textarea><br>
	<br>
	<p>Cochez les utilisateurs qui vont payer</p>
	<?php
	foreach ($datas as $data):
		$nameUser 	= htmlentities($data['name']);
		$userID		= intval($data['id'])
	?>
        <p>
        	<input type="checkbox" name = "name[]" value=<?=$userID;?>>
        	<input type="number" name="parts[<?=$userID;?>]">
        	<?php
        		echo $nameUser;
        	?>
        </p>
    <?php endforeach ?>
    <br>
    <input type="submit" class="btn btn-default regbutton" name="Ok" value="Add">
</form>
<p>
	<?php echo getFlashMessage(); ?>	
</p> 
<?php $content = ob_get_clean() ; ?>

<?php include __DIR__ . '/../layouts/master.php' ?>