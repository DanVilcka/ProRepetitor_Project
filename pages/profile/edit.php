<?php

function getoptions($id)
{
    global $db;
    $res = $db -> query("SELECT * FROM users where id = '".$id."' ");
    if($res){
        while ($row = mysqli_fetch_assoc($res)) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['phone'] = $row['phone'];
            $_SESSION['class'] = $row['class'];
            $_SESSION['status'] = $row['status'];
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['last_name'] = $row['last_name'];
            $_SESSION['skype'] = $row['skype'];
            $_SESSION['login'] = $row['login'];
            $_SESSION['password'] = $row['password'];

        }
    }

}
function update_info(): bool
{
    global $db;
    $str = trim($_POST['newVal']);
    $value = mysqli_real_escape_string($db, $str);
    $id = (int)$_POST['id'];
    $option = $_POST['option'];
    if($option === 'name'){
        $arr = explode(' ', $value);
        $name = $arr[0];
        $lname = $arr[1];
        $query = "UPDATE users SET first_name = '$name', last_name = '$lname' WHERE id = $id";
        $result = mysqli_query($db, $query);
        if(mysqli_affected_rows($db)){
            return true;
        } else {
            return false;
        }
    } else {
        $query = "UPDATE users SET $option = '$value' WHERE id = $id";
        $result = mysqli_query($db, $query);
        if(mysqli_affected_rows($db)){
            return true;
        } else {
            return false;
        }
    }
}
