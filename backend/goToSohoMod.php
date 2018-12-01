<?

    $passport = htmlspecialchars($_POST['passport']);
    $sohomode = htmlspecialchars($_POST['sohomode']);
    $bd = htmlspecialchars($_POST['bd']);

    if(!preg_match("/^[0-9]{10}$/", $passport)) {
        exit("Есть недопустимые символы! Вводите без пробела!");
    }

    if(strlen($passport) != 10){
        exit("Введены некорректные данные!");
    }

    if(!preg_match("/^[0-9]{2}-[0-9]{2}-[0-9]{4}$/", $bd)) {
        exit("Введите корректную дату!");
    }

    include('services/config.php');

    session_start();

    if ($result = mysqli_query($link, "SELECT `id` FROM `users` WHERE login = '{$_SESSION['login']}'")) {
        $row = mysqli_fetch_row($result);
        if(!empty($row)){

            if(!empty($passport)){

                $result = mysqli_query($link, "UPDATE `users` SET `passport`='{$passport}', `birthDay`='{$bd}' WHERE login = '{$_SESSION['login']}'");
                echo 'Готово!';

                if($sohomode == '1'){

                    $_SESSION['sohomode'] = 1;

                }

            }

        } else {

            exit('Войдите в сеть!');

        }
    }

?>
