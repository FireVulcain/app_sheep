<?php

#Function show message
function getFlashMessage()
{

    if( !isset($_SESSION) ) {
        throw new RuntimeException("Attention les sessions ne marche pas sur votre site");
    }

    if (!empty($_SESSION['flash'])) {
            $message = sprintf('<div class="info">
                <strong class="%s">%s</strong>
                </div>', 
            $_SESSION['flash']['type'],
            $_SESSION['flash']['message']
        );
        unset($_SESSION['flash']);

        return $message;
    }
}

#Funtcion set message info
function setFlashMessage($message, $type)
{
    if( !isset($_SESSION) ) {
        throw new RuntimeException("Attention les sessions ne marche pas sur votre site");
    }

    $_SESSION['flash'] = [
        'message' => $message,
        'type'    => $type
    ];
}

#Function connect pdo
function getPDO(){
    
    $defaults = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // PDO remonte les erreurs SQL, sinon il retourne une bête erreur PHP
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // retournera les données dans un tableau associatifs
    ];

    $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_DBNAME,DB_USER, DB_PASSWORD,$defaults);

    return $pdo;

}

#Function transform format date/time
function changeDate($oldDate){
    $dateFrance = date('d-m-Y à h:i:s', strtotime($oldDate));
    echo 'Le '. $dateFrance . '<br>';
}

#Function debug
function dump($data){

    echo "<pre>";

    var_dump($data);

    echo "</pre>";
}

function comparePrice() {

    $parts = [];

    foreach ($_POST['parts'] as $key) {
        if ($key != null) {
            array_push($parts, $key);
        }
    }       

    return array_sum($parts);
}


