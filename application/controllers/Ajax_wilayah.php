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
    function getIdProvinceSelect2($id = NULL)
    {
        if ($id == NULL) {
            $id = $this->input->get_post('id');
        } else {
            show_error('AJAX TIDAK VALID');
        }

        $this->db->select('id,UPPER(name) as name');
        $this->db->where('id', $id);
        $data_db = $this->db->get('provinces');


        $object = new stdClass();
        if ($data_db->result()) {
            foreach ($data_db->result() as $data_array) {
                $object->id = $data_array->id;
                $object->text = strtoupper($data_array->name);
            }
            header('Content-Type: application/json');
            echo json_encode($object);
        } else {
            return FALSE;
        }
    }
    function getProvinceSelect2($id = NULL)
    {
        // if ($id == NULL) {
        //     $id = $this->input->get_post('id');
        // } else {
        //     show_error('AJAX TIDAK VALID');
        // }

        $this->db->select('id,UPPER(name) as name');
        // $this->db->where('id', $id);
        $data_db = $this->db->get('provinces');


        $data = array();
        $i = 0;
        if ($data_db->result()) {
            foreach ($data_db->result() as $data_array) {
                $object[$i] = new stdClass();
                $object[$i]->id = $data_array->id;
                $object[$i]->text = strtoupper($data_array->name);
                $i++;
            }
            header('Content-Type: application/json');
            echo json_encode($object);
        } else {
            return FALSE;
        }
    }
    function getIdRegencySelect2($id = NULL)
    {
        if ($id == NULL) {
            $id = $this->input->get_post('id');
        } else {
            show_error('AJAX TIDAK VALID');
        }

        $this->db->select('id,name');
        $data_db = $this->db->get_where('regencies', array('id' => $id));


        $object = new stdClass();
        if ($data_db->result()) {
            foreach ($data_db->result() as $data_array) {
                $object->id = $data_array->id;
                $object->text = strtoupper($data_array->name);
            }
            header('Content-Type: application/json');
            echo json_encode($object);
        } else {
            return FALSE;
        }
    }
    function getIdDistrictSelect2($id = NULL)
    {
        if ($id == NULL) {
            $id = $this->input->get_post('id');
        } else {
            show_error('AJAX TIDAK VALID');
        }

        $this->db->select('id,name');
        $data_db = $this->db->get_where('districts', array('id' => $id));


        $object = new stdClass();
        if ($data_db->result()) {
            foreach ($data_db->result() as $data_array) {
                $object->id = $data_array->id;
                $object->text = strtoupper($data_array->name);
            }
            header('Content-Type: application/json');
            echo json_encode($object);
        } else {
            return FALSE;
        }
    }
}

/* End of file Ajax_wilayah.php */
/* Location: ./application/controllers/Ajax_wilayah.php */
/* Please DO NOT modify this information : */
/* http://hisyambsa.github.io */
