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
        $this->subject = 'PPDB';
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

        $crud->Columns(['delete_at', 'no_pendaftaran', 'upload_pas_foto', 'nik_santri', 'nama_santri', 'jenis_kelamin', 'status', 'jenjang']);
        $crud->setRead();
        $crud->setAdd();
        $crud->setEdit();


        $crud->editFields(['status']);
        $crud->setLangString('edit', 'UPDATE STATUS');
        $crud->setLangString('error_generic_title', 'INFO');
        $crud->setLangString('edit_item', 'UPDATE STATUS');

        $this->load->library('encryption');

        $crud->setActionButton('LINK PPDB', 'fa fa-link', function ($row) {
            $ciphertext = base64_encode(openssl_encrypt($row->no_pendaftaran, "AES-128-ECB", $this->config->item('hash')));


            $whitelist = array('127.0.0.1', "::1");
            if (!in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {
                // not valid
                return $ciphertext = "https://ppdb.smartponpes.id/ppdb/c/$ciphertext";
            } else {
                return $ciphertext = "https://ppdb.smartponpes.id/ppdb/c/$ciphertext";
            }
        }, true);
        $crud->setActionButton('<i class="fa-brands fa-whatsapp"></i>', 'fa fa-whatsapp', function ($row) {

            $whitelist = array('127.0.0.1', "::1");
            if (!in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {
                $ciphertext = base64_encode(openssl_encrypt($row->no_pendaftaran, "AES-128-ECB", $this->config->item('hash')));
                $no_bantuan_wa = $this->session->userdata('settings')->no_bantuan_wa;
                return "https://api.whatsapp.com/send?phone=6281905096842&text=Terima%20Kasih%20sudah%20mendaftar%20di%20smart-pesantren.%0AUntuk%20tahap%20selanjutnya%20adalah%20mengisi%20kelengkapan%20dokumen.%0A%0AStatus%20Pendaftaran%20dan%20Mengisi%20Kelengkapan%20Dokumen%20dapat%20melalui%20Link%20ini%20dibawah%20ini%0A%0Ahttps://ppdb.smartponpes.id/ppdb/c/$ciphertext%0A%0AJika%20Ada%20Pertanyaan%2C%20dapat%20hubungi%20di%20nomor%20ini%0A%0Ahttps%3A%2F%2Fwa.me%2F$no_bantuan_wa";
            } else {
                $ciphertext = base64_encode(openssl_encrypt($row->no_pendaftaran, "AES-128-ECB", $this->config->item('hash')));
                // $ciphertext = base64_encode(openssl_encrypt(base_url("ppdb/c/" . $row->no_pendaftaran), "AES-128-ECB", $this->config->item('hash')));
                $no_bantuan_wa = $this->session->userdata('settings')->no_bantuan_wa;
                return "https://api.whatsapp.com/send?phone=6281905096842&text=Terima%20Kasih%20sudah%20mendaftar%20di%20smart-pesantren.%0AUntuk%20tahap%20selanjutnya%20adalah%20mengisi%20kelengkapan%20dokumen.%0A%0AStatus%20Pendaftaran%20dan%20Mengisi%20Kelengkapan%20Dokumen%20dapat%20melalui%20Link%20ini%20dibawah%20ini%0A%0Ahttps://ppdb.smartponpes.id/ppdb/c/$ciphertext%0A%0AJika%20Ada%20Pertanyaan%2C%20dapat%20hubungi%20di%20nomor%20ini%0A%0Ahttps%3A%2F%2Fwa.me%2F$no_bantuan_wa";
            }
        }, true);
        $crud->setConfig('action_button_type', 'icon');

        $crud->callbackReadField('status', function ($value, $primaryKeyValue) use ($table) {;
            $this->db->where('id', $primaryKeyValue);
            $data_id = $this->db->get($table)->row();

            if ($data_id->status == 'Proses') {
                return '<span class="grey-text">' . ucfirst($data_id->status) . '</span>';
            } elseif ($data_id->status == 'Upload  Dokumen') {
                return '<span class="purple-text">' . ucfirst($data_id->status) . '</span>';
            } elseif ($data_id->status == 'Lulus') {
                return '<span class="amber-text">' . ucfirst($data_id->status) . '</span>';
            } elseif ($data_id->status == 'Tidak Lulus') {
                return '<span class="red-text">' . ucfirst($data_id->status) . '</span>';
            } elseif ($data_id->status == 'Diterima') {
                return '<span class="blue-text">' . ucfirst($data_id->status) . '</span>';
            } elseif ($data_id->status == 'Tidak Diterima') {
                return '<span class="red-text">' . ucfirst($data_id->status) . '</span>';
            } elseif ($data_id->status == 'Daftar Ulang') {
                return '<span class="green-text">' . ucfirst($data_id->status) . '</span>';
            } elseif ($data_id->status == 'Tidak Daftar Ulang') {
                return '<span class="red-text">' . ucfirst($data_id->status) . '</span>';
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
                    return '<span class="grey-text">' . ucfirst($data_id->status) . '</span>';
                } elseif ($data_id->status == 'Lulus') {
                    return '<span class="purple-text">' . ucfirst($data_id->status) . '</span>';
                } elseif ($data_id->status == 'Upload Dokumen') {
                    return '<span class="amber-text">' . ucfirst($data_id->status) . '</span>';
                } elseif ($data_id->status == 'Tidak Lulus') {
                    return '<span class="red-text">' . ucfirst($data_id->status) . '</span>';
                } elseif ($data_id->status == 'Diterima') {
                    return '<span class="blue-text">' . ucfirst($data_id->status) . '</span>';
                } elseif ($data_id->status == 'Tidak Diterima') {
                    return '<span class="red-text">' . ucfirst($data_id->status) . '</span>';
                } elseif ($data_id->status == 'Daftar Ulang') {
                    return '<span class="green-text">' . ucfirst($data_id->status) . '</span>';
                } elseif ($data_id->status == 'Tidak Daftar Ulang') {
                    return '<span class="red-text">' . ucfirst($data_id->status) . '</span>';
                } else {
                    return '-';
                }
            }
        );
        $crud->callbackColumn('upload_pas_foto', function ($value, $row) {
            if ($value == NULL) {
                $image = '';
            } else {
                $image = '';
                $image .= '<a data-caption="' . $row->no_pendaftaran . '" href="' . base_url('uploads/ppdb/' . $value) . '" class="blue-text" data-fancybox="pas_foto">';
                $image .= $this->ShowImage_('ppdb', $value);
                $image .= '</a>';
            }
            return $image;
        });


        // $crud->setRelation('asrama_id', 'asrama', '{no_kamar}-{nama_kamar}');

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



        $crud->callbackUpload(function ($uploadData) {
            // Hardcoded paths. Please make sure that in case you just copy the below code 
            // that you replace these two variables with yours

            if ($uploadData->field_name == 'upload_pas_foto') {
                $uploadPath = FCPATH . 'uploads/ppdb/'; // directory of the drive
                $publicPath = FCPATH . 'uploads/ppdb/'; // public directory (at the URL)
            } else {
                $uploadPath = FCPATH . 'uploads/ppdb/'; // directory of the drive
                $publicPath = FCPATH . 'uploads/ppdb/'; // public directory (at the URL)
            }

            $fieldName = $uploadData->field_name;

            $storage = new \Upload\Storage\FileSystem($uploadPath);
            $file = new \Upload\File($fieldName, $storage);

            $filename = isset($_FILES[$fieldName]) ? strtotime('now') : null;

            if ($filename === null) {
                return false;
            }

            // The library that we are using want us to remove the file 
            // extension as it is adding it by itself!
            $filename = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
            // Replace illegal characters with an underscore
            $filename = preg_replace("/([^a-zA-Z0-9\-\_]+?){1}/i", '_', $filename);

            $file->setName($filename);

            // Validate file upload
            if ($uploadData->field_name == 'upload_pas_foto') {
                $file->addValidations([
                    new \Upload\Validation\Extension([
                        'jpeg', 'jpg', 'png', 'JPEG', 'JPG', 'PNG'
                    ]),
                    new \Upload\Validation\Size('2M')
                ]);
                $uploadPath = FCPATH . 'uploads/foto/'; // directory of the drive
                $publicPath = FCPATH . 'uploads/foto/'; // public directory (at the URL)
            } else {
                $file->addValidations([
                    new \Upload\Validation\Extension(['pdf', 'PDF']),
                    new \Upload\Validation\Size('2M')
                ]);
                $uploadPath = FCPATH . 'uploads/ppdb/'; // directory of the drive
                $publicPath = FCPATH . 'uploads/ppdb/'; // public directory (at the URL)
            }


            // Work around so the try catch will work as expected.
            // Upload file will not yield any error if the error_reporting is 0
            $display_errors = ini_get('display_errors');
            $error_reporting = error_reporting();
            ini_set('display_errors', 'on');
            error_reporting(E_ALL);

            // Upload file
            try {
                // Success!
                $file->upload();
            } catch (\Upload\Exception\UploadException $e) {
                // Upload error, return a custom message
                $errors = print_r($file->getErrors(), true);
                return (new \GroceryCrud\Core\Error\ErrorMessage())
                    ->setMessage("There was an error with the upload:\n" . $errors);
            } catch (\Exception $e) {
                throw $e;
            }

            ini_set('display_errors', $display_errors);
            error_reporting($error_reporting);

            $filename = $file->getNameWithExtension();

            // Make sure that you return the results
            $uploadData->filePath = $publicPath . '/' . $filename;
            $uploadData->filename = $filename;

            return $uploadData;
        });


        $crud->fieldType('nik_santri', 'numeric');
        // $crud->unsetAddFields(['no_pendaftaran', 'timestamp', 'create_by', 'modify', 'modify_by', 'delete_at']);
        $crud->AddFields(['nik_santri', 'nama_santri', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'province_id', 'regency_id', 'district_id', 'village_id', 'jenjang', 'email', 'no_hp', 'nomor_kartu_keluarga', 'punya_buku_nasab', 'nama_ayah', 'nama_ibu', 'golongan_darah', 'upload_pas_foto', 'upload_kartu_keluarga', 'upload_nasab', 'upload_ijasah', 'status']);

        $crud->readOnlyFields(['no_pendaftaran']);
        $crud->EditFields(['no_pendaftaran', 'status', 'nama_santri', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'province_id', 'regency_id', 'district_id', 'village_id', 'jenjang', 'email', 'no_hp', 'nomor_kartu_keluarga', 'punya_buku_nasab', 'nama_ayah', 'nama_ibu', 'golongan_darah', 'upload_pas_foto', 'upload_kartu_keluarga', 'upload_nasab', 'upload_ijasah']);

        $crud->callbackInsert(function ($stateParameters) use ($table) {
            $this->load->model('Ppdb_model');

            $stateParameters->data['no_pendaftaran'] = $this->Ppdb_model->generate_nomor_pendaftaran();
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
        $crud->callbackBeforeUpdate(function ($stateParameters) {
            // $asrama = $stateParameters->data['asrama_id'];
            $status = $stateParameters->data['status'];

            // if ($status == 'Daftar Ulang') {
            //     // if ($asrama == '') {
            //     // }
            //     // return (new \GroceryCrud\Core\Error\ErrorMessage())
            //     //     ->setMessage("Penerimaan Santri Daftar Ulang");
            // } else {
            // }
            return $stateParameters;
        });


        $this->load->model('Santri_model');
        $crud->callbackAfterUpdate(function ($stateParameters) use ($table) {

            if ($stateParameters->data['status'] == 'Daftar Ulang') {
                $this->db->where('id', $stateParameters->primaryKeyValue);
                $data_ppdb = $this->db->get($table)->row();
                $data = array(
                    'ppdb_id' => $data_ppdb->id,
                    'nik_santri' => $data_ppdb->nik_santri,
                    // 'nisn' => $data_ppdb->nisn,
                    'nis' => $this->Santri_model->generate_nis(),
                    'nama_santri' => $data_ppdb->nama_santri,
                    'jenis_kelamin' => $data_ppdb->jenis_kelamin,
                    'tempat_lahir' => $data_ppdb->tempat_lahir,
                    'tanggal_lahir' => $data_ppdb->tanggal_lahir,
                    'alamat' => $data_ppdb->alamat,
                    'province_id' => $data_ppdb->province_id,
                    'regency_id' => $data_ppdb->regency_id,
                    'district_id' => $data_ppdb->district_id,
                    'village_id' => $data_ppdb->village_id,
                    'jenjang' => $data_ppdb->jenjang,
                    'email' => $data_ppdb->email,
                    'no_hp' => $data_ppdb->no_hp,
                    'nomor_kartu_keluarga' => $data_ppdb->nomor_kartu_keluarga,
                    'punya_buku_nasab' => $data_ppdb->punya_buku_nasab,
                    'nama_ayah' => $data_ppdb->nama_ayah,
                    'upload_pas_foto' => $data_ppdb->upload_pas_foto,
                    'upload_kartu_keluarga' => $data_ppdb->upload_kartu_keluarga,
                    'upload_nasab' => $data_ppdb->upload_nasab,
                    'upload_ijasah' => $data_ppdb->upload_ijasah,
                );
                $this->db->insert('t_santri', $data);
            }

            return $stateParameters;
        });
        if (isset($_GET['search'])) {
            $no_pendaftaran = $this->input->get_post('no_pendaftaran');
            $nama_santri = $this->input->get_post('nama_santri');
            $jenis_kelamin = $this->input->get_post('jenis_kelamin');
            $status = $this->input->get_post('status');
            $jenjang = $this->input->get_post('jenjang');
            $crud->where([
                "$table.no_pendaftaran LIKE ?" => "%$no_pendaftaran%",
                "$table.nama_santri LIKE ?" => "%$nama_santri%",
                "$table.jenis_kelamin LIKE ?" => "%$jenis_kelamin%",
                "$table.status LIKE ?" => "%$status%",
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

        if ($crud->getState() == 'EditForm') {

            $stateInfo = $crud->getStateInfo();
            $this->db->where('id', $stateInfo->primaryKeyValue);

            $data = $this->db->get($table)->row();
            if ($data->status == 'Daftar Ulang') {
                $output = (object)[
                    'isJSONResponse' => true,
                    'output' => json_encode(
                        (object)[
                            'message' =>
                            'Status sudah Daftar Ulang, sudah menjadi Santri',
                            'status' => 'failure'
                        ]
                    )
                ];
            } elseif ($data->upload_pas_foto == '' or $data->upload_pas_foto == NULL) {
                $output = (object)[
                    'isJSONResponse' => true,
                    'output' => json_encode(
                        (object)[
                            'message' =>
                            'Santri belum melengkapi Dokumen',
                            'status' => 'failure'
                        ]
                    )
                ];
            } else {
                $output = $crud->render();
            }
        } else {
            $output = $crud->render();
        }
        $this->output_crud($output);

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
            'action' => site_url('ppdb/modul'),
            'no_pendaftaran' => set_value('no_pendaftaran', $this->input->get_post('no_pendaftaran')),
            'nama_santri' => set_value('nama_santri', $this->input->get_post('nama_santri')),
            'jenis_kelamin' => set_value('jenis_kelamin', $this->input->get_post('jenis_kelamin')),
            'status' => set_value('status', $this->input->get_post('status')),
            'jenjang' => set_value('jenjang', $this->input->get_post('jenjang')),
            'attributes' => $attributes,
            'hidden' => $hidden
        );
        $search = $this->load->view('tempelate/search_ppdb', $data, true);
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
        $crud->unsetSearchColumns(['no_pendaftaran', 'nik_santri', 'nama_santri', 'jenis_kelamin', 'tanggal_lahir', 'status', 'jenjang']);
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
            'no_pendaftaran' => 'NP',
            'nik_santri' => 'NIK Santri',
            'nama_santri' => 'Nama',
            'jenis_kelamin' => 'Jenis Kelamin',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'province_id' => 'Provinsi',
            'regency_id' => 'Kota/Kabupaten',
            'district_id' => 'Kecamatan',
            'village_id' => 'Kelurahan',
            'status' => 'Status',
            'jenjang' => 'Jenjang',
            'email' => 'Email',
            'no_hp' => 'No. HP',
            'nomor_kartu_keluarga' => 'Nomor Kartu keluarga',
            'punya_buku_nasab' => 'Punya Buku Nasab',
            'nama_ayah' => 'Nama Ayah',
            'nama_ibu' => 'Nama Ibu',
            // 'asrama_id' => 'Asrama',
            'golongan_darah' => 'Golongan Darah',
            'upload_pas_foto' => 'Foto',
        ));
        return $crud;
    }
    function ShowImage_($folder, $value)
    {
        return '<img style="height: 60px; height: 60px; " class="rounded text-center" src="' . base_url('uploads/' . $folder . '/' . $value) . '">';
    }
}

/* End of file Ppdb.php */
