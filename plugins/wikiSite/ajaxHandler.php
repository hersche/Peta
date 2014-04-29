<?php
require_once 'Parsedown.php';
        //Ajax
        if(isset($_POST['data'])){
            $Parsedown = new Parsedown();
            echo $Parsedown->text($_POST['data']);
            exit();
        }



?>