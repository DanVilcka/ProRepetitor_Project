<?php
	//Подключение шапки
require_once 'header.php';
?>


<!DOCTYPE html>

<html lang="en">

<head>
    <title> ProRepetitor </title>
    <meta charset="utf-8">
    <link href="/style.css" type="text/css" rel="stylesheet">
</head>

<body>
<?php
	//Проверяем авторизован ли пользователь
if(!isset($_SESSION['email']) && !isset($_SESSION['password'])){
		// если нет, то выводим блок с ссылками на страницу регистрации и авторизации
	?>

	<div id="hello">
		<h1>Добро пожаловать!</h1>
		<h3>Вы можете зарегистрироваться, если вы еще этого не сделали!</h3>
	</div>
    <div class="auth_block">
        <div id="link_register">
            <a href="/form_register.php">Зарегистрироваться</a>
        </div>

        <div id="link_auth">
            <a href="/form_auth.php">Войти</a>
        </div>
    </div>

	<?php
}else{
		//Если пользователь авторизован, то выводим ссылку Выход
	?>
    <div class="window">

        <div class="Menu">
            <ul class="menu">
                <li>
                    <a href="pages/profile/profile.php" target="OpenSpace"> Профиль </a>
                </li>
                <li>
                    <a href="pages/chat/client/index.php" target="OpenSpace"> Чат </a>
                </li>
                <li>
                    <a href="pages/help/help.php" target="OpenSpace"> Поддержка </a>
                </li>
                <li>
                    <div id="link_logout">
                        <a href="/logout.php">Выход</a>
                    </div>
                </li>
            </ul>
        </div>

        <iframe class="OpenSpace" name="OpenSpace"></iframe>

    </div>
<?php
}
?>


</body>

</html>

