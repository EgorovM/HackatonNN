<?

    $login = htmlspecialchars($_POST['login']);
    $password = md5(htmlspecialchars($_POST['password']));

    include('services/config.php');

    if ($result = mysqli_query($link, "SELECT `id` FROM `users` WHERE login = '{$login}'")) {
        $row = mysqli_fetch_row($result);
        if(empty($row)){

            exit('Неверные данные');

        }

        if($result = mysqli_query($link, "SELECT `password`, `canLogin`, `login` FROM `users` WHERE login = '{$login}'")){

            $row = mysqli_fetch_assoc($result);

            if(!$row['canLogin']){

                exit('Подтвердите почту!');

            }

            if($row['password'] == $password){
                session_start();
                $_SESSION['login'] = $row['login'];
                echo 'Вы залогинились!';
            } else {
                echo 'Неверные данные!';
            }

        } else {

            exit('Ошибка. Попробуйте позже!');

        }
    }

?>
