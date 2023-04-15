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

defined('BASEPATH') or exit('No direct script access allowed');

use Carbon\Carbon;
use phpDocumentor\Reflection\Types\Array_;
use iio\libmergepdf\Merger;

class Cetak extends CI_Controller
{
    public $html_view = '';
    public  $orientation_page = 'p';
    public $pdf_unit = 'cm';
    public $pdf_page_format = 'A4';
    public $font_size = '9';

    function __construct()
    {
        parent::__construct();
        $this->load->helper('tcpdf');
        $this->load->library('my_extend_tcpdf');
        $this->load->library('My_extend_tcpdf_1');
        Carbon::setLocale('id');
        $this->envi = (ENVIRONMENT == 'development') ? '' . $this->config->item('development_folder') : '';
    }

    public function index()
    {
        show_404();
    }

    public function ppdb($id = NULL)
    {
        $id = base64_decode($id);
        $decrypted_string = openssl_decrypt($id, "AES-128-ECB", $this->config->item('hash'));
        if (!$decrypted_string) {
            show_error('LINK INVALID / ID TIDAK DITEMUKAN');
        }

        $envi = (ENVIRONMENT == 'development') ? '/' . $this->config->item('development_folder') : '';
        $this->load->model('Ppdb_model');


        $kondisi = array('no_pendaftaran' => $decrypted_string,);
        // $kondisi = array('no_pendaftaran' => 'NP-20230001',);
        $row = $this->Ppdb_model->get_all($kondisi)->row();

        if ($row) {
            $data = array(
                'no_pendaftaran' => $row->no_pendaftaran,
                'nik_santri' => $row->nik_santri,
                'nama_santri' => $row->nama_santri,
                'jenis_kelamin' => $row->jenis_kelamin,
                'tempat_lahir' => $row->tempat_lahir,
                'tanggal_lahir' => $row->tanggal_lahir,
                'tanggal_lahir_locale' => Carbon::parse($row->tanggal_lahir)->isoFormat('D MMMM ggg'),
                'golongan_darah' => $row->golongan_darah,
                'alamat' => $row->alamat,
                'sesuai_ktp' => $row->sesuai_ktp,
                'jenjang' => $row->jenjang,
                'email' => $row->email,
                'no_hp' => $row->no_hp,
                'nama_ayah' => $row->nama_ayah,
                'nama_ibu' => $row->nama_ibu,

                'province_id' => $row->province_id,
                'province_name' => $row->province_name,
                'regency_id' => $row->regency_id,
                'regency_name' => $row->regency_name,
                'district_id' => $row->district_id,
                'district_name' => $row->district_name,
                'village_id' => $row->village_id,
                'village_name' => $row->village_name,

                'nomor_kartu_keluarga' => $row->nomor_kartu_keluarga,
                'punya_buku_nasab' => $row->punya_buku_nasab,

                'upload_pas_foto' => $row->upload_pas_foto,
                'upload_kartu_keluarga' => $row->upload_kartu_keluarga,
                'upload_nasab' => $row->upload_nasab,
                'upload_ijasah' => $row->upload_ijasah,

                'status' => $row->status,
            );
        } else {
            show_error('GAGAL MENGAMBIL DATA, HUBUNGI SISTEM ADMIN');
        }
        $view = $row->no_pendaftaran;

        $html_view = $this->load->view('tempelate_pdf/formulir_ppdb', $data, TRUE);

        $watermark = false;
        $set_margin = array(0.9, 0, 1, 1);

        $ciphertext = base64_encode(openssl_encrypt($row->no_pendaftaran, "AES-128-ECB", $this->config->item('hash')));
        $whitelist = array('127.0.0.1', "::1");
        if (!in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {
            // not valid
            $ciphertext_link = "https://ppdb.smartponpes.id/ppdb/c/$ciphertext";
        } else {
            $ciphertext_link = "https://ppdb.smartponpes.id/ppdb/c/$ciphertext";
        }

        $pdf = tcpdf(strtoupper($view) . ' ' . $row->nama_santri, strtoupper($view), array(), $this->orientation_page, $this->pdf_unit, $this->pdf_page_format, $set_margin, $watermark, false, $ciphertext, false, '1.0', TRUE, 'IGNORED');
        $pdf->setCellPadding('0.05');


        $imglogo = $_SERVER['DOCUMENT_ROOT'] . $envi . '/uploads/settings/' . $this->session->userdata('settings')->logo_square;
        $ext = pathinfo($imglogo, PATHINFO_EXTENSION);
        $pdf->Image($imglogo, 1, 0, 3, 3, $ext, '', '', TRUE, 500, '', false, false, 0, false, false, false);

        if ($row->upload_pas_foto) {
            $imglogo = $_SERVER['DOCUMENT_ROOT'] . $envi . '/uploads/ppdb/' . $row->upload_pas_foto;
            $ext = pathinfo($imglogo, PATHINFO_EXTENSION);
            $pdf->Image($imglogo, 15.4, 6, 3, NULL, $ext, '', '', TRUE, 500, '', false, false, 0, false, false, false);
        }

        $nama_file = "$row->no_pendaftaran.($row->nama_santri)";
        $html = htmlspecialchars_decode($html_view);
        $pdf->writeHTML($html, TRUE, false, TRUE, false, '');





        $style = array(
            'border' => false,
            'padding' => 0,
            'fgcolor' => array(128, 0, 0),
            'bgcolor' => false
        );
        $pdf->write2DBarcode($ciphertext_link, 'QRCODE,H', 15.4, 21.5, 3.5, 3.5, $style, 'N');
        // --------------------------------------------------------- //
        $pdf->Output(strtoupper($nama_file) . '.pdf', 'I');
    }
    public function santri($id = NULL)
    {
        $id = base64_decode($id);
        $decrypted_string = openssl_decrypt($id, "AES-128-ECB", $this->config->item('hash'));
        if (!$decrypted_string) {
            // show_error('LINK INVALID / ID TIDAK DITEMUKAN');
        }

        $envi = (ENVIRONMENT == 'development') ? '/' . $this->config->item('development_folder') : '';
        $this->load->model('Santri_model');


        $kondisi = array('nis' => $decrypted_string,);
        // $kondisi = array('nis' => '2',);
        $row = $this->Santri_model->get_all($kondisi)->row();

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
                'tanggal_lahir_locale' => Carbon::parse($row->tanggal_lahir)->isoFormat('D MMMM ggg'),
                'alamat' => $row->alamat,
                'province_id' => $row->province_id,
                'province_name' => $row->province_name,
                'regency_id' => $row->regency_id,
                'regency_name' => $row->regency_name,
                'district_id' => $row->district_id,
                'district_name' => $row->district_name,
                'village_id' => $row->village_id,
                'village_name' => $row->village_name,
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
            // $data = array(
            //     'no_pendaftaran' => $row->no_pendaftaran,
            //     'nik_santri' => $row->nik_santri,
            //     'nama_santri' => $row->nama_santri,
            //     'jenis_kelamin' => $row->jenis_kelamin,
            //     'tempat_lahir' => $row->tempat_lahir,
            //     'tanggal_lahir' => $row->tanggal_lahir,
            //     'tanggal_lahir_locale' => Carbon::parse($row->tanggal_lahir)->isoFormat('D MMMM ggg'),
            //     'golongan_darah' => $row->golongan_darah,
            //     'alamat' => $row->alamat,
            //     'sesuai_ktp' => $row->sesuai_ktp,
            //     'jenjang' => $row->jenjang,
            //     'email' => $row->email,
            //     'no_hp' => $row->no_hp,
            //     'nama_ayah' => $row->nama_ayah,
            //     'nama_ibu' => $row->nama_ibu,

            //     'province_id' => $row->province_id,
            //     'province_name' => $row->province_name,
            //     'regency_id' => $row->regency_id,
            //     'regency_name' => $row->regency_name,
            //     'district_id' => $row->district_id,
            //     'district_name' => $row->district_name,
            //     'village_id' => $row->village_id,
            //     'village_name' => $row->village_name,

            //     'nomor_kartu_keluarga' => $row->nomor_kartu_keluarga,
            //     'punya_buku_nasab' => $row->punya_buku_nasab,

            //     'upload_pas_foto' => $row->upload_pas_foto,
            //     'upload_kartu_keluarga' => $row->upload_kartu_keluarga,
            //     'upload_nasab' => $row->upload_nasab,
            //     'upload_ijasah' => $row->upload_ijasah,

            //     'status' => $row->status,
            // );
        }
        $view = $row->nis;

        $html_view = $this->load->view('tempelate_pdf/santri_ppdb', $data, TRUE);

        $watermark = false;
        $set_margin = array(0.9, 0, 1, 1);

        $ciphertext = base64_encode(openssl_encrypt($row->nis, "AES-128-ECB", $this->config->item('hash')));
        $whitelist = array('127.0.0.1', "::1");
        if (!in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {
            // not valid
            $ciphertext_link = "https://app.smartponpes.id/cetak/santri/$ciphertext";
        } else {
            $ciphertext_link = "https://app.smartponpes.id/cetak/santri/$ciphertext";
        }

        $pdf = tcpdf(strtoupper($view) . ' ' . $row->nama_santri, strtoupper($view), array(), $this->orientation_page, $this->pdf_unit, $this->pdf_page_format, $set_margin, $watermark, false, $ciphertext, false, '1.0', TRUE, 'IGNORED');
        $pdf->setCellPadding('0.05');


        $imglogo = $_SERVER['DOCUMENT_ROOT'] . $envi . '/uploads/settings/' . $this->session->userdata('settings')->logo_square;
        $ext = pathinfo($imglogo, PATHINFO_EXTENSION);
        $pdf->Image($imglogo, 1, 0, 3, 3, $ext, '', '', TRUE, 500, '', false, false, 0, false, false, false);

        $imglogo = $_SERVER['DOCUMENT_ROOT'] . $envi . '/uploads/ppdb/' . $row->upload_pas_foto;
        $ext = pathinfo($imglogo, PATHINFO_EXTENSION);

        $pdf->Image($imglogo, 15.4, 6, 3, NULL, $ext, '', '', TRUE, 500, '', false, false, 0, false, false, false);

        $nama_file = "$row->nis.($row->nama_santri)";
        $html = htmlspecialchars_decode($html_view);
        $pdf->writeHTML($html, TRUE, false, TRUE, false, '');





        $style = array(
            'border' => false,
            'padding' => 0,
            'fgcolor' => array(128, 0, 0),
            'bgcolor' => false
        );
        $pdf->write2DBarcode($ciphertext_link, 'QRCODE,H', 15.4, 21.5, 3.5, 3.5, $style, 'N');
        // --------------------------------------------------------- //
        $pdf->Output(strtoupper($nama_file) . '.pdf', 'I');
    }

    public function client_pdf()
    {
        $this->load->view('pdf/client');
    }
}

/* End of file Cetak.php */
/* Location: ./application/controllers/Cetak.php */
/* Please DO NOT modify this information : */
/* http://hisyambsa.github.io */
