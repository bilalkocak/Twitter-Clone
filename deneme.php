<?php 
    require_once ("baglan.php");
    require_once('header.php');
    
    if(!isset($_GET['sayfa'])){
        $_GET['sayfa']='index';
    }

    switch($_GET['sayfa']){
        case 'insert':
            require_once('insert.php');
            break;

        case 'oku':
            require_once('oku.php');
            break;
    }


    


?>