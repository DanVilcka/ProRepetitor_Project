<?php
session_start();


	// Указываем кодировку
header('Content-Type: text/html; charset=utf-8');

$mysqli = new mysqli("danvil1z.beget.tech", "danvil1z_adm", "AdminDb#0903", "danvil1z_adm");

	// Проверяем, успешность соединения.
if ($mysqli->connect_errno) {
	die("<p><strong>Ошибка подключения к БД</strong></p><p><strong>Код ошибки: </strong> ". $mysqli->connect_errno ." </p><p><strong>Описание ошибки:</strong> ".$mysqli->connect_error."</p>");
} else {
	print_r('yes');
}

	// Устанавливаем кодировку подключения
$mysqli->set_charset('utf8');


