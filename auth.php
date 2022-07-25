<?php
    //Запускаем сессию
    session_start();

    //Добавляем файл подключения к БД
    require_once("connect.php");

    //Объявляем ячейку для добавления ошибок, которые могут возникнуть при обработке формы.
    $_SESSION["error_messages"] = '';
     
    //Объявляем ячейку для добавления успешных сообщений
    $_SESSION["success_messages"] = '';

	$login = trim($_POST["login"]);
	$password = trim($_POST["password"]);


if (isset($mysqli)) {
    $result_query_select = $mysqli -> query("SELECT * FROM users WHERE login = '".$login."' AND password = '".$password."'");
}

if (isset($result_query_select)) {
    if(!$result_query_select){
                // Сохраняем в сессию сообщение об ошибке.
            $_SESSION["error_messages"] .= "<p class='message_error' >Ошибка запроса на выборке пользователя из БД</p>";

                //Возвращаем пользователя на страницу регистрации
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: /form_auth.php");

                //Останавливаем скрипт
            exit();
        }else{
                //Проверяем, если в базе нет пользователя с такими данными, то выводим сообщение об ошибке
            if($result_query_select->num_rows == 1){
                while($row = $result_query_select->fetch_assoc())// получаем все строки в цикле по одной
                {
                    $_SESSION['id']=$row['id'];
                    $_SESSION['phone'] = $row['phone'];
                    $_SESSION['class'] = $row['class'];
                    $_SESSION['status'] = $row['status'];
                    $_SESSION['first_name'] = $row['first_name'];
                    $_SESSION['last_name'] = $row['last_name'];
                    $_SESSION['skype'] = $row['skype'];
                    $_SESSION['login'] = $row['login'];
                    $_SESSION['password'] = $row['password'];
                }
                    //Возвращаем пользователя на главную страницу
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: /index.php");

            }else{
                    // Сохраняем в сессию сообщение об ошибке.
                $_SESSION["error_messages"] .= "<p class='message_error' >Неправильный логин и/или пароль</p>";
                    //Возвращаем пользователя на страницу авторизации
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: /form_auth.php");
                    //Останавливаем скрипт
                exit();
            }
        }
}

