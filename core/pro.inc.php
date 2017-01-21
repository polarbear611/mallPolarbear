<?php
	function addPro()
	{
		$arr = $_POST;
		$arr['pubtime'] = time();
        $path = "./uploads";
        $uploadFiles = uploadFile($path);
        if($uploadFiles && is_array($uploadFiles))
        {

            foreach($uploadFiles as $key => $uploadFile)
            {
                thumb($path. "/". $uploadFile['name'],
                    "../image_50/". $uploadFile['name'], 50, 50);
                thumb($path. "/". $uploadFile['name'],
                    "../image_220/". $uploadFile['name'], 220, 220);
                thumb($path. "/". $uploadFile['name'],
                    "../image_350/". $uploadFile['name'], 350, 350);
                thumb($path. "/". $uploadFile['name'],
                    "../image_800/". $uploadFile['name'], 800, 800);
            }
        }       
        $res = insert("polarbear_pro", $arr);
        $pid = getInsertId();
        if($res && $pid)
        {
            foreach($uploadFiles as $uploadFile)
            {
                $arr_album['pid'] = $pid;
                $arr_album['albumPath'] = $uploadFile['name'];
                addAlbum($arr_album);
            }
            $mes = "<p>添加成功!</p><a href='addPro.php' target='mainFrame'>
                继续添加</a>";
        }
        else
        {
            foreach($uploadFiles as $uploadFile)
            {
                if(file_exists("../image_50/". $uploadFile['name']))
                {
                    unlink("../image_50/". $uploadFile['name']);
                }
                if(file_exists("../image_220/". $uploadFile['name']))
                {
                    unlink("../image_220/". $uploadFile['name']);
                }
                if(file_exists("../image_350/". $uploadFile['name']))
                {
                    unlink("../image_350/". $uploadFile['name']);
                }
                if(file_exists("../image_800/". $uploadFile['name']))
                {
                    unlink("../image_800/". $uploadFile['name']);
                }
            }
            $mes = "<p>添加失败!</p><a href='addPro.php' target='mainFrame'>
                重新添加</a>";
        }
        return $mes;
	}
	
	function editPro($id)
	{
		$arr = $_POST;
		$path = "./uploads";
        $uploadFiles = uploadFile($path);
        if($uploadFiles && is_array($uploadFiles))
        {

            foreach($uploadFiles as $key => $uploadFile)
            {
                thumb($path. "/". $uploadFile['name'],
                    "../image_50/". $uploadFile['name'], 50, 50);
                thumb($path. "/". $uploadFile['name'],
                    "../image_220/". $uploadFile['name'], 220, 220);
                thumb($path. "/". $uploadFile['name'],
                    "../image_350/". $uploadFile['name'], 350, 350);
                thumb($path. "/". $uploadFile['name'],
                    "../image_800/". $uploadFile['name'], 800, 800);
            }
        }
		$where = "id={$id}";
        $res = update("polarbear_pro", $arr, $where);
        $pid = $id;
        if($res && $pid)
        {
			if($uploadFiles && is_array($uploadFiles))
			{
			    foreach($uploadFiles as $uploadFile)
				{
					$arr_album['pid'] = $pid;
					$arr_album['albumPath'] = $uploadFile['name'];
					addAlbum($arr_album);
				}
			}
            $mes = "<p>修改成功!</p><a href='listPro.php' target='mainFrame'>
                查看列表</a>";
        }
        else
        {
			if($uploadFiles && is_array($uploadFiles))
			{
				foreach($uploadFiles as $uploadFile)
				{
					if(file_exists("../image_50/". $uploadFile['name']))
					{
						unlink("../image_50/". $uploadFile['name']);
					}
					if(file_exists("../image_220/". $uploadFile['name']))
					{
						unlink("../image_220/". $uploadFile['name']);
					}
					if(file_exists("../image_350/". $uploadFile['name']))
					{
						unlink("../image_350/". $uploadFile['name']);
					}
					if(file_exists("../image_800/". $uploadFile['name']))
					{
						unlink("../image_800/". $uploadFile['name']);
					}
				}
            }
			$mes = "<p>修改失败!</p><a href='listPro.php' target='mainFrame'>
                查看列表</a>";
        }
        return $mes;
	}
	
	function delPro($id)
	{
		$where = "id={$id}";
		$res = delete("polarbear_pro", $where);
		$proImages = getAllImgByProId($id);
		if($proImages && isarray($proImages))
		{
			foreach($proImages as $proImage)
			{
				$proImageName = $proImage['albumPath'];
				deleteProImageFile('uploads/'. $proImageName);
			}
		}
		$where = "pid={$id}";
		$resDelAlbum = delete("polarbear_album", $where);
		if($res && $resDelAlbum)
		{
			$mes = "删除成功<br/><a href='listPro.php' target='mainFrame'>查看商品列表</a>";
		}
		else
		{
			$mes = "删除失败<br/><a href='listPro.php' target='mainFrame'>查看商品列表</a>";
		}
		return $mes;
	}
	
	function deleteProImageFile($imageFilePath)
	{
		if(file_exists($imageFilePath))
			unlink($imageFilePath);
	}
	
	function getAllImgByProId($id)
	{
		$sql = "select albumPath from polarbear_album where pId={$id}";
		$rows = fetchAll($sql);
		return $rows;
	}
	
	function getProImageById($id)
	{
		$sql = "select albumPath from polarbear_album where pId={$id}";
		$row = fetchOne($sql);
		return $row;
	}
	
	function getProById($id)
	{
		$sql = "select p.id, p.pName, p.pSn, p.pNum, p.mPrice, p.pPrice, 
			p.pDesc, p.pubtime, p.isShow, p.isHot, p.cId, c.cName, c.id
			from polarbear_pro as p join polarbear_cate as c on p.cId = c.id
			where p.id = {$id}";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		return $row;
	}
	
	function getAllProsByCate($cid)
	{
		$sql = "select p.id, p.pName, p.pSn, p.pNum, p.mPrice, p.pPrice, 
			p.pDesc, p.pubtime, p.isShow, p.isHot, p.cId, c.cName, c.id
			from polarbear_pro as p join polarbear_cate as c on p.cId = c.id
			where c.id = {$cid}";
		$result = mysql_query($sql);
		if(!$result)
		{
			die("invalid query:". mysql_error());
		}
		if(mysql_num_rows($result) > 0)
		{
			while($pro = mysql_fetch_array($result, MYSQL_ASSOC))
			{
				$pros[] = $pro;
			}
		}
		else
		{
			$pros = null;
		}
		return $pros;
	}
	
	function getFourProsByCate($cid)
	{
		$sql = "select p.id, p.pName, p.pSn, p.pNum, p.mPrice, p.pPrice, 
			p.pDesc, p.pubtime, p.isShow, p.isHot, p.cId, c.cName, c.id 
			from polarbear_pro as p join polarbear_cate as c on p.cId=c.id
			where c.id={$cid} limit 4";
		$pros = fetchAll($sql);
		return $pros;
	}
	
	function getNextFourProsByCate($cid)
	{
		$sql = "select p.id, p.pName, p.pSn, p.pNum, p.mPrice, p.pPrice, 
			p.pDesc, p.pubtime, p.isShow, p.isHot, p.cId, c.cName, c.id 
			from polarbear_pro as p join polarbear_cate as c on p.cId=c.id
			where c.id={$cid} limit 4, 4";
		$pros = fetchAll($sql);
		return $pros;
	}
?>
