<?php

$db = new mysqli("danvil1z.beget.tech", "danvil1z_adm", "AdminDb#0903", "danvil1z_adm");
$db->set_charset('utf8');


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
