<?

    include('services/config.php');

    $request = htmlspecialchars($_POST['request']);

    $responce = array('text' => '', 'error' => 0);

    if(empty($request)) {

        $responce['text'] = 'Сделайте корректный запрос';
        $responce['error'] = 1;
        exit(json_encode($responce));

    }

    if($request == 'pushNewBill'){


        $date = date("Y-m-d");
        $kwN = $_POST['kwN'];
        $kwM = $_POST['kwM'];
        $total = $kwN*384+$kwM*593;

        if(empty($_SESSION['login'])){

            $responce['text'] = 'Войдите в свой аккаунт.';
            $responce['error'] = 20;
            exit(json_encode($responce));

        }

        $result = mysqli_query($link, "INSERT INTO `bill`(`userLogin`, `date`, `kwM`, `kwN`, `totalPrice`) VALUES ('{$_SESSION['login']}','{$date}','{$kwM}','{$kwN}','{$total}')");

        $responce['text'] = 'Готово.';

        exit(json_encode($responce));

    } else
    if($request == 'pushNewBill'){


        $id = htmlspecialchars($_POST['id']);
        $type = htmlspecialchars($_POST['type']);
        $money = htmlspecialchars($_POST['money']);
        $title = htmlspecialchars($_POST['title']);

        if(empty($_SESSION['login'])){

            $responce['text'] = 'Войдите в свой аккаунт.';
            $responce['error'] = 20;
            exit(json_encode($responce));

        }


        if($type == 'payment'){

            $result = mysqli_query($link, "INSERT INTO `crfund`(`type`, `money`, `user`, `title`) VALUES ('{$type}','{$money}','{$_SESSION["login"]}','{$title}')");

            $result = mysqli_query($link, "SELECT `money` from `crfund` WHERE id='{$id}'");

            $row = mysqly_fetch_assoc($result);
            $row['money'] = intval($row['money']) + intval($money);\

            $result = mysqli_query($link, "UPDATE `crfund` SET `needMoney`='{$row['money']}' WHERE id='{$id}'");

        } else {

            $result = mysqli_query($link, "INSERT INTO `crfund`(`type`, `money`, `needMoney`, `user`, `title`) VALUES ('{$type}',0,'{$money}','{$_SESSION["login"]}','{$title}')");

        }

        $responce['text'] = 'Готово.';

        exit(json_encode($responce));

    }

?>
