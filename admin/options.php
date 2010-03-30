<?php

require_once 'default.php';
require_once 'class/base.php';
$allAllowedSites = new allowedSites($connection);
//$dojorequire = array("dijit.InlineEditBox", "dijit.form.Textarea");
//$template->assign("dojorequire", $dojorequire);
/**
 * This is the site for managing the users as admin
 */
switch($_GET['action']){
	case "deleteAllowedSite":
		if(!empty($_GET['siteid'])){
			array_push($messages, $allAllowedSites->deleteAllowedSite($_GET['siteid'], $connection));
		}
		$template->assign("messages", $messages);
		$template->assign('sites', $allAllowedSites->getAllowedSiteList());
		$template->display('options_misc.tpl');
		break;
	case "editAllowedSite":
		if(!empty($_POST['site'])){
			array_push($messages, $allAllowedSites->editSite($_GET['siteid'], $_POST['site'], $connection));
		}
		$template->assign("messages", $messages);
		$template->assign('sites', $allAllowedSites->getAllowedSiteList());
		$template->display('options_misc.tpl');
		break;
	case "createAllowedSite":
		if(!empty($_POST['site'])){
			array_push($messages, $allAllowedSites->addSite($_POST['site'], $connection));
		}
		$template->assign("messages", $messages);
		$template->assign('sites', $allAllowedSites->getAllowedSiteList());
		$template->display('options_misc.tpl');
		break;
	
	default:

		$template->assign('sites', $allAllowedSites->getAllowedSiteList());
		$template->display('options_misc.tpl');
		break;
		
}

?>