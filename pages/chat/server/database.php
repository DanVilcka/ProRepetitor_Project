<?php

$db = new mysqli("danvil1z.beget.tech", "danvil1z_adm", "AdminDb#0903", "danvil1z_adm");
$db->set_charset('utf8');

$id = $_SESSION['id'];

function get_r(): array
{
    global $id;
    global $db;
    $int = $db->query("SELECT * FROM rooms WHERE `id_user` = '" . $id . "' OR `id_teacher` = '" . $id . "'  ");
    $info = array();
    while ($row = mysqli_fetch_assoc($int)) {
        $info[] = $row;
    }
    return $info;
}

function get_name($id_form_rooms): string
{
    global $db;
    $int = $db->query("SELECT first_name, last_name FROM users WHERE `id` = '" . $id_form_rooms . "' ");
    $name = '';
    while ($row = $int->fetch_assoc()) {
        $name = $row['first_name'] . ' ' . $row['last_name'];
    }
    return $name;
}

function get_messages($chat_id): array
{
    global $db;
    $resault = $db->query("select * from chat where id_chat = '" . $chat_id . "'");
    $arr = array();
    while ($row = $resault->fetch_assoc()) {
        $arr[] = $row;
    }
    return $arr;
}


