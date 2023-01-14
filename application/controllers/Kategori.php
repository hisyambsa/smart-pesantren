<?php

defined('BASEPATH') or exit('No direct script access allowed');

// include the base class
require_once("application/core/GCrud.php");

class Kategori extends CI_Controller
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
        $crud->unsetOperations();
        $crud->unsetExport();
        $crud->unsetFilters();
        $crud->unsetSettings();
        $crud->unsetPrint();

        $crud->setTable('kategori');
        $table = $crud->getTable();
        $crud->setSubject('Kategori', 'Kategori');


        $crud->addFields(['nama']);
        $crud->columns(['nama']);
        $crud->setAdd();
        $crud->setEdit();
        $crud->setRead();
        $crud->setDelete();


        $nama = $this->ion_auth->user()->row()->first_name;
        $crud->callbackAfterInsert(function ($stateParameters) use ($table, $nama) {

            $data = array(
                'create_by' => $nama,
            );

            $this->db->where('id', $stateParameters->insertId);
            $this->db->update($table, $data);

            return $stateParameters;
        });

        $crud->callbackAfterUpdate(function ($stateParameters) use ($table, $nama) {

            $data = array(
                'modify_by' => $nama,
            );

            $this->db->where('id', $stateParameters->primaryKeyValue);
            $this->db->update($table, $data);

            return $stateParameters;
        });

        $crud->unsetExportPdf();
        $output = $crud->render();
        $this->output_crud($output);
    }
}

/* End of file Kategori.php */
