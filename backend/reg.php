<?

    $login = htmlspecialchars($_POST['login']);
    $email = htmlspecialchars($_POST['email']);
    $password = md5(htmlspecialchars($_POST['password']));
    $name = htmlspecialchars($_POST['name']);
    $surname = htmlspecialchars($_POST['surname']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $number = htmlspecialchars($_POST['number']);
    $pers = json_decode(htmlspecialchars($_POST['pers']));

    if(strlen($password)<8){
        exit('Минимальная длина пароля - 8 символов');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        exit("Введите правильный адрес почты!");
    }

    if(!preg_match("/^[0-9]{11}$/", $number)) {
        exit("Введите правильный номер телефона!");
    }

    if(empty($login) || empty($email) || empty($name) || empty($surname) || empty($last_name) || empty($number) || empty($pers)){
        exit("Заполните все поля!");
    }

    include('services/config.php');

    if ($result = mysqli_query($link, "SELECT `id` FROM `users` WHERE `login` = '{$login}' OR `email` = '{$email}' OR `number` = '{$number}'")) {
        $row = mysqli_fetch_row($result);
        if(!empty($row)){

            exit('Такой логин/почта/номер уже занят!');

        }

        if($result = mysqli_query($link, "INSERT INTO `users` (`login`, `canLogin`, `password`, `name`, `surname`, `mname`, `email`, `number`, `pers`, `avatar`) VALUES ('{$login}','0','{$password}','{$name}','{$surname}','{$last_name}','{$email}','{$number}','{json_encode($pers)}','media/avatars/default.png')"))
        {
            $pass = generateRandomString();
            include('mail.php');
            $result = mysqli_query($link, "INSERT INTO `usersreg` (`login`, `pass`) VALUES ('{$login}','{$pass}')");
            echo 'Все почти готово! Подтвердите свою почту и можете начать работать!';

        } else {

            exit('Ошибка. Попробуйте позже!');

        }
    }

?>
