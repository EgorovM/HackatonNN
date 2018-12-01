<?

    $login = htmlspecialchars($_POST['login']);
    $password = md5(htmlspecialchars($_POST['password']));

    $responce = array('text' => '', 'error' => 0);

    include('services/config.php');

    if ($result = mysqli_query($link, "SELECT `id` FROM `users` WHERE login = '{$login}'")) {
        $row = mysqli_fetch_row($result);
        if(empty($row)){

            $responce['text'] = 'Неверные данные';
            $responce['error'] = 10;

            exit(json_encode($responce));

        }

        if($result = mysqli_query($link, "SELECT `password`, `canLogin`, `login` FROM `users` WHERE login = '{$login}'")){

            $row = mysqli_fetch_assoc($result);

            if(!$row['canLogin']){

                $responce['text'] = 'Подтвердите почту!';
                $responce['error'] = 11;

                exit(json_encode($responce));

            }

            if($row['password'] == $password){
                session_start();
                $_SESSION['login'] = $row['login'];
                $responce['text'] = 'Вы в сети!';
                $responce['error'] = 0;

                exit(json_encode($responce));
            } else {

                $responce['text'] = 'Неверные данные';
                $responce['error'] = 10;
                exit(json_encode($responce));
            }

        } else {

            $responce['text'] = 'Попробуйте позже!';
            $responce['error'] = 13;
            exit(json_encode($responce));

        }
    }

?>
