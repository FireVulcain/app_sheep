<!-- CSS PAR PAGE -->
<?php ob_start(); ?>
<link rel="stylesheet" href="/assets/css/style.css">
<?php $cssAuth = ob_get_clean(); ?>


<?php ob_start(); ?> <!-- Démarre le tampon de sortie -->
<div class="container">
	<form action="/auth" method="POST" class="register-form"> 
	  	<div class="row">  
	  		<p>
	  			<?php echo getFlashMessage(); ?>	
	  		</p> 
	  	
	       	<div class="grid-4">
	          	<label for="firstName">EMAIL</label>
	           	<input class="form-control" type="email" name="email" value="<?php echo $_SESSION['email']?? ''; ?>">
	       	</div>            
	  	</div>
	  	<div class="row">
	       	<div class="grid-4">
	          	<label for="password">MOT DE PASSE</label>
	           <input name="password" class="form-control password" type="password">             
	       	</div>            
	 	</div>
	 	<input type="hidden" value="<?php 
	 	$salt = 'SALT123';
	 	echo $token = md5(date('Y-m-d h:i:00').$salt);

	 	?>" name="token">
	  	<div class="row">
	       	<div class="grid-6">
	       		<input type="submit" class="btn btn-default regbutton" name="Ok" value="Ok">
	    	</div>   
	  	</div>   
	</form>
</div>


<!-- ob_get_clean -> récupere les octets dans la mémoire tampon et les mets dans une variable | echo pour l'afficher -->
<?php $content = ob_get_clean(); ?>


<?php include __DIR__ . '/../layouts/master.php' ; ?>