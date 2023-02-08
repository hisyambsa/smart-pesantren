<?php

use phpDocumentor\Reflection\Types\This;

defined('BASEPATH') or exit('No direct script access allowed');

// include the base class
require_once("application/core/GCrud.php");

class Santri extends CI_Controller
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
        $this->table = 't_santri';
        $this->subject = 'Data Santri';
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

        $crud->setConfig('action_button_type', 'icon');

        $crud->setRelation('ppdb_id', 't_ppdb', '{no_pendaftaran}');

        $crud->setRead();
        $crud->columns(['nama_santri', 'jenis_kelamin', 'nik_siswa']);

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
        $crud->displayAs(array(
            'ppdb_id' => 'No Pendaftaran',
            'nik_siswa' => 'NIK',
            'nis' => 'NIS',
            'nisn' => 'NISN',
            'nama_santri' => 'Nama',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
        ));

        return $crud;
    }
}

/* End of file Santri.php */
