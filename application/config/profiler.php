<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Profiler Sections
| -------------------------------------------------------------------------
| This file lets you determine whether or not various sections of Profiler
| data are displayed when the Profiler is enabled.
| Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/profiling.html
|
*/
$config['benchmarks']       = TRUE;
$config['get']              = TRUE;
$config['memory_usage']     = TRUE;
$config['post']             = TRUE;
$config['uri_string']       = TRUE;
$config['controller_info']  = TRUE;
$config['queries']          = TRUE;
$config['http_headers']     = TRUE;
$config['session_data']     = TRUE;
$config['config']           = TRUE;
