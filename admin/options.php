<?php

require_once 'default.php';
require_once 'class/base.php';
$allAllowedSites = new allowedSites($connection);
$dojorequire = array("dijit.InlineEditBox", "dijit.form.Textarea");
$template->assign("dojorequire", $dojorequire);
/**
 * This is the site for managing the users as admin
 */
switch($_GET['action']){
	case "deleteAllowedSite":
		if(!empty($_GET['siteid'])){
			$allAllowedSites->deleteAllowedSite($_GET['siteid'], $connection);
			array_push($messages, "Site removed successfull");
		}

		$template->assign("messages", $messages);
		$template->assign('sites', $allAllowedSites->getAllowedSiteList());
		$template->display('options_misc.tpl');
		break;
	case "editAllowedSite":
		echo $_POST['site'];
		$template->assign('sites', $allAllowedSites->getAllowedSiteList());
		$template->display('options_misc.tpl');
		break;
	case "createAllowedSite":
		if(!empty($_POST['site'])){
			$allAllowedSites->addSite($_POST['site'], $connection);
			array_push($messages, "Site added successfull");
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