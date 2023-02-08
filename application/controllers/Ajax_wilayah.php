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

class Ajax_wilayah extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function getProvSelect2()
    {
        $this->db->select('id,UPPER(name) as name');
        $data_db = $this->db->get('provinces');

        header('Content-Type: application/json');
        echo json_encode($data_db->result());
    }
    function getKabSelect2($id)
    {
        $this->db->select('id,name');
        $data_db = $this->db->get_where('regencies', array('province_id' => $id));

        $data = array();
        if ($data_db->result()) {
            foreach ($data_db->result() as $data_array) {
                $data[$data_array->id] = strtoupper($data_array->name);
            }
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            return FALSE;
        }
    }
    function getDistrictsSelect2($id)
    {
        $this->db->select('id,name');
        $data_db = $this->db->get_where('districts', array('regency_id' => $id));

        $data = array();
        if ($data_db->result()) {
            foreach ($data_db->result() as $data_array) {
                $data[$data_array->id] = strtoupper($data_array->name);
            }
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            return FALSE;
        }
    }
    function getVillagesSelect2($id)
    {
        $this->db->select('id,name');
        $data_db = $this->db->get_where('villages', array('district_id' => $id));

        $data = array();
        if ($data_db->result()) {
            foreach ($data_db->result() as $data_array) {
                $data[$data_array->id] = strtoupper($data_array->name);
            }
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            return FALSE;
        }
    }
}

/* End of file Ajax_wilayah.php */
/* Location: ./application/controllers/Ajax_wilayah.php */
/* Please DO NOT modify this information : */
/* http://hisyambsa.github.io */
