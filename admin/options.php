<?php

require_once 'default.php';
require_once 'class/base.php';
require_once '../class/plugin.php';
$allAllowedSites = new allowedSites($connection);
        $instancedPluginManager = new instancedPluginManager($user, $template, $connection);
        $template->assign('allSites', $instancedPluginManager->getInstancedPlugins());
//$dojorequire = array("dijit.InlineEditBox", "dijit.form.Textarea");
//$template->assign("dojorequire", $dojorequire);
/**
 * This is the site for managing the users as admin
 */
switch($_GET['action']){
    case "editStartpage":
        if($connection->query("SELECT * FROM `options` WHERE `key` LIKE 'startpage';")->rowCount()==0){
            $connection->exec('INSERT INTO `options` (`id`, `key`, `value`) VALUES (NULL,"startpage","'.$_POST['startpageEdit'].'");');
                
        }
        else {
            $connection->exec('UPDATE `options` SET `value` = '.$_POST['startpageEdit'].' WHERE `options`.`key` = "startpage";');
        }
        array_push($messages, "Startpage changed");
        $template->assign("messages", $messages);
        $template->display('options_misc.tpl');
        break;
        
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