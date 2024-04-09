<?php

use App\Core\Application;

include_once "../vendor/autoload.php";

const ROOT_APP = __DIR__ . '/../src/';

(new Application())->run();
