<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once 'config.php';
require_once 'languages/' . $_SESSION['lang'] . '.php';
require_once 'autoload.php';
loader();
