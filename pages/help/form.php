<?php

if (isset($_POST['submit_btn'])) {

	$to = "admin@onlsch.store";
	$from = "danvilcka@icloud.com";
	$subject = "Новая заявка на сайте";
	$message = "На сайте была заполнена форма обратной связи"."\r\n"
		."<b>Тема:</b> ".$_POST['theme']."\r\n"
		."<b>Ваше имя:</b> ".$_POST['name']."\r\n"
		."<b>Ваш email:</b> ".$_POST['email']."\r\n"
		."<b>Сообщение:</b> ".$_POST['message']."\r\n";
    $headers = "Content-type: text/html; charset=windows-1251 \r\n";
	$headers = "From: ".$from."\r\nContent-type: text/html; charset=utf-8\r\n";
    if (mail($to, $subject, $message, $headers)){
        echo "<h3>Сообщение отправлено</h3>";
    } else {
        echo "<h3>Не получилось отправить сообщение</h3>";
    }

}
