<?php
# session
session_start();

#constante de l'application
define('SALT', 'SALT123');
define('TOKEN_TIME', 5);
# database
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_DBNAME', 'db_sheep');


# autoloader
require_once __DIR__ . '/library/helpers.php';
require_once __DIR__ . '/model/insert_spend_model.php';
require_once __DIR__ . '/model/spend_model.php';
require_once __DIR__ . '/model/user_spends_model.php';
require_once __DIR__ . '/model/user_model.php';
require __DIR__ . '/controllers/back_controller.php';
require __DIR__ . '/controllers/front_controller.php';



# request
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];
