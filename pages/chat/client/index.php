<?php

session_start();

$status = $_SESSION['status'];
$id = $_SESSION['id'];

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

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <title>chat</title>
    <script src="index.js"></script>
    <link rel="stylesheet" href="/pages/chat/client/style/index.css">
    <link rel="stylesheet" href="/pages/chat/client/style/write_style.css">
    <link rel="stylesheet" href="/pages/chat/client/style/info_style.css">
    <link rel="stylesheet" href="/pages/chat/client/style/space_style.css">

</head>

<body>

    <div class="chat_index">

        <div class="rooms">
            <?php
                if ($status==2) {
                    ?>
                    <div class="rooms_div" style="height: 90vh; width: 100%">
                        <h2 style="text-align: center"> Чаты </h2>
                        <ul class="rooms_menu">
                            <?php
                            $row = get_r();
                            foreach ($row as $room):
                                ?>
                                <li>
                                    <?php echo $room['id_room'], ' ', $room['id_teacher'], ' ', $room['id_user'] ?>
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
                                print_r('<br>' . $row['first_name'] . ' ' . $row['last_name'] . '<button onclick="add_chat()" style="float: right; border: 1px solid black"> + </button>');
                            }
                        }

                        function add_chat($id_find): bool
                        {
                            global $db, $id;
                            if($id_find != 0 and $id_find != $id){
                                $add = $db->query("INSERT INTO rooms (`id_teacher`, `id_user`) VALUES ('" . $id . "', '" . $id_find . "') ");
                            }
                            return (bool)$add;
                        }
                ?>
                <script>
                    function add_chat(){
                        let result = "<?php add_chat($id_find); ?> ";
                        console.log(result);
                    }
                </script>
            <div class="rooms_div" style="border-top: 1px solid black; height: 90vh; width: 100%">
                <h2 style="text-align: center"> Чаты </h2>
                <ul class="rooms_menu">
                    <?php
                    $row = get_r();
                    foreach ($row as $room):
                    ?>
                    <li>
                        <?php echo $room['id_room'],' ', $room['id_teacher'], ' ', $room['id_user']?>
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
                </div>
                <a href="https://react-webrtc-call.herokuapp.com" style="float: right" id="video" target="_blank"><img src="help/камера.png" alt="Video" class="video_img" > </a>
            </div>

            <div id="space_for_messages">
            </div>

            <div id="mess">

                <label for="write"></label><textarea id="write" placeholder="Введите сообщение"></textarea>

                <div class="buttons">
                    <ul class="spbut">

                        <li>  <a href="index.js" id="chick"> Прикрепить </a> </li>
                        <li> <a href="index.js" id="send"> Отправить </a> </li>

                    </ul>
                </div>

            </div>

        </div>

    </div>

</body>


<?php
?>

</html>