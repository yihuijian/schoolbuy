<?php
    require_once '../include.php';
    $username = $_POST['account'];
    $username = addslashes($username);
    $password = md5($_POST['apwd']);
    $verify = $_POST['verify'];
    $verify1 = $_SESSION['verify'];
    $autoFlag = isset($_POST['autoFlag'])?$_POST['autoFlag']:"";
    if ($verify == $verify1) {
        $link=connect();
        $sql = "select * from admins where account='{$username}' and apwd='{$password}' limit 1";
        $row = checkAdmin($sql);
        if ($row) {
            //如果选了一周内自动登陆
            if ($autoFlag) {
                setcookie("adminId", $row['id'], time() + 7 * 24 * 3600);
                setcookie("adminName", $row['username'], time() + 7 * 24 * 3600);
            }
            $_SESSION['adminName'] = $row['account'];
            $_SESSION['adminId'] = $row['aid'];
            alertMes("登陆成功", "index.php");
        } else {
            alertMes("登陆失败，重新登陆", "login.php");
        }
    } else {
        alertMes("验证码错误", "login.php");
    }