<?php
defined('BASEPATH') or exit('No direct script access allowed');

// https://mailtrap.io/
$config = array(
    'protocol' => 'smtp',
    'smtp_host' => 'smtp.mailtrap.io',
    'smtp_port' => 2525,
    'smtp_user' => 'xxx',
    'smtp_pass' => 'xxx',
    'crlf' => "\r\n",
    'newline' => "\r\n",
    'mailtype' => 'html',
    'charset' => 'iso-8859-1',
    'wordwrap' => TRUE
);
