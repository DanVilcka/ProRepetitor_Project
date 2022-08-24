<?php
	//Подключение шапки
require_once("header.php");
?>

<div class="block_for_messages">

<?php
		//Если в сессии существуют сообщения об ошибках, то выводим их
	if(isset($_SESSION["error_messages"]) && !empty($_SESSION["error_messages"])){
		echo $_SESSION["error_messages"];

			//Уничтожаем чтобы не выводились заново при обновлении страницы
		unset($_SESSION["error_messages"]);
	}

		//Если в сессии существуют радостные сообщения, то выводим их
	if(isset($_SESSION["success_messages"]) && !empty($_SESSION["success_messages"])){
		echo $_SESSION["success_messages"];

			//Уничтожаем чтобы не выводились заново при обновлении страницы
		unset($_SESSION["success_messages"]);
	}
?>

</div>

<?php
	//Проверяем, если пользователь не авторизован, то выводим форму регистрации,
	//иначе выводим сообщение о том, что он уже зарегистрирован
	if(!isset($_SESSION["login"]) && !isset($_SESSION["password"])){
?>

<div id="form_register">
	<h2 style="text-align: center">Форма регистрации</h2>

	<form action="register.php" method="post" name="form_register">
		<table id="reg">
			<tbody>

			<tr>
			<td> Статус: </td>
			<td>
                <label>
                    <select name="status">
                        <option value="1">Репетитор</option>
                        <option value="2">Ученик</option>
                    </select>
                </label>
            </td>
			</tr>

			<tr>
			<td> Имя: </td>
			<td>
                <label>
                    <input type="text" name="first_name" placeholder="Иван" required="required">
                </label>
            </td>
			</tr>

			<tr>
			<td> Фамилия: </td>
			<td>
                <label>
                    <input type="text" name="last_name" placeholder="Иванов" required="required">
                </label>
            </td>
			</tr>

			<tr>
			<td> Класс: </td>
			<td>
                <label>
                    <select name="class">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                    </select>
                </label>
                <span id="valid_email_message" class="mesage_error"></span>
            </td>
            </tr>

            <tr>
                <td> Телефон:</td>
                <td>
                    <label>
                        <script src="libs/jquery.maskedinput/dist/jquery.maskedinput.min.js"></script>
                        <input id="phone" name="phone" required="required" placeholder="+7(999) 999-99-99">
                        <script>
                            $(function () {
                                $("#phone").mask("+7(999) 999-99-99");
                            });
                        </script>
                    </label><br>
                    <span id="valid_email_message" class="message_error"></span>
                </td>
            </tr>

            <tr>
                <td> Логин :</td>
                <td>
                    <label>
                        <input name="login" placeholder="Ivan" required="required">
                </label><br>
			<span id="valid_email_message" class="message_error"></span>
			</td>
			</tr>

			<tr>
			<td> Пароль: </td>
			<td>
                <label>
                    <input type="password" name="password" placeholder="минимум 6 символов" required="required">
                </label><br>
			<span id="valid_password_message" class="message_error"></span>
			</td>
			</tr>

			<tr>
			<td colspan="2" style="padding-left: 25%;">
			<input type="submit" name="btn_submit_register" value="Зарегистрироватся!" >
			</td>
			</tr>

			</tbody>
		</table>
	</form>
</div>


<?php
	}else{
?>
	<div id="authorized">
	<h2>Вы уже зарегистрированы</h2>
	</div>

<?php
    }
?>