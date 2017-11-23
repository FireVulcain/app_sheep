<?php 
require_once __DIR__ . '/../app.php';

if( $uri == '/' ){
	index();

}elseif( $uri == '/auth' && $method == 'POST' ){
    auth();

}elseif( $uri == '/admin' ){
    if( !isset($_SESSION['auth']) ){
    
        setFlashMessage("Vous n'avez pas les autorisations pour visiter cette page", "error");
    
        header('Location: /');
        exit;
    }
    dashboard();
}elseif ( $uri == '/history' ) {
	if( !isset($_SESSION['auth']) ){
    
        setFlashMessage("Vous n'avez pas les autorisations pour visiter cette page", "error");
    
        header('Location: /');
        exit;
    }
    
	history();
}elseif( $uri == '/addDep' ) {
    if( !isset($_SESSION['auth']) ){
    
        setFlashMessage("Vous n'avez pas les autorisations pour visiter cette page", "error");
    
        header('Location: /');
        exit;
    }
    addDep();
}elseif ( $uri == '/logout' ) {
    logout();
}else {
    header('HTTP/1.1 404 Not Found');
    echo '<html><body><h1>Cette page n\'existe pas</h1></body></html>';
}







