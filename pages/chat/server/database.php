<?php

$db = new mysqli("danvil1z.beget.tech", "danvil1z_adm", "AdminDb#0903", "danvil1z_adm");
$db->set_charset('utf8');

function get_rooms($id): array
{
    global $db;
    $result=$db->query("SELECT * FROM rooms WHERE `id - user` = '".$id."' OR `id - teacher` = '".$id."'");

    $array = array();
    while($row = mysqli_fetch_assoc($result)){
        $array[] = $row;
    }

    return $array;
}
function get_r($id): array
{
    global $db;
    $int = $db -> query("SELECT rooms.`id - teacher` or rooms.`id - user`, users.first_name, users.last_name FROM users INNER JOIN rooms ON rooms.`id - user` = $id or rooms.`id - teacher` = $id");
    $info = array();
    while($row = mysqli_fetch_assoc($int)){
        $info[] = $row;
    }
    return $info;
}

$rooms = get_rooms(13);
print_r($rooms);
?>
<br>
<?php
$r = get_r(13);
print_r($r);
?>