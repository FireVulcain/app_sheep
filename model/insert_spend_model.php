<?php 

function insert_spend() {

    try{


    	$pdo = getPDO();


        $pdo->beginTransaction(); // ce met en mode transactionnel

        // requete
        insertSpend();
        insertUserID();
        $pdo->commit();  // les exécutés
        
        return true;



    }catch(Exception $e){

        var_dump($e->getMessage());

        $pdo->rollBack(); // si une exception a été retourner par PDO ou PHP on retourne dans l'état initial 
        
        
        return false;

    }

}
