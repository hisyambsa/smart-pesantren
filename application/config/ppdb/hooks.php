<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/

// ini adalah middleware

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    // do nothing
} else {

    // pengecekan maintenance
    $hook['pre_system'][] = array(
        'class'    => 'maintenance_hook',
        'function' => 'offline_check',
        'filename' => 'maintenance_hook.php',
        'filepath' => 'hooks'
    );



    $segments = explode('/', trim($_SERVER['REQUEST_URI'], '/'));


    // localhost
    if (count($segments) > 0) {
        $controller = $segments[0];
        if (isset($segments[1])) {
            $method = $segments[1];
        } else {
            $method = null;
        }
    } else {
        $controller = null;
        $method = null;
    }

    $admin = array(
        'auth',
        'admin',
    );

    $trigger_controller = array(
        'auth',
    );

    // var_dump($without_main_hooks_header);
    // var_dump($controller);
    // var_dump($method);
    // var_dump(in_array($controller, $without_main_hooks_header));
    // die;
    if ($_SERVER['HTTP_HOST'] == 'localhost:8888') {
        $check = $method;
    } else {
        $check = $controller;
    }

    $hook['post_controller_constructor'][] = array(
        'class'    => '',
        'function' => 'showNavUser',
        'filename' => 'header.php',
        'filepath' => 'hooks',
        'params'   => array('judul')
    );
    $hook['post_controller'][] = array(
        'class'    => '',
        'function' => 'showFooterUser',
        'filename' => 'footer.php',
        'filepath' => 'hooks',
        'params'   => ''
    );


    $newFileName = basename($controller, ".html");
    if (TRIGGER_ACTIVATED) {
        $hook['post_controller_constructor'][] = array(
            'class'    => '',
            'function' => 'required',
            'filename' => 'trigger_controller.php',
            'filepath' => 'hooks',
            'params'   => array('judul')
        );
    }
}
