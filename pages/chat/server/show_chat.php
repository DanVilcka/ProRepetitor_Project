<?php
session_start();
$id = $_SESSION['id'];

function View_chat($ident_room, $name_oponent)
{
    global $id;
    echo <<<END
    <div class="Chats">
            <div id="oponent_info">
                <div id="name_oponent">
                    <div id="name_oponent">
                        <p style="width:100%; font-size: 3vh; margin-block-start: 0; margin-block-end: 0; margin: auto;">
                            $name_oponent
                        </p>
                    </div>
                </div>
                <a id="video" href="https://react-webrtc-call.herokuapp.com" style="float: right"  target="_blank"><img
                            src="/pages/chat/client/help/камера.png" alt="Video" class="video_img"> </a>
            </div>
    END;
    echo '<div class="for_scroll">';
    echo ' <div id="space_for_messages" > ';
    echo ' <ul class="list_of_mess" style="list-style-type: none; padding-inline-start: 0;"> ';
    if (isset($ident_room)) {
        $messages = get_messages($ident_room);
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
    }
    echo '</ul>';
    echo '</div>';
    echo '</div>';
    echo '';
    echo <<<END
            <form id="mess" action="/pages/chat/client/index.php" method="post" style="margin-top: 3vh">
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
           
        END;

    echo '</div>';
}