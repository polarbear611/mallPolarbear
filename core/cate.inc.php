<?php
	function addCate()
	{
		$arrCate = $_POST;
		if(insert("polarbear_cate", $arrCate))
		{
			$mes = "添加分类成功<br />
				<a href='addCate.php'>继续添加</a> | <a href='listCate.php'>查看分类列表</a>";
			return $mes;
		}
		else
		{
			$mes = "添加分类失败<br />
				<a href='addCate.php'>重新添加</a> | <a href='listCate.php'>查看分类列表</a>";
			return $mes;	
		}
	}
	function editCate($id)
	{
		$arrCate = $_POST;
        if(update("polarbear_cate", $arrCate, "id={$id}"))
			{
				$mes = "修改成功！<br/ >
                <a href='listCate.php'>查看分类列表</a>";
			}
		else
		{
			echo mysql_error();
            $mes = "修改失败!<br />
                <a href='listCate.php'>重新修改</a>";
		}
		return $mes;
	}
	function getAllCate()
	{
		$sql = "select * from polarbear_cate";
		$rows = fetchAll($sql);
		return $rows;
	}
	function getCateByPage($page, $pageSize = 2, $totalPage)
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
		$sql = "select id, cName from polarbear_cate limit {$offset}, {$pageSize}";
		$rows = fetchAll($sql);
		return $rows;
	}
	
	function delCate($id)
	{
		$sql = "select * from polarbear_pro where cId={$id}";
		$result = mysql_query($sql);
		if(!$result)
			die('Invalid query: '  .  mysql_error ());
		if(mysql_num_rows($result) > 0)
		{
			$mes = "删除失败！请先删除该分类下的所有产品<br />
				<a href='listPro.php'>产品列表</a>";
			return $mes;
		}
		if(delete("polarbear_cate", "id={$id}"))
			{
				$mes = "删除成功！<br />
					<a href='listCate.php'>查看分类列表</a>";
				return $mes;
			}
		else
		{
			$mes = "删除失败！<br />
				<a href='listCate.php'>重新删除</a>";
			return $mes;
		}
	}
?>