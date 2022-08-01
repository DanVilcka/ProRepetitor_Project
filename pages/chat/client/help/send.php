<?php
if (isset($_POST['message'])) {
    /*$message = $_POST['message'];
    if(send()){
        exit("Данные отправлены");
    } else {
        exit("Данные не отправлены");
    }*/
    exit('YES!');
}

function send(): bool
{
    global $db;
    $query = "insert into chat (id_chat, id_sender, id_msg, text, posted_on) values (2, 13, null, 'привет', NOW())";
    $result = mysqli_query($db, $query);
    if ($result) {
        return true;
    } else {
        return false;
    }
}