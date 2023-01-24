<?php if (!defined('BASEPATH'))
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


    public function create()
    {
        $attributes = array(
            'autocomplete' => 'off',
            'id' => 'form_id'
        );

        $hidden = array();
        $data = array(
            'button' => 'Buat',
            'action' => site_url('c_ppdb/create_action'),
            'id' => set_value('id'),
            'no_pendaftaran' => set_value('no_pendaftaran'),
            'nik_santri' => set_value('nik_santri'),
            'nama_santri' => set_value('nama_santri'),
            'jenis_kelamin' => set_value('jenis_kelamin'),
            'tempat_lahir' => set_value('tempat_lahir'),
            'tanggal_lahir' => set_value('tanggal_lahir'),
            'alamat' => set_value('alamat'),
            'jenjang' => set_value('jenjang'),
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
        $this->load->view('c_ppdb/t_ppdb_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
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
                'nama_ayah' => $this->input->post('nama_ayah', TRUE),
                'nama_ibu' => $this->input->post('nama_ibu', TRUE),
                'golongan_darah' => $this->input->post('golongan_darah', TRUE),
                'status' => 'proses',
                'timestamp' => $this->input->post('timestamp', TRUE),
                'create_by' => $this->input->post('create_by', TRUE),
                'modify' => $this->input->post('modify', TRUE),
                'modify_by' => $this->input->post('modify_by', TRUE),
                'delete_at' => $this->input->post('delete_at', TRUE),
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
            redirect(site_url(''));
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

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'no_pendaftaran' => $this->input->post('no_pendaftaran', TRUE),
                'nik_santri' => $this->input->post('nik_santri', TRUE),
                'nama_santri' => $this->input->post('nama_santri', TRUE),
                'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
                'tempat_lahir' => $this->input->post('tempat_lahir', TRUE),
                'tanggal_lahir' => $this->input->post('tanggal_lahir', TRUE),
                'alamat' => $this->input->post('alamat', TRUE),
                'jenjang' => $this->input->post('jenjang', TRUE),
                'nama_ayah' => $this->input->post('nama_ayah', TRUE),
                'nama_ibu' => $this->input->post('nama_ibu', TRUE),
                'golongan_darah' => $this->input->post('golongan_darah', TRUE),
                'status' => $this->input->post('status', TRUE),
                'timestamp' => $this->input->post('timestamp', TRUE),
                'create_by' => $this->input->post('create_by', TRUE),
                'modify' => $this->input->post('modify', TRUE),
                'modify_by' => $this->input->post('modify_by', TRUE),
                'delete_at' => $this->input->post('delete_at', TRUE),
            );

            if ($this->Ppdb_model->update($this->input->post('id', TRUE), $data)) {
                $messages = 'DATA BERHASIL <br>UPDATE';
                $this->session->set_tempdata('pesan', $messages, 5);
                $this->session->set_tempdata('type', 'success', 5);
                $this->session->set_tempdata('confirm', 'false', 5);
                $this->session->set_tempdata('timer', '3000', 5);
            } else {
                $errors = 'Terjadi Kesalahan System <br> Error Code : R004<br> Technical Assistant <br> ' . 'SYSTEM ADMIN';
                $this->session->set_tempdata('pesan', $errors, 5);
                $this->session->set_tempdata('type', 'error', 5);
                $this->session->set_tempdata('confirm', 'true', 5);
                $this->session->set_tempdata('toast', 'toast', 5);
                $this->session->set_tempdata('timer', '30000', 5);
            };
        }
        redirect(site_url('c_ppdb'));
    }

    public function delete($id)
    {
        $row = $this->Ppdb_model->get_by_id($id);

        if ($row) {
            if ($this->Ppdb_model->delete($id)) {
                $messages = 'DATA BERHASIL <br>DIHAPUS';
                $this->session->set_tempdata('pesan', $messages, 5);
                $this->session->set_tempdata('type', 'success', 5);
                $this->session->set_tempdata('confirm', 'false', 5);
                $this->session->set_tempdata('timer', '3000', 5);
            } else {
                $errors = 'Terjadi Kesalahan System <br> Error Code : R005<br> Technical Assistant <br> ' . 'SYSTEM ADMIN';
                $this->session->set_tempdata('pesan', $errors, 5);
                $this->session->set_tempdata('type', 'error', 5);
                $this->session->set_tempdata('confirm', 'true', 5);
                $this->session->set_tempdata('toast', 'toast', 5);
                $this->session->set_tempdata('timer', '30000', 5);
            };
        } else {
            $errors = 'Terjadi Kesalahan System <br> Error Code : R004<br> Technical Assistant <br> ' . 'SYSTEM ADMIN';
            $this->session->set_tempdata('pesan', $errors, 5);
            $this->session->set_tempdata('type', 'error', 5);
            $this->session->set_tempdata('confirm', 'true', 5);
            $this->session->set_tempdata('toast', 'toast', 5);
            $this->session->set_tempdata('timer', '30000', 5);
        }
        redirect(site_url('c_ppdb'));
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nik_santri', 'nik santri', 'trim|required|numeric|is_unique[t_ppdb.nik_santri]', array('is_unique' => 'NIK sudah Terdaftar'));
        $this->form_validation->set_rules('nama_santri', 'nama santri', 'trim|required');
        $this->form_validation->set_rules('jenis_kelamin', 'jenis kelamin', 'trim|required');
        $this->form_validation->set_rules('tempat_lahir', 'tempat lahir', 'trim|required');
        $this->form_validation->set_rules('tanggal_lahir', 'tanggal lahir', 'trim|required');
        $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
        $this->form_validation->set_rules('jenjang', 'jenjang', 'trim|required');
        // $this->form_validation->set_rules('nama_ayah', 'nama ayah', 'trim|required');
        // $this->form_validation->set_rules('nama_ibu', 'nama ibu', 'trim|required');
        // $this->form_validation->set_rules('golongan_darah', 'golongan darah', 'trim|required');
        // $this->form_validation->set_rules('status', 'status', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file C_ppdb.php */
/* Location: ./application/controllers/C_ppdb.php */
/* Please DO NOT modify this information : */
/* Generated by HISYAM 2023-01-21 13:34:42 */
/* http://hisyambsa.github.io */