<?php
$db = new mysqli("danvil1z.beget.tech", "danvil1z_adm", "AdminDb#0903", "danvil1z_adm");
$db->set_charset('utf8');

if (isset($_GET['view_chat'])) {
    print_r($_GET[''] . ' <br/><br/><br/>');
    $id = $_GET;
    print_r($id);

//комнаты
    $rooms = $db->query("select * from rooms where id_teacher = '" . $id . "' or id_user = '" . $id . "'");
    while ($row = $rooms->fetch_assoc()) {
        print_r($row['id_user'] . ' ' . $row['id_teacher'] . ' в этой комнате <br/>');
    }

//чаты
    $chats = $db->query("select * from `chat` inner join `rooms` on id_chat=id_room");
    while ($row = $chats->fetch_assoc()) {
        print_r($row['id_chat'] . ' ' . $row['id_sender'] . ' ' . $row['id_msg'] . ' ' . $row['id_teacher'] . ' в этом чате <br/>');
    }

//контент
//content c on chat.id_msg = c.id_msg
    $messages = $db->query("select * from `content` inner join chat on content.id_msg = chat.id_msg");
    while ($row = $messages->fetch_assoc()) {
        print_r($row['id_msg'] . ' ' . $row['posted_on'] . ' ' . $row['text'] . ' ' . $row['id_sender'] . ' сообщение <br/>');
    }
}
