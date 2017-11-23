<?php
function insertUserID() {

	$userCheck  = $_POST['name'];
	$price = $_POST['price'];

	$pdo = getPDO();

	$parts = [];

	foreach ($_POST['parts'] as $key) {
	    if ($key != null) {
	        array_push($parts, $key);
	    }
	}

	$somme = comparePrice();

	if ( $somme == $price ) {

		for($i = 0; $i < count($userCheck);$i++){
			
			$sql = "
				INSERT INTO user_spend (user_id,spend_id,price)
				VALUES(
				(SELECT u.id FROM users as u WHERE u.id = $userCheck[$i]),(SELECT max(s.id) FROM spends as s),$parts[$i]
				)
			";
			$ins = $pdo->prepare($sql);
			$exeIns = $ins->execute();
			
		}
	}else{
		setFlashMessage('Les parts ne corréspondent pas au prix de la dépense','error');
	}
	
}