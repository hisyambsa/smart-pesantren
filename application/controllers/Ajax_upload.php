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

class Ajax_upload extends CI_Controller
{

    public function index()
    {
        show_404();
    }

    public function upload($file_to_upload)
    {
        $nama_file = $file_to_upload;
        header('Content-Type: application/json'); // set json response headers
        $outData = $this->upload_action($nama_file); // a function to upload the bootstrap-fileinput files
        echo json_encode($outData); // return json data

        exit(); // terminate
    }
    public function delete($dir, $path)
    {

        header('Content-Type: application/json'); // set json response headers

        if ($this->input->post('key')) {
            if (FCPATH . $path . '/' . $this->input->post('key')) {
                unlink(FCPATH . $dir . '/' . $path . '/' . $this->input->post('key'));
                $preview = [];
                $out = ['initialPreview' => $preview,  'initialPreviewAsData' => true];
            } else {
                $out['error'] = 'GAGAL HAPUS DATA';
            }
            echo json_encode($out);
        }
    }
    public function upload_action($nama_file)
    {
        $preview = $config = $errors = [];
        $input = $nama_file; // the input name for the fileinput plugin

        if (empty($_FILES[$input])) {
            return [];
        }
        // $total = count($_FILES[$input]['name']); // multiple files
        $path = $this->input->post('upload_path');
        $tmpFilePath = $_FILES[$input]['tmp_name']; // the temp file path
        $fileName = $_FILES[$input]['name']; // the file name
        $fileSize = $_FILES[$input]['size']; // the file size

        $nama_file_explode = explode('.', $fileName);


        //Make sure we have a file path
        if ($tmpFilePath != "") {
            //Setup our new file path
            $nama_file_upload = $this->input->post('nama_file') . '.' . end($nama_file_explode);

            if (end($nama_file_explode) == 'pdf') {
                $type_file = 'pdf';
            } else {
                $type_file = 'image';
            }

            $newFilePath = $path . '/' . $nama_file_upload;
            $newFileUrl = base_url($path) . '/' . $nama_file_upload;
            // $newFileUrl = base_url('uploads/dpbj_tor/') . $fileName;
            // $newFileUrl = 'http://localhost/uploads/' . $fileName;

            //Upload the file into the new path
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $fileId = $fileName; // some unique key to identify the file
                $preview[] = $newFileUrl;
                $config[] = [
                    'type' => $type_file,
                    'key' => $nama_file_upload,
                    'caption' => date('d M y H:i:s'),
                    'size' => $fileSize,
                    'downloadUrl' => false, // the url to download the file
                    // 'downloadUrl' => $newFileUrl, // the url to download the file
                    'url' => base_url('ajax_upload/delete/' . $path), // server api to delete the file based on key
                ];
                // $url = "https://apps.smartponpes.id/";

                // // connect to FTP server
                // $ftp_server = "151.106.125.175";
                // $ftp_username = "admin_hisyambsa";
                // $ftp_userpass = "Ipd5FI*pd%xemLkM";
                // $ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");

                // //login to FTP server
                // $login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);
                // if (!$login) {
                //     log_message('error', __CLASS__ . ' baris :' . __LINE__);
                //     $out['error'] = 'terjadi masalah server';
                // }
                // ftp_chdir($ftp_conn, "public_html");
                // ftp_chdir($ftp_conn, "uploads");
                // ftp_chdir($ftp_conn, $path);
                // // upload file
                // if (ftp_put($ftp_conn, $nama_file_upload, "$newFileUrl", FTP_ASCII)) {
                //     $out['error'] = 'Oh snap! We could not upload';
                // }
            } else {
                $errors[] = $fileName;
            }
        }
        $out = ['initialPreview' => $preview, 'initialPreviewConfig' => $config, 'initialPreviewAsData' => true];
        if (!empty($errors)) {

            $img = count($errors) === 1 ? 'file "' . $fileId  . '" ' : 'files: "' . implode('", "', $errors) . '" ';
            $out['error'] = 'Oh snap! We could not upload the ' . $img . 'now. Please try again later.';
        }
        return $out;
    }
    public function upload_action_multiple($nama_file)
    {
        $preview = $config = $errors = [];
        $input = $nama_file; // the input name for the fileinput plugin
        if (empty($_FILES[$input])) {
            return [];
        }
        $total = count($_FILES[$input]['name']); // multiple files
        $path = $this->input->post('upload_path');
        for ($i = 0; $i < $total; $i++) {
            $tmpFilePath = $_FILES[$input]['tmp_name'][$i]; // the temp file path
            $fileName = $_FILES[$input]['name'][$i]; // the file name
            $fileSize = $_FILES[$input]['size'][$i]; // the file size

            $nama_file_explode = explode('.', $fileName);

            //Make sure we have a file path
            if ($tmpFilePath != "") {
                //Setup our new file path
                $nama_file_upload = strtotime('now') . '.' . end($nama_file_explode);

                if (end($nama_file_explode) == 'pdf') {
                    $type_file = 'pdf';
                } else {
                    $type_file = 'image';
                }

                $newFilePath = $path . '/' . $nama_file_upload;
                $newFileUrl = base_url($path) . '/' . $nama_file_upload;
                // $newFileUrl = base_url('uploads/dpbj_tor/') . $fileName;
                // $newFileUrl = 'http://localhost/uploads/' . $fileName;

                //Upload the file into the new path
                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $fileId = $fileName . $i; // some unique key to identify the file
                    $preview[] = $newFileUrl;
                    $config[] = [
                        'type' => $type_file,
                        'key' => $nama_file_upload,
                        'caption' => date('d M y H:i:s'),
                        'size' => $fileSize,
                        'downloadUrl' => false, // the url to download the file
                        // 'downloadUrl' => $newFileUrl, // the url to download the file
                        'url' => base_url('ajax_upload/delete/' . $path), // server api to delete the file based on key
                    ];
                } else {
                    $errors[] = $fileName;
                }
            }
            $out = ['initialPreview' => $preview, 'initialPreviewConfig' => $config, 'initialPreviewAsData' => true];
            if (!empty($errors)) {

                $img = count($errors) === 1 ? 'file "' . $fileId  . '" ' : 'files: "' . implode('", "', $errors) . '" ';
                $out['error'] = 'Oh snap! We could not upload the ' . $img . 'now. Please try again later.';
            }
            return $out;
        }
    }
}
/* End of file Ajax_upload.php */
/* Location: ./application/controllers/Ajax_upload.php */
/* Please DO NOT modify this information : */
/* http://hisyambsa.github.io */
