<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . "/pages/chat/server/database.php";

$id_chat = $_SESSION['id_room'];
$id = (int)$_SESSION['id'];


$messages = get_messages($id_chat);
foreach ($messages as $message):
    $id_sender = (int)$message['id_sender'];
    $text = $message['text'];
    echo ' <li style="width: 100%; display: table; margin-bottom: 1vh"> ';
    if ($id_sender == $id) {
        echo '<div style="float: right; display: table-cell; vertical-align: middle;">' . $text . '</div>';
    } else {
        echo ' <div style="float: left; display: table-cell; vertical-align: middle;">' . $text . '</div>  ';
    }
    echo '</li>';
endforeach;
