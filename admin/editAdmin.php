<?php
	require_once("../include.php");
	$id = $_REQUEST['id'];
	$sql = "select id,username,password,email from polarbear_admin where id = '{$id}'";
	$row = fetchOne($sql);
	print_r($row);
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <title></title>
</head>
<body>
    <h3>编辑管理员</h3>
    <form action="doAdminAction.php?act=editAdmin&id=<?php echo $row['id']; ?>" method="post">
    <table width="70%" border="1" cellpadding="5" cellspacing="0" 
        bgcolor="#cccccc">
        <tr>
            <td>管理员用户名：</td>
            <td>
                <input type="text" name="username" placeholder="<?php echo $row['username']; ?>" />
            </td>
        </tr>
        <tr>
            <td>管理员密码：</td>
            <td>
                <input type="password" name="password" value = "<?php echo $row['password']; ?>"/>
            </td>
        </tr>
        <tr>
            <td>管理员邮箱</td>
            <td>
                <input type="text" name="email" placeholder="<?php echo $row['email']; ?>" />
            </td>
        </tr>
    </table>
    <input type="submit" value="提交修改" />
    </form>
</body>
</html>

