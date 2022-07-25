<!DOCTYPE html>
<html lang="en">
<head>

	<link href="index.css" type="text/css" rel="stylesheet">
    <link href="/style.css" type="text/css" rel="stylesheet">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Online_School</title>

</head>
<body>

	<form class="form" method="POST" action="form.php">

		<div class="caption">Обратная связь</div>

		<div class="infofield">Тема обращения</div>

        <label>
            <select name="theme" required="required">
                <option value="">Выберите вариант</option>
                <option>Вопрос по работе сервиса</option>
                <option>Помощь в оформлении заказа</option>
                <option>Сотрудничество</option>
                <option>Пожелания / предложения</option>
            </select>
        </label>

        <div>Ваше имя</div>
        <label>
            <input type="text" name="name" required="required">
        </label>
        <div>Ваш email</div>
        <label>
            <input type="email" name="email" required="required">
        </label>
        <div>Сообщение</div>
        <label>
            <textarea name="message"></textarea>
        </label>

        <input type="submit" name="submit_btn" value="Отправить">

	</form>

</body>
</html>
