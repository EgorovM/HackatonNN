<?


    $request = htmlspecialchars($_POST['request']);

    $responce = array('text' => '', 'error' => 0);
    include('services/config.php');

    if(empty($request)) {

        $responce['text'] = 'Сделайте корректный запрос';
        $responce['error'] = 1;
        exit(json_encode($responce));

    }

    if($request == 'getPersonalData'){

        if(empty($_SESSION['login'])){

            $responce['text'] = 'Войдите в свой аккаунт.';
            $responce['error'] = 20;
            exit(json_encode($responce));

        }

        $result = mysqli_query($link, "SELECT `id`, `login`, `name`, `surname`, `mname`, `email`, `number`, `pers`, `count`, `contacts`, `birthDay` FROM `users` WHERE login = '{$_SESSION['login']}'");

        $row = mysqli_fetch_assoc($result);

        $responce = array_merge($row, $responce);

        exit(json_encode($responce));

    } else
    if($request == 'getPersonalSpent'){

        if(empty($_SESSION['login'])){

            $responce['text'] = 'Войдите в свой аккаунт.';
            $responce['error'] = 21;
            exit(json_encode($responce));

        }

        $result = mysqli_query($link, "SELECT * FROM `bill` WHERE userLogin = '{$_SESSION['login']}'");

        $i = 0;

        while($row = mysqli_fetch_assoc($result)){

            $responce[$i] = $row;

            $i++;

        };

        exit(json_encode($responce));

    } else
    if($request == 'getUserData'){

        $userId = htmlspecialchars($_POST['id']);

        if(empty($userId)){

            $responce['text'] = 'Некорретный запрос.';
            $responce['error'] = 22;
            exit(json_encode($responce));

        }

        $result = mysqli_query($link, "SELECT `id`, `name`, `surname`, `mname`, `email`, `number`, `contacts` FROM `users` WHERE id = '{$userId}'");

        $row = mysqli_fetch_assoc($result);

        $responce = array_merge($row, $responce);

        exit(json_encode($responce));

    } else
    if($request == 'getNews'){

        $result = mysqli_query($link, "SELECT * FROM `news` WHERE 1");

        $i = 0;

        while($row = mysqli_fetch_assoc($result)){

            $responce[$i] = $row;

            $i++;

        };

        exit(json_encode($responce));

    } else
    if($request == 'getCrfund'){

        $result = mysqli_query($link, "SELECT * FROM `crfund` WHERE id = '{$id}'");

        $row = mysqli_fetch_assoc($result)

        $responce = array_merge($row, $responce);

        exit(json_encode($responce));

    }





?>
