<?

    $request = htmlspecialchars($_POST['request']);

    $responce = array('text' => '', 'error' => 0);

    if(empty($request)) {

        $responce['text'] = 'Сделайте корректный запрос';
        $responce['error'] = 1;
        exit(json_encode($responce));

    }

    include('services/config.php');

    session_start();

    if($request == 'getPersonalData'){

        if(empty($_SESSION['login'])){

            $responce['text'] = 'Войдите в свой аккаунт.';
            $responce['error'] = 20;
            exit(json_encode($responce));

        }

        $result = mysqli_query($link, "SELECT `id`, `login`, `name`, `surname`, `mname`, `email`, `number`, `pers`, `count`, `contacts`, `birthDay` FROM `users` WHERE login = '{$_SESSION['login']}'")

        $row = mysqli_fetch_row($result);

        $responce = array_merge($row, $responce);

        exit(json_encode($responce);

    } else
    if($request == 'getPersonalSpent'){

        if(empty($_SESSION['login'])){

            $responce['text'] = 'Войдите в свой аккаунт.';
            $responce['error'] = 21;
            exit(json_encode($responce));

        }

        $result = mysqli_query($link, "SELECT * FROM `bill` WHERE userLogin = '{$_SESSION['login']}'")

        $row = mysqli_fetch_row($result);

        $responce = array_merge($row, $responce);

        exit(json_encode($responce);

    } else
    if($request == 'getUserData'){

        $userId = htmlspecialchars($_POST['id']);

        if(empty($userId)){

            $responce['text'] = 'Некорретный запрос.';
            $responce['error'] = 22;
            exit(json_encode($responce));

        }

        $result = mysqli_query($link, "SELECT `id`, `name`, `surname`, `mname`, `email`, `number`, `contacts` FROM `users` WHERE id = '{$userId}'")

        $row = mysqli_fetch_row($result);

        $responce = array_merge($row, $responce);

        exit(json_encode($responce);

    }





?>
