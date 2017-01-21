<?php
	require_once("../include.php");
	$id = $_REQUEST['id'];
	$sql = "select id,cName from polarbear_cate where id = '{$id}'";
	$row = fetchOne($sql);
	print_r($row);
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <title></title>
</head>
<body>
    <h3>编辑分类</h3>
    <form action="doAdminAction.php?act=editCate&id=<?php echo $row['id']; ?>" method="post">
    <table width="70%" border="1" cellpadding="5" cellspacing="0" 
        bgcolor="#cccccc">
        <tr>
            <td>分类名称：</td>
            <td>
                <input type="text" name="cName" placeholder="<?php echo $row['cName']; ?>" />
            </td>
        </tr>        
    </table>
    <input type="submit" value="提交修改" />
    </form>
</body>
</html>

