<?php

function showNavAdmin()
{
    $CI = &get_instance();

    if (isset($CI->ion_auth->user()->row()->foto_karyawan)) {
        if ($CI->ion_auth->user()->row()->foto_karyawan != '') {
            $img_user = base_url('uploads/karyawan/foto_karyawan/' . $CI->ion_auth->user()->row()->foto_karyawan);
        } else {
            $img_user = 'https://simg.nicepng.com/png/small/514-5146455_premium-home-loan-icon-download-in-svg-png.png';
        }
    } else {
        $img_user = 'https://simg.nicepng.com/png/small/514-5146455_premium-home-loan-icon-download-in-svg-png.png';
    }


    $data_settings = $CI->db->get('settings')->row();
    $CI->session->set_userdata('settings', $data_settings);

    $dataHeader = array(
        'title' =>  $data_settings->nama_pesantren,
        'nama_session' => 'xxx',
        'description' => $data_settings->deskripsi_pesantren,
        'nama_user' => NULL,
        'img_user' => $img_user,
    );




    $CI->load->view('inc/header_cdn', $dataHeader);
    if ($CI->ion_auth->logged_in()) {

        $CI->load->view('inc/nav_admin', $dataHeader);
    }
}
function showNavUser()
{
    $CI = &get_instance();
    $dataHeader = array(
        'title' => 'xxx',
        'nama_session' => 'xxx',
        'description' => 'xxx)',
        'nama_user' => NULL,
    );


    $data_settings = $CI->db->get('settings')->row();
    $CI->session->set_userdata('settings', $data_settings);

    $CI->load->view('inc/header_cdn', $dataHeader);
    $CI->load->view('inc/nav_user');
}
