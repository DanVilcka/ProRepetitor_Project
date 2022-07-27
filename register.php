<?php
	//Запускаем сессию
session_start();

	//Добавляем файл подключения к БД
require_once("connect.php");

	//Объявляем ячейку для добавления ошибок, которые могут возникнуть при обработке формы.
$_SESSION["error_messages"] = '';

	//Объявляем ячейку для добавления успешных сообщений
$_SESSION["success_messages"] = '';

$status = trim($_POST["status"]);
$first_name = trim($_POST["first_name"]);
$last_name = trim($_POST["last_name"]);
$class = trim($_POST["class"]);
$login = trim($_POST["login"]);
$password = trim($_POST["password"]);
$phone = trim($_POST["phone"]);
$skype = trim($_POST["skype"]);



if(isset($_POST["btn_submit_register"]) && !empty($_POST["btn_submit_register"])){
    //Проверка логина
    if (!empty($login)) {
        if (isset($mysqli)) {
            $result_query_select = $mysqli->query("SELECT * FROM users WHERE login = '" . $login . "'");
            if ($result_query_select->num_rows == 1) {
                $_SESSION["error_messages"] .= "<p class='message_error'> Пользователь с введенным логином существует <br/> Пожалуйста берете другой логин </p>";
                //Возвращаем пользователя на страницу регистрации
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: /form_register.php");
                //Останавливаем  скрипт
                exit();
            }
        }
    }
    //Добавление пользователя
    if (!empty($mysqli)) {
        $result_query_insert = $mysqli->query("INSERT INTO users (status, first_name, last_name, class, login, password, phone, skype) VALUES ( '" . $status . "', '" . $first_name . "','" . $last_name . "', '" . $class . "','" . $login . "','" . $password . "', '" . $phone . "', '" . $skype . "') ");
    }
    //Отлов ошибок при добавлении
    if (!isset($result_query_insert)) {
        // Сохраняем в сессию сообщение об ошибке.
        $_SESSION["error_messages"] .= "<p class='message_error' >Ошибка запроса на добавления пользователя в БД</p>";


        //Возвращаем пользователя на страницу регистрации
		header("HTTP/1.1 301 Moved Permanently");
		header("Location: /form_register.php");
			//Останавливаем  скрипт
		exit();

	}else{
		header("Location: /form_auth.php");


        $_SESSION["success_messages"] = "<p class='success_message'>Регистрация прошла успешно!!! <br/> Теперь Вы можете авторизоваться используя Ваш логин и пароль.</p>";
	}

	/* Завершение запроса */
	$result_query_insert->close();

		//Закрываем подключение к БД
    if (isset($mysqli)) {
        $mysqli->close();
    }


} else {
	header("Location: /");
}


