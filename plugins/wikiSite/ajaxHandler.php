<?php
require_once 'wiky.inc.php';
        //Ajax
        if(isset($_POST['data'])){
            $wiky=new wiky;
            print($wiky->parse($_POST['data']));
            exit();
        }



?>