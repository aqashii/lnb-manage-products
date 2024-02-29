<?php

session_start();

if(isset($_POST)){
    $username = $_POST['username'];
    $passwd = $_POST['passwd'];

    if($username == 'lb' && $passwd == 'lb'){
        $_SESSION['login']['status'] = "1";
        $res['status'] = '1';
        echo json_encode($res);
    }else{
        $res['status'] = '0';
        echo json_encode($res);
    }
}



?>