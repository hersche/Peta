<?php
require_once 'class/default.php';
if($user->getWelcome()){
	$messages[] = "Welcome ".$user->getUsername().'. Your last Login was at '.$user->getLastLogin().' from adress '.$user->getLastIp();
	$user->disableWelcome();
}

if ($plugin!=NULL){
	if($plugin->getRequiredDojo() != Null){
		$template->assign("dojorequire", $plugin->getRequiredDojo());
	}
	if($plugin->getRequiredCss() != Null){
		$template->assign("allcss", $plugin->getRequiredCss());
	}
	if($plugin->getOnLoadCode() != Null){
		$template->assign("onLoadCode", $plugin->getOnLoadCode());
	}
    	if($plugin->getJs() != Null){
		$template->assign("jsscripts", $plugin->getJs());
	}
        	if($plugin->getHeaderTags() != Null){
		$template->assign("headerTags", $plugin->getHeaderTags());
	}
    $template->assign("pluginContent", $plugin->start());
}

else {
    echo "nope, here's no plug - maybe it's inactive? Ask admin!";   
}

$template->assign("plugins", $instancedPluginManager->getInstancedPlugins());
$template->display('plugin.tpl');

?>