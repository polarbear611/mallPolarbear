<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <title></title>
</head>
<body>
    <h3>添加管理员</h3>
    <form action="doAdminAction.php?act=addAdmin" method="post">
    <table width="70%" border="1" cellpadding="5" cellspacing="0" 
        bgcolor="#cccccc">
        <tr>
            <td>管理员用户名：</td>
            <td>
                <input type="text" name="username" placeholder="请输入用户名" />
            </td>
        </tr>
        <tr>
            <td>管理员密码：</td>
            <td>
                <input type="password" name="password" />
            </td>
        </tr>
        <tr>
            <td>管理员邮箱</td>
            <td>
                <input type="text" name="email" placeholder="请输入邮箱" />
            </td>
        </tr>
    </table>
    <input type="submit" value="添加" />
    </form>
</body>
</html>

