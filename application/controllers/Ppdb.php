<?php

use phpDocumentor\Reflection\Types\This;

defined('BASEPATH') or exit('No direct script access allowed');

// include the base class
require_once("application/core/GCrud.php");

class Ppdb extends CI_Controller
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
        $this->table = 't_ppdb';
        $this->subject = 'HASIL TEST PPDB';
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
        $crud->unsetOperations();
        $crud->unsetExport();
        $crud->unsetFilters();
        $crud->unsetSettings();
        $crud->unsetPrint();

        $crud->setTable($this->table);
        $table = $crud->getTable();
        $subject = $this->subject;
        $crud = $this->initial_config($crud);
        $crud = $this->display_as($crud);

        $crud->Columns(['no_pendaftaran', 'nik_santri', 'nama_santri', 'jenis_kelamin', 'tanggal_lahir', 'status', 'jenjang']);
        $crud->setRead();
        $crud->setAdd();
        $crud->setEdit();

        $crud->editFields(['status']);
        $crud->setLangString('edit', 'UPDATE STATUS');
        $crud->setLangString('error_generic_title', 'INFO');
        $crud->setLangString('edit_item', 'UPDATE STATUS');

        $crud->callbackReadField('status', function ($value, $primaryKeyValue) use ($table) {;
            $this->db->where('id', $primaryKeyValue);
            $data_id = $this->db->get($table)->row();

            if ($data_id->status == 'Diterima') {
                return '<span class="green-text">' . ucfirst($data_id->status) . '</span>';
            } elseif ($data_id->status == 'Lulus') {
                return '<span class="info-text">' . ucfirst($data_id->status) . '</span>';
            } elseif ($data_id->status == 'Tidak Lulus') {
                return '<span class="red-text">' . ucfirst($data_id->status) . '</span>';
            } elseif ($data_id->status == 'Tidak Daftar Ulang') {
                return '<span class="orange-text">' . ucfirst($data_id->status) . '</span>';
            } else {
                return '-';
            }
        });
        $crud->callbackColumn(
            'status',
            function ($value, $row) use ($table) {
                $row = (object) $row;

                $this->db->where('id', $row->id);
                $data_id = $this->db->get($table)->row();
                if ($data_id->status == 'Proses') {
                    return '<span class="blue-text">' . ucfirst($data_id->status) . '</span>';
                } elseif ($data_id->status == 'Diterima') {
                    return '<span class="green-text">' . ucfirst($data_id->status) . '</span>';
                } elseif ($data_id->status == 'Lulus') {
                    return '<span class="info-text">' . ucfirst($data_id->status) . '</span>';
                } elseif ($data_id->status == 'Tidak Lulus') {
                    return '<span class="red-text">' . ucfirst($data_id->status) . '</span>';
                } elseif ($data_id->status == 'Tidak Daftar Ulang') {
                    return '<span class="orange-text">' . ucfirst($data_id->status) . '</span>';
                } else {
                    return '-';
                }
            }
        );

        $crud->fieldType('nik_santri', 'numeric');
        // $crud->unsetAddFields(['no_pendaftaran', 'timestamp', 'create_by', 'modify', 'modify_by', 'delete_at']);
        $crud->AddFields(['nik_santri', 'nama_santri', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'jenjang', 'nama_ayah', 'nama_ibu', 'golongan_darah', 'status']);
        $crud->EditFields(['no_pendaftaran', 'status', 'nik_santri', 'nama_santri', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'jenjang', 'nama_ayah', 'nama_ibu', 'golongan_darah']);

        $crud->readOnlyEditFields(['no_pendaftaran', 'nik_santri', 'nama_santri', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'jenjang', 'nama_ayah', 'nama_ibu', 'golongan_darah']);;
        $crud->callbackInsert(function ($stateParameters) use ($table) {
            $stateParameters->data['no_pendaftaran'] = $this->generate_nomor_pendaftaran();
            if ($this->db->insert($table, $stateParameters->data)) {
                $stateParameters->insertId = $this->db->insert_id();
                return $stateParameters;
            } else {
                return (new \GroceryCrud\Core\Error\ErrorMessage())
                    ->setMessage("GAGAL MENYIMPAN DATA, HUBUNGI SISTEM ADMIN");
            }
        });
        if ($crud->getState() == 'AddForm' || $crud->getState() == 'Insert') {
            $crud->requiredFields(['nik_santri', 'nama_santri', 'jenis_kelamin', 'status']);
            $crud->uniqueFields(['nik_santri']);
        }

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
        $crud->unsetColumns(['timestamp', 'create_by', 'modify', 'modify_by', 'delete_at']);
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
            'no_pendaftaran' => 'NP',
            'nik_santri' => 'NIK Santri',
            'nama_santri' => 'Nama',
            'jenis_kelamin' => 'Jenis Kelamin',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'status' => 'Status',
            'jenjang' => 'Jenjang',
            'nama_ayah' => 'Nama Ayah',
            'nama_ibu' => 'Nama Ibu',
            'golongan_darah' => 'Golongan Darah',
        ));
        return $crud;
    }
    private function generate_nomor_pendaftaran($dari_nama = NULL)
    {
        $nomor = "1";
        $tahun = date('Y');
        $this->db->order_by('id', 'desc');
        $data  = $this->db->get('t_ppdb', 1)->row();

        if ($data) {
            $tahun = substr($data->no_pendaftaran, 3, 4);
            if ($tahun == date('Y')) {
                $nomorTerakhir = substr($data->no_pendaftaran, -4, 4);
                $nomor = $nomorTerakhir + 1;
            }
        }

        return  "NP-" . $tahun . str_pad($nomor, 4, 0, STR_PAD_LEFT);
    }
}

/* End of file Ppdb.php */
