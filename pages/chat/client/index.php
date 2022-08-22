<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . "/pages/chat/server/database.php";


$status = $_SESSION['status'];
$id = $_SESSION['id'];

$db = new mysqli("danvil1z.beget.tech", "danvil1z_adm", "AdminDb#0903", "danvil1z_adm");
$db->set_charset('utf8');


//view_chat
if (isset($_POST['view_chat'])) {

    //1 - выводим имя опонента
    $name_oponent = $_POST['view_chat'];

    //2 - выводим сообщения

    $ident_room = $_POST['id_chat'];
    $_SESSION['id_room'] = $ident_room;
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

<div class=t_index">

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
                        /*$id_room = $row['id_room'];*/
                        ?>
                        <li>
                            <?php
                            print_r('
                                    <form action="" method="post">
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
                <form method="post"  id="search_form">
                    <label>
                        <input  type="text" name="id_find" style="border: 1px solid black">
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
                            <form action="" method="post">
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


    <div class="Chats">

        <div id="oponent_info">
            <div id="name_oponent">
                <?php
                if (isset($name_oponent)) {
                    print_r('<p style="width:100%; font-size: 3vh; margin-block-start: 0; margin-block-end: 0; margin: auto">' . $name_oponent . '</p>');
                }
                ?>
            </div>
            <a href="https://react-webrtc-call.herokuapp.com" style="float: right" id="video" target="_blank"><img
                        src="help/камера.png" alt="Video" class="video_img"> </a>
        </div>
        <div class="for_scroll">
            <div id="space_for_messages">
                <ul class="list_of_mess" style="list-style-type: none; padding-inline-start: 0; ">
                    <?php
                    if (isset($ident_room)) {
                        $messages = get_messages($ident_room);
                        foreach ($messages as $message):
                            $id = (int)$id;
                            $id_sender = (int)$message['id_sender'];
                            $text = $message['text'];

                            ?>
                            <li style="width: 100%; min-height: 5vh">
                                <?php
                                if ($id_sender == $id) {
                                    print_r('<div style="float: right">' . $text . '</div> ');
                                } else {
                                    print_r('<div style="float: left">' . $text . '</div> ');
                                }
                                ?>
                            </li>
                        <?php
                        endforeach;

                    }
                    ?>
                </ul>
            </div>
        </div>
        <script type="text/javascript">
            let block = document.getElementById("space_for_messages");
            block.scrollTop = block.scrollHeight
        </script>

        <form id="mess" action="index.php" method="post">

            <label for="write"></label><textarea name="write" id="write" placeholder="Введите сообщение"></textarea>

            <div class="buttons">
                <ul class="spbut">
                    <li class="chick_input">
                        <input type="file" id="file" name="chick" class="input-file" value="Прикрепить"/>
                        <label for="file" class="btn btn-tertiary js-labelFile">
                            <span class="js-fileName">Загрузить файл</span>
                        </label>
                    </li>
                    <li class="click_input">
                        <input type="submit" id="send" name="send" value="Отправить"/>
                    </li>
                </ul>
            </div>

        </form>

    </div>

</div>

</body>


</html>