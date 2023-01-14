<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

include(APPPATH . 'libraries/GroceryCrudEnterprise/autoload.php');

use GroceryCrud\Core\GroceryCrud;

class GCrud
{

    public function __construct()
    {
        // parent::__construct();
    }

    public function index()
    {
        show_error('tidak dapat membuka file');
    }
    public function output_crud($output = null)
    {
        if (isset($output->isJSONResponse) && $output->isJSONResponse) {
            header('Content-Type: application/json; charset=utf-8');
            echo $output->output;
            exit;
        }


        $this->load->view('db/karyawan', (array)$output);
    }

    public function _getDbData()
    {
        $db = [];
        include(APPPATH . 'config/' . ENVIRONMENT . '/database.php');
        return [
            'adapter' => [
                'driver' => 'mysqli',
                'host'     => $db['default']['hostname'],
                'database' => $db['default']['database'],
                'username' => $db['default']['username'],
                'password' => $db['default']['password'],
                'charset' => 'utf8'
            ]
        ];
    }

    public function _getGroceryCrudEnterprise($bootstrap = true, $jquery = true)
    {
        $db = $this->_getDbData();
        $config = include(APPPATH . 'config/' . ENVIRONMENT . '/gcrud-enteprise.php');
        $groceryCrud = new GroceryCrud($config, $db);
        // $crud->unsetBootstrap();
        // $crud->unsetJqueryUi();
        $groceryCrud->unsetJquery();

        $CI = &get_instance();
        $groceryCrud->setCsrfTokenName($CI->security->get_csrf_token_name());
        $groceryCrud->setCsrfTokenValue($CI->security->get_csrf_hash());
        return $groceryCrud;
    }
}
