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

        $crud = $this->initial_config($crud);
        $crud = $this->display_as($crud);

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
        $crud->callbackAfterUpdate(function ($stateParameters) use ($table) {

            $cek62_no_bantuan_wa = substr($stateParameters->data['no_bantuan_wa'], 0, 2);
            $cek0_no_bantuan_wa = substr($stateParameters->data['no_bantuan_wa'], 0, 1);
            if ($cek62_no_bantuan_wa == 62) {
                $str_to_replace = '';
                $input_str = $stateParameters->data['no_bantuan_wa'];
                $no_bantuan_wa_tel = $str_to_replace . substr($input_str, 2);
            } elseif ($cek0_no_bantuan_wa == 0) {
                $str_to_replace = '';
                $input_str = $stateParameters->data['no_bantuan_wa'];
                $no_bantuan_wa_tel = $str_to_replace . substr($input_str, 1);
            } else {
                // do nothing
            }
            $data = array('no_bantuan_wa' => '62' . $no_bantuan_wa_tel);

            $this->db->where('id', $stateParameters->primaryKeyValue);
            $this->db->update($table, $data);

            return $stateParameters;
        });
        $crud->setConfig('actions_column_side', 'left');
        $crud->unsetExportPdf();
        $output = $crud->render();
        $this->output_crud($output);
    }
    private function initial_config($crud)
    {
        $crud->unsetSearchColumns(['no_pendaftaran', 'nik_santri', 'nama_santri', 'jenis_kelamin', 'tanggal_lahir', 'status', 'jenjang']);
        $crud->unsetColumns(['create_by', 'modify_by']);
        $crud->unsetFields(['timestamp', 'create_by', 'modify', 'modify_by', 'delete_at']);

        $crud->unsetPrint();
        $crud->unsetExport();
        $crud->unsetSettings();
        $crud->unsetOperations();
        $crud->unsetFilters();


        $crud->setEdit();
        // $crud->setRead();
        // $crud->setDelete();
        return $crud;
    }
    private function display_as($crud)
    {
        $crud->displayAs(array(
            'nama_pesantren' => 'Nama Pesantren',
            'deskripsi_pesantren' => 'Deskripsi Pesantren',
            'no_bantuan_wa' => 'No Bantuan WA',

        ));
        return $crud;
    }
    function ShowImage_($folder, $value)
    {
        return '<img style="height: 60px; height: 60px; " class="rounded text-center" src="' . base_url('uploads/' . $folder . '/' . $value) . '">';
    }
}

/* End of file Settings.php */
