<?php
function index() {

	include __DIR__ . '/../views/front/auth.php';
}

function auth(){

	$pdo = getPDO();

	$flagToken = false;
    $token = $_POST['token'];

	if (isset($token) ) {
		foreach(range(0,TOKEN_TIME) as $t){
            if($token == md5( date('Y-m-d h:i:00', time() - 60*$t ) . SALT ) ){
               $flagToken = true;
            }
        }
	}
     if ( $flagToken == false ) {
        header('Location : /');
        exit;
    }

	$email = $_POST['email'];
    $password =  $_POST['password'];
    $rules = [
        
        'email' => FILTER_VALIDATE_EMAIL,
        'password' => [
            
            'filter' => FILTER_CALLBACK,
            'options' => function($pass){
            
                if( strlen($pass) < 4 ){
                    return false;
                }
                
                return $pass;
            
            }
        ]
    ];
    $sanitize = filter_input_array(INPUT_POST, $rules);
    
    $_SESSION['email']  = $santize['email'];  

    $prepare = $pdo->prepare('SELECT id, password FROM users WHERE email = ?');
    $prepare->bindValue(1, $sanitize['email']);
    $prepare->execute();
    $stmt = $prepare->fetch();

    
    if( password_verify($sanitize['password'], $stmt['password']) ){

        // regenérer le cookie de session
        session_regenerate_id(true); 

        $_SESSION['auth'] = $stmt['id'];
        header('Location: /admin');
        exit;

    }else{
        setFlashMessage("Email ou mot de passe incorrect", "error");
        header('Location: /');
        exit();
    }
}

function addDep() {

    $datas = getUser();

    if ( isset($_POST['titre'], $_POST['price'], $_POST['date']) ) {
        if (!empty($_POST['titre']) AND !empty($_POST['price']) AND !empty($_POST['date']) AND !empty($_POST['name']) AND is_array($_POST['name'])) {
            insert_spend();
        }else{
            setFlashMessage("Veuillez remplir tous les champs", "error");
            header('Location: /addDep');
            exit();
        }
    }

    include __DIR__ . '/../views/back/addDepense.php';
}
