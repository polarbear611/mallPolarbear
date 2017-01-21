<?php 
require_once '../include.php';
$pageSize = 2;
$sql = "select * from polarbear_cate";
$totalRows = getResultNum($sql);
$totalPage = ceil($totalRows / $pageSize);

$page = isset($_REQUEST['page']) ? (int)$_REQUEST['page'] : 1;
$rows = getCateByPage($page, $pageSize, $totalPage);
if(!$rows)
{
	alertMessage("没有分类，请先添加", "addCate.php");
	exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
<link rel="stylesheet" href="styles/backstage.css">
</head>
<body>
<div class="details">
                    <div class="details_operation clearfix">
                        <div class="bui_select">
                            <input type="button" value="添&nbsp;&nbsp;加" class="add"  onclick="addCate()">
                        </div>
                            
                    </div>
                    <!--表格-->
                    <table class="table" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th width="15%">分类ID</th>
                                <th width="20%">分类名称</th>
								<th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
							<?php foreach($rows as $row){ ?>
                            <tr>
                                <!--这里的id和for里面的c1 需要循环出来-->
                                <td><input type="checkbox" id="c1" class="check"><label for="c1" class="label"><?php echo $row['id']; ?></label></td>
                                <td><?php echo $row['cName']; ?></td>
								 <td align="center">
									<input type="button" value="修改" class="btn" onclick="editCate(<?php echo $row['id']; ?>)">
									<input type="button" value="删除" class="btn"  onclick="delCate(<?php echo $row['id']; ?>)">
								</td>
                            </tr>
                            <?php } ?>
							<?php if($totalRows > $pageSize){ ?>
							<tr>
								<td colspan=4>
									<?php echo showPage($page, $totalPage);?>
								</td>
							</tr>
							<?php } ?>
                        </tbody>
                    </table>
                </div>
<script type="text/javascript">
	function addCate()
	{
		window.location = "addCate.php";
	}
	function editCate(id)
	{
		window.location = "editCate.php?id=" + id;
	}
	function delCate(id)
	{
		if(confirm("确定要删除分类吗，操作不可恢复"))
		{
			window.location = "doAdminAction.php?act=delCate&id=" + id;
		}
	}
</script>
</body>
</html>