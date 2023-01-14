<?php
defined('BASEPATH') or exit('No direct script access allowed');

// To use reCAPTCHA, you need to sign up for an API key pair for your site.
// link: http://www.google.com/recaptcha/admin

// test localhost v2 
$config['recaptcha_site_key'] = '6LdVnLoZAAAAAMz9oeYAsVtVseZSYToJAY-vAB1V';
$config['recaptcha_secret_key'] = '6LdVnLoZAAAAAJS3i7GzGxSbME6Gji-3fJMCTgPh';


// test localhost v3 
// $config['recaptcha_site_key'] = '6Lfwl7oZAAAAAPuxBr9Icbhur63KY8DjnM5cX0kg';
// $config['recaptcha_secret_key'] = '6Lfwl7oZAAAAALKSnuVSn-k_iEmhv12_fKmCJQFo';

// captcha developer lama
// $config['recaptcha_site_key'] = '6LewmGQUAAAAAHNVZQ6PNy0a3yqJhWZgrMkENKEa';
// $config['recaptcha_secret_key'] = '6LewmGQUAAAAAPOFOI5DuIHE-hRTyWv5ILcpfCF1';

// reCAPTCHA supported 40+ languages listed here:
// https://developers.google.com/recaptcha/docs/language
$config['recaptcha_lang'] = 'id';

/* End of file recaptcha.php */
