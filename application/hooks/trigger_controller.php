<?php


function required()
{
    // trigger paksa survey
    $CI = &get_instance();

    $segments = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

    $admin = FALSE;
    if (ENVIRONMENT == 'development') {
        $admin = TRUE;
        // localhost/apps/base_url
        if (count($segments) > 1) {
            $controller = $segments[1];
        } else {
            $controller = null;
        }
    } elseif (ENVIRONMENT == 'testing') {
        $admin = TRUE;
        // localhost/apps/base_url
        if (count($segments) > 0) {
            $controller = $segments[0];
        } else {
            $controller = null;
        }
    } elseif (ENVIRONMENT == 'production') {
        // apps.len-telko/base_url
        if (count($segments) > 0) {
            $controller = $segments[0];
        } else {
            $controller = null;
        }
    } else {
        echo 'Environment : ' . ENVIRONMENT . ' <br>tidak terdefinisi';
        die;
    }

    // get from constants.php
    if (TRIGGER_ACTIVATED) {
        show_error('SETUP TRIGGER CONTROLLER');
        die;
        redirect('');
    }
}
