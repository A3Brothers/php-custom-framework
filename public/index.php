<?php

define('BASEPATH', __DIR__ . '/../');

require_once '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(BASEPATH);
$dotenv->load();

include_once '../app/helpers.php';


include_once '../routes/app.php';


