<?php

    $to  = $email;
    $subject = "Регистрация";

    $regLink = 'http://safetran.ru/backend/regConf.php?pass='.$pass;

    $message = '<p>Вы зарегистрировались на сайт safetran.ru </p> <p>Подтвердите почту, перейдя по этой ссылке, чтобы начать получить доступ к аккаунту!'.$regLink.'</p>';

    $headers  = "Content-type: text/html; charset=utf-8 \r\n";
    $headers .= "From: safetran.ru\r\n";
    $headers .= "Reply-To: safetran.ru\r\n";

    mail($to, $subject, $message, $headers);

?>
