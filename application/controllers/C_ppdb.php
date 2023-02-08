<?php

use Google\Service\Spanner\UpdateDatabaseDdlMetadata;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
<!-- .................................. -->
<!-- ...........COPYRIGHT ............. -->
<!-- Authors : Hisyam Husein .......... -->
<!-- Email : hisyam.husein@gmail.com .. -->
<!-- About : hisyambsa.github.io ...... -->
<!-- Instagram : @hisyambsa............ -->
<!-- .................................. -->
*/

class C_ppdb extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Ppdb_model');
        $this->load->library('form_validation');
    }

    public function ppdb_action()
    {
        $this->_rules_1();

        if ($this->form_validation->run() == FALSE) {
            $this->ppdb_1();
        } else {
            $no_pendaftaran = $this->Ppdb_model->generate_nomor_pendaftaran();
            $data = array(
                'no_pendaftaran' => $no_pendaftaran,
                'nik_santri' => $this->input->post('nik_santri', TRUE),
                'nama_santri' => $this->input->post('nama_santri', TRUE),
                'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
                'tempat_lahir' => $this->input->post('tempat_lahir', TRUE),
                'tanggal_lahir' => $this->input->post('tanggal_lahir', TRUE),
                'alamat' => $this->input->post('alamat', TRUE),
                'jenjang' => $this->input->post('jenjang', TRUE),
                'province_id' => $this->input->post('province_id', TRUE),
                'regency_id' => $this->input->post('regency_id', TRUE),
                'district_id' => $this->input->post('district_id', TRUE),
                'village_id' => $this->input->post('village_id', TRUE),
                'email' => $this->input->post('email', TRUE),
                'no_hp' => $this->input->post('no_hp', TRUE),
                'status' => 'proses',
            );
            if ($this->Ppdb_model->insert($data)) {
                $messages = 'REGISTRASI BERHASIL <br> Anda akan dihubungi <br>Panitia PPDB untuk informasi selanjutnya<hr><br>No. Registrasi<br>' . $no_pendaftaran;
                $this->session->set_tempdata('pesan', $messages, 5);
                $this->session->set_tempdata('type', 'success', 5);
                $this->session->set_tempdata('confirm', true, 5);
                $this->session->set_tempdata('timer', '60000', 5);
                $this->session->set_tempdata('toast', 'toast', 5);
            } else {
                $errors = 'Terjadi Kesalahan System <br> Error Code : R002<br> Technical Assistant <br> ' . 'SYSTEM ADMIN';
                $this->session->set_tempdata('pesan', $errors, 5);
                $this->session->set_tempdata('type', 'error', 5);
                $this->session->set_tempdata('confirm', 'true', 5);
                $this->session->set_tempdata('toast', 'toast', 5);
                $this->session->set_tempdata('timer', '60000', 5);
            };
            redirect(site_url('ppdb'));
        }
    }

    public function update_action()
    {
        // var_dump($_POST);
        var_dump($_FILES);
        die;
        if ($this->input->post('form') == 'form_2') {
            $this->_rules_2();
        } elseif ($this->input->post('form') == 'form_3') {
            $this->form_validation->set_rules('no_pendaftaran', 'No Pendaftaran', 'trim|required');
            $this->form_validation->set_rules('upload_kartu_keluarga', 'Upload Kartu Keluarga', 'trim|required');
            $this->form_validation->set_rules('upload_nasab', 'Upload Nasab', 'trim|required');
            $this->form_validation->set_rules('upload_ijasah', 'Upload Ijasah', 'trim|required');


            $this->form_validation->set_rules('id', 'id', 'trim');
            $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
        } else {
            show_error('Line : ' . __LINE__ . ' : INFOKAN ADMIN');
        }
        // $no_pendaftaran = base64_decode($this->input->post('no_pendaftaran', TRUE));
        $no_pendaftaran = $this->input->post('no_pendaftaran', TRUE);

        if ($this->form_validation->run() == FALSE) {
            if ($this->input->post('form') == 'form_2') {
                $this->ppdb_2($no_pendaftaran);
            } elseif ($this->input->post('form') == 'form_3') {
                $this->ppdb_3($no_pendaftaran);
            } else {
                show_error('Line : ' . __LINE__ . ' : INFOKAN ADMIN');
            }
        } else {
            if ($this->input->post('form') == 'form_2') {
                $data = array(
                    'no_pendaftaran' => base64_decode($this->input->post('no_pendaftaran', TRUE)),
                    'nomor_kartu_keluarga' => $this->input->post('nomor_kartu_keluarga', TRUE),
                    'punya_buku_nasab' => $this->input->post('punya_buku_nasab', TRUE),
                    'nama_ayah' => $this->input->post('nama_ayah', TRUE),
                    'nama_ibu' => $this->input->post('nama_ibu', TRUE),
                );
                $kondisi = array('no_pendaftaran' => base64_decode($this->input->post('no_pendaftaran', TRUE)),);
                if ($this->Ppdb_model->update_where($kondisi, $data)) {
                    $messages = 'BERHASIL SUBMIT DATA<br>SILAHKAN UPLOAD DOKUMEN';
                    $this->session->set_tempdata('pesan', $messages, 5);
                    $this->session->set_tempdata('type', 'success', 5);
                    $this->session->set_tempdata('confirm', 'true', 5);
                    $this->session->set_tempdata('timer', '10000', 5);
                    redirect('c_ppdb/ppdb_3');
                } else {
                    $errors = "Terjadi Kesalahan System <br> Error Code : __LINE__<br> Technical Assistant <br> ' . 'SYSTEM ADMIN";
                    $this->session->set_tempdata('pesan', $errors, 5);
                    $this->session->set_tempdata('type', 'error', 5);
                    $this->session->set_tempdata('confirm', 'true', 5);
                    $this->session->set_tempdata('toast', 'toast', 5);
                    $this->session->set_tempdata('timer', '30000', 5);
                    redirect('c_ppdb/ppdb_2');
                };
            } elseif ($this->input->post('form') == 'form_3') {
                $this->ppdb_3($no_pendaftaran);
            } else {
                show_error('Line : ' . __LINE__ . ' : INFOKAN ADMIN');
            }
        }
    }
    public function ppdb_1()
    {
        if ($this->ion_auth->logged_in()) {
            redirect('admin/home');
        }
        $attributes = array(
            'autocomplete' => 'off',
            'id' => 'form_id'
        );

        $hidden = array(
            'form' => 'form_1',
        );
        $data = array(
            'button' => 'Buat',
            'action' => site_url('c_ppdb/ppdb_action'),
            'id' => set_value('id'),
            'no_pendaftaran' => set_value('no_pendaftaran'),
            'nik_santri' => set_value('nik_santri'),
            'nama_santri' => set_value('nama_santri'),
            'jenis_kelamin' => set_value('jenis_kelamin'),
            'tempat_lahir' => set_value('tempat_lahir'),
            'tanggal_lahir' => set_value('tanggal_lahir'),
            'alamat' => set_value('alamat'),
            'jenjang' => set_value('jenjang'),
            'email' => set_value('email'),
            'no_hp' => set_value('no_hp'),
            'nama_ayah' => set_value('nama_ayah'),
            'nama_ibu' => set_value('nama_ibu'),
            'golongan_darah' => set_value('golongan_darah'),
            'status' => set_value('status'),
            'timestamp' => set_value('timestamp'),
            'create_by' => set_value('create_by'),
            'modify' => set_value('modify'),
            'modify_by' => set_value('modify_by'),
            'delete_at' => set_value('delete_at'),

            'attributes' => $attributes,
            'hidden' => $hidden
        );
        $form = $this->load->view('c_ppdb/t_ppdb_form_1', $data, true);
        $data = array(
            'form' => $form,
            'bagian' => 'PENDAFTARAN',
        );

        $this->load->view('c_ppdb/tempelate', $data);
    }
    public function ppdb_2($no_pendaftaran = NULL)
    {
        if ($no_pendaftaran == NULL) {
            show_404();
        } else {
            // $no_pendaftaran = base64_decode($no_pendaftaran);
        }
        $kondisi = array('no_pendaftaran' => $no_pendaftaran,);
        $row = $this->Ppdb_model->get_all($kondisi)->row();

        if ($row) {
            $attributes = array(
                'autocomplete' => 'off',
                'id' => 'form_id'
            );

            $hidden = array(
                'form' => 'form_2',
                // 'no_pendaftaran' => base64_encode($no_pendaftaran)
                'no_pendaftaran' => $no_pendaftaran
            );
            $data = array(
                'button' => 'Ubah',
                'action' => site_url('c_ppdb/update_action'),
                'id' => set_value('id', $row->id),
                'no_pendaftaran' => set_value('no_pendaftaran', $row->no_pendaftaran),
                'nik_santri' => set_value('nik_santri', $row->nik_santri),
                'nama_santri' => set_value('nama_santri', $row->nama_santri),
                'jenis_kelamin' => set_value('jenis_kelamin', $row->jenis_kelamin),
                'tempat_lahir' => set_value('tempat_lahir', $row->tempat_lahir),
                'tanggal_lahir' => set_value('tanggal_lahir', $row->tanggal_lahir),
                'alamat' => set_value('alamat', $row->alamat),
                'jenjang' => set_value('jenjang', $row->jenjang),
                'email' => set_value('email', $row->email),
                'no_hp' => set_value('no_hp', $row->no_hp),
                'nama_ayah' => set_value('nama_ayah', $row->nama_ayah),
                'nama_ibu' => set_value('nama_ibu', $row->nama_ibu),

                'province_id' => set_value('province_id', $row->province_id),
                'regency_id' => set_value('regency_id', $row->regency_id),
                'district_id' => set_value('district_id', $row->district_id),
                'village_id' => set_value('village_id', $row->village_id),

                'nomor_kartu_keluarga' => set_value('nomor_kartu_keluarga', $row->nomor_kartu_keluarga),
                'punya_buku_nasab' => set_value('punya_buku_nasab', $row->punya_buku_nasab),

                'attributes' => $attributes,
                'hidden' => $hidden
            );

            $form = $this->load->view('c_ppdb/t_ppdb_form_2', $data, true);
            $data = array(
                'form' => $form,
                'bagian' => 'KELENGKAPAN DATA',
            );

            $this->load->view('c_ppdb/tempelate', $data);
        } else {
            show_error('LINK INVALID / ID TIDAK DITEMUKAN');
        }
    }
    public function ppdb_3($no_pendaftaran = NULL)
    {
        if ($no_pendaftaran == NULL) {
            show_404();
        } else {
            // $no_pendaftaran = base64_decode($no_pendaftaran);
        }
        $kondisi = array('no_pendaftaran' => $no_pendaftaran,);
        $row = $this->Ppdb_model->get_all($kondisi)->row();

        if ($row) {
            $attributes = array(
                'autocomplete' => 'off',
                'id' => 'form_id'
            );

            $hidden = array(
                'form' => 'form_3',
                // 'no_pendaftaran' => base64_encode($no_pendaftaran)
                'no_pendaftaran' => $no_pendaftaran
            );
            $data = array(
                'button' => 'Ubah',
                'action' => site_url('c_ppdb/update_action'),
                'id' => set_value('id', $row->id),
                'no_pendaftaran' => set_value('no_pendaftaran', $row->no_pendaftaran),
                'nik_santri' => set_value('nik_santri', $row->nik_santri),
                'nama_santri' => set_value('nama_santri', $row->nama_santri),
                'jenis_kelamin' => set_value('jenis_kelamin', $row->jenis_kelamin),
                'tempat_lahir' => set_value('tempat_lahir', $row->tempat_lahir),
                'tanggal_lahir' => set_value('tanggal_lahir', $row->tanggal_lahir),
                'alamat' => set_value('alamat', $row->alamat),
                'jenjang' => set_value('jenjang', $row->jenjang),
                'email' => set_value('email', $row->email),
                'no_hp' => set_value('no_hp', $row->no_hp),
                'nama_ayah' => set_value('nama_ayah', $row->nama_ayah),
                'nama_ibu' => set_value('nama_ibu', $row->nama_ibu),

                'province_id' => set_value('province_id', $row->province_id),
                'regency_id' => set_value('regency_id', $row->regency_id),
                'district_id' => set_value('district_id', $row->district_id),
                'village_id' => set_value('village_id', $row->village_id),

                'nomor_kartu_keluarga' => set_value('nomor_kartu_keluarga', $row->nomor_kartu_keluarga),
                'punya_buku_nasab' => set_value('punya_buku_nasab', $row->punya_buku_nasab),

                'upload_kartu_keluarga' => set_value('upload_kartu_keluarga', $row->upload_kartu_keluarga),
                'upload_nasab' => set_value('upload_nasab', $row->upload_nasab),
                'upload_ijasah' => set_value('upload_ijasah', $row->upload_ijasah),

                'attributes' => $attributes,
                'hidden' => $hidden
            );

            $form = $this->load->view('c_ppdb/t_ppdb_form_3', $data, true);
            $data = array(
                'form' => $form,
                'bagian' => 'KELENGKAPAN DATA',
            );

            $this->load->view('c_ppdb/tempelate', $data);
        } else {
            show_error('LINK INVALID / ID TIDAK DITEMUKAN');
        }
    }

    public function update($id)
    {
        $row = $this->Ppdb_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Ubah',
                'action' => site_url('c_ppdb/update_action'),
                'id' => set_value('id', $row->id),
                'no_pendaftaran' => set_value('no_pendaftaran', $row->no_pendaftaran),
                'nik_santri' => set_value('nik_santri', $row->nik_santri),
                'nama_santri' => set_value('nama_santri', $row->nama_santri),
                'jenis_kelamin' => set_value('jenis_kelamin', $row->jenis_kelamin),
                'tempat_lahir' => set_value('tempat_lahir', $row->tempat_lahir),
                'tanggal_lahir' => set_value('tanggal_lahir', $row->tanggal_lahir),
                'alamat' => set_value('alamat', $row->alamat),
                'jenjang' => set_value('jenjang', $row->jenjang),
                'email' => set_value('email', $row->email),
                'no_hp' => set_value('no_hp', $row->no_hp),
                'nama_ayah' => set_value('nama_ayah', $row->nama_ayah),
                'nama_ibu' => set_value('nama_ibu', $row->nama_ibu),
                'golongan_darah' => set_value('golongan_darah', $row->golongan_darah),
                'status' => set_value('status', $row->status),
                'timestamp' => set_value('timestamp', $row->timestamp),
                'create_by' => set_value('create_by', $row->create_by),
                'modify' => set_value('modify', $row->modify),
                'modify_by' => set_value('modify_by', $row->modify_by),
                'delete_at' => set_value('delete_at', $row->delete_at),
            );
            $this->load->view('c_ppdb/t_ppdb_form', $data);
        } else {
            $errors = 'Terjadi Kesalahan System <br> Error Code : R003<br> Technical Assistant <br> ' . 'SYSTEM ADMIN';
            $this->session->set_tempdata('pesan', $errors, 5);
            $this->session->set_tempdata('type', 'error', 5);
            $this->session->set_tempdata('confirm', 'true', 5);
            $this->session->set_tempdata('toast', 'toast', 5);
            $this->session->set_tempdata('timer', '30000', 5);
        }
    }

    public function _rules_1()
    {
        $this->form_validation->set_rules('nik_santri', 'nik santri', 'trim|required|numeric|is_unique[t_ppdb.nik_santri]', array('is_unique' => 'NIK sudah Terdaftar'));
        $this->form_validation->set_rules('nama_santri', 'nama santri', 'trim|required');
        $this->form_validation->set_rules('jenis_kelamin', 'jenis kelamin', 'trim|required');
        $this->form_validation->set_rules('tempat_lahir', 'tempat lahir', 'trim|required');
        $this->form_validation->set_rules('tanggal_lahir', 'tanggal lahir', 'trim|required');
        $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');

        $this->form_validation->set_rules('province_id', 'province_id', 'trim|required');
        $this->form_validation->set_rules('regency_id', 'regency_id', 'trim|required');
        $this->form_validation->set_rules('district_id', 'district_id', 'trim|required');
        $this->form_validation->set_rules('village_id', 'village_id', 'trim|required');


        $this->form_validation->set_rules('jenjang', 'jenjang', 'trim|required');
        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
        $this->form_validation->set_rules('no_hp', 'no_hp', 'trim|required|numeric');


        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    public function _rules_2()
    {
        $this->form_validation->set_rules('no_pendaftaran', 'No Pendaftaran', 'trim|required');
        $this->form_validation->set_rules('nomor_kartu_keluarga', 'No Kartu Keluarga', 'trim|required');
        $this->form_validation->set_rules('punya_buku_nasab', 'Buku Nasab', 'trim|required');
        $this->form_validation->set_rules('nama_ayah', 'Nama Ayah', 'trim|required');
        $this->form_validation->set_rules('nama_ibu', 'Nama Ibu', 'trim|required');


        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file C_ppdb.php */
/* Location: ./application/controllers/C_ppdb.php */
/* Please DO NOT modify this information : */
/* Generated by HISYAM 2023-01-21 13:34:42 */
/* http://hisyambsa.github.io */