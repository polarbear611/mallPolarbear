<?php
    require_once '../include.php';
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $verify = $_POST['verify'];
    $verify1 = $_SESSION['verify'];
    $autoFlag = isset($_POST['autoFlag']) ? $_POST['autoFlag'] : null;
    if($verify == $verify1)
    {
        $sql = "select * from polarbear_admin
            where username = '{$username}' and password = '{$password}'";
        $row = checkAdmin($sql);
		//print_r($row);
        if($row)
        {
            if($autoFlag)
            {
                setcookie("adminId", $row['id'], time() + 7 * 24 * 3600);
                setcookie("adminName", $row['username'], 
                    time() + 7 * 24 * 3600);
            }
            $_SESSION['adminName'] = $row['username'];
            $_SESSION['adminId'] = $row['id'];
            alertMessage(" 登陆成功 ", "index.php");
        }
        else
        {
            alertMessage("登陆失败，重新登陆", "login.php");
        }
    }
    else
    {
        alertMessage("验证码错误", "login.php");
    }
?>
