<?php 

require_once 'controller/Controller.php';

session_start();

$controller = new Controller();

$controller->processRequest();
