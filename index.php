<?php

ini_set('display_errors', 1);

session_start();
if ($_SERVER['REQUEST_URI'] == '/migration') {
    require_once 'application/migrations/migration.php';
    exit();
}

require_once 'application/bootstrap.php';