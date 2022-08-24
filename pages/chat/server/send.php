<?php
session_start();
$db = new mysqli("danvil1z.beget.tech", "danvil1z_adm", "AdminDb#0903", "danvil1z_adm");
$db->set_charset('utf8');

if (isset($_POST['message'])) {
    $message = $_POST['message'];
    $id = $_SESSION['id'];
    $ident_room = $_SESSION['id_room'];
    if ($db->query("insert into chat (id_chat, id_sender, id_msg, text, posted_on) values ('$ident_room', '$id', null, '$message', NOW())")) {
        exit("Данные сохранены");
    } else {
        exit("Данные НЕ СОХРАНЕНЫ");
    }

}