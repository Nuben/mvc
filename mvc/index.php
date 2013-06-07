<?php
/**
*
* All requests routed through here. This is an overview of what actaully happens during
* a request.
*
* @package LydiaCore
*/

// ---------------------------------------------------------------------------------------
//
// PHASE: BOOTSTRAP
//
define('Chris_INSTALL_PATH', dirname(__FILE__));
define('Chris_SITE_PATH', Chris_INSTALL_PATH . '/site');

require(Chris_INSTALL_PATH.'/src/bootstrap.php');

$Chris = CChris::Instance();


// ---------------------------------------------------------------------------------------
//
// PHASE: FRONTCONTROLLER ROUTE
//
$Chris->FrontControllerRoute();


// ---------------------------------------------------------------------------------------
//
// PHASE: THEME ENGINE RENDER
//
$Chris->ThemeEngineRender();
