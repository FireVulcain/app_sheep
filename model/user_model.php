<?php 

function getUser() {

	$pdo = getPDO();

	$prepare = $pdo->prepare("SELECT id,name FROM users");
	$prepare->execute();
	
	return $prepare->fetchAll();

}