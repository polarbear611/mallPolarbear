<?php
    function checkAdmin($sql)
    {
        return fetchOne($sql);
    }
    function checkLogined()
    {
        if(!isset($_SESSION['adminId']) && $_COOKIE['adminId'] == "")
        {
            alertMessage("请先登陆", "login.php");
        }
    }
    function logout()
    {
        $_SESSION = array();
        if(isset($_COOKIE[session_name()]))
        {
            setcookie(session_name(), "", time() - 1);
        }
        if(isset($_COOKIE['adminId']))
        {
            setcookie("adminId", "", time() - 1);
        }
        if(isset($_COOKIE['adminName']))
        {
            setcookie("adminName", "", time() - 1);
        }
        session_destroy();
        header("location:login.php");
    }
    function addAdmin()
    {
        $arrAdmin = $_POST;
        $arrAdmin['password'] = md5($_POST['password']);
        if(insert("polarbear_admin", $arrAdmin))
        {
            $mes = "添加成功！<br/ >
                <a href='addAdmin.php'>继续添加</a> | 
                <a href='listAdmin.php'>查看管理员列表</a>";
        }
        else
        {
			echo mysql_error();
            $mes = "添加失败!<br />
                <a href='addAdmin.php'>重新添加</a>";
        }
        return $mes;
    }
	function getAllAdmin()
	{
		$sql = "select id,username,email from polarbear_admin";
		$rows = fetchAll($sql);
		return $rows;
	}
	function getAdminByPage($page, $pageSize = 2, $totalPage)
	{
		if($page < 1 || $page == null || !is_numeric($page))
		{
			$page = 1;
		}
		if($page > $totalPage)
		{
			$page = $totalPage;
		}
		$offset = ($page - 1) * $pageSize;
		$sql = "select id, username, email from polarbear_admin limit {$offset}, {$pageSize}";
		$rows = fetchAll($sql);
		return $rows;
	}
	function editAdmin($id)
	{
		$arrAdmin = $_POST;
        $arrAdmin['password'] = md5($_POST['password']);
		if(update("polarbear_admin", $arrAdmin, "id={$id}"))
			{
				$mes = "修改成功！<br/ >
                <a href='listAdmin.php'>查看管理员列表</a>";
			}
		else
		{
			echo mysql_error();
            $mes = "修改失败!<br />
                <a href='listAdmin.php'>重新修改</a>";
		}
		return $mes;
	}
	function delAdmin($id)
	{
		if(delete("polarbear_admin", "id={$id}"))
			{
				$mes = "删除成功！<br />
					<a href='listAdmin.php'>查看管理员列表</a>";
				return $mes;
			}
		else
		{
			$mes = "删除失败！<br />
				<a href='listAdmin.php'>重新删除</a>";
			return $mes;
		}
	}
?>
