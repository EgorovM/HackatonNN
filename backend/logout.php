<?

    header('Access-Control-Allow-Origin: *');
    session_start();

    echo $_SESSION['login'];

    session_destroy();

?>
