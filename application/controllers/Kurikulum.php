<?php

use phpDocumentor\Reflection\Types\This;

defined('BASEPATH') or exit('No direct script access allowed');

// include the base class
require_once("application/core/GCrud.php");

class Kurikulum extends CI_Controller
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
        $this->table = 'kurikulum';
        $this->subject = 'Data Kurikulum';
    }

    public function output_crud($output = null)
    {
        if (isset($output->isJSONResponse) && $output->isJSONResponse) {
            header('Content-Type: application/json; charset=utf-8');
            echo $output->output;
            exit;
        }

        $output->link_tambah = FALSE;
        $output->nama_link = 'Create';
        $output->link =  __CLASS__ . '/create';
        $output->group = array('all_users');

        return $this->load->view('db/view_crud', (array)$output, TRUE);
    }
    public function modul()
    {
        $crud = $this->GCrud->_getGroceryCrudEnterprise();

        $crud->setTable($this->table);
        $table = $crud->getTable();
        $subject = $this->subject;

        $crud = $this->initial_config($crud);
        $crud = $this->display_as($crud);


        $crud->setAdd();
        $crud->setRead();
        $crud->setEdit();
        $crud->setDelete();
        $crud->setConfig('action_button_type', 'icon');

        $crud->uniqueFields(['kode_mapel']);
        $crud->requiredFields(['kode_mapel', 'mata_pelajaran', 'kitab_rujukan', 'jenjang', 'kelas', 'jam_perminggu']);
        $crud->addFields(['kode_mapel', 'mata_pelajaran', 'kitab_rujukan', 'jenjang', 'kelas', 'jam_perminggu']);
        $crud->editFields(['kode_mapel', 'mata_pelajaran', 'kitab_rujukan', 'jenjang', 'kelas', 'jam_perminggu']);
        $crud->columns(['kode_mapel', 'mata_pelajaran', 'jenjang', 'kelas', 'jam_perminggu']);

        // $crud->setRelation('kitab_rujukan', 'kitab', '{nama} - {pengarang}');
        $crud->setRelationNtoN('kitab_rujukan', 'kurikulum_kitab', 'kitab', 'kurikulum_id', 'kitab_id', '{nama} - {pengarang}');



        $output = $crud->render();
        $this->output_crud($output);

        $dataGcrud = $this->output_crud($output);

        $data = array(
            'subject' => $subject,
            'dataGcrud' => $dataGcrud,
        );
        $this->load->view('tempelate/gcrud', $data);
    }
    private function initial_config($crud)
    {
        $crud->unsetColumns(['create_by', 'modify', 'modify_by', 'delete_at']);
        $crud->unsetFields(['timestamp', 'create_by', 'modify', 'modify_by', 'delete_at']);

        $crud->unsetPrint();
        $crud->unsetExport();
        $crud->unsetSettings();
        $crud->unsetOperations();
        $crud->unsetFilters();
        return $crud;
    }
    private function display_as($crud)
    {
        return $crud;
    }
}

/* End of file Kurikulum.php */
