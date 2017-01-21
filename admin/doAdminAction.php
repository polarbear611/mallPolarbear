<?php
    require_once("../include.php");
    checkLogined();
    $act = $_REQUEST['act'];
    $id = isset($_REQUEST['id'])? $_REQUEST['id'] : null;
    switch($act)
    {
    case "logout" :
        logout();
        break;
    case "addAdmin" :
        $mes = addAdmin();
        break;
	case "editAdmin" :
		$mes = editAdmin($id);
		break;
	case "delAdmin" :
		$mes = delAdmin($id);
		break;
	case "addCate":
		$mes = addCate();
		break;
	case "editCate":
		$mes = editCate($id);
		break;
	case "delCate":
		$mes = delCate($id);
		break;
	case "addPro" :
		$mes = addPro();
		break;
	case "editPro" :
		$mes = editPro($id);
		break;
	case "delPro" :
		$mes = delPro($id);
		break;
    default:
        break;
    }
    if(isset($mes))
    {
        echo $mes;
    }
?>
