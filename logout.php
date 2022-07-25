<?php
    //Запускаем сессию
    session_start();
 
    unset($_SESSION["login"]);
    unset($_SESSION["password"]);
    unset($_SESSION["class"]);
    unset($_SESSION["status"]);
    unset($_SESSION["phone"]);
    unset($_SESSION["first_name"]);
    unset($_SESSION["last_name"]);
    unset($_SESSION["skype"]);
     
    // Возвращаем пользователя на ту страницу, на которой он нажал на кнопку выход.
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: ".$_SERVER["HTTP_REFERER"]);
