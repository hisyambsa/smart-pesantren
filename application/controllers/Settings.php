<?php

defined('BASEPATH') or exit('No direct script access allowed');

// include the base class
require_once("application/core/GCrud.php");

class Settings extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->GCrud = new GCrud();

        if (!$this->ion_auth->logged_in()) {
            $messages = 'Anda tidak mempunyai Akses ke Halaman ini';
            $this->session->set_tempdata('pesan', $messages, 5);
            $this->session->set_tempdata('type', 'danger', 5);
            $this->session->set_tempdata('timer', '15000', 5);
            redirect('', 'refresh');
        }
    }
    public function output_crud($output = null)
    {
        if (isset($output->isJSONResponse) && $output->isJSONResponse) {
            header('Content-Type: application/json; charset=utf-8');
            echo $output->output;
            exit;
        }

        $output->link_tambah = FALSE;
        $output->nama_link = 'Create Artikel';
        $output->link = 'c/create';
        $output->group = array('all_users');

        $this->load->view('db/view_crud', (array)$output);
    }
    public function index()
    {
        $crud = $this->GCrud->_getGroceryCrudEnterprise();
        $crud->setTable('settings');
        $table = $crud->getTable();
        $crud->setSubject('Settings', 'Settings');

        $crud->unsetOperations();
        $crud->unsetExport();
        $crud->unsetFilters();
        $crud->unsetSettings();
        $crud->unsetPrint();

        $crud->setEdit();
        // $crud->setRead();
        // $crud->setDelete();


        $uploadValidations = [
            'maxUploadSize' => '1M', // 1 Mega Bytes
            'minUploadSize' => '1K', // 1 Kilo Byte
            'allowedFileTypes' => [
                'jpeg', 'jpg', 'png',
            ]
        ];
        $crud->setFieldUpload(
            'logo_16_9',
            'uploads/settings',
            base_url('uploads/settings'),
            $uploadValidations
        );
        $crud->setFieldUpload(
            'logo_square',
            'uploads/settings',
            base_url('uploads/settings'),
            $uploadValidations
        );
        $crud->callbackColumn('logo_16_9', function ($value, $row) {
            if ($value == NULL) {
                $image = '';
            } else {
                $image = '';
                $image .= '<a data-caption="Logo 16:9" href="' . base_url('uploads/settings/' . $value) . '" class="blue-text" data-fancybox="logo_16_9">';
                $image .= $this->ShowImage_('settings', $value);
                $image .= '</a>';
            }
            return $image;
        });
        $crud->callbackColumn('logo_square', function ($value, $row) {
            if ($value == NULL) {
                $image = '';
            } else {
                $image = '';
                $image .= '<a data-caption="Logo Square" href="' . base_url('uploads/settings/' . $value) . '" class="blue-text" data-fancybox="logo_square">';
                $image .= $this->ShowImage_('settings', $value);
                $image .= '</a>';
            }
            return $image;
        });
        $crud->unsetExportPdf();
        $output = $crud->render();
        $this->output_crud($output);
    }
    function ShowImage_($folder, $value)
    {
        return '<img style="height: 60px; height: 60px; " class="rounded text-center" src="' . base_url('uploads/' . $folder . '/' . $value) . '">';
    }
}

/* End of file Settings.php */
