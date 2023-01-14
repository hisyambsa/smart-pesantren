<?php
function showHeader()
{
    $CI = &get_instance();
    $CI->ion_auth->user()->row();
    $nama_user_first = ($CI->ion_auth->user()->row()) ? $CI->ion_auth->user()->row()->first_name : $no_registrasi_test = ($CI->session->userdata('no_registrasi_test_online_session') ? $CI->session->userdata('no_registrasi_test_online_session') : 'Login');
    $nama_user = ($CI->ion_auth->user()->row()) ? $CI->ion_auth->user()->row()->last_name : '';
    $nip_user = ($CI->ion_auth->user()->row()) ? $CI->ion_auth->user()->row()->nip : '';
    $job_level_user = ($CI->ion_auth->user()->row()) ? $CI->ion_auth->user()->row()->job_level : '';
    $unit_kerja_user = ($CI->ion_auth->user()->row()) ? $CI->ion_auth->user()->row()->unit_kerja : '';
    $img_user = ($CI->ion_auth->user()->row()) ? base_url('uploads/karyawan/foto_karyawan/' . $CI->ion_auth->user()->row()->foto_karyawan) : 'https://simg.nicepng.com/png/small/514-5146455_premium-home-loan-icon-download-in-svg-png.png';
    // $img_user = '';

    $CI->load->model('approval_model');
    $badge_approval =  $CI->approval_model->badge();
    $dataHeader = array(
        'title' => $CI->uri->segment(1, 'Landing Page'),
        'nama_session' => $nama_user_first,
        'judul' => 'Len Telekomunikasi Indonesia',
        // 'imgSrc' => 'https://v5e4f4k6.hostrycdn.com/gambar/favicon.png',
        'logo' => 'https://v5e4f4k6.hostrycdn.com/gambar/favicon.png',
        'logo_full' => 'https://v5e4f4k6.hostrycdn.com/gambar/logo_transparant_mini.png',
        'img_user' => $img_user,
        'nama_user' => $nama_user,
        'nip_user' => $nip_user,
        'job_level_user' => $job_level_user,
        'unit_kerja_user' => $unit_kerja_user,
        'badge_approval' => $badge_approval,
    );
    $CI->load->view('inc/nav', $dataHeader);
    // var_dump($dataHeader);
    // die;
}
