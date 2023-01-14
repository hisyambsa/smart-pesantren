<?php

function showFooterAdmin()
{
    $CI = &get_instance();
    $data = array(
        // '' => , 
    );
    $CI->load->view('inc/footer_admin', $data);
}
function showFooterUser()
{
    $CI = &get_instance();
    $CI->ion_auth->user()->row();
    $nama_user_first = ($CI->ion_auth->user()->row()) ? $CI->ion_auth->user()->row()->first_name : $no_registrasi_test = ($CI->session->userdata('no_registrasi_test_online_session') ? $CI->session->userdata('no_registrasi_test_online_session') : 'Login');
    $nama_user = ($CI->ion_auth->user()->row()) ? $CI->ion_auth->user()->row()->last_name : '';
    $dataFooter = array(
        'title' => $CI->uri->segment(1, 'Landing Page'),
        'nama_session' => $nama_user_first,
        'judul' => 'Admin',
        // 'imgSrc' => 'https://v5e4f4k6.hostrycdn.com/gambar/favicon.png',
        'nama_user' => $nama_user,
    );

    $CI = &get_instance();
    if (ENVIRONMENT == 'production') {
        $CI->load->view('inc/analytics_google', $dataFooter);
        // https://api.github.com/repos/hisyambsa/SDM/stats/contributors?access_token=85a4e59e38444d95acdb8fad5745e356f8e46dff
        //this is demo key please change with your own key
        $access_token = 'xxx'; //this is demo key please change with your own key
        $url = 'xxx';
        // $url = 'https://api.github.com/repos/hisyambsa/SDM/stats/contributors';
        $data = array(
            "access_token" => $access_token,
        );
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/vnd.github.v3+json',
            'Authorization: token ' . $access_token,
            'User-Agent: GitHub-hisyambsa'
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $json = curl_exec($ch);

        $data_git = json_decode($json); // This outputs the proper JSON.

        if (is_array($data_git[0]->contributions)) {
            $total_new_format = NULL;
        } else {
            $total = $data_git[0]->contributions;

            $total_text = (string)$total; // convert into a string
            $arr = str_split($total_text, "1"); // break string in 3 character sets

            $total_new_format = implode(".", $arr);  // implode array with comma
        }
    } else {
        $total_new_format = 'DEVELOPMENT';
    }

    $data = array(
        'data_commit' => $total_new_format,
    );


    // $CI->load->view('inc/one_signal');

    if ($CI->config->item('testing_mode')) {
        $CI->load->view('testing_view');
    }
    $CI->load->view('inc/footer_user', $data);
}
function showFooter()
{
    $CI = &get_instance();
    $data = array(
        // '' => , 
    );
    $CI->load->view('inc/footer_admin', $data);
}
