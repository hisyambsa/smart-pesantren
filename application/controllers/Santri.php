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
        $crud->setUniqueId($table);
        $crud->defaultOrdering("$table.timestamp", 'desc');
        $subject = $this->subject;

        $crud = $this->initial_config($crud);
        $crud = $this->display_as($crud);

        $crud->setConfig('action_button_type', 'icon');

        $crud->setRelation('ppdb_id', 't_ppdb', '{no_pendaftaran}');
        $crud->setRelation('asrama_id', 'asrama', '{no_kamar}-{nama_kamar}');

        $crud->setRelation('province_id', 'provinces', '{id}-{name}');
        $crud->setRelation('regency_id', 'regencies', '{id}-{name}');
        $crud->setRelation('district_id', 'districts', '{id}-{name}');
        $crud->setRelation('village_id', 'villages', '{id}-{name}');
        $crud->setDependentRelation('regency_id', 'province_id', 'province_id');
        $crud->setDependentRelation('district_id', 'regency_id', 'regency_id');
        $crud->setDependentRelation('village_id', 'district_id', 'district_id');

        $crud->setFieldUpload('upload_pas_foto', 'uploads/ppdb', base_url('uploads/ppdb'));
        $crud->setFieldUpload('upload_kartu_keluarga', 'uploads/ppdb', base_url('uploads/ppdb'));
        $crud->setFieldUpload('upload_nasab', 'uploads/ppdb', base_url('uploads/ppdb'));
        $crud->setFieldUpload('upload_ijasah', 'uploads/ppdb', base_url('uploads/ppdb'));


        $crud->setRead();
        $crud->setEdit();
        $crud->editFields(['jenjang', 'asrama_id']);

        $crud->columns(['delete_at', 'nis', 'upload_pas_foto', 'nik_santri', 'nama_santri', 'tanggal_lahir', 'jenjang', 'asrama_id']);
        $crud->EditFields(['asrama_id', 'jenjang']);



        if (isset($_GET['search'])) {
            $nama_santri = $this->input->get_post('nama_santri');
            $nis = $this->input->get_post('nis');
            $jenis_kelamin = $this->input->get_post('jenis_kelamin');
            $jenjang = $this->input->get_post('jenjang');

            $crud->where([
                "$table.nama_santri LIKE ?" => "%$nama_santri%",
                "$table.nis LIKE ?" => "%$nis%",
                "$table.jenis_kelamin LIKE ?" => "%$jenis_kelamin%",
                "$table.jenjang LIKE ?" => "%$jenjang%"
            ]);
        }
        $page = $this->input->get_post('page');
        if ($page == '') {
            $page = 1;
            $start = 0;
            $this->session->set_userdata('lastSerial', $start);
        } else {
            $per_page = $this->input->get_post('per_page');
            $start = ($page - 1) * $per_page;
            // $start = 1;
            $this->session->set_userdata('lastSerial', $start);
        }


        $crud->callbackColumn('delete_at', function ($value, $row) {
            $this->load->model('Gcrud_model');
            return $this->Gcrud_model->generateSerialNo();
        });

        $crud->callbackColumn('upload_pas_foto', function ($value, $row) {
            if ($value == NULL) {
                $image = '';
            } else {
                $image = '';
                $image .= '<a data-caption="' . $row->nama_santri . '" href="' . base_url('uploads/ppdb/' . $value) . '" class="blue-text" data-fancybox="pas_foto">';
                $image .= $this->ShowImage_('ppdb', $value);
                $image .= '</a>';
            }
            return $image;
        });


        $output = $crud->render();

        $dataGcrud = $this->output_crud($output);


        $attributes = array(
            'autocomplete' => 'off',
            'id' => 'form_id',
            'method' => 'get'
        );

        $hidden = array(
            'search' => 'on',
        );
        $data = array(
            'button' => 'Cari',
            'action' => site_url('santri/modul'),
            'nis' => set_value('nis', $this->input->get_post('nis')),
            'nama_santri' => set_value('nama_santri', $this->input->get_post('nama_santri')),
            'jenis_kelamin' => set_value('jenis_kelamin', $this->input->get_post('jenis_kelamin')),
            'status' => set_value('status', $this->input->get_post('status')),
            'jenjang' => set_value('jenjang', $this->input->get_post('jenjang')),
            'attributes' => $attributes,
            'hidden' => $hidden
        );

        $search = $this->load->view('tempelate/search_santri', $data, true);
        $data = array(
            'subject' => $subject,
            'search' => $search,
            'dataGcrud' => $dataGcrud,
            'tableUnique' => $table,
        );
        $this->load->view('tempelate/gcrud', $data);
    }
    private function initial_config($crud)
    {
        $crud->unsetColumns(['create_by', 'modify', 'modify_by']);
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
            'delete_at' => 'No.',
            'ppdb_id' => 'No Pendaftaran',
            'nik_santri' => 'NIK',
            'nis' => 'NIS',
            'nisn' => 'NISN',
            'nama_santri' => 'Nama',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'upload_pas_foto' => 'Foto',
            'asrama_id' => 'Asrama',
        ));

        return $crud;
    }
    function ShowImage_($folder, $value)
    {
        return '<img style="height: 60px; height: 60px; " class="rounded text-center" src="' . base_url('uploads/' . $folder . '/' . $value) . '">';
    }
}

/* End of file Santri.php */
