<?php

function showNavAdmin()
{
    $CI = &get_instance();

    if (isset($CI->ion_auth->user()->row()->foto_karyawan)) {
        if ($CI->ion_auth->user()->row()->foto_karyawan != '') {
            $img_user = base_url('uploads/karyawan/foto_karyawan/' . $CI->ion_auth->user()->row()->foto_karyawan);
        } else {
            $img_user = 'https://apps.len-telko.co.id/uploads/karyawan/foto_karyawan/6205f75d0f3a5.png';
        }
    } else {
        $img_user = 'https://apps.len-telko.co.id/uploads/karyawan/foto_karyawan/6205f75d0f3a5.png';
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
    $data_settings = $CI->db->get('settings')->row();
    $CI->session->set_userdata('settings', $data_settings);

    $dataHeader = array(
        'title' => 'PPDB ' . $data_settings->nama_pesantren,
        'nama_session' => 'PPDB',
        'description' => $data_settings->nama_pesantren,
        'nama_user' => NULL,
    );

    $CI->load->view('inc/header_cdn', $dataHeader);
    // $CI->load->view('inc/nav_user');
}
