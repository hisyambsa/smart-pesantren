<?php

use phpDocumentor\Reflection\Types\This;

defined('BASEPATH') or exit('No direct script access allowed');

// include the base class
require_once("application/core/GCrud.php");

class Pengajar extends CI_Controller
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
        $this->table = 't_pengajar';
        $this->subject = 'Data Pengajar';
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

        $crud->setRelation('login_id', 'users', '{username} - {first_name}');
        $crud->callbackInsert(function ($stateParameters) use ($table) {

            $this->db->trans_begin();

            $this->load->model('Pengajar_model');
            $stateParameters->data['nip'] = $this->Pengajar_model->generate_nip();

            $this->db->insert($table, $stateParameters->data);
            $stateParameters->insertId = $this->db->insert_id();

            $dataInsert = $this->db->get_where($table, array('id' => $stateParameters->insertId,))->row();

            $groupIon = $this->db->where('name', 'Pengajar')->get('groups')->row();

            $additional_data = array(
                'first_name' => $dataInsert->nama_pengajar,
            );
            $group = array('2'); // Sets Pengajar


            $this->ion_auth->register($dataInsert->nip, $dataInsert->tanggal_lahir, $dataInsert->email, $additional_data, array($groupIon->id));


            $userRegister = $this->db->where('username', $dataInsert->nip)->get('users')->row();
            $object = array('login_id' => $userRegister->id,);
            $this->db->where('id', $stateParameters->insertId);
            $this->db->update($table, $object);


            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $errorMessage = new \GroceryCrud\Core\Error\ErrorMessage();
                return $errorMessage->setMessage("EMAIL SUDAH TERDAFTAR\n");
            } else {
                // $this->db->trans_rollback();
                $this->db->trans_commit();
            }

            return $stateParameters;
        });


        $crud->setEdit();
        $crud->setDelete();
        $crud->setConfig('action_button_type', 'icon');

        $crud->requiredFields(['nik', 'nama_pengajar', 'tanggal_lahir', 'email']);

        // application/libraries/GroceryCrudEnterprise/grocerycrud/enterprise/src/GroceryCrud/Core/Validate.php
        $crud->uniqueFields(['nik']);

        $crud->setRule('nik', 'numeric');
        $crud->setRule('nik', 'length', [16]);

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
        $crud->unsetFields(['nip', 'login_id', 'timestamp', 'create_by', 'modify', 'modify_by', 'delete_at']);

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
            'nik' => 'NIK Pengajar',
            'nama_pengajar' => 'Nama Pengajar',
            'login_id' => 'Username - Nama',
            'no_hp' => 'No. HP / WA',
        ));
        return $crud;
    }
}

/* End of file Pengajar.php */
