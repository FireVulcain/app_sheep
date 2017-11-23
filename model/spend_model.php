<?php 
function spend_model( $args, $where = 1, $limit = 10 ) {

	$pdo = getPDO();
	$prepare = $pdo->prepare("SELECT $args FROM spends WHERE ? LIMIT ?");

	$prepare->bindValue(1,$where,PDO::PARAM_INT); //PDO::PARAM_INT passe limite en int
	$prepare->bindValue(2,$limit,PDO::PARAM_INT);

	$prepare->execute();

	return $prepare->fetchAll();
}

function getSpendByUsersPart($limit,$offset) {

	$pdo = getPDO();

	$sql = "
		SELECT us.user_id, GROUP_CONCAT(u.name) as name, s.title, s.price, s.pay_date, us.price as part 
		FROM users as u
		JOIN user_spend as us
		ON us.user_id = u.id
		JOIN spends as s 
		ON s.id = us.spend_id
		GROUP BY s.pay_date
		ORDER BY s.pay_date DESC
		LIMIT ?,?;
	";
	$prepare = $pdo->prepare($sql);
	$prepare->bindValue(1,$limit, PDO::PARAM_INT);
	$prepare->bindValue(2,$offset, PDO::PARAM_INT);
    $prepare->execute();

    return $prepare->fetchAll();
}

function getTotalSpend() {

	$pdo = getPDO();

	$prepare = $pdo->prepare("SELECT SUM(price) as total FROM user_spend");
	$prepare->execute();

	$row = $prepare->fetch();

	return $row["total"];
}

function getSpendByUsers() {

	$pdo = getPDO();

	$prepare = $pdo->prepare("
		SELECT name, user_id, SUM(price) as price
		FROM user_spend as us
		INNER JOIN users as u
		ON u.id = us.user_id
		GROUP BY user_id
	");
	$prepare->execute();

	return $prepare->fetchAll();

}

function getIdSpend() {

	$pdo = getPDO();
	$req = $pdo->query("SELECT COUNT(id) as nbDep FROM spends");

	$req->execute();
	$data = $req->fetch();

	return $data['nbDep'];
}

function insertSpend() {

	$titre 		 = $_POST['titre'];
    $price 		 = $_POST['price'];
    $description = $_POST['description'];
    $date 		 = $_POST['date'];
	
	$pdo = getPDO();

	$somme = comparePrice();

	if ( $somme == $price ) {	
		$sql = "INSERT INTO spends (title, price, description, pay_date) VALUES (?,?,?,?);";
		$ins = $pdo->prepare($sql);
		return $ins->execute(array($titre,$price,$description,$date));
	}else{
		setFlashMessage('Les parts ne corréspondent pas au prix de la dépense','error');
	}
}




