<?php
    //Подключение шапки
    require_once("header.php");
?>
 
<!-- Блок для вывода сообщений -->
<div class="block_for_messages">
    <?php
 
        if(isset($_SESSION["error_messages"]) && !empty($_SESSION["error_messages"])){
            echo $_SESSION["error_messages"];
 
            //Уничтожаем чтобы не появилось заново при обновлении страницы
            unset($_SESSION["error_messages"]);
        }
 
        if(isset($_SESSION["success_messages"]) && !empty($_SESSION["success_messages"])){
            echo $_SESSION["success_messages"];
             
            //Уничтожаем чтобы не появилось заново при обновлении страницы
            unset($_SESSION["success_messages"]);
        }
    ?>
</div>
 
<?php
    //Проверяем, если пользователь не авторизован, то выводим форму авторизации, 
    //иначе выводим сообщение о том, что он уже авторизован
    if(!isset($_SESSION["login"]) && !isset($_SESSION["password"])){
?>
 
 
    <div id="form_auth">
        <h2 style="text-align: center">Форма авторизации</h2>
        <form action="auth.php" method="post" name="form_auth">
            <table id="auth">
                <tbody><tr>
                    <td> Логин: </td>
                    <td>
                        <label>
                            <input name="login"
                                   required="required">
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
                        <input type="submit" name="btn_submit_auth" value="Войти" >
                    </td>
                </tr>
            </tbody></table>
        </form>
    </div>
 
<?php
    }else{
?>
 
    <div id="authorized">
        <h2>Вы уже авторизованы</h2>
    </div>
 
<?php
    }
?>

