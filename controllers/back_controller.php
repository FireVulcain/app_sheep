<?php
function dashboard() {

    $datas = getSpendByUsersPart(0,3);

    # Pour histogramme
    $total = getTotalSpend();
    $depenses = getSpendByUsers();
    $diffX = 25;

    include __DIR__ . '/../views/back/dashboard.php';
    
}


function history() {
	# Pagination
	$nbDep = getIdSpend();

	$perPage = 8;
	$cPage = 1;
	$nbPage = ceil($nbDep/$perPage);

    

	if ( isset($_GET['page']) AND $_GET['page']>0 AND $_GET['page']<=$nbPage ) {

        $_GET['page'] = intval($_GET['page']);
    	$cPage = $_GET['page'];

	}else {
	    $cPage = 1;
	}

   	$datas = getSpendByUsersPart(($cPage-1)*$perPage,$perPage);

    $total = getTotalSpend();
    
    include __DIR__ . '/../views/back/history.php';
}

function logout() {

    // delete le cookie
    
    if ( ini_get("session.use_cookies") ) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    session_destroy();
    header('Location: /');
    exit;
}


