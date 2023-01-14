<?php

defined('BASEPATH') or exit('No direct script access allowed');

use Carbon\Carbon;

Carbon::setLocale('id');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
    }
}

/* End of file Resources.php */
