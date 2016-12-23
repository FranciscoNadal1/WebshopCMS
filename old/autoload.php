<?php


   const  settings = '/settings';
   
// LOAD SILEX COMPONENTS    
    require_once $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';
    
// LOAD SETTINGS

    require_once $_SERVER["DOCUMENT_ROOT"].settings.'/sysFolders.php';
    require_once $_SERVER["DOCUMENT_ROOT"].settings.'/twigSettings.php';
    require_once $_SERVER["DOCUMENT_ROOT"].settings.'/redirections.php';
    require_once $_SERVER["DOCUMENT_ROOT"].settings.'/httpStatusErrors.php';
    
    
    
    require_once $_SERVER["DOCUMENT_ROOT"].'/admin/adminBar.php';

?>