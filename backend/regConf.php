<?

    $pass = htmlspecialchars($_GET['pass']);

    include('services/config.php');

    if ($result = mysqli_query($link, "SELECT * FROM `usersreg` WHERE pass = '{$pass}'")) {
        $row = mysqli_fetch_assoc($result);
        if(!empty($row)){

            if($result = mysqli_query($link, "UPDATE `users` SET `canLogin`=1  WHERE login = '{$row['login']}'"))
            {

                echo 'Все готово! Регистрация закончена!';
                $result = mysqli_query($link, "DELETE FROM `usersreg` WHERE login = '{$row['login']}'");
                session_start();
                $_SESSION['login'] = $row['login'];

            } else {

                exit('Ошибка. Попробуйте позже!');

            }

        }
    }

?>
