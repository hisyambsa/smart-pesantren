<?php

use phpDocumentor\Reflection\Types\This;

defined('BASEPATH') or exit('No direct script access allowed');

// include the base class
require_once("application/core/GCrud.php");

class Catatan_akademik extends CI_Controller
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
        $this->table = 'catatan_akademik';
        $this->subject = 'Catatan Akademik';
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
        $crud->setUniqueId($table);
        $crud->defaultOrdering("$table.timestamp", 'desc');
        $subject = $this->subject;

        $crud = $this->initial_config($crud);
        $crud = $this->display_as($crud);

        $crud->setRelation('santri_id', 't_santri', '{nama_santri} - {nik_santri}');
        $crud->setRelation('pengajar_id', 't_pengajar', '{nama_pengajar} - {nik}');

        // $crud->addFields(['pengajar_id', 'kurikulum_id', 'santri_id', 'data_nilai']);



        if ($this->ion_auth->in_group('pengajar')) {
            $crud->setAdd();
            $crud->setEdit();

            $crud->addFields(['pengajar_id', 'santri_id', 'data_catatan']);
            $crud->setDelete();
            // $crud->callbackAddField('pengajar_id', function ($fieldType, $fieldName) {
            //     $dataPengajar = $this->db->where('login_id', $this->ion_auth->user()->row()->id)->get('t_pengajar')->row();

            //     return $dataPengajar->nama_pengajar . '<input readonly class="form-control" name="' . $fieldName . '" type="hidden" value="' . $dataPengajar->id . '">';
            // });
        }
        $crud->setConfig('action_button_type', 'icon');

        $output = $crud->render();
        $this->output_crud($output);

        $dataGcrud = $this->output_crud($output);

        $data = array(
            'subject' => $subject,
            'dataGcrud' => $dataGcrud,
            'tableUnique' => $table,
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
            'santri_id' => 'Nama Santri',
            'pengajar_id' => 'Nama Pengajar',
            'data_catatan' => 'Catatan',
        ));
        return $crud;
    }
}

/* End of file Catatan_akademik.php */
