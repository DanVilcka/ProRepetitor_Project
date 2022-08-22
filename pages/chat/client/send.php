<?php
session_start();
$db = new mysqli("danvil1z.beget.tech", "danvil1z_adm", "AdminDb#0903", "danvil1z_adm");
$db->set_charset('utf8');

if (isset($_GET['message'])) {
    $message = $_GET['message'];
    $id = $_SESSION['id'];
    $ident_room = $_SESSION['id_room'];
    $db->query("insert into chat (id_chat, id_sender, id_msg, text, posted_on) values ('$ident_room', '$id', null, '$message', NOW())");
    /*if (isset($ident_room)) {
        print_r($_POST['write'], $ident_room);
    $res = $db -> query("insert into chat (id_chat, id_sender, id_msg, text, posted_on) values (2, 13, null, 'Text_1', NOW())");
    usleep(1000);
    if($res){
        exit("Send it!");
    } else {
        exit('Not Send!');
    }
    } else {
        exit("Error room id!");
    }*/
}