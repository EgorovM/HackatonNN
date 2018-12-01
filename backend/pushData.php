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

    }





?>
