<?php
    $bootstrap = require_once(__DIR__.'/../config/bootstrap.php');
    if ($bootstrap['has_log'] and !in_array($_SERVER['REMOTE_ADDR'],['::1','127.0.0.1'])) {
        $log = new \App\Kernel\Log();
        $log->write();
    }
    if ($bootstrap['has_web_view']) {
        require_once(__DIR__.'/../helper/helper.php');
    }
