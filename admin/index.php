<?php
session_start();
session_destroy();

$view = new stdClass();
$view->pageTitle = 'Login';
require_once('../Views/admin/index.phtml');

