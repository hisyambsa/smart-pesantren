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

class C_santri extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Santri_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$q = urldecode($this->input->get('q', TRUE));
		$start = intval($this->input->get('start'));

		if ($q <> '') {
			$config['base_url'] = base_url() . 'c_santri/index.html?q=' . urlencode($q);
			$config['first_url'] = base_url() . 'c_santri/index.html?q=' . urlencode($q);
		} else {
			$config['base_url'] = base_url() . 'c_santri/index.html';
			$config['first_url'] = base_url() . 'c_santri/index.html';
		}
		$kondisi = NULL;
		$config['per_page'] = 10;
		$config['page_query_string'] = TRUE;
		$config['total_rows'] = $this->Santri_model->total_rows($q, $kondisi);
		$c_santri = $this->Santri_model->get_limit_data($config['per_page'], $start, $q, $kondisi);

		$this->load->library('pagination');
		$this->pagination->initialize($config);

		$data = array(
			'c_santri_data' => $c_santri,
			'q' => $q,
			'pagination' => $this->pagination->create_links(),
			'total_rows' => $config['total_rows'],
			'start' => $start,
		);

		$this->load->view('c_santri/t_santri_list', $data);
	}

	public function read($id)
	{
		$row = $this->Santri_model->get_by_id($id);
		if ($row) {
			$data = array(
				'id' => $row->id,
				'ppdb_id' => $row->ppdb_id,
				'nis' => $row->nis,
				'nik_santri' => $row->nik_santri,
				'nama_santri' => $row->nama_santri,
				'jenis_kelamin' => $row->jenis_kelamin,
				'tempat_lahir' => $row->tempat_lahir,
				'tanggal_lahir' => $row->tanggal_lahir,
				'alamat' => $row->alamat,
				'province_id' => $row->province_id,
				'regency_id' => $row->regency_id,
				'district_id' => $row->district_id,
				'village_id' => $row->village_id,
				'jenjang' => $row->jenjang,
				'email' => $row->email,
				'no_hp' => $row->no_hp,
				'nomor_kartu_keluarga' => $row->nomor_kartu_keluarga,
				'punya_buku_nasab' => $row->punya_buku_nasab,
				'nama_ayah' => $row->nama_ayah,
				'nama_ibu' => $row->nama_ibu,
				'upload_pas_foto' => $row->upload_pas_foto,
				'upload_kartu_keluarga' => $row->upload_kartu_keluarga,
				'upload_nasab' => $row->upload_nasab,
				'upload_ijasah' => $row->upload_ijasah,
				'golongan_darah' => $row->golongan_darah,
				'status' => $row->status,
				'timestamp' => $row->timestamp,
				'create_by' => $row->create_by,
				'modify' => $row->modify,
				'modify_by' => $row->modify_by,
				'delete_at' => $row->delete_at,
			);
			$this->load->view('c_santri/t_santri_read', $data);
		} else {
			$errors = 'Terjadi Kesalahan System <br> Error Code : R001<br> Technical Assistant <br> ' . 'SYSTEM ADMIN';
			$this->session->set_tempdata('pesan', $errors, 5);
			$this->session->set_tempdata('type', 'error', 5);
			$this->session->set_tempdata('confirm', 'true', 5);
			$this->session->set_tempdata('toast', 'toast', 5);
			$this->session->set_tempdata('timer', '30000', 5);
		}
	}

	public function create()
	{
		$data = array(
			'button' => 'Buat',
			'action' => site_url('c_santri/create_action'),
			'id' => set_value('id'),
			'ppdb_id' => set_value('ppdb_id'),
			'nis' => set_value('nis'),
			'nik_santri' => set_value('nik_santri'),
			'nama_santri' => set_value('nama_santri'),
			'jenis_kelamin' => set_value('jenis_kelamin'),
			'tempat_lahir' => set_value('tempat_lahir'),
			'tanggal_lahir' => set_value('tanggal_lahir'),
			'alamat' => set_value('alamat'),
			'province_id' => set_value('province_id'),
			'regency_id' => set_value('regency_id'),
			'district_id' => set_value('district_id'),
			'village_id' => set_value('village_id'),
			'jenjang' => set_value('jenjang'),
			'email' => set_value('email'),
			'no_hp' => set_value('no_hp'),
			'nomor_kartu_keluarga' => set_value('nomor_kartu_keluarga'),
			'punya_buku_nasab' => set_value('punya_buku_nasab'),
			'nama_ayah' => set_value('nama_ayah'),
			'nama_ibu' => set_value('nama_ibu'),
			'upload_pas_foto' => set_value('upload_pas_foto'),
			'upload_kartu_keluarga' => set_value('upload_kartu_keluarga'),
			'upload_nasab' => set_value('upload_nasab'),
			'upload_ijasah' => set_value('upload_ijasah'),
			'golongan_darah' => set_value('golongan_darah'),
			'status' => set_value('status'),
			'timestamp' => set_value('timestamp'),
			'create_by' => set_value('create_by'),
			'modify' => set_value('modify'),
			'modify_by' => set_value('modify_by'),
			'delete_at' => set_value('delete_at'),
		);
		$this->load->view('c_santri/t_santri_form', $data);
	}

	public function create_action()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->create();
		} else {
			$data = array(
				'ppdb_id' => $this->input->post('ppdb_id', TRUE),
				'nis' => $this->input->post('nis', TRUE),
				'nik_santri' => $this->input->post('nik_santri', TRUE),
				'nama_santri' => $this->input->post('nama_santri', TRUE),
				'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
				'tempat_lahir' => $this->input->post('tempat_lahir', TRUE),
				'tanggal_lahir' => $this->input->post('tanggal_lahir', TRUE),
				'alamat' => $this->input->post('alamat', TRUE),
				'province_id' => $this->input->post('province_id', TRUE),
				'regency_id' => $this->input->post('regency_id', TRUE),
				'district_id' => $this->input->post('district_id', TRUE),
				'village_id' => $this->input->post('village_id', TRUE),
				'jenjang' => $this->input->post('jenjang', TRUE),
				'email' => $this->input->post('email', TRUE),
				'no_hp' => $this->input->post('no_hp', TRUE),
				'nomor_kartu_keluarga' => $this->input->post('nomor_kartu_keluarga', TRUE),
				'punya_buku_nasab' => $this->input->post('punya_buku_nasab', TRUE),
				'nama_ayah' => $this->input->post('nama_ayah', TRUE),
				'nama_ibu' => $this->input->post('nama_ibu', TRUE),
				'upload_pas_foto' => $this->input->post('upload_pas_foto', TRUE),
				'upload_kartu_keluarga' => $this->input->post('upload_kartu_keluarga', TRUE),
				'upload_nasab' => $this->input->post('upload_nasab', TRUE),
				'upload_ijasah' => $this->input->post('upload_ijasah', TRUE),
				'golongan_darah' => $this->input->post('golongan_darah', TRUE),
				'status' => $this->input->post('status', TRUE),
				'timestamp' => $this->input->post('timestamp', TRUE),
				'create_by' => $this->input->post('create_by', TRUE),
				'modify' => $this->input->post('modify', TRUE),
				'modify_by' => $this->input->post('modify_by', TRUE),
				'delete_at' => $this->input->post('delete_at', TRUE),
			);
			if ($this->Santri_model->insert($data)) {
				$messages = 'DATA BERHASIL <br>DIBUAT';
				$this->session->set_tempdata('pesan', $messages, 5);
				$this->session->set_tempdata('type', 'success', 5);
				$this->session->set_tempdata('confirm', 'false', 5);
				$this->session->set_tempdata('timer', '3000', 5);
			} else {
				$errors = 'Terjadi Kesalahan System <br> Error Code : R002<br> Technical Assistant <br> ' . 'SYSTEM ADMIN';
				$this->session->set_tempdata('pesan', $errors, 5);
				$this->session->set_tempdata('type', 'error', 5);
				$this->session->set_tempdata('confirm', 'true', 5);
				$this->session->set_tempdata('toast', 'toast', 5);
				$this->session->set_tempdata('timer', '30000', 5);
			};
			redirect(site_url('c_santri'));
		}
	}

	public function update($id)
	{
		$row = $this->Santri_model->get_by_id($id);

		if ($row) {
			$data = array(
				'button' => 'Ubah',
				'action' => site_url('c_santri/update_action'),
				'id' => set_value('id', $row->id),
				'ppdb_id' => set_value('ppdb_id', $row->ppdb_id),
				'nis' => set_value('nis', $row->nis),
				'nik_santri' => set_value('nik_santri', $row->nik_santri),
				'nama_santri' => set_value('nama_santri', $row->nama_santri),
				'jenis_kelamin' => set_value('jenis_kelamin', $row->jenis_kelamin),
				'tempat_lahir' => set_value('tempat_lahir', $row->tempat_lahir),
				'tanggal_lahir' => set_value('tanggal_lahir', $row->tanggal_lahir),
				'alamat' => set_value('alamat', $row->alamat),
				'province_id' => set_value('province_id', $row->province_id),
				'regency_id' => set_value('regency_id', $row->regency_id),
				'district_id' => set_value('district_id', $row->district_id),
				'village_id' => set_value('village_id', $row->village_id),
				'jenjang' => set_value('jenjang', $row->jenjang),
				'email' => set_value('email', $row->email),
				'no_hp' => set_value('no_hp', $row->no_hp),
				'nomor_kartu_keluarga' => set_value('nomor_kartu_keluarga', $row->nomor_kartu_keluarga),
				'punya_buku_nasab' => set_value('punya_buku_nasab', $row->punya_buku_nasab),
				'nama_ayah' => set_value('nama_ayah', $row->nama_ayah),
				'nama_ibu' => set_value('nama_ibu', $row->nama_ibu),
				'upload_pas_foto' => set_value('upload_pas_foto', $row->upload_pas_foto),
				'upload_kartu_keluarga' => set_value('upload_kartu_keluarga', $row->upload_kartu_keluarga),
				'upload_nasab' => set_value('upload_nasab', $row->upload_nasab),
				'upload_ijasah' => set_value('upload_ijasah', $row->upload_ijasah),
				'golongan_darah' => set_value('golongan_darah', $row->golongan_darah),
				'status' => set_value('status', $row->status),
				'timestamp' => set_value('timestamp', $row->timestamp),
				'create_by' => set_value('create_by', $row->create_by),
				'modify' => set_value('modify', $row->modify),
				'modify_by' => set_value('modify_by', $row->modify_by),
				'delete_at' => set_value('delete_at', $row->delete_at),
			);
			$this->load->view('c_santri/t_santri_form', $data);
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
				'ppdb_id' => $this->input->post('ppdb_id', TRUE),
				'nis' => $this->input->post('nis', TRUE),
				'nik_santri' => $this->input->post('nik_santri', TRUE),
				'nama_santri' => $this->input->post('nama_santri', TRUE),
				'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
				'tempat_lahir' => $this->input->post('tempat_lahir', TRUE),
				'tanggal_lahir' => $this->input->post('tanggal_lahir', TRUE),
				'alamat' => $this->input->post('alamat', TRUE),
				'province_id' => $this->input->post('province_id', TRUE),
				'regency_id' => $this->input->post('regency_id', TRUE),
				'district_id' => $this->input->post('district_id', TRUE),
				'village_id' => $this->input->post('village_id', TRUE),
				'jenjang' => $this->input->post('jenjang', TRUE),
				'email' => $this->input->post('email', TRUE),
				'no_hp' => $this->input->post('no_hp', TRUE),
				'nomor_kartu_keluarga' => $this->input->post('nomor_kartu_keluarga', TRUE),
				'punya_buku_nasab' => $this->input->post('punya_buku_nasab', TRUE),
				'nama_ayah' => $this->input->post('nama_ayah', TRUE),
				'nama_ibu' => $this->input->post('nama_ibu', TRUE),
				'upload_pas_foto' => $this->input->post('upload_pas_foto', TRUE),
				'upload_kartu_keluarga' => $this->input->post('upload_kartu_keluarga', TRUE),
				'upload_nasab' => $this->input->post('upload_nasab', TRUE),
				'upload_ijasah' => $this->input->post('upload_ijasah', TRUE),
				'golongan_darah' => $this->input->post('golongan_darah', TRUE),
				'status' => $this->input->post('status', TRUE),
				'timestamp' => $this->input->post('timestamp', TRUE),
				'create_by' => $this->input->post('create_by', TRUE),
				'modify' => $this->input->post('modify', TRUE),
				'modify_by' => $this->input->post('modify_by', TRUE),
				'delete_at' => $this->input->post('delete_at', TRUE),
			);

			if ($this->Santri_model->update($this->input->post('id', TRUE), $data)) {
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
		redirect(site_url('c_santri'));
	}

	public function _rules()
	{
		$this->form_validation->set_rules('ppdb_id', 'ppdb id', 'trim|required');
		$this->form_validation->set_rules('nis', 'nis', 'trim|required');
		$this->form_validation->set_rules('nik_santri', 'nik santri', 'trim|required');
		$this->form_validation->set_rules('nama_santri', 'nama santri', 'trim|required');
		$this->form_validation->set_rules('jenis_kelamin', 'jenis kelamin', 'trim|required');
		$this->form_validation->set_rules('tempat_lahir', 'tempat lahir', 'trim|required');
		$this->form_validation->set_rules('tanggal_lahir', 'tanggal lahir', 'trim|required');
		$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
		$this->form_validation->set_rules('province_id', 'province id', 'trim|required');
		$this->form_validation->set_rules('regency_id', 'regency id', 'trim|required');
		$this->form_validation->set_rules('district_id', 'district id', 'trim|required');
		$this->form_validation->set_rules('village_id', 'village id', 'trim|required');
		$this->form_validation->set_rules('jenjang', 'jenjang', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required');
		$this->form_validation->set_rules('no_hp', 'no hp', 'trim|required');
		$this->form_validation->set_rules('nomor_kartu_keluarga', 'nomor kartu keluarga', 'trim|required');
		$this->form_validation->set_rules('punya_buku_nasab', 'punya buku nasab', 'trim|required');
		$this->form_validation->set_rules('nama_ayah', 'nama ayah', 'trim|required');
		$this->form_validation->set_rules('nama_ibu', 'nama ibu', 'trim|required');
		$this->form_validation->set_rules('upload_pas_foto', 'upload pas foto', 'trim|required');
		$this->form_validation->set_rules('upload_kartu_keluarga', 'upload kartu keluarga', 'trim|required');
		$this->form_validation->set_rules('upload_nasab', 'upload nasab', 'trim|required');
		$this->form_validation->set_rules('upload_ijasah', 'upload ijasah', 'trim|required');
		$this->form_validation->set_rules('golongan_darah', 'golongan darah', 'trim|required');
		$this->form_validation->set_rules('status', 'status', 'trim|required');
		$this->form_validation->set_rules('timestamp', 'timestamp', 'trim|required');
		$this->form_validation->set_rules('create_by', 'create by', 'trim|required');
		$this->form_validation->set_rules('modify', 'modify', 'trim|required');
		$this->form_validation->set_rules('modify_by', 'modify by', 'trim|required');
		$this->form_validation->set_rules('delete_at', 'delete at', 'trim|required');

		$this->form_validation->set_rules('id', 'id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}

/* End of file C_santri.php */
/* Location: ./application/controllers/C_santri.php */
/* Please DO NOT modify this information : */
/* Generated by HISYAM 2023-04-09 02:19:34 */
/* http://hisyambsa.github.io */