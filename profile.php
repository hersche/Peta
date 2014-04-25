<?php
require_once 'class/default.php';

if((isset($_POST['newKey']))&&(isset($_POST['newValue']))){
	$user->addCustomfield($_POST['newKey'],$_POST['newValue'],$connection);
}

elseif((isset($_POST['editKey']))&&(isset($_POST['editValue']))&&(isset($_GET['actionEditId']))){
	$user->editCustomfield($_GET['actionEditId'],$_POST['editKey'],$_POST['editValue'],$connection);
}

elseif(isset($_GET['deleteId'])){
	$user->removeCustomfield($_GET['deleteId'],$connection);
}


elseif(isset($_GET['doOrder'])){
$foo = var_dump($_POST['customfieldsOrder']);
$user->orderCustomfields($_POST['customfieldsOrder'],$connection);
die();
	//throw new Exception(json_encode($_POST));
}
echo $foo;
switch($_GET['action']){
	case "edit":
		$template->assign("onLoadCode", 'dojo.connect(customfieldList,"onDndDrop",function(e){updateCustomfieldList()});');
		$template->assign("dojorequire", array("dijit.Editor","dojo.dnd.Source"));
		if(isset($_POST)){
			usertools::editUser($user->getId(), $_POST, $connection);
		}
		if(isset($_GET['editId'])){
			$template->assign("editCustomField",$user->getCustomfieldById($_GET['editId']));
		}
		$template->assign("customfields", $user->getCustomfields($connection));
		$template->assign("roles", $user->getRoles());
		$template->assign("username", $user->getUsername());
		$template->display('profile_edit.tpl');
		break;
		
		
	default:
        
		if((isset($_GET['userid']))&&(usertools::userIdExists($_GET['userid'], $connection))&&($_GET['userid']!=$user->getId())){
			$user = usertools::getAlienUserbyId($_GET['userid'], $connection);
		}
    elseif((isset($_GET['userid']))&&($_GET['userid']==-1)){
        $user = new alienuser();
        $user->setId(-1);
        $user->setUsername("Guest");
        
    }
		else{
			$template->assign("own", true);
			$template->assign("roles", $user->getRoles());
		}
		$template->assign("customfields", $user->getCustomfields($connection));
		$template->assign("username", $user->getUsername());
		$template->display("profile.tpl");
		break;
}

?>