<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * One Signal php server work
 *
 * Notification library for PHP
 *
 * @package		One signal
 * @author		Zcodia Tech (http://zcodia.com/)
 * @version		1.0.1
 * @license		MIT License Copyright (c) 2008 Erick Hartanto
 */
class Onesignal
{

    private $error = array();
    public $ci = '';
    public $app_id = '';
    public $url = '';
    public $auth = '';
    public $dev_mode = false;

    function __construct()
    {
        $this->ci = &get_instance();

        $this->ci->load->config('onesignal', TRUE);
        $this->ci->load->library(array('custom_curl', 'ion_auth'));
        $this->ci->load->database();
        //configratin 
        $this->app_id = $this->ci->config->item('app_id');
        $this->auth = $this->ci->config->item('authorization');
        $this->dev_mode = $this->ci->config->item('debug_mode');
        $this->heading = (isset($this->ci->ion_auth->user()->row()->first_name)) ? $this->ci->ion_auth->user()->row()->first_name : 'Sistem Informasi';
        $this->subtitle = 'Notifications';
        $this->content = 'hello world';
    }


    function view_devices($message)
    {

        $fields = array(
            'app_id' => $this->app_id,
            'limit' => 300,
            'offset' => 0,
        );

        // Simple call to CI URI
        $this->ci->custom_curl->create('https://onesignal.com/api/v1/players');
        $this->ci->custom_curl->get(json_encode($fields));
        $this->ci->custom_curl->ssl(FALSE);
        $this->ci->custom_curl->http_header("Authorization", "Basic " . $this->auth);
        $this->ci->custom_curl->http_header('Content-Type', 'application/json');

        $res = $this->ci->custom_curl->execute();

        // $this->ci->custom_curl->debug();
        // echo '<pre>';
        // print_r($fields);
        // echo '<pre>';
        // print_r($res);
        // die;
        if (!$res) {
            if ($this->dev_mode)
                $this->ci->loglib->logall(array('class' => $this->ci->router->fetch_class(), 'method' => $this->ci->router->fetch_method(), 'data' => 'Onesignal No Response.....'));
            return false;
        }
        if ($this->dev_mode)
            $this->ci->loglib->logall(array('class' => $this->ci->router->fetch_class(), 'method' => $this->ci->router->fetch_method(), 'data' => 'Onesignal Success.....', 'message' => $fields, 'responce' => $res));
        $response = json_decode($res, true);
        return $response;
    }
    function view_device($player_id)
    {

        $fields = array(
            'app_id' => $this->app_id,
        );

        // Simple call to CI URI
        $this->ci->custom_curl->create('https://onesignal.com/api/v1/players/' . $player_id);
        $this->ci->custom_curl->get(json_encode($fields));
        $this->ci->custom_curl->ssl(FALSE);
        $this->ci->custom_curl->http_header("Authorization", "Basic " . $this->auth);
        $this->ci->custom_curl->http_header('Content-Type', 'application/json');

        $res = $this->ci->custom_curl->execute();

        // $this->ci->custom_curl->debug();
        // echo '<pre>';
        // print_r($fields);
        // echo '<pre>';
        // print_r($res);
        $data_hasil = json_decode($res);



        $CI = &get_instance();
        $CI->load->model('Users_notifications_model');

        $data = array(
            'last_active_users_notifications' => $data_hasil->last_active,
            // 'badge_count_users_notifications' => $this->input->post('badge_count_users_notifications', TRUE),
            // 'session_count_users_notifications' => $data_hasil->last_active,
            // 'identifier_users_notifications' => $this->input->post('identifier_users_notifications', TRUE),
        );


        $CI->Users_notifications_model->update_where($player_id, $data);

        if (!$res) {
            if ($this->dev_mode)
                $this->ci->loglib->logall(array('class' => $this->ci->router->fetch_class(), 'method' => $this->ci->router->fetch_method(), 'data' => 'Onesignal No Response.....'));
            return false;
        }
        if ($this->dev_mode) {
            $this->ci->loglib->logall(array('class' => $this->ci->router->fetch_class(), 'method' => $this->ci->router->fetch_method(), 'data' => 'Onesignal Success.....', 'message' => $fields, 'responce' => $res));
            return $response = json_decode($res, true);
        } else {
            return $response = json_decode($res, true);
        }
    }
    public function send_notification_user($content, $data, $player_id, $data_notif = NULL, $kategori = NULL, $link = NULL, $label_tag = NULL, $app_id = false, $auth = false, $heading = NULL)
    {
        if ($this->dev_mode)
            $this->ci->loglib->logall(array('class' => $this->ci->router->fetch_class(), 'method' => $this->ci->router->fetch_method(), 'data' => 'Onesignal Starts.....'));
        if (isset($app_id) && $app_id != '') {
            $this->app_id = $app_id;
        }
        if (isset($auth) && $auth != '') {
            $this->auth = $auth;
        }
        if ($heading != NULL) {
            $this->heading = $heading;
        }
        if (isset($subtitle) && $subtitle != '') {
            $this->subtitle = $subtitle;
        }
        if (isset($content) && $content != '') {
            $this->content = $content;
        }
        $this->heading = array(
            "en" => $this->heading,
        );
        $this->subtitle = array(
            "en" => $this->subtitle,
        );
        $this->content = array(
            "en" => $this->content,
        );
        // $big_picture = base_url().'/assets/theme/dist/img/MTV-Logo-200w.png';
        // for single
        if (is_array($player_id)) {
            $device_ids = $player_id;
        } else {
            $device_ids = array($player_id);
        }

        // for multiple from array
        /*$device_ids = array(
        '2c5d007-5985-4ad9-a1d7-f4ec7eb84f00', // device id 1 (register_id from onceSignal)
        '2c5d007-5985-4ad9-a1d7-f4ec7eb84f00'  // device id 1 (register_id from onceSignal)
        ); */

        $fields = array(
            'app_id' => $this->app_id,
            'include_player_ids' => $device_ids,
            'data' => $data,
            'contents' => $this->content,
            // 'included_segments' => "Active Users",
        );

        if (($this->heading)) {
            $fields['headings'] = $this->heading;
        }
        if (($this->subtitle)) {
            $fields['subtitle'] = $this->subtitle;
        }
        if (($this->content)) {
            $fields['contents'] = $this->content;
        }

        // if(($big_picture)){
        //     $fields['big_picture'] = $big_picture;
        // }

        // Simple call to CI URI
        $this->ci->custom_curl->create('https://onesignal.com/api/v1/notifications');
        $this->ci->custom_curl->post(json_encode($fields));
        $this->ci->custom_curl->ssl(FALSE);
        $this->ci->custom_curl->http_header("Authorization", "Basic " . $this->auth);
        $this->ci->custom_curl->http_header('Content-Type', 'application/json');

        if ($player_id == NULL) {
            $res = TRUE;
        } else {
            $res = $this->ci->custom_curl->execute();
        }
        // $this->ci->custom_curl->debug();
        // echo '<pre>';
        // print_r($fields);
        // echo '<pre>';
        // print_r($res);
        // die;

        if ($this->dev_mode) {
            $this->ci->loglib->logall(array('class' => $this->ci->router->fetch_class(), 'method' => $this->ci->router->fetch_method(), 'data' => 'Onesignal Success.....', 'message' => $fields, 'response' => $res));
            $response = json_decode($res, true);
            return $response;
        }
        if (!$res) {
            if ($this->dev_mode) {
                $this->ci->loglib->logall(array('class' => $this->ci->router->fetch_class(), 'method' => $this->ci->router->fetch_method(), 'data' => 'Onesignal No Response.....'));
                return false;
            } else {
                return false;
            }
        } else {
            if (is_array($device_ids)) {
                $device_ids = $player_id;
                $data_notifikasi = json_decode($res, true);

                if ($data_notif != NULL) {
                    $res = TRUE;


                    $CI = &get_instance();
                    $CI->load->model('Log_notifications_model');


                    $tempArray = array_unique(array_column($data_notif, 'nama_users_notifications'));
                    $moreUniqueArray = array_values(array_intersect_key($data_notif, $tempArray));
                    $get_nama_penerima = (array_column($moreUniqueArray, 'nama_users_notifications'));


                    $CI->db->trans_start();
                    foreach ($get_nama_penerima as $key) {
                        if ($this->heading == 'Mesin Absensi') {
                            // do nothing
                        } else {
                            if ($key == 'Hisyam Husein') {
                                // do nothing
                            } else {
                                $data_log = array(
                                    'nama_penerima' => $key,
                                    'kategori' => $kategori,
                                    'isi' => $content,
                                    'link' => $link,
                                    'status' => 'delivery',
                                    'label_tag' => $label_tag,
                                    'create_at' => strtotime('now'),
                                    'create_by' => $this->ci->ion_auth->user()->row()->first_name,
                                );
                                $CI->Log_notifications_model->insert($data_log);
                            }
                        }
                    }
                    $CI->db->trans_complete();
                    return $CI->db->trans_status();
                } else {
                    return true;
                }
            } else {
                $device_ids = array($player_id);
                $data_notifikasi = $this->view_device($player_id);
                if ($data_notif != NULL) {
                    $res = TRUE;
                    $CI = &get_instance();
                    $CI->load->model('Log_notifications_model');


                    $tempArray = array_unique(array_column($data_notif, 'nama_users_notifications'));
                    $moreUniqueArray = array_values(array_intersect_key($data_notif, $tempArray));
                    $get_nama_penerima = (array_column($moreUniqueArray, 'nama_users_notifications'));


                    $CI->db->trans_start();
                    foreach ($get_nama_penerima as $key) {
                        $data_log = array(
                            'nama_penerima' => $key,
                            'kategori' => $kategori,
                            'isi' => $content,
                            'link' => $link,
                            'status' => 'delivery',
                            'label_tag' => $label_tag,
                            'create_at' => strtotime('now'),
                            'create_by' => $this->ci->ion_auth->user()->row()->first_name,
                        );
                        $CI->Log_notifications_model->insert($data_log);
                    }
                    $CI->db->trans_complete();
                    return $CI->db->trans_status();
                } else {
                    return true;
                }
            }
            // $this->Users_notifications_model->update($device_ids, $data_notifikasi);
            // return $data_notifikasi;
        }
    }
    function send_notification($message, $data, $tags = FALSE, $schdule = false, $app_id = false, $auth = false)
    {
        if ($this->dev_mode)
            $this->ci->loglib->logall(array('class' => $this->ci->router->fetch_class(), 'method' => $this->ci->router->fetch_method(), 'data' => 'Onesignal Starts.....'));
        if (isset($app_id) && $app_id != '') {
            $this->app_id = $app_id;
        }
        if (isset($auth) && $auth != '') {
            $this->auth = $auth;
        }
        $content = array(
            "en" => $message,
        );
        $heading = array(
            "en" => 'Sistem Informasi',
        );
        $subtitle = array(
            "en" => 'PT Len Telekomunikasi Indonesia',
        );
        // $big_picture = base_url().'/assets/theme/dist/img/MTV-Logo-200w.png';
        $tag_array = array();
        if (is_array($tags) && !empty($tags)) {
            foreach ($tags as $tag) {
                if (isset($tag['relation']) && $tag['relation'] != '' && isset($tag['key']) && $tag['key'] != '' && isset($tag['value']) && $tag['value'] != '') {
                    $tag_array[] = array(
                        "field" => "tag",
                        "relation" => $tag['relation'],
                        "key" => $tag['key'],
                        "value" => $tag['value'],
                    );
                    $tag_array[] = array("operator" => "OR");
                }
            }
            array_pop($tags);
        }

        $fields = array(
            'app_id' => $this->app_id,
            'data' => $data,
            'contents' => $content,
            'included_segments' => "Active Users",
        );
        if ($schdule && !empty($schdule)) {
            if (isset($schdule['send_after']))
                $fields['send_after'] = $schdule['send_after'];
            if (isset($schdule['delayed_option']))
                $fields['delayed_option'] = $schdule['delayed_option'];
            if (isset($schdule['delivery_time_of_day']))
                $fields['delivery_time_of_day'] = $schdule['delivery_time_of_day'];
        }
        if (!empty($tag_array)) {
            $fields['tags'] = $tag_array;
        }
        if (($heading)) {
            $fields['headings'] = $heading;
        }
        if (($subtitle)) {
            $fields['subtitle'] = $subtitle;
        }
        // if(($big_picture)){
        //     $fields['big_picture'] = $big_picture;
        // }

        // Simple call to CI URI
        $this->ci->custom_curl->create('https://onesignal.com/api/v1/notifications');
        $this->ci->custom_curl->post(json_encode($fields));
        $this->ci->custom_curl->ssl(FALSE);
        $this->ci->custom_curl->http_header("Authorization", "Basic " . $this->auth);
        $this->ci->custom_curl->http_header('Content-Type', 'application/json');

        $res = $this->ci->custom_curl->execute();
        // $this->ci->custom_curl->debug();
        // echo '<pre>';print_r($fields);
        // echo '<pre>';print_r($res);
        // die;
        if ($this->dev_mode)
            $this->ci->loglib->logall(array('class' => $this->ci->router->fetch_class(), 'method' => $this->ci->router->fetch_method(), 'data' => 'Onesignal Success.....', 'message' => $fields, 'responce' => $res));
        $response = json_decode($res, true);
        return $response;
        if (!$res) {
            if ($this->dev_mode)
                $this->ci->loglib->logall(array('class' => $this->ci->router->fetch_class(), 'method' => $this->ci->router->fetch_method(), 'data' => 'Onesignal No Response.....'));
            return false;
        } else {
            return true;
        }
    }

    function cancel_notification($id, $app_id = false, $auth = false)
    {
        if ($this->dev_mode)
            $this->ci->loglib->logall(array('class' => $this->ci->router->fetch_class(), 'method' => $this->ci->router->fetch_method(), 'data' => 'Onesignal Starts.....'));
        if (isset($app_id) && $app_id != '') {
            $this->app_id = $app_id;
        }
        if (isset($auth) && $auth != '') {
            $this->auth = $auth;
        }
        $fields = array(
            'app_id' => $this->app_id,
        );

        // Simple call to CI URI
        $this->ci->custom_curl->create('https://onesignal.com/api/v1/notifications/' . $id);
        $this->ci->custom_curl->delete($fields);
        $this->ci->custom_curl->ssl(FALSE);
        $this->ci->custom_curl->http_header("Authorization", "Basic " . $this->auth);
        //  $this->ci->custom_curl->http_header('Content-Type', 'application/json');

        $res = $this->ci->custom_curl->execute();
        if (!$res) {
            if ($this->dev_mode)
                $this->ci->loglib->logall(array('class' => $this->ci->router->fetch_class(), 'method' => $this->ci->router->fetch_method(), 'data' => 'Onesignal No Response.....'));
            return false;
        }
        if ($this->dev_mode)
            $this->ci->loglib->logall(array('class' => $this->ci->router->fetch_class(), 'method' => $this->ci->router->fetch_method(), 'data' => 'Onesignal Success.....', 'message' => $fields, 'responce' => $res));
        $response = json_decode($res, true);
        if (!empty($response) && isset($response['success']) && $response['success'] == true) {
            return true;
        } else {
            return false;
        }
    }
}

/* End of file onesignal.php */
/* Location: ./application/libraries/Onesignal.php */