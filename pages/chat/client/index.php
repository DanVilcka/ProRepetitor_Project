<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . "/pages/chat/server/database.php";
include $_SERVER['DOCUMENT_ROOT'] . "/pages/chat/server/show_chat.php";


$status = $_SESSION['status'];
$id = (int)$_SESSION['id'];

$db = new mysqli("danvil1z.beget.tech", "danvil1z_adm", "AdminDb#0903", "danvil1z_adm");
$db->set_charset('utf8');

if (isset($_POST['view_chat'])) {

    //1 - выводим имя опонента
    $_SESSION['name_oponent'] = $_POST['view_chat'];

    //2 - выводим сообщения

    $_SESSION['id_room'] = $_POST['id_chat'];

    //3 - выводим чат
    View_chat($_SESSION['id_room'], $_SESSION['name_oponent']);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <title>chat</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="js/chat_js.js"></script>
    <link rel="stylesheet" href="/pages/chat/client/style/index.css">
    <link rel="stylesheet" href="/pages/chat/client/style/write_style.css">
    <link rel="stylesheet" href="/pages/chat/client/style/info_style.css">
    <link rel="stylesheet" href="/pages/chat/client/style/space_style.css">

</head>

<body>

    <div class="rooms">
        <?php
        if ($status == 2) {
            ?>
            <div class="rooms_div" style="height: 90vh; width: 100%">
                <h2 style="text-align: center"> Чаты </h2>
                <ul class="rooms_menu">
                    <?php
                    $row = get_r();
                    foreach ($row as $room):
                        $name_room = get_name($room['id_teacher']);
                        ?>
                        <li>
                            <?php
                            print_r('
                                    <form id="id_room" action="" method="post">
                                        <input name="id_chat" type="hidden" value="' . $room['id_room'] . '"/>
                                        <input name="view_chat" type="submit" style="padding:0; margin:0; border:0; background-color:transparent; font-size: 2vh; width: 100%" value="' . $name_room . '" />
                                    </form>
                                    ');
                            ?>
                        </li>
                    <?php
                            endforeach;
                            ?>
                        </ul>

                    </div>
                <?php
                } elseif ($status==1) {
            ?>
            <div class="find">
                <form method="post" id="search_form">
                    <label>
                        <input type="text" name="id_find" style="border: 1px solid black">
                    </label>
                    <input type="submit" value="Поиск">
                </form>
            </div>
            <?php
                        $id_find = trim($_POST['id_find']);
                        $result = $db -> query("SELECT * FROM users WHERE id = '".$id_find."'");
                        if($result -> num_rows == 1){
                            while ($row = $result->fetch_assoc()) {
                                print_r($row['first_name'] . ' ' . $row['last_name'] . ' ');
                            }
                        }

                        function add_chat($id_find): bool
                        {
                            global $db, $id;
                            $lev1 = $db->query("select * from users where id = ' " . $id_find . "'  ");
                            if ($lev1->num_rows == 1) {
                                $lev2 = $db->query("select * from rooms where (id_teacher = ' " . $id_find . "' and id_user = ' " . $id . "') or (id_teacher = '" . $id . "' and id_user = '" . $id_find . "') ");
                                if ($lev2->num_rows == 0) {
                                    //lev 3
                                    if ($id_find != 0 and $id_find != $id) {
                                        $add_room = $db->query("INSERT INTO rooms (`id_teacher`, `id_user`) VALUES ('" . $id . "', '" . $id_find . "') ");

                                    }
                                } else {
                                    exit('<br><p> Пользователь уже добавлен</p>');
                                }
                            } else {
                                exit('<br><p> Пользователь не найден</p>');
                            }
                            if (isset($add_room)) {
                                return (bool)$add_room;
                            } else {
                                return false;
                            }
                        }

            if (!empty($_POST['id_find'])) {
                add_chat($_POST['id_find']);
            }
            ?>

            <div class="rooms_div"
                 style="margin-top: 1vh; border-top: 1px solid black; height: 89vh; width: 100%">
                <h2 style="text-align: center"> Чаты </h2>
                <ul class="rooms_menu">
                    <?php
                    $row = get_r();
                    foreach ($row as $room):
                        $name_room = get_name($room['id_user']);
                        ?>
                        <li>
                            <?php
                            print_r('                                      
                            <form id="id_room" action="" method="post">
                                <input name="id_chat" type="hidden" value="' . $room['id_room'] . '"/>
                                <input name="view_chat" type="submit" style="padding:0; margin:0; border:0; background-color:transparent; font-size: 2vh; width: 100%" value="' . $name_room . '" />
                            </form>
                            ');
                            ?>
                        </li>
                    <?php
                    endforeach;
                    ?>
                </ul>
            </div>
            <?php

        }

        ?>
    </div>


</body>


</html>